@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('admins.create') }}" class="btn btn-primary" style="float:right">Create Admin</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @forelse ($admins as $admin)
                            <li class="list-group-item">
                                {{ $admin->user_name }}
                                
                                <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                
                            </li>
                        @empty
                            <li class="list-group-item">
                                No admins Added
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection