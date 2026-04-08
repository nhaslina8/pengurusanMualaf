<?php

namespace App\Http\Controllers;

use App\Models\Mastercode;
use App\Models\Pendakwah;

class PendakwahController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Pendakwah::query();

        if ($search) {
            $query->where('NamaIslam', 'like', "%{$search}%")
                ->orWhere('NamaAsal', 'like', "%{$search}%")
                ->orWhere('NoKP', 'like', "%{$search}%")
                ->orWhere('NoTel1', 'like', "%{$search}%");
        }

        $pendakwahs = $query->orderBy('Id', 'desc')->get();

        return view('pendakwahs.index', compact('pendakwahs', 'search'));
    }

    public function create()
    {
        [$jantinaOptions, $daerahOptions, $bankOptions] = $this->getMastercodeOptions();

        return view('pendakwahs.create', compact('jantinaOptions', 'daerahOptions', 'bankOptions'));
    }

    public function store()
    {
        abort(405, 'Method Not Allowed. Use API endpoint POST /api/pendakwahs');
    }

    public function show(string $id)
    {
        $pendakwah = Pendakwah::with(['lantikans' => function ($query) {
            $query->orderByDesc('Tahun')->orderByDesc('Id');
        }])->findOrFail($id);

        $jantinaLabel = $this->resolveMastercodeDescription('JANTINA', $pendakwah->Jantina);
        $daerahLabel = $this->resolveMastercodeDescription('DAERAH', $pendakwah->Daerah);
        $bankLabel = $this->resolveMastercodeDescription('BANK', $pendakwah->KodBank);

        return view('pendakwahs.show', compact('pendakwah', 'jantinaLabel', 'daerahLabel', 'bankLabel'));
    }

    public function edit(string $id)
    {
        $pendakwah = Pendakwah::with(['lantikans' => function ($query) {
            $query->orderByDesc('Tahun')->orderByDesc('Id');
        }])->findOrFail($id);

        [$jantinaOptions, $daerahOptions, $bankOptions] = $this->getMastercodeOptions();

        return view('pendakwahs.edit', compact('pendakwah', 'jantinaOptions', 'daerahOptions', 'bankOptions'));
    }

    public function update(string $id)
    {
        abort(405, 'Method Not Allowed. Use API endpoint PUT /api/pendakwahs/' . $id);
    }

    public function destroy(string $id)
    {
        abort(405, 'Method Not Allowed. Use API endpoint DELETE /api/pendakwahs/' . $id);
    }

    private function getMastercodeOptions(): array
    {
        try {
            $records = Mastercode::query()
                ->select(['Category', 'Code', 'Description', 'OrderNo'])
                ->whereIn('Category', ['JANTINA', 'DAERAH', 'BANK'])
                ->where('Status', 'Y')
                ->orderBy('Category')
                ->orderBy('OrderNo')
                ->get()
                ->groupBy('Category');

            return [
                $records->get('JANTINA', collect()),
                $records->get('DAERAH', collect()),
                $records->get('BANK', collect()),
            ];
        } catch (\Throwable $e) {
            return [collect(), collect(), collect()];
        }
    }

    private function resolveMastercodeDescription(string $category, ?string $code): ?string
    {
        if (empty($code)) {
            return null;
        }

        try {
            return Mastercode::query()
                ->where('Category', $category)
                ->where('Code', $code)
                ->where('Status', 'Y')
                ->value('Description');
        } catch (\Throwable $e) {
            return null;
        }
    }
}
