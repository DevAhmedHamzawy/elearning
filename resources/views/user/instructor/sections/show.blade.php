@extends('layouts.app')

@section('content')

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $course->name }} > {{ $section->name }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    <ul class="list-group">
                        <li class="list-group-item">
                            Lectures
                            <div id="app">
                                <lectures default_lectures="{{ $section->lectures ?? 'null' }}" course_slug="{{ $course->slug }}" section_slug="{{ $section->slug }}"></lectures>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection