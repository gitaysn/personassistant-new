<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pakaian;
use Illuminate\Http\Request;

class PakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();

        // Ambil relasi pakaian dan subkriteria dengan kriteria-nya
        $query = Pakaian::with(['subKriterias.kriteria']);

        // Filter search nama pakaian
        if ($request->filled('search')) {
            $query->where('nama_pakaian', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('entries', 10);
        $alternatif = $query->paginate($perPage)->appends($request->query());

        return view('admin.pages.pakaian.index', compact('kriteria', 'alternatif'));
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
        $request->validate([
            'nama_pakaian' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'img' => 'nullable|image|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('uploads/pakaian', 'public');
        }

        $pakaian = Pakaian::create([
            'nama_pakaian' => $request->nama_pakaian,
            'harga' => $request->harga,
            'img' => $imgPath ? 'storage/' . $imgPath : null,
        ]);

        // Simpan relasi subkriteria (many-to-many)
        $pakaian->subKriterias()->sync($request->subkriterias);

        return redirect()->route('admin.pakaian.index')->with('success', 'Data pakaian berhasil ditambahkan.');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pakaian' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pakaian = Pakaian::findOrFail($id);
        $pakaian->nama_pakaian = $request->nama_pakaian;
        $pakaian->harga = $request->harga;

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {
            if ($pakaian->img && file_exists(public_path($pakaian->img))) {
                unlink(public_path($pakaian->img));
            }

            $file = $request->file('gambar');
            $path = 'uploads/pakaian/';
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $pakaian->img = $path . $filename;
        }

        $pakaian->save();

        return redirect()->back()->with('success', 'Data pakaian berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
