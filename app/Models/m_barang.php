<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\m_kategori;

class m_barang extends Model
{
    public function kategori(): BelongsTo
     {
         return $this->belongsTo(m_kategori::class, 'kategori_id', 'kategori_id');
     }
}
