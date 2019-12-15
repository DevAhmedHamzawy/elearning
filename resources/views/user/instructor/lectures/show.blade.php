@extends('layouts.app')

@section('content')

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{ $course->name }}</h2>
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
                <div class="card-header">
                    {{ $course->name }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    <ul class="list-group">
                        <li class="list-group-item">
                            <video id="video"  controls  width="1050" height="468">
                                <source src='{{ asset("storage/courses/{$course->slug}/sections/{$section->slug}/lessons/{$lecture->video}") }}' type="video/mp4">
                            </video>
                        </li>
                    </ul>

                    <attachments course_slug="{{ $course->slug }}" section_slug="{{ $section->slug }}" lecture_slug="{{ $lecture->slug }}"  inline-template>
                            <div>
                                <h2 class="text-center" onclick="document.getElementById('file-upload').click()">
                                    <i class="ti-clip"></i>
                                    Attach File
                                </h2>
                                <input type="file" id="file-upload" multiple ref="attachments" @change="upload">
                                
                                <ul class="list-group d-flex">

                                    <li class="list-group-item d-flex justify-content-between" v-for="upload in uploads" :key="upload.id">
                                        <p><a :href="upload[1]" target="_blank">@{{ upload[0] }}</a></p>
                                        <p>
                                        <button class="genric-btn danger-border" @click="deleteAttachment(lecture_slug, upload[0] , key)">
                                            <i class="ti-trash"></i>
                                        </button>
                                        </p>
                                    </li>

                                </ul>
                            </div>
                    </attachments>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')    
    <script>
        window.CURRENT_VIDEO = '{{ $lecture->video }}'
    </script>
    <!-- script src='{{ asset('js/player.js') }}'></script!-->
    <script>
        function videoEnded() {
    
        }
    </script>
@endsection