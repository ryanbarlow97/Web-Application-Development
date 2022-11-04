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
        'user_id',
        'post_id',
        'content',
    ];

    /**
     * Parent Relationship: 
     * Post belongs to a user.
    */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->morphMany(Comment::class, "commentable");
    }

    public function likes() {
        $table->morphs('likeable');
    }

    public function flairs() {
        $table->morphs('flairable');
    }
}
