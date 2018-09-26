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
        <i class="fa fa-users"></i> Manage Users
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="">
        <i class="fa fa-users"></i> Manage Users
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- Buttons row -->

  <div class="row">
    <div class="col-lg-12 m-b-15">
      @role(['superadministrator', 'administrator'])
        <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create New User </a>
      @endrole
      @role('superadministrator')
        <a href="{{route('deleted.accounts')}}" class="btn btn-danger"><i class="fa fa-user"></i> Deleted Accounts </a>
      @endrole
    </div>
  </div><!--/.row -->

<!-- All Users -->
<div class="row">
  <div class="col-lg-12 m-b-15">
      <table class="table table-striped table-hover table-responsive">
        <thead>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Activity</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>
              {{$user->roles->count() == 0 ? 'No roles yet' : ''}}
              @foreach ($user->roles as $role)
                {{$role->display_name}}
              @endforeach
            </td>
            <td>
              @if ($user->current_login < $user->last_logout)
                    <p class="btn btn-danger btn-xs">Offline</p>
                    @elseif ($user->current_login > $user->last_logout)
                    <p class="btn btn-success btn-xs">Online</p>
                    @elseif ($user->current_login == '')
                    <p class="btn btn-danger btn-xs">Offline</p>
                @endif
            </td>
            <td>
              <a href="{{route('users.show', $user->id)}}" class="btn btn-primary btn-xs">View</a>
              @role(['superadministrator', 'administrator'])
              <a href="{{route('users.edit', $user->id)}}" class="btn btn-default btn-xs">Edit</a>
              @endrole
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div><!--/.row -->


</div><!--/.container-fluid -->

@endsection
