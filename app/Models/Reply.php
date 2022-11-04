<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    /**
     * The Replies Unique ID.
     */
    protected $urid = 'urid';

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
     * Reply belongs to a user.
     * Reply belongs to a comment.
    */
    public function user() {
        //uuid = Unique User ID
        return $this->belongsTo("App\Models\User", "uuid");
    }
    public function comment() {
        //uuid = Unique Comment ID
        return $this->belongsTo("App\Models\Reply", "ucid");
    }
}