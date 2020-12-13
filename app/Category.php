<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subcategories()
    {
        return $this->hasMany('App\Category', 'category_id')->whereNotNull('category_id');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
