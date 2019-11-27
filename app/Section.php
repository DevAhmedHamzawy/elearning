<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    protected $guarded = [];

    protected $with = ['lectures'];


    public function lectures(){
        return $this->hasMany('App\Lecture');
    }
}
