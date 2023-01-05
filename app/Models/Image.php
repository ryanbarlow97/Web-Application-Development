<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
            'post_id',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    //ONE TO ONE
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
