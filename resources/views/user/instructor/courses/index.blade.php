@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('courses.create') }}" class="btn btn-primary" style="float:right">Create Course</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="progress-table-wrap">
                            <div class="progress-table">
                                <div class="table-head">
                                    <div class="id">#</div>
                                    <div class="course_name">Course Name</div>
                                    <div class="operations">Operations</div>
                                </div>
                                @forelse ($courses as $course)
                                <div class="table-row">
                                    <div class="id">{{ $course->id }}</div>
                                    <div class="course_name">{{ $course->name }}</div>
                                    <div class="operations">
                                        <a href="{{ route('courses.show', $course->slug) }}" class="genric-btn info-border mr-2"><i class="ti-eye"></i></a>
                                        <a href="{{ route('courses.edit', $course->slug) }}" class="genric-btn warning-border mr-2"><i class="ti-pencil-alt"></i></a>
                                        <form action="{{ route('courses.destroy', $course->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="genric-btn danger-border mr-2" type="submit"><i class="ti-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <li class="list-group-item">
                                    No courses Added
                                </li>
                                @endforelse
                            </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection