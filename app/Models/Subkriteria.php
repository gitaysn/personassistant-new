<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriterias';

    protected $fillable = ['kriteria_id', 'nama_sub', 'nilai', 'min_harga', 'max_harga'];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function pakaian(): BelongsToMany
    {
        return $this->belongsToMany(Pakaian::class, 'pakaian_sub_kriteria');
    }
}
