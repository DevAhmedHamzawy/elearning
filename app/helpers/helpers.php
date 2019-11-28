<?php 

function upload_image($image, $name){
    $fileName = str_slug($name) . '.' . $image->getClientOriginalExtension();
    $image->storePubliclyAs('public/courses/images/', $fileName);

    return $fileName;
}

function upload_video($video, $sort, $name, $course_name = null, $section_name = null){
    $sorts = ["promo" => "public/courses/promos/", "lesson" => "public/courses/${course_name}/sections/${section_name}/lessons/"];
    $fileName = str_slug($name) . '.' . $video->getClientOriginalExtension();
    $video->storePubliclyAs($sorts[$sort], $fileName);

    return $fileName;
}

function upload_file($file, $course_name = null, $section_name = null, $lecture_name = null){
    $fileName = str_slug($file) . '.' . $file->getClientOriginalExtension();
    $file->storePubliclyAs("public/courses/${course_name}/sections/${section_name}/attachments/${lecture_name}/", $fileName);

    return $fileName;
}