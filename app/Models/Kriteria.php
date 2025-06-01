<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = ['nama_kriteria', 'bobot', 'jenis', 'kode_kriteria'];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

}
