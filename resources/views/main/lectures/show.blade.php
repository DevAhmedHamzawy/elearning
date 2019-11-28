@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                            <video-js id="video" class="vjs-default-skin" controls preload="auto" width="640" height="268">
                                <source src='{{ asset("storage/courses/{$course->slug}/sections/{$section->slug}/lessons/{$lecture->video}") }}' type="video/mp4">
                            </video-js>
                            
                           
                        </li>
                    </ul>

                    <attachments course_slug="{{ $course->slug }}" section_slug="{{ $section->slug }}" lecture_slug="{{ $lecture->slug }}"  inline-template>
                            <input type="file" multiple ref="attachments" @change="upload">
                    </attachments>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">
    <style>
        .vjs-default-skin {
            width: 100%;
        }
        .thumbs-up, .thumbs-down {
            width: 20px;
            height: 20px;
            cursor: pointer;
            fill: currentColor;
        }

        .thumbs-down-active, .thumbs-up-active {
            color: #3EA6FF;
        }

        .thumbs-down {
            margin-left: 1rem;
        }
    </style>

    <style>
        .w-full {
            width: 100% !important;
        }
        .w-80 {
            width: 80% !important;
        }
    </style>
@endsection


@section('scripts')
    <script src='https://vjs.zencdn.net/7.5.4/video.js'></script>
    
    <script>
        window.CURRENT_VIDEO = '{{ $lecture->video }}'
    </script>
    <script src='{{ asset('js/player.js') }}'></script>
@endsection