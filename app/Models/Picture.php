<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function post(){
        return $this->hasOne('App\Models\Post');
    }

    protected $fillable = ['path'];
}
