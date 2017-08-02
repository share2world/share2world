<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //task has comment , one to one
    public function comments(){
        return $this->hasMany('App\Comment','tid');
    }
}
