<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use App\http\Requests\CourseFormRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.courses.index')->withCourses(Course::whereUserId(auth()->user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.courses.add')->withCategories(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @helpers \App\helpers\helpers.php upload_image
     */
    public function store(CourseFormRequest $request)
    {
        $request->merge(['thumbnail' => upload_image($request->thumb, $request->name), 'promo_video_url' => upload_video($request->video, "promo", $request->name) ,'slug' => str_slug($request->name)]);
        $course = auth()->user()->courses()->create($request->except('thumb', 'video'));
        session()->flash('success', 'Course Created Successfully');
        return redirect()->route('courses.show', $course->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('main.courses.show')->withCourse($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('main.courses.edit')->withCourse($course)->withCategories(Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseFormRequest $request, Course $course)
    {
        $request->merge(['thumbnail' => upload_image($request->thumb, $request->name), 'promo_video_url' => upload_video($request->video, "promo", $request->name) ,'slug' => str_slug($request->name)]);
        $course->update($request->except('thumb', 'video', 'user_id'));
        session()->flash('success', 'Course Created Successfully');
        return redirect()->route('courses.show', $course->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('status', 'Course Deleted Successfully');
    }
}
