<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\m_level;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class m_user extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'user_id'; 
    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(m_level::class, 'level_id', 'level_id');
    }
}