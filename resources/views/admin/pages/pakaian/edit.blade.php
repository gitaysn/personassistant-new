@extends('admin.layouts.base')

@section('title', 'Edit Pakaian')

@section('content')
    <div class="py-4">
        <div class="card shadow-sm border-0 mx-auto">
            <div class="card-header bg-warning text-white d-flex align-items-center">
                <i class="bi bi-pencil-square me-2 fs-5"></i>
                <h5 class="mb-0">Edit Pakaian</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.pakaian.update', $pakaian->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pakaian</label>
                        <input type="text" name="nama_pakaian" class="form-control"
                            value="{{ old('nama_pakaian', $pakaian->nama_pakaian) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" class="form-control"
                                value="{{ old('harga', $pakaian->harga) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Lama</label><br>
                        @if ($pakaian->img && Storage::disk('public')->exists($pakaian->img))
                            <img src="{{ asset('storage/' . $pakaian->img) }}" alt="Gambar Lama"
                                style="width: 100px; height: 100px; object-fit: cover;" class="border rounded">
                        @else
                            <p class="text-muted">Tidak ada gambar</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Gambar Baru</label>
                        <input type="file" name="img" class="form-control" accept="image/*">
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
                                                onclick="handleSingleChoice(this)"
                                                {{ in_array($sub->id, $pakaian->subKriterias->pluck('id')->toArray()) ? 'checked' : '' }}>
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
                        </div>
                    </div>

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

                    <div class="d-flex justify-content-between pt-3">
                        <a href="{{ route('admin.pakaian.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-save"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
