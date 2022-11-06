<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    //don't need timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'module_id',
    ];

    public function findUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function findModule() {
        return $this->belongsTo(Module::class, 'module_id');
    }

}
