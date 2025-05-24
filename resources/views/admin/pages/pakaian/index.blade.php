@extends('admin.layouts.base')

@section('title', 'Data Alternatif')

@section('content')
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-grey-800">
            <i class="bi bi-boxes"></i> Data Alternatif
        </h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold" style="color: #064E3B;">
                <i class="bi bi-table"></i> Daftar Data Alternatif
            </h6>
            <button type="button" class="btn" style="background-color: #064E3B; color: white;" data-bs-toggle="modal"
                data-bs-target="#modalTambah">
                <i></i> Tambah Data
            </button>
        </div>

        <div class="card-body">
            <form method="GET" id="entriesForm" action="{{ route('admin.pakaian.index') }}"
            class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

            {{-- KIRI --}}
            <div class="d-flex align-items-center">
                <label for="entriesPerPage" class="me-2 mb-0">Show</label>
                <select name="entries" id="entriesPerPage" class="form-select form-select-sm me-2"
                    onchange="document.getElementById('entriesForm').submit()">
                    <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                </select>
                <span class="mb-0">entries</span>
            </div>

            {{-- KANAN --}}
            <div class="d-flex align-items-center">
                <label for="search" class="me-2 mb-0">Search:</label>
                <input type="text" name="search" id="search" class="form-control form-control-sm me-3" placeholder="Search..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
            </div>

        </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Pakaian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = ($alternatif->currentPage() - 1) * $alternatif->perPage() + 1; @endphp
                        @foreach ($alternatif as $item)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td class="text-center">
                                    @if ($item->img)
                                        <img src="{{ asset($item->img) }}" alt="Gambar"
                                            class="img-fluid rounded object-fit-cover"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>
                                <td>{{ $item->nama_pakaian }}</td>
                                <td class="text-center">
                                    <!-- Tombol Info -->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#infoModal{{ $item->id }}">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">
                                         <i class="bi bi-pencil"></i>
                                    </button>

                                    @foreach ($alternatif as $item)
                                        <!-- Modal Info -->
                                        <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">
                                                            Detail Subkriteria - {{ $item->nama_pakaian }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Kriteria</th>
                                                                    <th>Subkriteria</th>
                                                                    <th>Nilai</th>
                                                                    <th>Range Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($item->subKriterias as $sub)
                                                                    <tr>
                                                                        <td>{{ $sub->kriteria->nama_kriteria ?? '-' }}</td>
                                                                        <td>{{ $sub->nama_sub }}</td>
                                                                        <td>{{ $sub->nilai }}</td>
                                                                        <td>
                                                                            @if ($sub->kriteria->nama_kriteria === 'Harga')
                                                                                Rp{{ number_format($sub->min_harga, 0, ',', '.') }}
                                                                                -
                                                                                Rp{{ number_format($sub->max_harga, 0, ',', '.') }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end">
                    {{ $alternatif->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Tambah Data Pakaian -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Centered vertically -->
            <div class="modal-content rounded-3 shadow-sm border-0">
                <!-- Header -->
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-semibold" id="modalTambahLabel">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Pakaian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <!-- Body -->
                <div class="modal-body pt-0">
                    <form action="{{ route('admin.pakaian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_pakaian" class="form-label">Nama Pakaian</label>
                            <input type="text" class="form-control" name="nama_pakaian" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" required>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>

                        <!-- Footer Buttons -->
                        <div class="modal-footer border-top-0 d-flex justify-content-end gap-2 pt-0">
                        <button type="button" class="btn" style="background-color: #90ee90; color: black; border-radius: 5px; padding: 6px 20px;" data-bs-dismiss="modal">
                            <i></i> Batal
                        </button>
                        <button type="submit" class="btn" style="background-color: #064e3b; color: white; border-radius: 5px; padding: 6px 20px;">
                            <i></i> Simpan
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($alternatif as $item)
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1"
            aria-labelledby="modalEdit{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEdit{{ $item->id }}">Edit Data Pakaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('admin.pakaian.update', $item->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <!-- Nama Pakaian -->
                            <div class="mb-3">
                                <label for="edit_nama_pakaian{{ $item->id }}" class="form-label">Nama Pakaian</label>
                                <input type="text" class="form-control" id="edit_nama_pakaian{{ $item->id }}"
                                    name="nama_pakaian" value="{{ $item->nama_pakaian }}" required>
                            </div>
                            <!-- Harga -->
                            <div class="mb-3">
                                <label for="edit_harga{{ $item->id }}" class="form-label">Harga</label>
                                <input type="number" id="edit_harga{{ $item->id }}" name="harga"
                                    class="form-control" value="{{ $item->harga }}" required>
                            </div>

                            <!-- Upload Gambar Baru -->
                            <div class="mb-3">
                                <label for="edit_gambar{{ $item->id }}" class="form-label">Gambar Baru</label>
                                <input type="file" class="form-control" name="gambar"
                                    id="edit_gambar{{ $item->id }}" accept="image/*">
                            </div>

                            <!-- Preview Gambar Lama -->
                            <div class="mb-3">
                                <label class="form-label">Gambar Lama:</label><br>
                                <img src="{{ asset($item->img) }}" alt="Gambar Lama"
                                    style="width: 100px; height: 100px; object-fit: cover;" class="border rounded">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn" style="background-color: #90ee90; color: black;"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn"
                                style="background-color: #064E3B; color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <style>
        .label-spacing {
            margin-right: 0.3rem;
            /* Jarak antara label dan select */
        }

        .search-input {
            width: 200px;
            /* Lebar input search */
        }

        .justify-between {
            justify-content: space-between;
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
            /* Geser ke pojok kanan */
            align-items: center;
            padding: 10px;
        }

        .pagination .page-item .page-link {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #064E3B;
            /* Warna biru */
            margin: 0 2px;
            transition: 0.3s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #053B2D;
            /* Biru lebih gelap */
            font-weight: bold;
        }

        .pagination .page-item .page-link:hover {
            background-color: #046C4E;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }

        .entries-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .entries-left,
        .entries-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 14px;
        }

        .entries-left label,
        .entries-right label {
            margin: 0;
            line-height: 1;
        }

        .entries-left select,
        .entries-right input[type="text"] {
            padding: 4px 8px;
            height: 32px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .entries-right button {
            height: 32px;
            padding: 0 12px;
            font-size: 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .entries-right button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
