@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #1ac28d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Subscribe to our awesome site</h1>
      </div>
    </div>

  </div>
</header>
@stop

@section('content')


 <!-- breadcrumb start-->
 <section class="breadcrumb breadcrumb_bg" style="background-image:url({{ url('img/main.png') }})">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="breadcrumb_iner text-center">
                  <div class="breadcrumb_iner_item">
                      <h2>Subscribe</h2>
                  </div>
              </div>
          </div>
      </div>
</div>
</section>
<!-- breadcrumb start-->
<br><br>


<section class="section" id="section-vtab">
    <div class="container text-center">
        <stripe email="{{ auth()->user()->email }}"></stripe>
    </div>
</section>    

@endsection


@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
@endsection