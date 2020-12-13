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


        <div class="row">
          <div class="col-md-12">
            <div class="bg-mattBlackLight p-3" style="border-radius:8px;">
              <h4 class="mb-2 text-center">  Courses Of Month {{ date("M") }}</h4>
              <div>{!! $postsAddingInYear->container() !!}</div>
            </div>
          </div>
         
        </div>
        

        <div class="row">
          <div class="col-md-6 my-3">
            <div class="bg-mattBlackLight p-3" style="border-radius:8px;">
              <h4 class="mb-2 text-center">Courses By Category</h4>
            <div>{!! $countCategoryChart->container() !!}</div>
          </div>
          </div>
  
          <div class="col-md-6 my-3">
            <div class="bg-mattBlackLight p-3" style="border-radius:8px;">
              <h4 class="mb-2 text-center">Courses By Subscription</h4>
            <div>{!! $countSubscription->container() !!}</div>
          </div>
          </div>
        </div>



        <div class="row">
          <div class="col-md-6 my-3">
      
            <div class="bg-mattBlackLight p-3" style="border-radius:8px;">
      
              <h3 class="text-center pt-3 mb-3">Last Users</h3>
      
              <table class="table table-striped table-dark" style="width: 95%;margin: 3%;">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                  </tr>
                </thead>
                @foreach ($users as $user)
                  <tbody>
                    <td scope="row">#</td>
                    <td>{{ $user->id ?? 0  }}</td>
                    <td>{{ $user->user_name }}</td>
                  </tbody>
                @endforeach
              </table>
      
            </div>
      
          </div>
      
      
        <div class="col-md-6 my-3">
      
          <div class="bg-mattBlackLight p-3" style="border-radius:8px;">
      
            <h3 class="text-center pt-3 mb-3">Last Admins</h3>
      
            <table class="table table-striped table-dark" style="width: 95%;margin: 3%;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">id</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              @foreach ($admins as $admin)
                <tbody>
                  <td scope="row">#</td>
                  <td>{{ $admin->id ?? 0  }}</td>
                  <td>{{ $admin->user_name }}</td>
                </tbody>
              @endforeach
            </table>
          </div>
        </div>
      
        </div>
       
</div>





@endsection


@section('footer')
{!! $postsAddingInYear->script() !!}
{!! $countCategoryChart->script() !!}
{!! $countSubscription->script() !!}

@endsection