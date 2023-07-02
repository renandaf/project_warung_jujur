<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preorder extends Model
{
  use HasFactory;

  protected $fillable = [
    'judul',
    'deskripsi',
    'user_id',
    'gambar', 'no_hp', 'available', 'status', 'catatan'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
