@extends('layouts.app')

@section('content')

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg" style="background-image:url({{ url('img/main.png') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<!-- breadcrumb start-->
<br><br>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('courses.index') }}" class="btn btn-primary" style="float:right">All Course</a>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary mr-5" style="float:right">Create Course</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     <!--::review_part start::-->
    <section class="special_cource">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section_tittle text-center">
                            <h2>Courses You Recently Added</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($courses as $course)
                    <div class="col-sm-6 col-lg-4">
                            <div class="single_special_cource">
                                <img src="{{ $course->img_path }}" class="special_img" alt="">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
