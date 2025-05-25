<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pakaian::with('subKriterias.kriteria');

        // Filter berdasarkan nama_pakaian jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_pakaian', 'like', '%' . $request->search . '%');
        }

        // Ambil jumlah per halaman dari parameter 'perPage' atau default ke 10
        $perPage = $request->get('perPage', 10);

        // Ambil data pakaian dengan pagination
        $pakaians = $query->paginate($perPage);

        // Ambil semua data kriteria
        $kriterias = Kriteria::all();

        // Return ke view dengan data yang dibutuhkan
        return view('admin.pages.penilaian.index', compact('pakaians', 'kriterias'));
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
        //
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
        // Ambil data pakaian dengan relasi subKriterias beserta kriteria-nya
        $pakaian = Pakaian::with('subKriterias.kriteria')->findOrFail($id);

        // Ambil semua kriteria, supaya bisa ditampilkan di form edit untuk memilih/mengubah subkriteria
        $kriterias = Kriteria::with('subKriteria')->get();

        // Kirim data ke view edit
        return view('admin.pages.penilaian.edit', compact('pakaian', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pakaian = Pakaian::findOrFail($id);

        // Ambil list kriteria yang multiple select (jenis acara, lokasi, cuaca)
        $multiSelectKriteria = Kriteria::whereIn('nama_kriteria', ['Jenis Acara', 'Lokasi', 'Cuaca'])->pluck('id')->toArray();

        $rules = [];
        $messages = [];

        foreach ($request->input('nilai') as $kriteriaId => $value) {
            if (in_array($kriteriaId, $multiSelectKriteria)) {
                // Kriteria yang multiple select wajib berupa array dengan minimal 1 elemen
                $rules["nilai.$kriteriaId"] = 'required|array|min:1';
                $messages["nilai.$kriteriaId.required"] = 'Harap pilih minimal satu subkriteria untuk kriteria ' . Kriteria::find($kriteriaId)->nama_kriteria;
                $messages["nilai.$kriteriaId.min"] = 'Harap pilih minimal satu subkriteria untuk kriteria ' . Kriteria::find($kriteriaId)->nama_kriteria;
            } else {
                // Kriteria yang single select wajib ada (string / integer)
                $rules["nilai.$kriteriaId"] = 'required';
                $messages["nilai.$kriteriaId.required"] = 'Harap pilih satu subkriteria untuk kriteria ' . Kriteria::find($kriteriaId)->nama_kriteria;
            }
        }

        $validated = $request->validate($rules, $messages);

        // Flatten semua subkriteria dari array nilai (baik single select maupun multi)
        $subKriteriaIds = [];

        foreach ($validated['nilai'] as $kriteriaId => $sub) {
            if (is_array($sub)) {
                $subKriteriaIds = array_merge($subKriteriaIds, $sub);
            } else {
                $subKriteriaIds[] = $sub;
            }
        }

        $subKriteriaIds = array_unique($subKriteriaIds);

        // Sync relasi many-to-many
        $pakaian->subKriterias()->sync($subKriteriaIds);

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
