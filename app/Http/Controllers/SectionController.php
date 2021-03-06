<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\SectionFormRequest;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, SectionFormRequest $request)
    {
        $request->merge(['slug' => str_slug(request('name'))]);
        $course = $course->sections()->create($request->all());
        return $course;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Section $section)
    {
        return view('user.instructor.sections.show')->withCourse($course)->withSection($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionFormRequest $request, Course $course, Section $section)
    {
        $request->merge(['slug' => str_slug(request('name'))]);
        $section->update($request->all());
        return $section->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Section $section)
    {
        $section->delete();
        return response()->json(['status' => 'ok'], 200);
    }
}
