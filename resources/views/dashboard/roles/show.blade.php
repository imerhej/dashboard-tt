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
        <i class="fa fa-users"></i> Manage Roles
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('roles.index')}}"><i class="fa fa-users"></i> Manage Roles</a>
        </li>
        <li class="">
        <i class="fa fa-user"></i> {{ $role->display_name }}
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- Buttons row -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit This Role </a>
    </div>
  </div><!--/.row -->

<!-- Role Details -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <div class="card">
          <div class="card-header">
            {{$role->display_name}}
          </div>
          <div class="card-body">
            <h4 class="card-title">Role Name:</h4> ({{$role->name}})
            <h4 class="card-title">Description:</h4> {{$role->description}}
            <h4 class="card-title">Permissions:</h4>
            <ul>
              @foreach($role->permissions as $rol)
                <li>{{ $rol->display_name }} <em>({{ $rol->description }})</em></li>
              @endforeach
            </ul>
          </div>
        </div>
    </div>
  </div><!--/.row -->
</div><!--/.container-fluid -->

@endsection
