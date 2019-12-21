<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Category;
use App\Course;
use App\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home', ['courses' => auth()->user()->courses()->get()]);
    }

    public function welcome()
    {
        return view('welcome', ['topThreeCourses' => Course::topThreeCourses(),'userscount' => User::count(), 'coursescount' => Course::count(), 'attachmentscount' => Attachment::count() ]);
    }

    public function courses()
    {
        return view('general.courses.all', ['courses' => Course::paginate(6)]);
    }

    public function courseByCategory(Category $category)
    {
        return view('general.courses.by_category', ['courses' => Course::coursesByCategory($category->id)]);
    }

    public function courseBySubCategory(Category $category)
    {
        return view('general.courses.by_subcategory', ['courses' => Course::coursesBySubCategory($category->id)]);
    }

    public function courseDetails(Category $category, Course $course)
    {
        return view('general.course.details', ['category' => $category, 'course' => $course]);
    }

    public function about()
    {
        return view('general.other.about', ['userscount' => User::count(), 'coursescount' => Course::count(), 'attachmentscount' => Attachment::count()]);
    }

    public function contact()
    {
        return view('general.other.contact');
    }
}
