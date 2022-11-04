<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    /**
     * The Post's ID.
     */
    protected $upid = 'upid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'content',
        'timestamp',
        'upvotes',
        'downvotes',
    ];

    /**
     * Parent Relationship: 
     * Post belongs to a user.
    */
    public function user() {
        //uuid = Unique User ID
        return $this->belongsTo("App\Models\User", "uuid");
    }
    
    /**
     * Child Relationship: 
     * Post can have many comments.
    */
    public function comments() {
        return $this->hasMany("App\Models\Comment", "upid");
    }
}
