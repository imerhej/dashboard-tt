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
        <i class="fa fa-users"></i> Deleted Accounts
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Manage Users</a>
        </li>
        <li class="">
        <i class="fa fa-users"></i> Deleted Users
        </li>
      </ol>
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
          <th> Deleted At</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($deletedUsers as $deletedUser)
          <tr>
            <td>{{$deletedUser->first_name}}</td>
            <td>{{$deletedUser->last_name}}</td>
            <td>{{$deletedUser->email}}</td>
            <td>
              {{$deletedUser->roles->count() == 0 ? 'No roles yet' : ''}}
              @foreach ($deletedUser->roles as $role)
               {{$role->display_name}}
              @endforeach
            </td>
            <td>{{date('F j Y @ h:i:s a', strtotime($deletedUser->deleted_at))}}</td>
            <td>
              {!! Form::open(['method' => 'DELETE', 'action' => ['DeletedController@restore', $deletedUser->id], 'class' => 'restore']) !!}
                {{ Form::submit('Restore', ['class' => 'btn btn-success btn-xs'])}}
              {!! Form::close() !!}
             </td>
                <td>
              {!! Form::open(['method' => 'DELETE', 'action' => ['DeletedController@delete', $deletedUser->id], 'class' => 'pdelete']) !!}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])}}
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div><!--/.row -->


</div><!--/.container-fluid -->

@endsection
