@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $course->name }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    <ul class="list-group">
                        <li class="list-group-item">
                            Sections
                            <button type="button" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#addSection">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div id="app">
                                <sections course_slug="{{ $course->slug }}" course_sections="{{ $course->sections }}"></sections>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection