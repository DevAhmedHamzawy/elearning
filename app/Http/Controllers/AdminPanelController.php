<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Attachment;
use App\Category;
use App\Charts\CountCategoryChart;
use App\Charts\CoursesPerYearChart;
use App\Charts\SubscriptionChart;
use App\Contact;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Spatie\Newsletter\Newsletter;

class AdminPanelController extends Controller
{

    public function __construct()
    {
        $this->monthLabels =  ['jan', 'feb', 'mar', 'abr','may','jun','jul','aug','sep','oct','non','dec'];
    }

    public function dashboard(){


        $PostsBySortInYear = [];

        
        for($j = 1; $j < 13; $j++){
            array_push($PostsBySortInYear,Course::FindCoursesByMonth('n', $j));
        }

        $postsAddingInYear = new CoursesPerYearChart;
        $postsAddingInYear->labels = ($this->monthLabels);
        $postsAddingInYear->dataset('courses', 'line', $PostsBySortInYear);


        $countCategories = Course::CountCategories();

        $countCategoryChart = new CountCategoryChart;
        $countCategoryChart->labels = array_keys($countCategories);
        $resultCountCategories = array_values($countCategories);
        $countCategoryChart->dataset('My dataset', 'doughnut', $resultCountCategories);
        $countCategoryChart->minimalist(false);
        $countCategoryChart->displayAxes(false);


        $countSubscription = new SubscriptionChart;
        $countSubscription->labels = ['annually', 'monthly', 'free'];
        $data = [rand(500,1000), rand(600,1000) , rand(800,1000)];
        $countSubscription->dataset('My dataset', 'pie', $data);
        $countSubscription->minimalist(false);
        $countSubscription->displayAxes(false);


        $users = User::limit(20)->get();
        $admins = Admin::limit(20)->get();

        return view('admin.dashboard', ['coursesno' => Course::count(), 'categoriesno' => Category::count(), 'usersno' => User::count(), 'adminsno' => Admin::count(), 'contactsno' => Contact::count(), 'attachmentsno' => Attachment::count(), 'bestRatingCourses' => Course::bestRatingCourses() , 'worstRatingCourses' => Course::worstRatingCourses() , 'postsAddingInYear' => $postsAddingInYear, 'countCategoryChart' => $countCategoryChart, 'countSubscription' => $countSubscription, 'users' => $users, 'admins' => $admins ]);
    }
}
