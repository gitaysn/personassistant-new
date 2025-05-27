<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Rekomendasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .card-img {
            object-fit: cover;
            height: 100%;
        }

        .card-body h5 {
            font-weight: 600;
        }

        .card-body p {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">Hasil Rekomendasi Pakaian</h2>

        @if ($rekomendasi->isEmpty())
            <div class="alert alert-warning text-center">
                Tidak ada pakaian yang cocok dengan preferensimu.
            </div>
        @else
            @foreach ($rekomendasi as $item)
                <div class="card mb-4 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $item['pakaian']->img) }}" class="img-fluid card-img"
                                alt="Gambar {{ $item['pakaian']->nama_pakaian }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['pakaian']->nama_pakaian }}</h5>
                                <p class="card-text">Harga: <strong>Rp
                                        {{ number_format($item['pakaian']->harga, 0, ',', '.') }}</strong></p>
                                <p class="card-text">Skor Kecocokan: <span
                                        class="badge bg-primary">{{ number_format($item['score'], 3) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
