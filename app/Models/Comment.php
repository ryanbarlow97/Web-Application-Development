<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'content',
    ];

    /**
    * A comment belongs to an owner.
    */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A comment belongs to a post.
    */
    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }
    /**
     * Get all of the post's likes.
    */
    public function likes() {
        return $this->morphToMany(User::class, 'likeable');
    }
}