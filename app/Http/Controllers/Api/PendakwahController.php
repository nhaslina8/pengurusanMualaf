<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AkaunPenggunaMain;
use App\Models\LantikanPendakwah;
use App\Models\Mastercode;
use App\Models\Pendakwah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PendakwahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Pendakwah::query();

        if ($search) {
            $query->where('NamaIslam', 'like', "%{$search}%")
                ->orWhere('NamaAsal', 'like', "%{$search}%")
                ->orWhere('NoKP', 'like', "%{$search}%")
                ->orWhere('NoTel1', 'like', "%{$search}%");
        }

        $pendakwahs = $query->orderBy('Id', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Senarai pendakwah berjaya diambil.',
            'data' => $pendakwahs,
            'count' => $pendakwahs->count(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate($this->rules());

            $pendakwah = DB::transaction(function () use ($validated) {
                $payload = $this->extractPendakwahPayload($validated);
                $payload['IdAkaunPengguna'] = $this->resolveIdAkaunPengguna($payload['IdAkaunPengguna'] ?? null);

                $pendakwah = Pendakwah::create($payload);
                $this->syncLantikans($pendakwah, $validated['lantikans'] ?? []);

                return $pendakwah->fresh(['lantikans']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Pendakwah berjaya ditambah.',
                'data' => $pendakwah,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ralat validasi.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Gagal simpan pendakwah.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Ralat semasa menyimpan rekod pendakwah.',
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $pendakwah = Pendakwah::with(['lantikans' => function ($query) {
                $query->orderByDesc('Tahun')->orderByDesc('Id');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Maklumat pendakwah berjaya diambil.',
                'data' => $pendakwah,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pendakwah tidak dijumpai.',
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $pendakwah = Pendakwah::findOrFail($id);
            $validated = $request->validate($this->rules());

            DB::transaction(function () use ($pendakwah, $validated) {
                $payload = $this->extractPendakwahPayload($validated);
                $payload['IdAkaunPengguna'] = array_key_exists('IdAkaunPengguna', $payload)
                    ? $this->resolveIdAkaunPengguna($payload['IdAkaunPengguna'])
                    : $this->resolveIdAkaunPengguna($pendakwah->IdAkaunPengguna ?? null);

                $pendakwah->update($payload);
                $this->syncLantikans($pendakwah->fresh(), $validated['lantikans'] ?? []);
            });

            return response()->json([
                'success' => true,
                'message' => 'Pendakwah berjaya dikemas kini.',
                'data' => $pendakwah->fresh(['lantikans']),
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pendakwah tidak dijumpai.',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ralat validasi.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Gagal kemas kini pendakwah.', ['error' => $e->getMessage(), 'id' => $id]);

            return response()->json([
                'success' => false,
                'message' => 'Ralat semasa mengemas kini rekod pendakwah.',
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $pendakwah = Pendakwah::findOrFail($id);

            DB::transaction(function () use ($pendakwah) {
                LantikanPendakwah::query()->where('IdPendakwah', $pendakwah->Id)->delete();
                $pendakwah->delete();
            });

            return response()->json([
                'success' => true,
                'message' => 'Pendakwah berjaya dipadam.',
                'data' => null,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pendakwah tidak dijumpai.',
            ], 404);
        }
    }

    private function rules(): array
    {
        $mastercodeTable = (new Mastercode())->getTable();
        $hasMastercodeTable = Schema::hasTable($mastercodeTable);
        $akaunPenggunaTable = (new AkaunPenggunaMain())->getTable();
        $hasAkaunPenggunaTable = Schema::hasTable($akaunPenggunaTable);

        $jantinaRules = ['nullable', 'string', 'max:10'];
        $daerahRules = ['nullable', 'string', 'max:100'];
        $bankRules = ['nullable', 'string', 'max:20'];
        $idAkaunPenggunaRules = ['nullable', 'integer', 'min:1'];

        if ($hasAkaunPenggunaTable) {
            $idAkaunPenggunaRules[] = Rule::exists($akaunPenggunaTable, 'Id');
        }

        if ($hasMastercodeTable) {
            $jantinaRules[] = Rule::exists($mastercodeTable, 'Code')
                ->where(fn ($query) => $query
                    ->where('Category', 'JANTINA')
                    ->where('Status', 'Y'));

            $daerahRules[] = Rule::exists($mastercodeTable, 'Code')
                ->where(fn ($query) => $query
                    ->where('Category', 'DAERAH')
                    ->where('Status', 'Y'));

            $bankRules[] = Rule::exists($mastercodeTable, 'Code')
                ->where(fn ($query) => $query
                    ->where('Category', 'BANK')
                    ->where('Status', 'Y'));
        }

        return [
            'IdAkaunPengguna' => $idAkaunPenggunaRules,
            'NamaIslam' => 'required|string|max:150',
            'NamaAsal' => 'nullable|string|max:150',
            'NoKP' => 'nullable|string|max:20',
            'Daerah' => $daerahRules,
            'Jantina' => $jantinaRules,
            'Bangsa' => 'nullable|string|max:50',
            'Kategori' => 'nullable|string|max:50',
            'NoTel1' => 'nullable|string|max:20',
            'TarikhIslam' => 'nullable|date',
            'Alamat1' => 'nullable|string|max:200',
            'Alamat2' => 'nullable|string|max:200',
            'Alamat3' => 'nullable|string|max:200',
            'Poskod' => 'nullable|string|max:10',
            'Bandar' => 'nullable|string|max:100',
            'Negeri' => 'nullable|string|max:100',
            'KodBank' => $bankRules,
            'NoAkaunBank' => 'nullable|string|max:50',
            'Catatan' => 'nullable|string',
            'Status' => 'nullable|in:Y,N',
            'lantikans' => 'sometimes|array',
            'lantikans.*.Tahun' => 'nullable|integer|min:1900|max:2100',
            'lantikans.*.TarikhMula' => 'nullable|date',
            'lantikans.*.TarikhAkhir' => 'nullable|date|after_or_equal:lantikans.*.TarikhMula',
            'lantikans.*.Catatan' => 'nullable|string',
            'lantikans.*.Status' => 'nullable|in:Y,N',
        ];
    }

    private function extractPendakwahPayload(array $validated): array
    {
        unset($validated['lantikans']);

        return $validated;
    }

    private function normalizeIdAkaunPengguna($value): ?int
    {
        if ($value === null || $value === '' || (int) $value <= 0) {
            return null;
        }

        return (int) $value;
    }

    private function resolveIdAkaunPengguna($value): int
    {
        $normalized = $this->normalizeIdAkaunPengguna($value);
        if ($normalized !== null) {
            return $normalized;
        }

        try {
            $fallbackId = (int) (AkaunPenggunaMain::query()->orderBy('Id')->value('Id') ?? 0);
        } catch (\Throwable $e) {
            $fallbackId = 0;
        }

        if ($fallbackId > 0) {
            return $fallbackId;
        }

        throw ValidationException::withMessages([
            'IdAkaunPengguna' => ['Id akaun pengguna diperlukan dan mesti wujud dalam AkaunPenggunaMain.'],
        ]);
    }

    private function syncLantikans(Pendakwah $pendakwah, array $lantikans): void
    {
        LantikanPendakwah::query()->where('IdPendakwah', $pendakwah->Id)->delete();

        foreach ($lantikans as $lantikan) {
            $tahun = $lantikan['Tahun'] ?? null;
            $tarikhMula = $lantikan['TarikhMula'] ?? null;
            $tarikhAkhir = $lantikan['TarikhAkhir'] ?? null;
            $catatan = $lantikan['Catatan'] ?? null;
            $status = $lantikan['Status'] ?? 'Y';

            if (empty($tahun) && empty($tarikhMula) && empty($tarikhAkhir) && empty($catatan)) {
                continue;
            }

            LantikanPendakwah::create([
                'IdPendakwah' => $pendakwah->Id,
                'Tahun' => $tahun,
                'TarikhMula' => $tarikhMula,
                'TarikhAkhir' => $tarikhAkhir,
                'Catatan' => $catatan,
                'Status' => $status,
            ]);
        }
    }
}
