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
    public function index(Course $course, Section $section, Lecture $lecture)
    {
        $attachments = Attachment::getAttachments($lecture);
        $attachmentsPaths = [];
        $path = "public/courses/".$course->slug."/sections/".$section->slug."/attachments/".$lecture->slug."/";

        foreach($attachments as $attachment){
            array_push($attachmentsPaths, [$attachment->name, $path.= $attachment->name]);
        }

        return $attachmentsPaths;
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
        return $lecture->attachments()->create($request->except('attachment_file'));
    }

    public function destroy(Course $course, Section $section, Lecture $lecture)
    {
        return 'done';
    }
}
