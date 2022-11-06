<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likeable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
    */
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];
    
    //Find User who liked something
    public function findUser() {
        return $this->belongsTo(User::class);
    }
    /**
     * The attributes that are mass assignable.
    */
    public function posts() {
        return $this->morphedByMany(Post::class, 'likeable');
    }
    public function comments() {
        return $this->morphedByMany(Comment::class, 'likeable');
    }
}
