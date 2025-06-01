<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use App\Models\PenilaianPakaian;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10); // Ambil dari query, default ke 10

        $query = PenilaianPakaian::with(['pakaian', 'subKriteria.kriteria']);

        if ($request->has('search') && $request->search != '') {
        $search = $request->get('search');
        $query->where(function ($q) use ($search) {
            // Cari di nama pakaian
            $q->whereHas('pakaian', function ($q1) use ($search) {
                $q1->where('nama_pakaian', 'like', "%$search%");
            })
            // Cari di nama sub kriteria
            ->orWhereHas('subKriteria', function ($q2) use ($search) {
                $q2->where('nama_sub', 'like', "%$search%");
            })
            // Cari di nama kriteria
            ->orWhereHas('subKriteria.kriteria', function ($q3) use ($search) {
                $q3->where('nama_kriteria', 'like', "%$search%");
            });
        });
    }

    $penilaians = $query->paginate($perPage)->appends($request->all());

        return view('admin.pages.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $pakaians = Pakaian::all();
        $subkriterias = SubKriteria::all();
        return view('admin.pages.penilaian.form', compact('pakaians', 'subkriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pakaian_id' => 'required|exists:pakaians,id',
            'sub_kriteria_id' => 'required|exists:sub_kriterias,id',
            'nilai' => 'required|numeric|between:1,5',
        ]);

        // Cek apakah kombinasi sudah ada
        $cek = PenilaianPakaian::where('pakaian_id', $request->pakaian_id)
            ->where('sub_kriteria_id', $request->sub_kriteria_id)
            ->first();

        if ($cek) {
            return redirect()->back()
                ->withErrors(['Data penilaian untuk kombinasi ini sudah ada.'])
                ->withInput();
        }

        PenilaianPakaian::create($request->all());
        $page = $request->input('page', 1); // default page 1 jika tidak ada
        return redirect()->route('admin.penilaian.index', ['page' => $page])
            ->with('success', 'Data penilaian berhasil ditambahkan.');
    }

    public function edit(PenilaianPakaian $penilaian)
    {
        $pakaians = Pakaian::all();
        $subkriterias = SubKriteria::all();
        return view('admin.pages.penilaian.form', compact('penilaian', 'pakaians', 'subkriterias'));
    }

    public function update(Request $request, PenilaianPakaian $penilaian)
    {
        $request->validate([
            'pakaian_id' => 'required|exists:pakaians,id',
            'sub_kriteria_id' => 'required|exists:sub_kriterias,id',
            'nilai' => 'required|numeric|between:1,5',
        ]);

        // Cek jika ada duplikat kombinasi (tapi bukan dirinya sendiri)
        $cek = PenilaianPakaian::where('pakaian_id', $request->pakaian_id)
            ->where('sub_kriteria_id', $request->sub_kriteria_id)
            ->where('id', '!=', $penilaian->id)
            ->first();

        if ($cek) {
            return redirect()->back()
                ->withErrors(['Kombinasi ini sudah digunakan pada data lain.'])
                ->withInput();
        }

        $penilaian->update($request->all());
        $page = $request->input('page', 1);
        return redirect()->route('admin.penilaian.index', ['page' => $page])
            ->with('success', 'Data penilaian berhasil diperbarui.');
    }

    public function destroy(PenilaianPakaian $penilaian)
    {
        $penilaian->delete();
        $page = request()->input('page', 1);
        return redirect()->route('admin.penilaian.index', ['page' => $page])
            ->with('success', 'Data berhasil dihapus.');
            }
}
