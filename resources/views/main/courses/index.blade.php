@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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

                    <ul class="list-group">
                        @forelse ($courses as $course)
                            <li class="list-group-item">
                                {{ $course->name }}
                                
                                <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('courses.edit', $course->slug) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('courses.destroy', $course->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                
                            </li>
                        @empty
                            <li class="list-group-item">
                                No courses Added
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection