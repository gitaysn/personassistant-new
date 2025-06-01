@extends('admin.layouts.base')

@section('title', 'Tambah Pakaian')

@section('content')
    <div class="py-4">
        <div class="card shadow-sm border-0 mx-auto">
            <div class="card-header text-white d-flex align-items-center" style="background-color: #14532d;">
                <h5 class="mb-0">Tambah Pakaian</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.pakaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="page" value="{{ request()->input('page') }}">

                    <div class="mb-3">
                        <label for="nama_pakaian" class="form-label fw-semibold">Nama Pakaian</label>
                        <input type="text" name="nama_pakaian" id="nama_pakaian" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label fw-semibold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label fw-semibold">Upload Gambar</label>
                        <input type="file" name="img" id="img" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi pakaian..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Sub Kriteria</label>
                        <div class="border rounded px-3 py-2" style="max-height: 300px; overflow-y: auto;">
                            @foreach ($kriterias as $kriteria)
                                <div class="mb-3">
                                    <h6 style="color: #14532d;">{{ $kriteria->nama_kriteria }}</h6>
                                    @foreach ($kriteria->subKriteria as $sub)
                                        @php
                                            $isRadio = in_array($kriteria->nama_kriteria, ['Harga', 'Jenis Pakaian']);
                                            $inputType = $isRadio ? 'radio' : 'checkbox';
                                            $inputName = $isRadio ? 'sub_kriterias[' . $kriteria->id . ']' : 'sub_kriterias[]';
                                        @endphp
                                        <div class="form-check mb-2 ms-3">
                                            <input
                                                class="form-check-input"
                                                type="{{ $inputType }}"
                                                name="{{ $inputName }}"
                                                value="{{ $sub->id }}"
                                                id="sub_{{ $sub->id }}"
                                                data-kriteria="{{ $kriteria->nama_kriteria }}"
                                            >
                                            <label class="form-check-label" for="sub_{{ $sub->id }}">
                                                <strong>{{ $sub->nama_sub }}</strong>
                                                @if ($kriteria->nama_kriteria === 'Harga')
                                                    <div class="text-muted small">
                                                        Min: Rp {{ number_format($sub->min_harga, 0, ',', '.') }},
                                                        Max: Rp {{ number_format($sub->max_harga, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                        <a href="{{ route('admin.pakaian.index', ['page' => request('page')]) }}"
                           class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn text-white" style="background-color: #14532d;">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        .form-check-input[type="checkbox"],
        .form-check-input[type="radio"] {
            accent-color: #14532d;
        }

        .form-check-input:checked {
            background-color: #14532d;
            border-color: #14532d;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(20, 83, 45, 0.25);
            border-color: #14532d;
        }
    </style>
@endpush
