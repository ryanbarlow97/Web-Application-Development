<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The Comments's Unique ID.
     */
    protected $ucid = 'ucid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'upid',
        'content',
        'upvotes',
        'downvotes',
    ];

    /**
     * Parent Relationship:
     * Comment belongs to a user.
     * Comment belongs to a post.
    */
    public function user() {
        //uuid = Unique User ID
        return $this->belongsTo("App\Models\User", "uuid");
    }
    public function post() {
        //upid = Unique Post ID
        return $this->belongsTo("App\Models\Post", "upid");
    }

    /**
     * Child Relationship: 
     * Comment has many replies.
     */
    public function replies() {
        //uuid = Unique User ID
        return $this->hasMany("App\Models\Reply", "uuid");
    }
}