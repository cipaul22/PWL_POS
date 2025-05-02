<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use App\Models\m_user;
 
 class m_level extends Model
 {
     public function user(): BelongsTo
     {
         return $this->belongsTo((m_user::class));
     }
 }