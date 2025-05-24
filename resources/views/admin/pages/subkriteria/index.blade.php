@extends('admin.layouts.base')

@section('title', 'Data Sub Kriteria')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-grey-800">
            <i class="bi bi-boxes"></i> Data Sub Kriteria untuk: {{ $kriteria->nama_kriteria }}
        </h1>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahSubkriteriaModal"
            style="background-color: #006400; border-color: #006400; color: white;">
            <i></i> Tambah Data
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold" style="color: #006400;">
                <i class="bi bi-table"></i> Daftar Sub Kriteria
            </h6>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-bold text-success">
                    Subkriteria untuk: {{ $kriteria->nama_kriteria }}
                </span>
                <a href="{{ route('admin.kriteria.index') }}" class="btn btn-sm btn-success">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Subkriteria</th>
                            <th>Nilai</th>
                            <th>Min Harga</th>
                            <th>Max Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subkriterias as $sub)
                            <tr>
                                <td>{{ $sub->nama_sub }}</td>
                                <td>{{ $sub->nilai }}</td>
                                <td>{{ $sub->min_harga ?? '-' }}</td>
                                <td>{{ $sub->max_harga ?? '-' }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $sub->id }}">Edit</button>

                                    <!-- Tombol Delete -->
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $sub->id }}">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada subkriteria</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Subkriteria -->
    <div class="modal fade" id="tambahSubkriteriaModal" tabindex="-1" aria-labelledby="tambahSubkriteriaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.subkriteria.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahSubkriteriaLabel">Tambah Subkriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kriteria_id" class="form-label">Pilih Kriteria</label>
                            <select class="form-select" id="kriteria_id" name="kriteria_id" required
                                onchange="toggleHargaFields()">
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

                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" step="1"
                                required>
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
                    </script>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    @foreach ($subkriterias as $sub)
        <div class="modal fade" id="editModal{{ $sub->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $sub->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.subkriteria.update', $sub->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $sub->id }}">Edit Subkriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kriteria_id" class="form-label">Kriteria</label>
                                <select class="form-select kriteria-select" data-id="{{ $sub->id }}"
                                    name="kriteria_id" required>
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
                                <input type="text" class="form-control" name="nama_sub" value="{{ $sub->nama_sub }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="number" class="form-control" name="nilai" value="{{ $sub->nilai }}"
                                    required>
                            </div>

                            <div class="harga-fields" id="hargaFields{{ $sub->id }}" style="display: none;">
                                <div class="mb-3">
                                    <label for="min_harga" class="form-label">Min Harga</label>
                                    <input type="number" class="form-control" name="min_harga"
                                        value="{{ $sub->min_harga }}">
                                </div>

                                <div class="mb-3">
                                    <label for="max_harga" class="form-label">Max Harga</label>
                                    <input type="number" class="form-control" name="max_harga"
                                        value="{{ $sub->max_harga }}">
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Loop semua select.kriteria-select
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

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    @foreach ($subkriterias as $sub)
        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal{{ $sub->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $sub->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.subkriteria.destroy', $sub->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $sub->id }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus subkriteria "<strong>{{ $sub->nama_sub }}</strong>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <!-- Tambahkan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi untuk menampilkan SweetAlert sukses
        function showSuccessMessage(message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                showConfirmButton: false,
                timer: 1500
            });
        }

        // SweetAlert untuk konfirmasi hapus data
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.form-hapus');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Cegah submit langsung

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Lanjutkan submit jika dikonfirmasi
                        }
                    });
                });
            });
        });

        // Menampilkan SweetAlert saat ada pesan sukses dari server
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = "{{ session('success') }}";
            if (successMessage.trim() !== "") {
                showSuccessMessage(successMessage);
            }
        });

        // SweetAlert setelah menambah data
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = "{{ session('success') }}";
            if (successMessage.trim() !== "") {
                showSuccessMessage(successMessage);
            }
        });

        // SweetAlert setelah edit data
        document.getElementById('formEdit')?.addEventListener('submit', function(event) {
            event.preventDefault();
            let form = this;
            let url = form.action;
            let formData = new FormData(form);

            fetch(url, {
                    method: 'POST', // atau 'PUT' jika pakai PUT
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diperbarui!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Gagal!", data.message || "Data tidak dapat diperbarui.", "error");
                    }
                })
                .catch(error => {
                    console.log("Error di fetch:", error);
                    Swal.fire("Error!", "Terjadi kesalahan saat mengupdate data.", "error");
                });
        });
    </script>

@endsection
