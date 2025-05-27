@extends('admin.layouts.base')

@section('title', 'Tambah Pakaian')

@section('content')

    <div class=" py-4">
        <div class="card shadow-sm border-0 mx-auto">
            <div class="card-header bg-success text-white d-flex align-items-center">
                <i class="bi bi-plus-circle me-2 fs-5"></i>
                <h5 class="mb-0">Tambah Pakaian</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.pakaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                        <label class="form-label fw-semibold">Pilih Sub Kriteria</label>

                        <div class="border rounded px-3 py-2" style="max-height: 300px; overflow-y: auto;">
                            @foreach ($kriterias as $kriteria)
                                <div class="mb-3">
                                    <h6 class="text-primary">{{ $kriteria->nama_kriteria }}</h6>

                                    @foreach ($kriteria->subKriteria as $sub)
                                        <div class="form-check mb-2 ms-3">
                                            <input class="form-check-input" type="checkbox" name="sub_kriterias[]"
                                                value="{{ $sub->id }}" id="sub_{{ $sub->id }}"
                                                data-kriteria="{{ $kriteria->nama_kriteria }}"
                                                onclick="handleSingleChoice(this)">
                                            <label class="form-check-label" for="sub_{{ $sub->id }}">
                                                <strong>{{ $sub->nama_sub }}</strong>
                                                @if ($kriteria->nama_kriteria === 'Harga')
                                                    <div class="text-muted small">
                                                        Min: Rp {{ number_format($sub->min_harga, 0, ',', '.') }},
                                                        Max: Rp {{ number_format($sub->max_harga, 0, ',', '.') }}
                                                    </div>
                                                @else
                                                    <div class="text-muted small">Nilai: {{ $sub->nilai }}</div>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            {{-- SCRIPT UNTUK MEMILIH 1 checkbox --}}
                            @push('scripts')
                                <script>
                                    function handleSingleChoice(checkbox) {
                                        const singleChoiceKriterias = ['Harga', 'Jenis Pakaian'];

                                        const kriteria = checkbox.getAttribute('data-kriteria');
                                        if (singleChoiceKriterias.includes(kriteria)) {
                                            const checkboxes = document.querySelectorAll(`input[data-kriteria="${kriteria}"]`);
                                            checkboxes.forEach(cb => {
                                                if (cb !== checkbox) cb.checked = false;
                                            });
                                        }
                                    }
                                </script>
                            @endpush
                            @stack('scripts')

                        </div>
                    </div>


                    <div class="d-flex justify-content-between pt-3">
                        <a href="{{ route('admin.pakaian.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
