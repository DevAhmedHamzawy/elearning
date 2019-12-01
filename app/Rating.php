<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
