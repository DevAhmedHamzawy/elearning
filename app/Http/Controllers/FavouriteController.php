<?php

namespace App\Http\Controllers;

use App\Course;
use App\Favourite;
use App\Http\Requests\FavouriteFormRequest;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, FavouriteFormRequest $request)
    {
        $request->merge(['course_id' => $course->id]);
        return auth()->user()->favourites()->create($request->all());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Favourite $favourite)
    {   
        return $favourite->delete();
    }
}
