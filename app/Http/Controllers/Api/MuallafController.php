<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mastercode;
use App\Models\Muallaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class MuallafController extends Controller
{
    /**
     * List all muallafs with optional search
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Muallaf::query();

        if ($search) {
            $query->where('NamaIslam', 'like', "%{$search}%")
                ->orWhere('NamaAsal', 'like', "%{$search}%")
                ->orWhere('NoKP', 'like', "%{$search}%")
                ->orWhere('NoTel1', 'like', "%{$search}%");
        }

        $muallafs = $query->orderBy('Id', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Senarai muallaf berjaya diambil.',
            'data' => $muallafs,
            'count' => $muallafs->count(),
        ]);
    }

    /**
     * Create a new muallaf
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate($this->rules());
            $validated['IdPenggunaMain'] = $validated['IdPenggunaMain'] ?? 0;

            $muallaf = Muallaf::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Muallaf berjaya ditambah.',
                'data' => $muallaf,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ralat validasi.',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Get specific muallaf details
     */
    public function show(string $id)
    {
        try {
            $muallaf = Muallaf::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Maklumat muallaf berjaya diambil.',
                'data' => $muallaf,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Muallaf tidak dijumpai.',
            ], 404);
        }
    }

    /**
     * Update muallaf information
     */
    public function update(Request $request, string $id)
    {
        try {
            $muallaf = Muallaf::findOrFail($id);
            $validated = $request->validate($this->rules());
            $validated['IdPenggunaMain'] = $validated['IdPenggunaMain'] ?? ($muallaf->IdPenggunaMain ?? 0);

            $muallaf->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Muallaf berjaya dikemas kini.',
                'data' => $muallaf->fresh(),
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Muallaf tidak dijumpai.',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ralat validasi.',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Delete muallaf record
     */
    public function destroy(string $id)
    {
        try {
            $muallaf = Muallaf::findOrFail($id);
            $muallaf->delete();

            return response()->json([
                'success' => true,
                'message' => 'Muallaf berjaya dipadam.',
                'data' => null,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Muallaf tidak dijumpai.',
            ], 404);
        }
    }

    /**
     * Validation rules for muallaf
     */
    private function rules(): array
    {
        $mastercodeTable = (new Mastercode())->getTable();
        $hasMastercodeTable = Schema::hasTable($mastercodeTable);

        $jantinaRules = ['nullable', 'string', 'max:10'];
        $daerahRules = ['nullable', 'string', 'max:100'];
        $bankRules = ['nullable', 'string', 'max:20'];

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
            'IdPenggunaMain' => 'nullable|integer|min:0',
            'NamaIslam' => 'required|string|max:150',
            'NamaAsal' => 'nullable|string|max:150',
            'NoKP' => 'nullable|string|max:20',
            'Daerah' => $daerahRules,
            'BilDaftar' => 'nullable|string|max:50',
            'Jantina' => $jantinaRules,
            'Bangsa' => 'nullable|string|max:50',
            'KategoriMuallaf' => 'nullable|string|max:50',
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
            'Pendakwah' => 'nullable|string|max:150',
            'Catatan' => 'nullable|string',
            'Status' => 'nullable|in:A,I',
        ];
    }
}