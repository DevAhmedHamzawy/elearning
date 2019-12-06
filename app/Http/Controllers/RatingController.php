<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\RatingFormRequest;
use App\Rating;


class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, RatingFormRequest $request)
    {
        $request->merge(['course_id' => $course->id]);
        return auth()->user()->ratings()->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(RatingFormRequest $request, Course $course, Rating $rating)
    {
        $request->merge(['course_id' => $course->id]);
        $rating->update($request->all());
        return $rating->fresh();
    }
}
