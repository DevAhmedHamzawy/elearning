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
                            <video id="video" onended="videoEnded()" controls  width="640" height="268">
                                <source src='{{ asset("storage/courses/{$course->slug}/sections/{$section->slug}/lessons/{$lecture->video}") }}' type="video/mp4">
                            </video>
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