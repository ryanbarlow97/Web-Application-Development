<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'comment_id', 'post_id', 'content', 'likes',
    ];

    /**
    * A comment belongs to an owner.
    */
    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
    * A comment belongs to a post.
    */
    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
    * A comment has other comments.
    */
    public function commentChildren() {
        return $this->hasMany(self::class, "comment_id");
    }
}