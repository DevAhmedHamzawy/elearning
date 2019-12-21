@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #9ac29d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $lecture->name }}</h1>
        <p class="fs-20 opacity-70">{{ $course->name }}</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
  <!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg" style="background-image:url({{ url('img/main.png') }})">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="breadcrumb_iner text-center">
                  <div class="breadcrumb_iner_item">
                      <h2>{{ $course->name }}</h2>
                  </div>
              </div>
          </div>
      </div>
</div>
</section>
<!-- breadcrumb start-->
<br><br>

  <div class="section bg-grey">
    <div class="container">
      @php
        $nextLecture = $lecture->getNextLecture();
        $prevLecture = $lecture->getPrevLecture();
      @endphp 
      <div class="row text-center">
      <div class="col-md-5 col-xs-12">
          <ul class="list-group">
            @foreach($course->getOrderedLectures() as $l)
              <li class="list-group-item
                @if($l->id == $lecture->id)
                  active
                @endif
                ">
                  @if(auth()->user()->hasCompletedLecture($l))
                    <img src="https://img.icons8.com/flat_round/50/000000/checkmark.png">
                  @endif
                  <a href="{{ route('course.watch', ['course' => $course->slug, 'lecture' => $l->slug]) }}">{{ $l->name }}</a>
              </li>
            @endforeach
          </ul>
        </div> 
        <div class="col-xs-12">
            @if ($lecture->premium && auth()->user()->subscriptions->isEmpty())
                
                You Must <a href="{{ route('subscribe') }}">Subscribe To Watch This Lecture</a> 
                
            @else 

              <player default_course_name={{ $course->slug }} default_section_name={{ $lecture->section->slug }} default_lecture="{{ $lecture }}"
              @if($nextLecture->id !== $lecture->id)
                  next_lecture_url="{{ route('course.watch', ['course' => $course->slug, 'lecture' => $nextLecture->slug ]) }}"
              @endif 
              ></player>
              @if($prevLecture->id !== $lecture->id)
                <a href="{{ route('course.watch', ['course' => $course->slug, 'lecture' => $prevLecture->slug ]) }}" class="btn btn-info btn-lg pull-left">Prev Lecture</a>
              @endif
              @if($nextLecture->id !== $lecture->id)
                <a href="{{ route('course.watch', ['course' => $course->slug, 'lecture' => $nextLecture->slug ]) }}" class="btn btn-info btn-lg pull-right">Next Lecture</a>
              @endif

            @endif
            
        </div>
       
      </div>
    </div>
  </div>
@stop