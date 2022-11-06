<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'module_id', 'content', 'flair',
    ];

    /**
     * Post belongs to a user.
    */
    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Post belongs to a module.
    */
    public function module() {
        return $this->belongsTo(Module::class, 'module_id');
    }

    /**
     * Post can have many comments.
    */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    /**
     * Get all of the post's likes.
    */
    public function likes() {
        return $this->morphToMany(User::class, 'likeable');
    }
}
