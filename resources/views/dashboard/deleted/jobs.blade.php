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
          <a href="{{route('jobs.index')}}"><i class="fa fa-cog"></i> Manage Jobs</a>
        </li>
        <li class="">
        <i class="fa fa-users"></i> Deleted Jobs
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- All Users -->
<div class="row">
  <div class="col-lg-12 m-b-15">
      <table class="table table-striped table-hover table-responsive">
        <thead>
          <th>Name</th>
          <th>Type</th>
          <th>Description</th>
          <th>Status</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($deletedJobs as $deletedJob)
          <tr>
            <td>{{$deletedJob->name}}</td>
            <td>{{$deletedJob->type}}</td>
            <td>{{ substr(strip_tags($deletedJob->description), 0, 25) }}{{ strlen(strip_tags($deletedJob->description)) > 25 ? "..." : "" }}</td>
            <td>
                @if ($deletedJob->status == "complete")
                  <i class="btn btn-danger btn-xs">Complete</i>
                  @elseif ($deletedJob->status == "in process")
                  <i class="btn btn-success btn-xs">In Process</i>
                @endif
            </td>
            <td>{{date('M j Y h:i a', strtotime($deletedJob->start))}}</td>
            <td>{{date('M j Y h:i a', strtotime($deletedJob->end))}}</td>
            <td>
              {!! Form::open(['method' => 'DELETE', 'action' => ['DeletedController@restoreJob', $deletedJob->id], 'class' => 'jobrestore']) !!}
                {{ Form::submit('Restore', ['class' => 'btn btn-success btn-xs'])}}
              {!! Form::close() !!}
             </td>
                <td>
              {!! Form::open(['method' => 'DELETE', 'action' => ['DeletedController@deleteJob', $deletedJob->id], 'class' => 'jobdelete']) !!}
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
