@extends('admin.layouts.base')
@section('title','Dashboard')
@section('content')

<style>
    #content-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    #content {
        flex: 1;
    }

    .sticky-footer {
        width: calc(100% - 225px);
        position: fixed;
        bottom: 0;
        left: 225px;
        background-color: white;
        padding: 10px 0;
        text-align: center;
    }
</style>

<h1 class="h3 text-gray-800">
    <i class="bi bi-house-door-fill"></i> Dashboard
</h1>

<!-- Notification -->
<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 14px; display: flex; align-items: center; justify-content: space-between; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px;">
    <span><strong>Selamat datang ADMIN!</strong> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-left: 10px;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="row mt-4">
    <!-- Tentang Sistem -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100 p-4">
            <h5 class="mb-3" style="color: #155724; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">
                Informasi Sistem Pendukung Keputusan Pemilihan Pakaian
            </h5>
            <p class="text-gray-700 mb-0">
                Sistem ini menggunakan metode <strong>Simple Additive Weighting (SAW)</strong> untuk memberikan rekomendasi pakaian berdasarkan preferensi pengguna.
                Setiap pakaian dinilai berdasarkan kecocokan terhadap subkriteria dari 5 kriteria utama, dengan bobot yang telah ditentukan.
                Semakin tinggi skor akhir, semakin cocok pakaian tersebut untuk kebutuhan pengguna.
            </p>
        </div>
    </div>

    <!-- Grafik -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100 p-4">
            <h5 class="mb-3" style="color: #155724; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">
                Statistik Jumlah Data
            </h5>
            <canvas id="dashboardChart" height="170"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Kriteria', 'Sub Kriteria', 'Pakaian'],
            datasets: [{
                label: 'Jumlah Data',
                data: [{{ $totalKriteria }}, {{ $totalSubKriteria }}, {{ $totalPakaian }}],
                backgroundColor: [
                    'rgba(78, 115, 223, 0.7)',
                    'rgba(54, 185, 204, 0.7)',
                    'rgba(28, 200, 138, 0.7)'
                ],
                borderColor: [
                    'rgba(78, 115, 223, 1)',
                    'rgba(54, 185, 204, 1)',
                    'rgba(28, 200, 138, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection
