<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = [];


    public static function getAttachments($lecture)
    {
        return Parent::where('lecture_id', $lecture->id)->get();
    }
}
