<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pakaian extends Model
{
    use HasFactory;

    protected $table = 'pakaians';

    protected $fillable = ['nama_pakaian', 'img', 'harga'];

    public function subKriterias(): BelongsToMany
    {
        return $this->belongsToMany(SubKriteria::class, 'pakaian_sub_kriterias');
    }
}
