@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-4 my-3">
            <div class="bg-mattBlackLight p-3">
              <h4 class="mb-2">Courses</h4>
              {{ $coursesno }}
            </div>
        </div>

        <div class="col-md-4 my-3">
          <div class="bg-mattBlackLight p-3">
            <h4 class="mb-2">Categories</h4>
            {{ $categoriesno }}
          </div>
        </div>

        <div class="col-md-4 my-3">
            <div class="bg-mattBlackLight p-3">
            <h4 class="mb-2">Users</h4>
            {{ $usersno }}
            </div>
        </div>

    </div>

    <div class="row">
        
            <div class="col-md-4 my-3">
                <div class="bg-mattBlackLight p-3">
                  <h4 class="mb-2">Admins</h4>
                  {{ $adminsno }}
                </div>
            </div>
    
            <div class="col-md-4 my-3">
              <div class="bg-mattBlackLight p-3">
                <h4 class="mb-2">contactsno</h4>
                {{ $contactsno }}
              </div>
            </div>
    
            <div class="col-md-4 my-3">
                <div class="bg-mattBlackLight p-3">
                <h4 class="mb-2">Attachments</h4>
                {{ $attachmentsno }}
                </div>
            </div>
    
        </div>
</div>

@endsection