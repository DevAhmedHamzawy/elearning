<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\LectureFormRequest;
use App\Lecture;
use App\Section;

class LectureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Section $section, LectureFormRequest $request)
    {
        $premium = $request->premium == 'true' ? 1 : 0;
        $request->merge(['course_id' => $course->id, 'section_id' => $section->id, 'video' => upload_video($request->video_file, "lesson", $request->name, $course->slug, $section->slug), 'duration' => 5 , 'premium' => $premium  ,'slug' => str_slug($request->name)]);
        return $section->lectures()->create($request->except('video_file'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Section $section, Lecture $lecture)
    {
        return view('user.instructor.lectures.show')->withCourse($course)->withSection($section)->withLecture($lecture);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course, Section $section, Lecture $lecture, LectureFormRequest $request)
    {
        $lecture->update($request->all());

        return $lecture->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Section $section, Lecture $lecture)
    {
        $lecture->delete();
        return response()->json(['status' => 'ok'], 200);
    }
}
