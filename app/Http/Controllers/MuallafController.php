<?php

namespace App\Http\Controllers;

use App\Models\Mastercode;
use App\Models\Muallaf;
use App\Models\UploadFileMuallaf;
use Illuminate\Http\Request;

class MuallafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        
        $query = Muallaf::query();
        
        if ($search) {
            $query->where('NamaIslam', 'like', "%{$search}%")
                  ->orWhere('NamaAsal', 'like', "%{$search}%")
                  ->orWhere('NoKP', 'like', "%{$search}%")
                  ->orWhere('NoTel1', 'like', "%{$search}%");
        }
        
        $muallafs = $query->orderBy('Id', 'desc')->get();
        
        return view('muallafs.index', compact('muallafs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        [$jantinaOptions, $daerahOptions, $bankOptions] = $this->getMastercodeOptions();

        return view('muallafs.create', compact('jantinaOptions', 'daerahOptions', 'bankOptions'));
    }

    /**
     * Store is handled by API Controller
     * @deprecated Use API endpoint POST /api/muallafs instead
     */
    public function store(Request $request)
    {
        abort(405, 'Method Not Allowed. Use API endpoint POST /api/muallafs');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $muallaf = Muallaf::findOrFail($id);

        $jantinaLabel = $this->resolveMastercodeDescription('JANTINA', $muallaf->Jantina);
        $daerahLabel = $this->resolveMastercodeDescription('DAERAH', $muallaf->Daerah);
        $bankLabel = $this->resolveMastercodeDescription('BANK', $muallaf->KodBank);
        $lampiranTypeLabels = [
            'NOKP' => 'Lampiran NoKP',
            'KAD_ISLAM' => 'Lampiran Kad Islam',
            'AKAUN_BANK' => 'Lampiran Akaun Bank',
            'SURAT_BERMAUSTATIN' => 'Lampiran Surat Bermaustatin',
        ];

        try {
            $lampiranMuallaf = UploadFileMuallaf::query()
                ->where('REFNO', $muallaf->Id)
                ->where('TYPE', 'MUALLAF')
                ->orderBy('ORDERNO')
                ->get();
        } catch (\Throwable $e) {
            $lampiranMuallaf = collect();
        }

        return view('muallafs.show', compact('muallaf', 'jantinaLabel', 'daerahLabel', 'bankLabel', 'lampiranMuallaf', 'lampiranTypeLabels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $muallaf = Muallaf::findOrFail($id);
        [$jantinaOptions, $daerahOptions, $bankOptions] = $this->getMastercodeOptions();

        return view('muallafs.edit', compact('muallaf', 'jantinaOptions', 'daerahOptions', 'bankOptions'));
    }

    /**
     * Get active mastercode options for muallaf form.
     */
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

    /**
     * Resolve mastercode description by category and code.
     */
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

    /**
     * Update is handled by API Controller
     * @deprecated Use API endpoint PUT /api/muallafs/{id} instead
     */
    public function update(Request $request, string $id)
    {
        abort(405, 'Method Not Allowed. Use API endpoint PUT /api/muallafs/' . $id);
    }

    /**
     * Delete is handled by API Controller
     * @deprecated Use API endpoint DELETE /api/muallafs/{id} instead
     */
    public function destroy(string $id)
    {
        abort(405, 'Method Not Allowed. Use API endpoint DELETE /api/muallafs/' . $id);
    }
}
