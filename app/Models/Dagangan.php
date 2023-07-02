<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Dagangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        'qr',
        'qr_code',
        'jenis_dagangan', 'user_id', 'available', 'status', 'catatan'
    ];

    protected $appends = ['gambar', 'qr'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function getGambarAttribute()
    {
        return asset('storage/dagangan/' . $this->attributes['gambar']);
    }
    function getQrAttribute()
    {
        return asset('storage/qr/' . $this->attributes['qr']);
    }
}
