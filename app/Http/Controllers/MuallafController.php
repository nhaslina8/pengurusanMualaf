<?php

namespace App\Http\Controllers;

use App\Models\Muallaf;
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
        return view('muallafs.create');
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
        return view('muallafs.show', compact('muallaf'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $muallaf = Muallaf::findOrFail($id);
        return view('muallafs.edit', compact('muallaf'));
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
