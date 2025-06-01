@extends('admin.layouts.base')

@section('title', 'Data Sub Kriteria')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-grey-800">
            <i class="bi bi-boxes"></i> Data Sub Kriteria untuk: {{ $kriteria->nama_kriteria }}
        </h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold d-flex justify-content-between align-items-center" style="color: #006400;">
                <span>
                    <i class="bi bi-table"></i> Daftar Sub Kriteria
                </span>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahSubkriteriaModal"
                        style="background-color: #006400; border-color: #004d00;">
                        <i class="bi bi-plus"></i> Tambah Data
                    </button>
                </div>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Subkriteria</th>
                            <th class="text-center">Min Harga</th>
                            <th class="text-center">Max Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subkriterias as $key => $sub)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $sub->nama_sub }}</td>
                                <td class="text-center">{{ $sub->min_harga ?? '-' }}</td>
                                <td class="text-center">{{ $sub->max_harga ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $sub->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form id="delete-form-{{ $sub->id }}" action="{{ route('admin.subkriteria.destroy', $sub->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm mx-1 delete-button" data-id="{{ $sub->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada subkriteria</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Subkriteria -->
    <div class="modal fade" id="tambahSubkriteriaModal" tabindex="-1" aria-labelledby="tambahSubkriteriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 shadow-sm">
                <form action="{{ route('admin.subkriteria.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">

                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title fw-bold" id="tambahSubkriteriaLabel">Tambah Subkriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kriteria_id" class="form-label">Pilih Kriteria</label>
                            <select class="form-select" id="kriteria_id" name="kriteria_id" required onchange="toggleHargaFields()">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}" data-nama="{{ $kriteria->nama_kriteria }}">
                                        {{ $kriteria->nama_kriteria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_sub" class="form-label">Nama Subkriteria</label>
                            <input type="text" class="form-control" id="nama_sub" name="nama_sub" required>
                        </div>

                        <div id="harga-fields" style="display: none;">
                            <div class="mb-3">
                                <label for="min_harga" class="form-label">Min Harga</label>
                                <input type="number" class="form-control" id="min_harga" name="min_harga" min="0">
                            </div>

                            <div class="mb-3">
                                <label for="max_harga" class="form-label">Max Harga</label>
                                <input type="number" class="form-control" id="max_harga" name="max_harga" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn" style="background-color: #90ee90; color: #000; border: none; border-radius: 0.5rem;" data-bs-dismiss="modal">
                            <i></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success" style="background-color: #14532d; border-color: #14532d;">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    @foreach ($subkriterias as $sub)
        <div class="modal fade" id="editModal{{ $sub->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sub->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.subkriteria.update', $sub->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $sub->id }}">Edit Subkriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kriteria_id" class="form-label">Pilih Kriteria</label>
                                <select class="form-select kriteria-select" data-id="{{ $sub->id }}" name="kriteria_id" required>
                                    @foreach ($kriterias as $kriteria)
                                        <option value="{{ $kriteria->id }}" data-nama="{{ $kriteria->nama_kriteria }}"
                                            {{ $sub->kriteria_id == $kriteria->id ? 'selected' : '' }}>
                                            {{ $kriteria->nama_kriteria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nama_sub" class="form-label">Nama Subkriteria</label>
                                <input type="text" class="form-control" name="nama_sub" value="{{ $sub->nama_sub }}" required>
                            </div>

                            <div class="harga-fields" id="hargaFields{{ $sub->id }}" style="display: none;">
                                <div class="mb-3">
                                    <label for="min_harga" class="form-label">Min Harga</label>
                                    <input type="number" class="form-control" name="min_harga" value="{{ $sub->min_harga }}">
                                </div>

                                <div class="mb-3">
                                    <label for="max_harga" class="form-label">Max Harga</label>
                                    <input type="number" class="form-control" name="max_harga" value="{{ $sub->max_harga }}">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn" style="background-color: #90ee90; color: #000; border: none; border-radius: 0.5rem;" data-bs-dismiss="modal">
                                <i"></i> Batal
                            </button>
                            <button type="submit" class="btn" style="background-color: #14532d; color: #fff; border: none; border-radius: 0.5rem;">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    <script>
        function toggleHargaFields() {
            const select = document.getElementById('kriteria_id');
            const selectedOption = select.options[select.selectedIndex];
            const namaKriteria = selectedOption.getAttribute('data-nama');
            const hargaFields = document.getElementById('harga-fields');

            if (namaKriteria === 'Harga') {
                hargaFields.style.display = 'block';
                document.getElementById('min_harga').required = true;
                document.getElementById('max_harga').required = true;
            } else {
                hargaFields.style.display = 'none';
                document.getElementById('min_harga').required = false;
                document.getElementById('max_harga').required = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete buttons with SweetAlert
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data ini akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                });
            });

            // Handle edit modal harga fields toggle
            document.querySelectorAll('.kriteria-select').forEach(select => {
                const id = select.dataset.id;
                const hargaFields = document.getElementById(`hargaFields${id}`);

                function toggleHargaFields() {
                    const selectedOption = select.options[select.selectedIndex];
                    const namaKriteria = selectedOption.getAttribute('data-nama');
                    if (namaKriteria === 'Harga') {
                        hargaFields.style.display = 'block';
                    } else {
                        hargaFields.style.display = 'none';
                    }
                }

                // Tampilkan sesuai kondisi saat pertama kali modal muncul
                toggleHargaFields();

                // Tambahkan event saat value berubah
                select.addEventListener('change', toggleHargaFields);
            });
        });
    </script>

@endsection