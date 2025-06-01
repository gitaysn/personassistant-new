<?php

namespace Database\Seeders;

use App\Models\Pakaian;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Database\Seeder;
use App\Models\PenilaianPakaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenilaianPakaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Nonaktifkan foreign key sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Kosongkan tabel penilaian_pakaians
        DB::table('penilaian_pakaians')->truncate();

        // Aktifkan lagi foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $pakaianMap = [
            'Ariana Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Charlotte Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 4],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Freya Etnic Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Keira Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Aurelie Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Elyna Lace Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Louisa Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Azura Etnic Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Celia Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Elaine Blouse' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 5],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Annelise Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Daisy Silk Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 3],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 4],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 5],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Edelia Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 2],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 3],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 4],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 5],
                ]
            ],
            'Embroidery Tunik' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 2],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 3],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 4],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 5],
                ]
            ],
            'Shimmer Raya Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 4],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Elena Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Aster Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 3],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 4],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 5],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Orchid Flowy Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Adeline Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Daphne Dress' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 5],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 2],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 3],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 4],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 5],
                ]
            ],
            'Brielle Ribbon Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Ruby Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Rose Knit Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Camellia Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Chloe Cardigan' => [
               'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Jade Stripes Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Giselle Knit Top' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Stripes Fur Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Polo Stripes Knit' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Ribbon Fur Cardigan' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 5],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Knit Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Kirei Flare Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Mermaid Jeans Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 5],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Viona Mermaid Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 4],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Floral Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Fleur Embroidery Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Belle Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Mermaid Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Silk Ruffle Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 5],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Arabella Ruffle Skirt' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 5],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 1],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Cutbray Jeans Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 5],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Anne Flare Jeans' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 1],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 5],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 1],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Cutbray Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Laura Highwaist Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Flowy Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Casual Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Celine Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 4],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 5],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Pleated Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 5],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 5],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Iris Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 1],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 4],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
            'Scuba Pants' => [
                'Jenis Acara' => [
                    ['sub' => 'Semi Formal', 'nilai' => 5],
                    ['sub' => 'Non Formal', 'nilai' => 5],
                ],
                'Jenis Pakaian' => [
                    ['sub' => 'Dress', 'nilai' => 1],
                    ['sub' => 'Rok', 'nilai' => 1],
                    ['sub' => 'Blouse', 'nilai' => 1],
                    ['sub' => 'Cardigan', 'nilai' => 1],
                    ['sub' => 'Celana', 'nilai' => 5],
                ],
                'Warna Pakaian' => [
                    ['sub' => 'Warna Dingin (hijau, ungu, denim, mint)', 'nilai' => 1],
                    ['sub' => 'Warna Panas (maroon, orange, lime)', 'nilai' => 1],
                    ['sub' => 'Warna Netral (putih, hitam, abu-abu, beige, nude, khaki)', 'nilai' => 4],
                    ['sub' => 'Warna Lembut (merah muda, biru muda, hijau muda)', 'nilai' => 4],
                    ['sub' => 'Warna Pastel (cream, coklat muda, hijau kaki, kuning gading)', 'nilai' => 1],
                ],
                'Lokasi Acara' => [
                    ['sub' => 'Indoor', 'nilai' => 5],
                    ['sub' => 'Outdoor', 'nilai' => 1],
                ],
                'Harga' => [
                    ['sub' => 'Rp 94000 - Rp 134000', 'nilai' => 5],
                    ['sub' => 'Rp 135000 - Rp 174000', 'nilai' => 1],
                    ['sub' => 'Rp 175000 - Rp 214000', 'nilai' => 1],
                    ['sub' => 'Rp 215000 - Rp 254000', 'nilai' => 1],
                ]
            ],
        ];

        foreach ($pakaianMap as $pakaianName => $kriteriaList) {
            $pakaian = Pakaian::where('nama_pakaian', $pakaianName)->first();
            if (!$pakaian) continue;

            foreach ($kriteriaList as $kriteriaName => $subList) {
                $kriteria = Kriteria::where('nama_kriteria', $kriteriaName)->first();
                if (!$kriteria) continue;

                foreach ($subList as $entry) {
                    $sub = Subkriteria::where('nama_sub', $entry['sub'])
                        ->where('kriteria_id', $kriteria->id)
                        ->first();

                    if ($sub) {
                        PenilaianPakaian::updateOrCreate([
                            'pakaian_id' => $pakaian->id,
                            'sub_kriteria_id' => $sub->id,
                        ], [
                            'nilai' => $entry['nilai'],
                        ]);
                    }
                }
            }
        }
    }
}