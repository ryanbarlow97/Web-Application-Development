<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
}
