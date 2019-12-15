@extends('layouts.app')

@section('content')


 <!-- breadcrumb start-->
 <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Our Courses</h2>
                            <p>Home<span>/</span>Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--::review_part start::-->
    <section class="special_cource padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>popular courses</p>
                        <h2>Special Courses</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($courses as $course)
                <div class="col-sm-6 col-lg-4">
                        <div class="single_special_cource">
                            <img src="{{ $course->thumbnail }}" class="special_img" alt="">
                            <div class="special_cource_text">
                                <a href="course-details.html" class="btn_4">{{ $course->category->name }}</a>
                                <h4>{{ $course->price }}$</h4>
                                <a href="{{ route('course.details', $course->slug) }}">
                                    <h3>{{ $course->name }}</h3>
                                </a>
                                <p>{{ $course->description }}</p>
                                <div class="author_info">
                                    <div class="author_img">
                                        <img src="{{ $course->user->img }}" width="50" height="50">
                                        <div class="author_info_text">
                                            <p>Conduct by:</p>
                                            <h5><a href="#">{{ $course->user->user_name }}</a></h5>
                                        </div>
                                    </div>
                                    <div class="author_rating">
                                        <div class="rating">
                                            <ratingsthree total_course_ratings="{{ round($course->ratings->avg('rating'),1) }}"></ratingsthree>
                                        </div>
                                        <p>{!! $course->ratings->avg('rating') !!} Ratings</p>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--::blog_part end::-->

@endsection