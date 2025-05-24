<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('admin.pages.kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // 👈 akan menampilkan semua input form dan menghentikan proses

        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'jenis' => 'required',
        ]);

        try {
            Kriteria::create([
                'kode_kriteria' => $request->kode_kriteria,
                'nama_kriteria' => $request->nama_kriteria,
                'bobot' => $request->bobot,
                'jenis' => $request->jenis,
            ]);
            return redirect()->route('admin.kriteria.index')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $kriteria = Kriteria::findOrFail($id);
        // return view('admin.kriteria.show', compact('kriteria'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('admin.pages.kriteria.edit', compact('kriteria'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'jenis' => 'required',
        ]);

        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->update([
                'kode_kriteria' => $request->kode_kriteria,
                'nama_kriteria' => $request->nama_kriteria,
                'bobot' => $request->bobot,
                'jenis' => $request->jenis,
            ]);
            return redirect()->route('admin.kriteria.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();
            return redirect()->route('admin.kriteria.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
