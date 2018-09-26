@extends('layouts.backend')

@section('content')
<div class="container-fluid">
  <div class="row m-t-10">
    <div class="col-lg-12">
      @if ($errors->any())
        <ul class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                {{ session('danger') }}
            </div>
        @endif
    </div>
  </div>
<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-plus"></i> Add Task
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('jobs.index')}}"><i class="fa fa-cog"></i> Jobs</a>
        </li>
        <li class="">
        <i class="fa fa-plus"></i> Add Task
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <div class="row">
    <div class="col-lg-12">
      @foreach ($jobs as $job)
        {{$job->id}}
      @endforeach
    </div>
  </div>
</div>
@endsection
