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


    public static function bestRatingCourses()
    {
        return self::with(['ratings' => function ($q) {
            $q->where('rating', '>', 3);
        }])->get();
    }

    public static function worstRatingCourses()
    {
        return self::with(['ratings' => function ($q) {
            $q->where('rating', '<', 3);
        }])->get();
    }

    public function getVideoPathAttribute()
    {
        return asset('storage/courses/promos/' . $this->promo_video_url);
    }

    public function getimgPathAttribute()
    {
        if(file_exists(public_path() .'/storage/courses/images/' . $this->thumbnail)){
            return asset('storage/courses/images/' . $this->thumbnail);
        }else{
            return asset('storage/random_pics/' . rand(1,22) . '.jpg');
        }
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

    //Count Posts By Month
    public Static function FindCoursesByMonth($categoryName, $monthNumber)
    {   
        //$category = Category::whereName($categoryName)->first();
        //return Self::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $monthNumber)->whereCategoryId($category->id)->count();
        //return self::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $monthNumber)->get();
        return rand(0,50);
    }


    //Count Categories
    public static function CountCategories()
    {
        $categories = Category::limit(10)->get();
        $countCategories = [];
        
        foreach($categories as $key => $value)
        {
            $key = $value->name;
            $countCategories[$key] = [];
            $countCategories[$key] = $value->courses()->count();
        }
 
        return $countCategories;
    }


    public function delete(){

        // Delete Sections Related To First
        $this->sections()->delete();

        // Afterwards Delete The Course
        return parent::delete();
    }
}
