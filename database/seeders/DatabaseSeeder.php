<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
        ['username' => 'ysn'], // Cek berdasarkan username
        [
            'name' => 'Admin User',
            'email' => 'yasindaputri16@gmail.com',
            'password' => Hash::make('1234567890'),
        ]
    );

        // Panggil seeder PenilaianPakaianSeeder
        $this->call([
            PenilaianPakaianSeeder::class,
        ]);
    }
}
