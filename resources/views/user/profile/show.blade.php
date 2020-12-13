@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #1ac28d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Kati frantz</h1>
        <p class="fs-20 opacity-70">kati-frantz</p>
        <br>
        <h1>{{ $user->getTotalNumberOfCompletedLectures() }}</h1>
        <p class="fs-20 opacity-70">Lessons completed</p>
      </div>
    </div>

  </div>
</header>
@stop

@section('content')
<section class="special_cource padding_top" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Course being watched ...</h2>
        <hr>
        </header>


        <div class="row gap-5">
            @forelse($courses as $course)
            <div class="col-sm-6 col-lg-4">
                    <div class="single_special_cource">
                        <img src="{{ $course->thumbnail }}" class="special_img" alt="">
                        <div class="special_cource_text">
                            <a href="course-details.html" class="btn_4">{{ $course->category->name }}</a>
                            <h4>{{ $course->price }}$</h4>
                            <a href="{{ route('course.details', $course->slug) }}">
                                <h3>{{ $course->name }}</h3>
                            </a>
                            <p>{{ $course->description }}</p>
                            <div class="author_info">
                                <div class="author_img">
                                    <img src="{{ $course->user->img }}" width="50" height="50" alt="">
                                    <div class="author_info_text">
                                        <p>Conduct by:</p>
                                        <h5><a href="#">{{ $course->user->user_name }}</a></h5>
                                    </div>
                                </div>
                                <div class="author_rating">
                                    <div class="rating">
                                        <ratingsthree total_course_ratings="{{ round($course->ratings->avg('rating'),1) }}"></ratingsthree>
                                    </div>
                                    <p>{!! $course->ratings->avg('rating') !!} Ratings</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                You Didn't Watch Any Course
            @endforelse

        </div>


    </div>
</section>    

@if(auth()->id() === $user->id)
@php 
$subscription = auth()->user()->subscriptions->first();
@endphp 
<section class="section bg-gray" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Edit your profile</h2>
        <hr>
        </header>


        <div class="row gap-5">
        

        <div class="col-12 col-md-4">
            <ul class="nav nav-vertical">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home-2">
                <h6>Personal details</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages-2">
                <h6>Payments & Subscriptions</h6>
                </a>
            </li>
            @if(auth()->user()->card_brand)
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings-2">
                <h6>Card details</h6>
                </a>
            </li>
            @endif 
            </ul>
        </div>


        <div class="col-12 col-md-8 align-self-center">
            <div class="tab-content">
            
            <div class="tab-pane fade show active" id="home-2">
                <form action="{{ route('profile.update', $user->id)  }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="user_name" value="{{ $user->user_name }}" placeholder="{{ $user->user_name }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="first_name" value="{{ $user->first_name }}" placeholder="{{ $user->first_name }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="last_name" value="{{ $user->last_name }}" placeholder="{{ $user->last_name }}">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror textarea" cols="30" rows="10">{{ $user->description }}</textarea>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Save changes</button>
                    </form>
            </div>

            <div class="tab-pane fade text-center" id="profile-2">
                
            </div>

            <div class="tab-pane fade" id="messages-2">
                <form action="{{ route('subscriptions.change') }}" method="post">
                    {{ csrf_field() }}
                    <h5 class="text-center">
                        Your current plan: 
                        @if($subscription)
                        <span class="badge badge-success">{{ $subscription->stripe_plan }}</span>
                        @else 
                        <span class="badge badge-danger">NO PLAN</span>
                        @endif 
                    </h5>
                    <br>
                    @if($subscription)
                    <select name="plan" class="form-control">
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                    <br>
                    <p class="text-center">
                        <button class="btn btn-primary" type="submit">Change plan</button>
                    </p>
                    @endif
                    
                </form>
            </div>

            @if(auth()->user()->card_brand)
            <div class="tab-pane fade" id="settings-2">
                <div class="row">
                    <h2 class="text-center">
                        Your current card: <span class="badge badge-sm badge-primary">{{ auth()->user()->card_brand }}:{{ auth()->user()->card_last_four }}</span>
                    </h2>
                    <p class="ml-5 mt-5 text-center">
                        <update-card email="{{ auth()->user()->email }}"></update-card>
                    </p>
                </div>
            </div>
            @endif 

            </div>
        </div>


        </div>


    </div>
</section>
@endif

@endsection

@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
@endsection