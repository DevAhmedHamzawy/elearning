<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;

class ManagingNewsletterController extends Controller
{
    public function index()
    {
        return view('admin.newsletter.index' , ['newsletterMembers' => Newsletter::getMembers()]);
    }
    
}
