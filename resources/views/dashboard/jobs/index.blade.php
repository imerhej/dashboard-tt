@extends('layouts.backend')

@section('content')
<!-- Job Modal -->
<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Create form -->
        <div class="row">
          <div class="col-lg-12">
            {!! Form::open(array('route' => 'jobs.store')) !!}
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>Add New Job</strong>
                  </div>
                  <div class="body">
                    {{ Form::hidden('user_id', $user->id) }}
                    <div class="field">
                    {{ Form::label('name', 'Job Name:') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' =>'']) }}
                    </div>
                    <div class="field">
                    {{ Form::label('type', 'Job Type:') }}
                    {{ Form::text('type', null, ['class' => 'form-control', 'required' =>'']) }}
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="field">
                          {{ Form::label('start', 'Starting Date & Time:') }}
                          <div class='input-group date' id='start'>
                              <input type='text' name="start" class="form-control" required >
                              <span class="input-group-addon">
                                  <span class="fa fa-calendar"></span>
                              </span>
                          </div>
                      </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="field">
                          {{ Form::label('end', 'Ending Date & Time:') }}
                          <div class='input-group date' id='end'>
                              <input type='text' name="end" class="form-control" required>
                              <span class="input-group-addon">
                                  <span class="fa fa-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="field">
                    {{ Form::label('description', 'Job Description:') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'required' =>'', 'rows' => 5]) }}
                    </div>
                    <div class="field">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        <!-- {{ Form::submit('Submit', ['class' => 'btn btn-primary m-t-10']) }} -->
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Tasks Modal -->
<div class="modal fade" id="tasksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="name" class="form-control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="form-control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<!--index page starts here -->
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
        <i class="fa fa-cog"></i> Manage Jobs
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="">
        <i class="fa fa-cog"></i> Manage Jobs
        </li>
      </ol>
    </div>
  </div><!--/.row -->

<!-- Buttons row -->
  <div class="row">
    <div class="col-lg-12 m-b-15">
      @role(['superadministrator', 'administrator'])
      <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jobModal">
            Create New Job
          </button>
        <!-- <a href="{{route('jobs.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Job </a> -->
        @endrole
        @role('superadministrator')
          <a href="{{route('deleted.jobs')}}" class="btn btn-danger"><i class="fa fa-cog"></i> Deleted Jobs </a>
        @endrole
    </div>
  </div><!--/.row -->

  <!-- All Jobs -->
    <div class="row">
      <div class="col-lg-12 m-b-15">
          <table class="table table-hover table-striped table-responsive">
            <thead>
              <th>Name</th>
              <th>Type</th>
              <th>Description</th>
              <th>Status</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th></th>
            </thead>
            <tbody>
              @foreach ($jobs as $job)
              <tr>
                <td>{{$job->name}}</td>
                <td>{{$job->type}}</td>
                <td>{{ substr(strip_tags($job->description), 0, 25) }}{{ strlen(strip_tags($job->description)) > 25 ? "..." : "" }}</td>
                <td>
                  @if ($job->status == "complete")
                    <i class="btn btn-danger btn-xs">Complete</i>
                    @elseif ($job->status == "in process")
                    <i class="btn btn-success btn-xs">In Process</i>
                  @endif
                </td>
                <td>{{date('M j Y h:i a', strtotime($job->start))}}</td>
                <td>{{date('M j Y h:i a', strtotime($job->end))}}</td>
                <td>
                  <a href="{{route('jobs.show', $job->id)}}" class="btn btn-primary btn-xs">View</a>

                  <a href="{{route('jobs.edit', $job->id)}}" class="btn btn-default btn-xs">Edit</a>

                  <!-- <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModal">
                    Tasks
                  </button> -->

                  <a href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#tasksModal">Tasks</a>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div><!--/.row -->

</div>
@endsection

@section('scripts')
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#start').datetimepicker();
        $('#end').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#start").on("dp.change", function (e) {
            $('#end').data("DateTimePicker").minDate(e.date);
        });
        $("#end").on("dp.change", function (e) {
            $('#start').data("DateTimePicker").maxDate(e.date);
        });
    });

var app = new Vue({
    el:'#app',
    data: {
      jobs: []
    },
    created: function () {
      axios.get('http://localhost:8000/dashboard/jobs')
      .then (response =>  {
        console.log(response);
        this.jobs = response.data;
      }).catch(function (error) {
        console.log(error);
      });
    }
});
</script>
@endsection
