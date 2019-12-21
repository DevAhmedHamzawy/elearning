@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $category->name }} 
                    <a href="{{ route('subcategories.create', $category->slug) }}" class="btn btn-primary" style="float:right">Create Subcategory</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @forelse ($subcategories as $subcategory)
                            <li class="list-group-item">
                                {{ $subcategory->name }}

                                <a href="{{ route('subcategories.show', [$category->slug, $subcategory->slug]) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('subcategories.edit', [$category->slug, $subcategory->slug]) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('subcategories.destroy',  [$category->slug, $subcategory->slug]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                
                            </li>
                        @empty
                            <li class="list-group-item">
                                No subcategories Added
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection