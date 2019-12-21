@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                    <table class="table table-striped table-dark">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            @forelse ($users as $user)
                            <tbody>
                                <tr>
                                    <td scope="row">#</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->img }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->user_name) }}" class="btn btn-primary">Show</a>
                                        <a href="{{ route('users.edit', $user->user_name) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $user->user_name) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            @empty
                                <li class="list-group-item">
                                    No users Added
                                </li>
                            @endforelse
                        </table>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection