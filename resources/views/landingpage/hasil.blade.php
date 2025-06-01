<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rekomendasi Pakaian</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a4d3a 0%, #0d2818 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 25px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .back-button:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .results-summary {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .summary-text {
            color: #4a5568;
            font-size: 1.1rem;
            text-align: center;
        }

        .summary-text i {
            color: #2d5a3d;
            margin-right: 8px;
        }

        .alert {
            background: linear-gradient(135deg, #2d5a3d 0%, #1a4d3a 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            font-size: 1.2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin: 40px 0;
        }

        .alert i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2d5a3d, #1a4d3a);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }

        .card-rank {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #2d5a3d, #1a4d3a);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .card-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .card-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #4a5568;
            font-size: 0.95rem;
        }

        .info-item i {
            width: 20px;
            color: #2d5a3d;
        }

        .price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d5a3d;
        }

        .score-container {
            background: linear-gradient(135deg, #2d5a3d 0%, #1a4d3a 100%);
            color: white;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 20px;
        }

        .score-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .score-value {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .score-stars {
            margin-top: 8px;
        }

        .star {
            color: #ffd700;
            font-size: 1.2rem;
            margin: 0 2px;
        }

        .star.empty {
            color: rgba(255,255,255,0.3);
        }


        .clothing-type {
            background: #e8f5e8;
            color: #2d5a3d;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .recommendation-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #2d5a3d;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }

        .top-choice {
            background: linear-gradient(135deg, #2d5a3d 0%, #0d2818 100%);
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .card-rank {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url()->previous() }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Pencarian
        </a>

        <div class="header">
            <h1>Top 3 Rekomendasi Pakaian</h1>
            <p>Temukan 3 pakaian terbaik yang sesuai dengan preferensi Anda</p>
        </div>

        @if (isset($message) || (isset($recommendations) && $recommendations->isEmpty()) || (isset($rekomendasi) && $rekomendasi->isEmpty()))
            <div class="alert">
                <i class="fas fa-search"></i>
                <div>
                    {{ $message ?? 'Tidak ada pakaian yang cocok dengan preferensi Anda.' }}
                </div>
                <p style="margin-top: 15px; font-size: 1rem; opacity: 0.9;">
                    Coba ubah kriteria pencarian atau pilih opsi yang lebih fleksibel.
                </p>
            </div>
        @else
            @php
                // Support both variable names for backward compatibility
                $results = $recommendations ?? $rekomendasi ?? collect([]);
                // Limit to top 3 recommendations
                $top3Results = $results->take(3);
            @endphp

            <div class="results-summary">
                <div class="summary-text">
                    <i class="fas fa-check-circle"></i>
                    Menampilkan <strong>3 pakaian terbaik</strong> dari {{ $results->count() }} hasil yang ditemukan
                </div>
            </div>

            <div class="grid">
                @foreach ($top3Results as $index => $item)
                    @php
                        $rank = $index + 1;
                        $clothing = $item['pakaian'];
                        $score = $item['score'];
                        $clothingType = $item['jenis_pakaian'] ?? 'Lainnya';
                        
                        // Calculate star rating based on score (0-1 scale to 0-5 stars)
                        $maxScore = $results->max('score');
                        $normalizedScore = $maxScore > 0 ? ($score / $maxScore) * 5 : 0;
                        $fullStars = floor($normalizedScore);
                        $hasHalfStar = ($normalizedScore - $fullStars) >= 0.5;
                    @endphp
                    
                    <div class="card fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="card-rank">{{ $rank }}</div>
                        
                        @if ($rank == 1)
                            <div class="recommendation-badge top-choice">
                                <i class="fas fa-crown"></i> Pilihan Terbaik
                            </div>
                        @else
                            <div class="recommendation-badge">
                                <i class="fas fa-star"></i> Top {{ $rank }}
                            </div>
                        @endif

                        @if ($clothing->img && file_exists(public_path('storage/' . $clothing->img)))
                            <img src="{{ asset('storage/' . $clothing->img) }}" 
                                 class="card-img"
                                 alt="Gambar {{ $clothing->nama_pakaian ?? $clothing->nama }}"
                                 onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                        @else
                            <div class="card-img" style="background: linear-gradient(135deg, #f0f0f0, #e0e0e0); display: flex; align-items: center; justify-content: center; color: #999;">
                                <i class="fas fa-tshirt" style="font-size: 3rem;"></i>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="clothing-type">{{ $clothingType }}</div>
                            
                            <div class="card-title">{{ $clothing->nama_pakaian ?? $clothing->nama }}</div>
                            
                            <div class="card-info">
                                <div class="info-item">
                                    <i class="fas fa-tag"></i>
                                    <span class="price">Rp {{ number_format($clothing->harga ?? 0, 0, ',', '.') }}</span>
                                </div>
                                
                                @if (isset($clothing->merek))
                                    <div class="info-item">
                                        <i class="fas fa-copyright"></i>
                                        <span>{{ $clothing->merek }}</span>
                                    </div>
                                @endif
                                
                                @if (isset($clothing->ukuran))
                                    <div class="info-item">
                                        <i class="fas fa-ruler"></i>
                                        <span>Ukuran: {{ $clothing->ukuran }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="score-container">
                                <div class="score-label">Skor Kecocokan</div>
                                <div class="score-value">{{ number_format($score, 3) }}</div>
                                <div class="score-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="fas fa-star star"></i>
                                        @elseif ($i == $fullStars + 1 && $hasHalfStar)
                                            <i class="fas fa-star-half-alt star"></i>
                                        @else
                                            <i class="far fa-star star empty"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        // Add smooth animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards
            document.querySelectorAll('.card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>