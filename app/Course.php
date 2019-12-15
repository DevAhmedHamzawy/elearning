<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    protected $with = ['sections','ratings','favourites','category','subcategory', 'user'];
    protected $appends = ['video_path'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function activeCourses()
    {
        return self::whereVisible(1)->get();
    }

    public static function coursesByCategory($id)
    {
        return self::whereCategoryId($id)->get();
    }

    public static function coursesBySubCategory($id)
    {
        return self::whereCategoryId($id)->get();
    }

    public static function topThreeCourses()
    {
        return self::with(['ratings' => function ($q) {
            $q->orderBy('rating', 'desc');
        }])->take(3)->get();
    }

    public function getVideoPathAttribute(){
        return asset('storage/courses/promos/' . $this->promo_video_url);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Category');
    }


    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function lectures()
    {
        return $this->hasMany('App\Lecture');
    }

    public function Ratings()
    {
        return $this->hasMany('App\Rating')->where('spam','0')->orWhereNull('spam');
    }

    public function favourites()
    {
        return $this->hasMany('App\Favourite');
    }

    public function getOrderedLectures(){
        return $this->lectures->sortBy('episode_number');
    }

    public function delete(){

        // Delete Sections Related To First
        $this->sections()->delete();

        // Afterwards Delete The Course
        return parent::delete();
    }
}
