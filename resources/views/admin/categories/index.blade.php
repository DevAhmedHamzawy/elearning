@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('categories.create') }}" class="btn btn-primary" style="float:right">Create Category</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-dark">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        @forelse ($categories as $category)
                        <tbody>
                            <tr>
                                <td scope="row">#</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('subcategories.index', $category->slug) }}" class="btn btn-primary">Show</a>
                                    <a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->slug) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @empty
                            <li class="list-group-item">
                                No categories Added
                            </li>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection