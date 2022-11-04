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
        'user_id',
        'comment_id',
        'content',
    ];

    /**
     * Parent Relationship:
    */
    public function user() {
        return $this->belongsTo(User::class);
    }



    public function commentable() {
        return $this->morphTo();
    }

    public function comments() {
        return $this->morphMany(Comment::class, "commentable");
    }

    public function likes() {
        return $this->morphMany(Like::class,"likeable");
    }
}