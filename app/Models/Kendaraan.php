<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'plat',
        'tiket',
        'barang',
        'kendaraan',
        'golongan'
    ];
}
