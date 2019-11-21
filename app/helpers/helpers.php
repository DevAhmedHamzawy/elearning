<?php 

function upload_image($image, $name){
    $fileName = str_slug($name) . '.' . $image->getClientOriginalExtension();
    $image->storePubliclyAs('public/courses/images/', $fileName);

    return $fileName;
}

function upload_video($video, $sort, $name){
    $sorts = ["promo" => "public/courses/promos/"];
    $fileName = str_slug($name) . '.' . $video->getClientOriginalExtension();
    $video->storePubliclyAs($sorts[$sort], $fileName);

    return $fileName;
}