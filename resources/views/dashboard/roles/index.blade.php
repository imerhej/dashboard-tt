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
          <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="">
        <i class="fa fa-cog"></i> Manage Roles
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- Buttons row -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create New Role </a>
    </div>
  </div><!--/.row -->

<!-- Roles Cards -->
<div class="row">
@foreach($roles as $role)
  <div class="col-sm-3">
    <div class="card" id="card">
      <div class="card-body">
        <h4 class="card-title text-center">{{ $role->display_name }}</h4>
        <p class="card-text">{{ $role->description }}</p>
        <h6 class="h6"><strong>Created at:</strong> {{date('F j, Y', strtotime($role->created_at))}}</h6>
        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary btn-xs">Details</a>
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-light btn-xs pull-right">Edit</a>
      </div>
    </div>
    <hr>
  </div>
  @endforeach
</div><!-- /.row -->

</div><!--/.container-fluid -->

@endsection
