<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakaianSubKriteria extends Model
{
    protected $table = 'pakaian_sub_kriterias';

    protected $fillable = ['pakaian_id', 'sub_kriteria_id'];
}
