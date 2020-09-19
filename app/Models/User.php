<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function comments(){
        return $this->belongsToMany('App\Models\Post',"comments")->withPivot('post_id','user_id','content','created_at');
    }

    public function post(){
        return $this->hasMany('App\Models\Post');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function statistics(){
        return $this->hasMany('App\Models\Statistic');
    }

    protected $fillable = ['name', 'surname', 'email', 'password', 'role_id'];
}
