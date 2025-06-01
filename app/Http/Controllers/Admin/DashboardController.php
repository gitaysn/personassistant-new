<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAlternatif;
use App\Models\Kriteria;
use App\Models\Pakaian;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use App\Models\SubKriteria as ModelsSubKriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $totalPakaian = Pakaian::count();
        $totalKriteria = Kriteria::count();
        $totalSubKriteria = Subkriteria::count();

        // Dapatkan jumlah penilaian berdasarkan kriteria
        $dataPenilaianPerKriteria = Kriteria::with('subKriteria.penilaians')->get()->map(function ($kriteria) {
            return [
                'label' => $kriteria->nama_kriteria, // sesuaikan jika nama kolomnya ini
                'jumlah' => $kriteria->subKriteria->sum(fn($sub) => $sub->penilaians->count())
            ];
        });

        return view('admin.pages.dashboard.index', compact(
            'totalKriteria', 
            'totalSubKriteria', 
            'totalPakaian', 
            'dataPenilaianPerKriteria'
        ));
    }
}
