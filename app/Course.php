<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    protected $with = ['sections'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function activeCourses()
    {
        return $this->whereVisible(1)->get();
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function delete(){

        // Delete Sections Related To First
        $this->sections()->delete();

        // Afterwards Delete The Course
        return parent::delete();
    }
}
