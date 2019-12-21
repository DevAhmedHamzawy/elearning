@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('contacts.create') }}" class="btn btn-primary" style="float:right">Create contact</a>
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
                                <th scope="col">Message</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        @forelse ($contacts as $contact)
                        <tbody>
                            <tr>
                                <td scope="row">#</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>
                                    {{--<a href="{{ route('subcontacts.index', $contact->slug) }}" class="btn btn-primary">Show</a>--}}
                                </td>
                            </tr>
                        </tbody>
                        @empty
                            <li class="list-group-item">
                                No contacts Added
                            </li>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection