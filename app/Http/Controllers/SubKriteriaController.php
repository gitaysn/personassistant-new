<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubKriteria;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria_id = $request->query('kriteria_id');

        if (!$kriteria_id) {
            return redirect()->back()->with('error', 'ID Kriteria tidak ditemukan.');
        }

        $kriteria = Kriteria::findOrFail($kriteria_id);
        $subkriterias = SubKriteria::where('kriteria_id', $kriteria_id)->get();

        return view('admin.subkriteria.index', compact('kriteria', 'subkriterias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kriteria_id' => 'required',
            'nama_sub' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1|max:5',
            'min_harga' => 'nullable|numeric|min:0',
            'max_harga' => 'nullable|numeric|min:0|gte:min_harga',
        ]);

        // Simpan data
        SubKriteria::create([
            'kriteria_id' => $validated['kriteria_id'],
            'nama_sub' => $validated['nama_sub'],
            'nilai' => $validated['nilai'],
            'min_harga' => $validated['min_harga'] ?? null,
            'max_harga' => $validated['max_harga'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Subkriteria berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'nama_sub' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1|max:5',
            'min_harga' => 'nullable|numeric',
            'max_harga' => 'nullable|numeric',
        ]);

        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'nama_sub' => $request->nama_sub,
            'nilai' => $request->nilai,
            'min_harga' => $request->min_harga,
            'max_harga' => $request->max_harga,
        ]);

        return redirect()->back()->with('success', 'Subkriteria berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->delete();

        return redirect()->back()->with('success', 'Subkriteria berhasil dihapus.');
    }
}
