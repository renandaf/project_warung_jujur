<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dagangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'desc',
        'harga',
        'gambar',
        'qr',
        'qr_code',
        'jenis_dagangan','pemilik','available'
    ];
}
