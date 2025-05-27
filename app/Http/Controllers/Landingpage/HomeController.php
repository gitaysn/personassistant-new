<?php

namespace App\Http\Controllers\Landingpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAlternatif;
use App\Models\Kriteria;
use App\Models\Pakaian;
use App\Models\QuizHistory;
use App\Models\Subkriteria;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua sub kriteria dan relasinya dengan kriteria
        $subKriteria = SubKriteria::with('kriteria')->get()->groupBy(function ($item) {
            return $item->kriteria->nama_kriteria;
        });

        return view('landingpage.master', [
            'subKriteria' => $subKriteria
        ]);
    }
    public function prosesRekomendasi(Request $request)
{
    $sub_kriterias = $request->input('sub_kriteria'); // [kriteria_id => sub_kriteria_id]

    if (!$sub_kriterias) {
        return back()->with('error', 'Harap pilih semua preferensi terlebih dahulu.');
    }

    $selectedSubs = SubKriteria::whereIn('id', array_values($sub_kriterias))->get()->keyBy('id');
    $allPakaian = Pakaian::with('subKriterias')->get();

    // Step 1: Filter berdasarkan preferensi user
    $filteredPakaian = $allPakaian->filter(function ($pakaian) use ($sub_kriterias, $selectedSubs) {
        foreach ($sub_kriterias as $kriteria_id => $sub_id) {
            if ($kriteria_id == 2) { // Harga (range)
                $harga = $pakaian->harga;
                $sub = $selectedSubs[$sub_id];
                if ($harga < $sub->min_harga || $harga > $sub->max_harga) {
                    return false;
                }
            } elseif ($kriteria_id == 3) { // Jenis Pakaian (C3) WAJIB SAMA
                $match = $pakaian->subKriterias->contains(function ($item) use ($kriteria_id, $sub_id) {
                    return $item->kriteria_id == $kriteria_id && $item->id == $sub_id;
                });
                if (!$match) return false;
            } else {
                // Untuk kriteria lain, cukup memiliki salah satu sub_kriteria
                $match = $pakaian->subKriterias->where('kriteria_id', $kriteria_id)->isNotEmpty();
                if (!$match) return false;
            }
        }
        return true;
    });

    if ($filteredPakaian->isEmpty()) {
        return back()->with('error', 'Tidak ada pakaian yang sesuai dengan preferensi Anda.');
    }

    // Step 2: Siapkan bobot & maksimum nilai
    $kriterias = Kriteria::all()->keyBy('id');
    $maxPerKriteria = [];
    foreach ($kriterias as $kriteria_id => $kriteria) {
        $maxPerKriteria[$kriteria_id] = SubKriteria::where('kriteria_id', $kriteria_id)->max('nilai') ?: 1;
    }

    // Step 3: Hitung skor SAW
    $matrix = [];

    foreach ($filteredPakaian as $pakaian) {
        $score = 0;

        foreach ($kriterias as $kriteria_id => $kriteria) {
            $bobot = $kriteria->bobot;
            $jenis = $kriteria->jenis;

            // Ambil sub_kriteria tertinggi untuk kriteria ini
            $subs = $pakaian->subKriterias->where('kriteria_id', $kriteria_id);
            $sub = $subs->sortByDesc('nilai')->first();

            if ($sub) {
                $nilai = $sub->nilai;
                $max = $maxPerKriteria[$kriteria_id];
                $normal = $jenis == 'COST' ? ($nilai ? $max / $nilai : 0) : $nilai / $max;
                $score += $normal * $bobot;
            }
        }

        $matrix[] = [
            'pakaian' => $pakaian,
            'score' => round($score, 3),
        ];
    }

    $rekomendasi = collect($matrix)->sortByDesc('score')->values();
    return view('landingpage.hasil', compact('rekomendasi'));
}

}
