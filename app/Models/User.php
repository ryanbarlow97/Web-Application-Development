<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'date_of_birth', 'mobile', 
        'email', 'password', 'profile_picture', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array
     */
    protected $hidden = [
        'email', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * User can belong to multiple modules.
    */
    public function modules() {
        return $this->belongsToMany(Modules::class, 'modules');
    }

    /**
     * User can have many posts.
     * User can have many comments.
    */
    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * User can like many posts.
     * User can like many comments.
    */
    public function likedPosts() {
        return $this->morphedByMany(Post::class, 'likeable');
    }
    public function likedComments() {
        return $this->morphedByMany(Comment::class, 'likeable');
    }
};