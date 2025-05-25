@extends('admin.layouts.base')

@section('title', 'Penilaian Pakaian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-grey-800">
        <i class="bi bi-box"></i> Penilaian Pakaian
    </h1> 
</div>

<style>
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

    .form-select-sm,
    .form-control-sm {
        width: auto;
    }

    .search-input {
        width: 200px;
    }

    .btn-biru {
        background-color: #007bff;
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

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold" style="color: #064E3B;">
            <i class="bi bi-table"></i> Daftar Penilaian Pakaian
        </h6>
    </div>

    <div class="card-body">
        {{-- GABUNGKAN FORM --}}
        <form method="GET" action="{{ route('admin.penilaian.index') }}" class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                <label for="entriesPerPage" class="mb-0 text-muted fw-semibold" style="margin-right: 12px;">Show</label>
                <select name="entries" id="entriesPerPage" class="modern-select" onchange="this.form.submit()">
                    <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                </select>
                <span class="text-muted fw-semibold" style="margin-left: 12px;">entries</span>
            </div>

            <div class="search-box">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pakaian..." class="form-control form-control-sm search-input">
                <button type="submit" class="btn btn-sm" style="background-color: #14532d; color: white;">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Pakaian</th>
                        {{-- Header Kriteria --}}
                        @foreach ($kriterias as $kriteria)
                            <th class="text-center">{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pakaians as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $item->nama_pakaian ?? '-' }}</td>

                        {{-- Subkriteria --}}
                        @foreach ($kriterias as $kriteria)
                            @php
                                $subKriterias = $item->subKriterias->where('kriteria_id', $kriteria->id);
                                $namaSubs = $subKriterias->pluck('nama_sub')->toArray();
                            @endphp
                            <td class="text-center">
                                @if (count($namaSubs))
                                    @if ($kriteria->nama_kriteria === 'Jenis Acara')
                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                            @foreach ($namaSubs as $nama)
                                                <span class="rounded-pill px-3 py-1 bg-light border text-dark small shadow-sm">
                                                    {{ $nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        {{ $namaSubs[0] ?? '-' }}
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach

                        <td class="text-center">
                            <a href="{{ route('admin.penilaian.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> 
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 3 + $kriterias->count() }}" class="text-center">Belum ada data penilaian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{-- BAWA PARAMETER PAGINATION --}}
            {{ $pakaians->appends(['entries' => request('entries'), 'search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

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

@endsection
