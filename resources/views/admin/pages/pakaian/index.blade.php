@extends('admin.layouts.base')

@section('title', 'Data Pakaian')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .search-input {
            width: 200px;
        }

        .btn-biru {
            background-color: #007bff;
            /* biru Bootstrap */
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-biru:hover {
            background-color: #0069d9;
        }

        .search-box {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 12px;
        }

        .search-box input[type="text"] {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modern-select {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: border 0.2s ease-in-out;
        }

        .modern-select:focus {
            border-color: #0d6efd;
            outline: none;
        }
    </style>
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
            <i class="bi bi-boxes"></i> Data Pakaian
        </h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold" style="color: #064E3B;">
                <i class="bi bi-table"></i> Daftar Data Pakaian
            </h6>

            <a href="{{ route('admin.pakaian.create') }}" class="btn" style="background-color: #064E3B; color: white;">
                <i></i> Tambah Data
            </a>
        </div>

        <div class="card-body">
            <form method="GET" id="entriesForm" action="{{ route('admin.pakaian.index') }}"
                class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

                {{-- KIRI --}}
                <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                    <label for="entriesPerPage" class="mb-0 text-muted fw-semibold" style="margin-right: 8px;">Show</label>
                    <select name="entries" id="entriesPerPage" class="modern-select" style="margin-right: 8px;"
                        onchange="document.getElementById('entriesForm').submit()">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                    </select>

                    <span class="text-muted fw-semibold">entries</span>
                </div>
                {{-- KANAN --}}
                <div class="d-flex align-items-center" style="gap: 10px;">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-control-sm" placeholder="Cari nama pakaian...">
                    <button type="submit" class="btn btn-success btn-sm"
                        style="background-color: #14532d; border-color: #14532d;">
                        Cari
                    </button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered border-secondary table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Pakaian</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatif as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($item->img)
                                    <img src="{{ asset($item->img) }}" alt="Gambar"
                                        style="width: 100px; height: 100px;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $item->nama_pakaian }}</td>
                            <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->deskripsi ?? '-' }}</td>
                            <td>
                                <!-- Tombol Info -->
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}">
                                    <i class="bi bi-info-circle"></i>
                                </button>

                                <a href="{{ route('admin.pakaian.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-sm btn-delete"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama_pakaian }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <!-- Form Hapus (disembunyikan) -->
                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('admin.pakaian.destroy', $item->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Info -->
        @foreach ($alternatif as $item)
            <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">
                                Detail Subkriteria - {{ $item->nama_pakaian }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Subkriteria</th>
                                        <th>Range Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->subKriterias as $sub)
                                        <tr>
                                            <td>{{ $sub->kriteria->nama_kriteria ?? '-' }}</td>
                                            <td>{{ $sub->nama_sub }}</td>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-end">
            {{ $alternatif->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
        </div>

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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const deleteButtons = document.querySelectorAll(".btn-delete");

                deleteButtons.forEach(button => {
                    button.addEventListener("click", function() {
                        const id = this.getAttribute("data-id");
                        const nama = this.getAttribute("data-nama");

                        Swal.fire({
                            title: 'Hapus Data?',
                            text: `Data pakaian "${nama}" akan dihapus!`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById(`delete-form-${id}`).submit();
                            }
                        });
                    });
                });
            });
        </script>

    @endsection
