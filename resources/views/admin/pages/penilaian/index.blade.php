@extends('admin.layouts.base')

@section('title', 'Data Penilaian Pakaian')

@section('content')
    <style>
        .btn-hijau {
            background-color: #064E3B;
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-hijau:hover {
            background-color: #053B2D;
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

        .pagination {
            display: flex;
            justify-content: flex-end;
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
            margin: 0 2px;
            transition: 0.3s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #053B2D;
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
    </style>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-grey-800">
            <i class="bi bi-clipboard-data"></i> Data Penilaian Pakaian
        </h1>
        <a href="{{ route('admin.penilaian.create') }}" class="btn btn-hijau">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    </div>

    <div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="d-flex justify-content-start align-items-center mb-3">
            <label for="perPage" class="me-3 mt-1">Tampilkan</label>

            <select name="perPage" id="perPage" class="modern-select mx-2" onchange="this.form.submit()">
                @foreach([10, 50, 100, 500, 1000] as $size)
                    <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>

            <label class="ms-2 mt-1">entri</label>
        </form>

            <form method="GET" class="d-flex justify-content-end mb-3">
                {{-- Pertahankan nilai perPage --}}
                <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pakaian..."
                    class="form-control form-control-sm" style="width: 200px; margin-right: 8px;">
                <button type="submit" class="btn btn-success btn-sm" style="background-color: #14532d; border: none;">
                    Cari
                </button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pakaian</th>
                            <th>Kriteria</th>
                            <th>Sub Kriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penilaians as $index => $penilaian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penilaian->pakaian->nama_pakaian ?? '-' }}</td>
                                <td>{{ $penilaian->subKriteria->kriteria->nama_kriteria ?? '-' }}</td>
                                <td>{{ $penilaian->subKriteria->nama_sub ?? '-' }}</td>
                                <td>{{ $penilaian->nilai ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.penilaian.edit', ['penilaian' => $penilaian->id, 'page' => request('page')]) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="delete-form-{{ $penilaian->id }}" action="{{ route('admin.penilaian.destroy', $penilaian->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $penilaian->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">Tidak ada data penilaian tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $penilaians->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Yakin ingin menghapus data ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
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


