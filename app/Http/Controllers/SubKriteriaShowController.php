<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaShowController extends Controller
{
    public function indexShow($nama_kriteria)
    {
        $kriteria = Kriteria::where('nama_kriteria', $nama_kriteria)->firstOrFail();
        $subkriterias = SubKriteria::where('kriteria_id', $kriteria->id)->get();
        $kriterias = Kriteria::all();
        return view('admin.pages.subkriteria.index', compact('kriteria', 'subkriterias', 'kriterias'));
    }
}
