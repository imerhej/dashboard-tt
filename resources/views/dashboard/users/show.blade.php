@extends('layouts.backend')

@section('content')

<div class="container-fluid">
  <div class="row m-t-10">
    <div class="col-lg-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                {{ session('success') }}
            </div>
        @endif
    </div>
  </div>

<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-user"></i> Manage {{$user->first_name}}'s Account
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Manage Users</a>
        </li>
        <li class="">
        <i class="fa fa-user"></i> {{$user->first_name}}
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <strong>{{$user->first_name}} Details</strong>
          @role(['superadministrator', 'administrator'])
          <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-pencil"></i> Edit This User </a>
          @endrole
        </div>
        <div class="card-body">
          <div class="row">
          <div class="col-lg-7">

            <div class="field">
              <label for="first_name">First Name:</label>
              <h5>{{$user->first_name}}</h5>
            </div>

            <div class="field">
              <label for="first_name">Last Name:</label>
              <h5>{{$user->last_name}}</h5>
            </div>

            <div class="field">
              <label for="first_name">Email:</label>
              <h5>{{$user->email}}</h5>
            </div>

            <div class="field">
              <label for="phone_number">Phone Number:</label>
              <h5>{{$user->address->phone_number}}</h5>
            </div>

            <div class="field">
              <label for="roles">Roles:</label>
              <p>
              {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : ''}}
              @foreach ($user->roles as $role)
                <p>{{$role->display_name}} ({{$role->description}})</p>
              @endforeach
              </p>
            </div>

            <div class="field">
              <label for="roles">Permissions:</label>
              <p>
              {{$user->permissions->count() == 0 ? 'This user has not been assigned any permission yet' : ''}}
              @foreach ($user->permissions as $permission)
                <p>{{$permission->display_name}} ({{$permission->description}})</p>
              @endforeach
              </p>
            </div>
          </div>
          <!-- User Address -->
          <div class="col-lg-5">
            <div class="field">
              <label for="address1">Address 1:</label>
              <h5>{{$user->address->address1}}</h5>
            </div>

            <div class="field">
              <label for="address2">Address 2:</label>
              <h5>{{$user->address->address2}}</h5>
            </div>

            <div class="field">
              <label for="city">City:</label>
              <h5>{{$user->address->city}}</h5>
            </div>

            <div class="field">
              <label for="state">State:</label>
              <h5>{{$user->address->state}}</h5>
            </div>

            <div class="field">
              <label for="zipcode">Zip Code:</label>
              <h5>{{$user->address->zipcode}}</h5>
            </div>

          </div>
        </div><!--/.row -->
        </div>
      </div>
    </div>

    <!-- Activity Log Column -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <strong>Activity Log</strong>
        </div>
        <div class="card-body">
            <div class="field">
              <label for="activity">Current Status:</label>
                @if ($user->current_login < $user->last_logout)
                      <p class="btn btn-danger btn-xs">Offline</p>
                      @elseif ($user->current_login > $user->last_logout)
                      <p class="btn btn-success btn-xs">Online</p>
                      @elseif ($user->current_login == '')
                      <p class="btn btn-danger btn-xs">Offline</p>
                  @endif
                  @if ($user->current_login < $user->last_logout)
                   <pre>{{\Carbon\Carbon::parse($user->last_logout)->diffForHumans()}}</pre>
                   @elseif ($user->current_login > $user->last_logout)
                   <pre>{{\Carbon\Carbon::parse($user->current_login)->diffForHumans()}}</pre>
                  @endif
            </div>
            <div class="field">
              <label for="current_logint">Login Time:</label>
              @if ($user->current_login == '')
                <pre>Never logged in</pre>
                @elseif ($user->current_login != '')
                <pre>{{date('F j Y @ h:i:s a', strtotime($user->current_login))}}</pre>
              @endif
            </div>

            <div class="field">
              <label for="last_logout">Last Logout Time:</label>
              @if ($user->last_logout == '')
                <pre>Never logged out</pre>
                @elseif ($user->last_logout != '')
                <pre>{{date('F j Y @ h:i:s a', strtotime($user->last_logout))}}</pre>
              @endif
            </div>

            <div class="field">
              <label for="last_logout">Created At:</label>
                <pre>{{date('F j Y @ h:i:s a', strtotime($user->created_at))}}</pre>
            </div>

            <div class="field">
              <label for="last_logout">Last Update:</label>
                <pre>{{date('F j Y @ h:i:s a', strtotime($user->updated_at))}}</pre>
            </div>

            @role(['superadministrator'])
            @if (Auth::user()->id != $user->id)
            <div class="field">
              {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'class' => 'delete']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
              {!! Form::close() !!}
            </div>
            @endif
            @endrole
        </div>
      </div>
    </div>
  </div>


</div><!--/.container-fluid -->

@endsection
