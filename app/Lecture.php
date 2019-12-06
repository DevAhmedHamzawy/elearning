<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function getNextLecture(){
        $nextLecture =  $this->course->lectures()->where('episode_number', '>', $this->episode_number)->OrderBy('episode_number', 'asc')->first();
        return $nextLecture ? $nextLecture : $this;
    }

    public function getPrevLecture(){
        $prevLecture = $this->course->lectures()->where('episode_number', '<', $this->episode_number)->OrderBy('episode_number', 'desc')->first();
        return $prevLecture ? $prevLecture : $this;
    }
}
