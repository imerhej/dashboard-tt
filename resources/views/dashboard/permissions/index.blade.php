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
        <i class="fa fa-pencil"></i> Manage Permissions
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="">
        <i class="fa fa-pencil"></i> Manage Permissions
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- Buttons row -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create New Permissions </a>
    </div>
  </div><!--/.row -->

<!-- All Permissions -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <table class="table table-hover table-striped table-responsive">
          <thead>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($permissions as $permission)
            <tr>
              <td>{{$permission->name}}</td>
              <td>{{$permission->display_name}}</td>
              <td>{{$permission->description}}</td>
              <td>{{date('F j Y', strtotime($permission->created_at))}}</td>
              <td>{{date('F j Y', strtotime($permission->updated_at))}}</td>
              <td>
                <a href="{{route('permissions.show', $permission->id)}}" class="btn btn-primary btn-xs">View</a>
                <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-default btn-xs">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
  </div><!--/.row -->

</div><!--/.container-fluid -->

@endsection
