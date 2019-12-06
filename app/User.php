<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Entities\Learning;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Learning, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $with = ['subscriptions'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'user_name';
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating')->where('spam', 0)->orWhereNull('spam');
    }

    public function favourites()
    {
        return $this->hasMany('App\Favourite');
    }

    public function delete(){

        // Delete Courses Related To First
        $this->courses()->delete();

        // Delete Ratings Related To First
        $this->ratings()->delete();

        // Delete Favourites Related To First
        $this->favourites()->delete();

        // Afterwards Delete The Course
        return parent::delete();
    }
}
