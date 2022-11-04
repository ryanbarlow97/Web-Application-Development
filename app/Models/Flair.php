<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flair extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'flairable_id',
        'flairable_type',
    ];


    /**
     * Get all posts assigned to tag.
     */
    public function posts() {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function flairable() {
        return $this->morphTo();
    }
}
