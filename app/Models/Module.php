<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'module_logo',
    ];

    /**
    * A module area can have many posts.
    */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
    * A module area can have many comments.
    */
    public function comments() {
        return $this->hasMany(Commment::class);
    }

    /**
    * A module area can have many comments.
    */
    public function enrolledStudents() {
        return $this->belongsToMany(User::class, 'enrolled');
    }

}
