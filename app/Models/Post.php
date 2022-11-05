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
        'post_id', 'user_id', 'module_id', 'content', 
        'likes', 'flair', 'comment_num', 
    ];

    /**
     * Post belongs to a user.
    */
    public function owner() {
        return $this->belongsTo(User::class);
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
}
