<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        Newsletter::subscribe($request->email);
        return redirect()->back()->withStatus('Email Added Successfully');
    }

    public function getMembers()
    {
        dd(Newsletter::getMembers());
    }
}
