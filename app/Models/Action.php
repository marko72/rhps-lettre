<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public function statistics(){
        return $this->hasMany('\App\Models\Statistic');
    }
    public $timestamps = false;
}
