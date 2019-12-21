@extends('layouts.app')

@section('content')

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg" style="background-image:url({{ url('img/main.png') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Edit Course</h2>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<!-- breadcrumb start-->
<br><br>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                @if($errors->any())
                    @foreach($errors as $error)
                        {{ $error }}
                    @endforeach
                @endif

                <div class="card-header">{{ __('Course') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('courses.update' , $course->slug) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                        <div class="row">
                                <div class="col-3">
                                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                                  </div>
                                </div>
                                <div class="col-9">
                                  <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            
                                            <div class="form-group row">
                                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                    
                                                <div class="col-md-6">
                                                  
                                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $course->name }}" required autocomplete="name"  >
                    
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror textarea" cols="30" rows="10" required autocompleted="description"  >{{ $course->description }}</textarea>
                    
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="visible" class="col-md-4 col-form-label text-md-right">{{ __('Visible') }}</label>
                    
                                                <div class="col-md-6">
                    
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="visible" id="inlineRadio1" value="1">
                                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                    </div>
                    
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="visible" id="inlineRadio2" value="0">
                                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                                    </div>
                    
                                                    @error('visible')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="Thumbnail" class="col-md-4 col-form-label text-md-right">{{ __('Thumbnail') }}</label>
                                                <div class="col-md-6">
                                                    <input type="file" name="thumb" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" required  >
                                                    @error('thumbnail')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <div class="form-group row">
                                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $course->price }}" required autocomplete="price"  >
                    
                                                    @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="language" class="col-md-4 col-form-label text-md-right">{{ __('Language') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="language" type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ $course->language }}" required autocomplete="language"  >
                    
                                                    @error('language')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="faq" class="col-md-4 col-form-label text-md-right">{{ __('FAQ') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea name="faq" id="faq" class="form-control @error('faq') is-invalid @enderror textarea" cols="30" rows="10" required autocompleted="faq"  >{{ $course->faq }}</textarea>
                    
                                                    @error('faq')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="what_will_students_learn" class="col-md-4 col-form-label text-md-right">{{ __('What Will Students Learn') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea name="what_will_students_learn" id="what_will_students_learn" class="form-control @error('what_will_students_learn') is-invalid @enderror textarea" cols="30" rows="10" required autocompleted="what_will_students_learn"  >{{ $course->what_will_students_learn }}</textarea>
                    
                                                    @error('what_will_students_learn')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
    


                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                         
                                            <div class="form-group row">
                                                <label for="target_students" class="col-md-4 col-form-label text-md-right">{{ __('Target Students') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea name="target_students" id="target_students" class="form-control @error('target_students') is-invalid @enderror textarea" cols="30" rows="10" required autocompleted="target_students"  >{{ $course->target_students }}</textarea>
                    
                                                    @error('target_students')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="requirements" class="col-md-4 col-form-label text-md-right">{{ __('Requirements') }}</label>
                    
                                                <div class="col-md-6">
                                                    <textarea name="requirements" id="requirements" class="form-control @error('requirements') is-invalid @enderror textarea" cols="30" rows="10" required autocompleted="requirements"  >{{ $course->requirements }}</textarea>
                    
                                                    @error('requirements')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <input type="file" name="video" class="form-control @error('promo_video_url') is-invalid @enderror" name="promo_video_url" required  >
                                                @error('promo_video_url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                            <div class="form-group row">
                                                <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ $course->start_date }}" required autocomplete="start_date"  >
                    
                                                    @error('start_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ $course->end_date }}" required autocomplete="end_date"  >
                    
                                                    @error('end_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="hours_number" class="col-md-4 col-form-label text-md-right">{{ __('Hours Number') }}</label>
                    
                                                <div class="col-md-6">
                                                    <input id="hours_number" type="number" class="form-control @error('hours_number') is-invalid @enderror" name="hours_number" value="{{ old('hours_number') }}" required autocomplete="hours_number"  >
                    
                                                    @error('hours_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                    </div>
                                  </div>
                                </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Course') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
