@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                    <table class="table table-striped table-dark">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        @forelse ($newsletterMembers['members'] as $newsletterMember)
                        <tbody>
                            <tr>
                                <td scope="row">#</td>
                                <td>{{ $newsletterMember['email_address'] }}</td>
                                <td>
                                    {{--<a href="{{ route('subnewsletterMembers.index', $newsletterMember->slug) }}" class="btn btn-primary">Show</a>--}}
                                </td>
                            </tr>
                        </tbody>
                        @empty
                            <li class="list-group-item">
                                No One Subscribed In The Newsletter
                            </li>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection