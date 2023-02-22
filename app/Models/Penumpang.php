<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'noHp',
        'usia',
        'jk',
        'golongan',
        'harga',
        'tgl_keberangkatan',
        'asal',
        'tujuan'
    ];
}
