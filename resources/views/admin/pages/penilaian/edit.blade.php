@extends('admin.layouts.base')

@section('title', 'Edit Penilaian Alternatif')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-grey-800">
        <i class="bi bi-pencil-square"></i> Edit Penilaian Alternatif
    </h1>
</div>

<style>
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 15px;
        max-height: 200px;
        overflow-y: auto;
        background-color: #f9f9f9;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        transition: background-color 0.2s;
    }

    .checkbox-item input[type="checkbox"] {
        margin-right: 10px;
        transform: scale(1.2);
    }

    .checkbox-item:hover {
        background-color: #f0f0f0;
    }

    .form-text.text-muted {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 5px;
    }

    label.cursor-pointer {
        cursor: pointer;
    }
</style>

<div class="card shadow mb-4">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk update penilaian -->
        <form action="{{ route('admin.penilaian.update', $pakaian->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Alternatif -->
            <div class="mb-3">
                <label class="form-label">Nama Pakaian</label>
                <input type="text" class="form-control" value="{{ $pakaian->nama_pakaian }}" readonly>
            </div>

            <div class="row">
                @foreach ($kriterias as $kriteria)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">{{ $kriteria->nama_kriteria }}</label>

                    @if(in_array($kriteria->nama_kriteria, ['Jenis Acara', 'Lokasi', 'Cuaca']))
                        {{-- Checkbox group untuk multiple select --}}
                        <div class="checkbox-group d-flex flex-wrap gap-2">
                            @foreach ($kriteria->subKriteria as $subkriteria)
                                <div class="form-check">
                                    <input type="checkbox" 
                                        name="nilai[{{ $kriteria->id }}][]" 
                                        value="{{ $subkriteria->id }}" 
                                        id="sub_{{ $kriteria->id }}_{{ $subkriteria->id }}"
                                        class="form-check-input"
                                        {{ (isset($nilai[$kriteria->id]) && in_array($subkriteria->id, (array) $nilai[$kriteria->id])) ? 'checked' : '' }}>
                                    <label for="sub_{{ $kriteria->id }}_{{ $subkriteria->id }}" class="form-check-label cursor-pointer">
                                        {{ $subkriteria->nama_sub }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                            <small class="form-text text-muted">Pilih satu atau lebih</small>
                        @else
                            {{-- Dropdown biasa untuk single select --}}
                            <select class="form-control" name="nilai[{{ $kriteria->id }}]" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($kriteria->subKriteria as $subkriteria)
                                    <option value="{{ $subkriteria->id }}"
                                        {{ isset($nilai[$kriteria->id]) && $nilai[$kriteria->id] == $subkriteria->id ? 'selected' : '' }}>
                                        {{ $subkriteria->nama_sub }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn" style="background-color: #064E3B; color: white;">
                Simpan
            </button>
            <a href="{{ route('admin.penilaian.index') }}" class="btn" style="background-color: #90ee90; color: black;">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
