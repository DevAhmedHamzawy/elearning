@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @forelse ($categories as $category)
                            <li class="list-group-item">
                                {{ $category->name }}
                                
                                <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', $category->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                
                            </li>
                        @empty
                            <li class="list-group-item">
                                No categories Added
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection