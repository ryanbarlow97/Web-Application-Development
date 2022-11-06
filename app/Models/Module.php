<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    //don't need timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
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
     * A module area can have many users (staff/student).
    */
    public function users() {
        return $this->hasMany(Enrollment::class, 'module_id');
    }
}