<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Attachment;
use App\Category;
use App\Contact;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use Spatie\Newsletter\Newsletter;

class AdminPanelController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard', ['coursesno' => Course::count(), 'categoriesno' => Category::count(), 'usersno' => User::count(), 'adminsno' => Admin::count(), 'contactsno' => Contact::count(), 'attachmentsno' => Attachment::count(), 'bestRatingCourses' => Course::bestRatingCourses() , 'worstRatingCourses' => Course::worstRatingCourses() ]);
    }
}
