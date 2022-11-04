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
     * The Users's ID.
     */
    protected $uuid = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'dob',
        'mobile',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Child Relationship: 
     * User can have many posts.
     * User can have many comments.
     * User can have many replies.
    */
    public function userPosts() {
        return $this->hasMany("App\Models\Post", "uuid");
    }
    public function userComments() {
        return $this->hasMany("App\Models\Comment", "uuid");
    }
    public function userReplies() {
        return $this->hasMany("App\Models\Reply", "uuid");
    }
};
