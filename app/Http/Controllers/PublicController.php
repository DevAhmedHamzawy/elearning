<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('welcome','about');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function welcome()
    {
        return view('welcome', ['topThreeCourses' => Course::topThreeCourses() ]);
    }

    public function courses()
    {
        return view('general.courses.all', ['courses' => Course::activeCourses()]);
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
        return view('general.other.about');
    }

    public function contact()
    {
        return view('general.other.contact');
    }
}
