@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @forelse ($widgets as $widget)
                            <li class="list-group-item">
                                {{ $widget->name }}
                                
                                <a href="{{ route('widgets.edit', $widget->id) }}" class="btn btn-warning">Edit</a>
                               
                                
                            </li>
                        @empty
                            <li class="list-group-item">
                                No widgets Added
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection