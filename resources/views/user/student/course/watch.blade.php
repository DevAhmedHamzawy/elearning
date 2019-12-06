@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #9ac29d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $lecture->title }}</h1>
        <p class="fs-20 opacity-70">{{  $course->title }}</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
  <div class="section bg-grey">
    <div class="container">
      @php
        $nextLecture = $lecture->getNextLecture();
        $prevLecture = $lecture->getPrevLecture();
      @endphp 
      <div class="row gap-y text-center"> 
        <div class="col-12">    
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
            
        </div>
        <div class="col-12">
          <ul class="list-group">
            @foreach($course->getOrderedLectures() as $l)
              <li class="list-group-item
                @if($l->id == $lecture->id)
                  active
                @endif
                ">
                  @if(auth()->user()->hasCompletedLecture($l))
                    <b><small>COMPLETED</small></b>
                  @endif
                  <a href="{{ route('course.watch', ['course' => $course->slug, 'lecture' => $l->slug]) }}">{{ $l->name }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@stop