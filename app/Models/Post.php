<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'flair',
    ];

    /**
     * Post belongs to a user.
    */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function image() {
        return $this->hasOne(Image::class);
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
    public function likeables() {
        return $this->morphToMany(User::class, 'likeable');
    }

    public function likes() {
    return $this->likeables()
        ->where('likeable_id', $this->id)
        ->where('likeable_type', 'App\Models\Post')
        ->count();
    }

    public function isUpvotedBy(User $user){
    return $this->likeables()
        ->where('user_id', $user->id)
        ->exists();
    }
    
    public function upvote(User $user) {
    $this->likeables()->attach($user);
    }

    public function unupvote(User $user){
    $this->likeables()->detach($user);
    }
}
