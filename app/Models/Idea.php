<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    // ✅ Likes relationship
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // User who posted the idea
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}