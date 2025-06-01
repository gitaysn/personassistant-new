<?php

namespace App\Models;

use App\Models\Subkriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianPakaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pakaian_id',
        'sub_kriteria_id',
        'nilai',
    ];

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'sub_kriteria_id');
    }

}
