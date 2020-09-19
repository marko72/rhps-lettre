<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }

    public static function paginacija($br){
        return Statistic::with('user')->skip($br)->take(5)->get();
    }

    public static function paginacijaPretraga($pretraga, $br){
        return Statistic::with('user')->where('action','like','%'.$pretraga.'%')->skip($br)->take(5)->get();
    }

    public static function pretraga($var){
        $data = [];
        $data['brojAkcija'] = Statistic::with('user')->where('action','like','%'.$var.'%')->count();
        $data['akcije'] = Statistic::with('user')->where('action','like','%'.$var.'%')->limit(5)->get();
        return $data;
    }

    protected $fillable = ['action','user_id'];
}
