<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();

        $perPage = $request->input('entries', 10);
        $search = $request->input('search');

        $alternatif = Pakaian::with(['subKriterias.kriteria'])
            ->when($search, function ($query, $search) {
                $query->where('nama_pakaian', 'like', '%' . $search . '%');
            })
            ->paginate($perPage)
            ->appends($request->query());

        return view('admin.pages.pakaian.index', compact('kriteria', 'alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $kriterias = Kriteria::with('subKriteria')->get(); // load kriteria + sub_kriterias
        return view('admin.pages.pakaian.create', compact('kriterias'));
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
            'sub_kriterias' => 'array|nullable',
        ]);

        DB::beginTransaction();

        try {
            // Upload image jika ada
            $path = null;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('pakaian', 'public');
            }

            // Simpan pakaian
            $pakaian = Pakaian::create([
                'nama_pakaian' => $request->nama_pakaian,
                'harga' => $request->harga,
                'img' => $path,
            ]);

            // Simpan relasi sub kriteria
            if ($request->filled('sub_kriterias')) {
                $pakaian->subKriterias()->sync($request->sub_kriterias);
            }

            DB::commit();

            return redirect()->route('admin.pakaian.index')->with('success', 'Pakaian berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Rollback semua jika ada error
            DB::rollBack();

            // Hapus file yang sudah di-upload jika perlu
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()->with('error', 'Gagal menambahkan pakaian: ' . $e->getMessage());
        }
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
    public function edit($id)
    {
        $pakaian = Pakaian::with('subKriterias')->findOrFail($id);
        $kriterias = Kriteria::with('subKriteria')->get();

        return view('admin.pages.pakaian.edit', compact('pakaian', 'kriterias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pakaian' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'img' => 'nullable|image|max:2048',
            'sub_kriterias' => 'array|nullable',
        ]);

        DB::beginTransaction();

        try {
            $pakaian = Pakaian::findOrFail($id);
            $path = $pakaian->img;

            // Update gambar jika ada file baru
            if ($request->hasFile('img')) {
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
                $path = $request->file('img')->store('pakaian', 'public');
            }

            $pakaian->update([
                'nama_pakaian' => $request->nama_pakaian,
                'harga' => $request->harga,
                'img' => $path,
            ]);

            // Update relasi sub_kriterias
            $pakaian->subKriterias()->sync($request->sub_kriterias ?? []);

            DB::commit();

            return redirect()->route('admin.pakaian.index')->with('success', 'Pakaian berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($path) && $request->hasFile('img') && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()->back()->with('error', 'Gagal memperbarui pakaian: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pakaian = Pakaian::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($pakaian->img && file_exists(public_path($pakaian->img))) {
            unlink(public_path($pakaian->img));
        }

        // Hapus relasi subkriteria (pivot table)
        $pakaian->subKriterias()->detach();

        // Hapus data pakaian dari database
        $pakaian->delete();

        return redirect()->route('admin.pakaian.index')->with('success', 'Data pakaian berhasil dihapus.');
    }
}
