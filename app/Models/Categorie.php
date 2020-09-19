<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function posts(){
        return $this->hasMany('App\Models\Post','category_id');
    }
    public $timestamps = false;
    protected $fillable = ['title'];

    /*public function posts(){
        return $this->belongsTo('App\Models\Post');
    }*/
}
