@extends('layouts.app')

@section('content')

 <!-- breadcrumb start-->
 <section class="breadcrumb breadcrumb_bg" style="background-image:url({{ url($course->img_path) }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{ $course->name }}</h2>
                            <h2>From: {{ $course->start_date }} - To: {{ $course->end_date }}</h2>
                            <p><a href="{{ url("/") }}">Home</a><span>/</span><a href="#">Courses</a><span>/</span><a href="{{ route('course.details', $course->slug) }}">{{ $course->slug }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                        <video id="video"  controls  width="750" height="300">
                            <source src='{{ $course->video_path }}' type="video/mp4">
                        </video>
                    </div>
                    <div class="content_wrapper">
                        <h4 class="title_top">Description</h4>
                        <div class="content">{!! $course->description !!}</div>

                        <h4 class="title">Language</h4>
                        <div class="content">{!! $course->language !!}</div>

                        <h4 class="title">Faq</h4>
                        <div class="content">{!! $course->faq !!}</div>

                        <h4 class="title">What Will Students Learn</h4>
                        <div class="content">{!! $course->what_will_students_learn !!}</div>

                        <h4 class="title">Target Students</h4>
                        <div class="content">{!! $course->target_students !!}</div>

                        <h4 class="title">Requirements</h4>
                        <div class="content">{!! $course->requirements !!}</div>

                        <h4 class="title">Course Outline</h4>
                        <div class="content">
                            <ul class="course_list">
                                @forelse ($course->sections as $section)
                                    <li class="justify-content-between align-items-center d-flex">
                                        <h1>{{ $section->name }}</h1>
                                        {{--<a class="btn_2 text-uppercase" href="#">View Details</a>--}}
                                    </li>
                                @forelse ($section->lectures as $lecture)
                                    <li class="justify-content-between align-items-center d-flex">
                                        <p>{{ $lecture->name }}</p>
                                    </li>
                                @empty
                                    No Content For This Section
                                @endforelse    
                                @empty   
                                    No Content On This Course      
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Trainer’s Name</p>
                                    <span class="color">{{ $course->user->user_name }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Course Fee </p>
                                    <span>{{ $course->price }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Starts In</p>
                                    <span>{{ $course->start_date }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Ends In</p>
                                    <span>{{ $course->end_date }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>No. Of Hours</p>
                                    <span>{{ $course->hours_number }}</span>
                                </a>
                            </li>

                        </ul>
                        <a href="{{ route('course.learning' , $course->slug) }}" class="btn_1 d-block">Enroll the course</a>
                    </div>
                    @auth
                        <h4 class="title">Reviews</h4>
                        <div class="content">
                            <div class="feedeback row">
                                <div class="mt-10 col-md-12">
                                    <a href="#" class="btn_1" data-toggle="modal" data-target="#addRating">Add Your Feedback</a>
                                </div>
                                {{--<div class="mt-10">
                                    <favourites :course="{{ $course }}" course_slug="{{ $course->slug }}"  course_id="{{ $course->id }}" :initial-favourites="{{ $course->favourites }}" />
                                </div>--}}
                            </div>
                            <div class="comments-area mb-30">
                                <ratingstwo course_slug="{{ $course->slug }}" total_course_ratings="{{ round($course->ratings->avg('rating'),1) }}" course_ratings="{{ $course->ratings }}" auth_user_id={{ auth()->user()->id }}></ratingstwo>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Details Area =================-->
    
@endsection