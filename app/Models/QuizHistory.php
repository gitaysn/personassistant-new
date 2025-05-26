<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    protected $fillable = [
        'jenis_acara',
        'harga',
        'jenis_pakaian',
        'warna',
        'cuaca',
        'lokasi',
        'pakaian_id',
    ];

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }
}
