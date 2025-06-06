<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = ['nama_kriteria', 'bobot', 'jenis', 'kode_kriteria'];

    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteria::class, );
    }

}
