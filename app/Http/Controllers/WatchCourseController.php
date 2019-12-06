<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lecture;
use Illuminate\Http\Request;

class WatchCourseController extends Controller
{

    public function index(Course $course)
    {
        $user = auth()->user();
        if($user->hasStartedCourse($course)){
            return redirect()->route('course.watch', ['course' => $course->slug, 'lecture' => $user->getNextLectureToWatch($course) ]);
        }
        return redirect()->route('course.watch', ['course' => $course->slug, 'lecture' => $course->lectures->first()->slug]);

    }

    public function showLecture(Course $course, Lecture $lecture)
    {
        return view('user.student.course.watch', ['course' => $course,'lecture' => $lecture]);
    }

    public function completeLecture(Lecture $lecture)
    {
        auth()->user()->completeLecture($lecture);
        return response()->json(['status' => 'ok']);
    }
}
