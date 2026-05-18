<?php

// App\Models\Idea.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['content', 'user_id'];  // Do not include 'likes' here

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Like model
    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }
}
