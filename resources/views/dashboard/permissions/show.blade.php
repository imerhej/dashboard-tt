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
        <i class="fa fa-pencil"></i> Manage Permission
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('permissions.index')}}"><i class="fa fa-pencil"></i> Manage Permissions</a>
        </li>
        <li class="">
        <i class="fa fa-pencil"></i> {{ $permission->display_name }} Permission
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- Buttons row -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit This Permission </a>
    </div>
  </div><!--/.row -->

<!-- Role Details -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
        <div class="card">
          <div class="card-header">
            <strong>Permission Details</strong>
          </div>
          <div class="card-body">
            <h4 class="card-title">Permission Display Name:</h4> {{$permission->display_name}}
            <h4 class="card-title">Permission Name (Slug):</h4> ({{$permission->name}})
            <h4 class="card-title">Description:</h4> {{$permission->description}}
          </div>
        </div>
    </div>
  </div><!--/.row -->
</div><!--/.container-fluid -->

@endsection
