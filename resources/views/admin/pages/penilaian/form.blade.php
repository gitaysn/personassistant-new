@extends('admin.layouts.base')

@section('title', isset($penilaian) ? 'Edit Data Penilaian' : 'Tambah Data Penilaian')

@section('content')
<h1 class="h3 mb-4 text-grey-800">
    <i class="bi bi-database"></i> Data Penilaian
</h1>

<div class="card shadow mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold" style="color: #14532d;">
            {{ isset($penilaian) ? 'Edit Data Penilaian' : '+ Tambah Data Penilaian' }}
        </span>

        <a href="{{ route('admin.penilaian.index', ['page' => request('page')]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form 
            action="{{ isset($penilaian) ? route('admin.penilaian.update', $penilaian->id) : route('admin.penilaian.store') }}" 
            method="POST">
            @csrf
            @if (isset($penilaian))
                @method('PUT')
            @endif

            <div class="row">
                <!-- Pilih Pakaian -->
                <div class="col-md-6 mb-3">
                    <label for="pakaian_id" class="form-label">Nama Pakaian</label>
                    <select class="form-control" id="pakaian_id" name="pakaian_id" required>
                        <option value="" disabled {{ old('pakaian_id', $penilaian->pakaian_id ?? '') == '' ? 'selected' : '' }}>-- Pilih Pakaian --</option>
                        @foreach ($pakaians as $pakaian)
                            <option value="{{ $pakaian->id }}"
                                {{ old('pakaian_id', $penilaian->pakaian_id ?? '') == $pakaian->id ? 'selected' : '' }}>
                                {{ $pakaian->nama_pakaian }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Sub Kriteria -->
                <div class="col-md-6 mb-3">
                    <label for="sub_kriteria_id" class="form-label">Sub Kriteria</label>
                    <select class="form-control" id="sub_kriteria_id" name="sub_kriteria_id" required>
                        <option value="" disabled {{ old('sub_kriteria_id', $penilaian->sub_kriteria_id ?? '') == '' ? 'selected' : '' }}>-- Pilih Sub Kriteria --</option>
                        @foreach ($subkriterias as $sub)
                            <option value="{{ $sub->id }}"
                                {{ old('sub_kriteria_id', $penilaian->sub_kriteria_id ?? '') == $sub->id ? 'selected' : '' }}>
                                {{ $sub->nama_sub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nilai -->
                <div class="col-md-6 mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <select class="form-control" name="nilai" id="nilai" required>
                        <option value="" disabled {{ old('nilai', $penilaian->nilai ?? '') === '' ? 'selected' : '' }}>-- Pilih Nilai --</option>
                        <option value="1" {{ old('nilai', $penilaian->nilai ?? '') == '1' ? 'selected' : '' }}>1 - Sangat Tidak Cocok</option>
                        <option value="2" {{ old('nilai', $penilaian->nilai ?? '') == '2' ? 'selected' : '' }}>2 - Tidak Cocok</option>
                        <option value="3" {{ old('nilai', $penilaian->nilai ?? '') == '3' ? 'selected' : '' }}>3 - Cukup Cocok</option>
                        <option value="4" {{ old('nilai', $penilaian->nilai ?? '') == '4' ? 'selected' : '' }}>4 - Cocok</option>
                        <option value="5" {{ old('nilai', $penilaian->nilai ?? '') == '5' ? 'selected' : '' }}>5 - Sangat Cocok</option>
                    </select>
                </div>

                <div class="col-md-12 d-flex justify-content-between mt-3">
                    <div>
                        {{-- Tambahkan input hidden untuk simpan halaman --}}
                       <input type="hidden" name="page" value="{{ request('page') }}">

                        <button type="submit" class="btn" style="background-color: #064E3B; color: white;">
                           {{ isset($penilaian) ? 'Update' : 'Simpan' }}
                        </button>

                        <button type="reset" class="btn" style="background-color: #90ee90; color: black;">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </button>
                    </div>
                </div>

        </form>
    </div>
</div>
@endsection
