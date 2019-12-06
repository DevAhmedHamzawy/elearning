<?php

namespace App\Http\Controllers;

use App\Course;
use App\Section;
use App\Lecture;
use App\Attachment;
use App\Http\Requests\AttachmentFormRequest;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Section $section, Lecture $lecture, AttachmentFormRequest $request)
    {
        $request->merge(['attachment' => upload_file($request->attachment_file, $course->slug, $section->slug, $lecture->slug)]);
        $lecture->attachments()->create($request->except('attachment_file'));
        //dd($request->all());
    }
}
