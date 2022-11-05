<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'content', 'likes', 'flair',
    ];

    /**
     * Post belongs to a user.
    */
    public function owner() {
        return $this->belongsTo(User::class);
    }

    /**
     * Post can have many comments.
    */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
