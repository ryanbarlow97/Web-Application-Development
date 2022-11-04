<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_id',
        'profile_picture',
        'about_user',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function posts() {
        return $this->belongsToMany(Post::class, 'posts');
    }

    public function comments() {
        return $this->belongsToMany(Comment::class, 'comments');
    }
}
