@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('users.create') }}" class="btn btn-primary" style="float:right">Create User</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @forelse ($users as $user)
                            <li class="list-group-item">
                                {{ $user->user_name }}
                                
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                
                            </li>
                        @empty
                            <li class="list-group-item">
                                No users Added
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection