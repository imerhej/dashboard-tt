@extends('layouts.backend')

@section('content')
<div class="container-fluid">
  <div class="row m-t-10">
    <div class="col-lg-12">
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
        <i class="fa fa-pencil"></i> Edit Job
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('jobs.index')}}"><i class="fa fa-cog"></i> Jobs</a>
        </li>
        <li class="">
        <i class="fa fa-pencil"></i> Edit Job
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <!-- Create form -->
  <div class="row">
    <div class="col-lg-12">
    {!! Form::model($job, ['route' => ['jobs.update', $job->id], 'method' => 'PUT']) !!}
    <!-- {{ Form::hidden('user_id', $user->id) }} -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <strong>Edit Job</strong>
            </div>
            <div class="body">

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
                        <input type='text' name="start" class="form-control" value="{{date('m/j/Y g:i A ', strtotime($job->start))}}" required >
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
                        <input type='text' name="end" class="form-control" value="{{date('m/j/Y g:i A ', strtotime($job->end))}}" required>
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
              <div class="field m-t-15">
                {{ Form::label('status', 'Status:') }}

                {{ Form::label('status', 'In Process:') }}
                {!! Form::radio('status', 'in process', (old('$status') == 'in process')) !!}
                {{ Form::label('status', 'Complete:') }}
                {!! Form::radio('status', 'complete', (old('$status') == 'complete')) !!}

              </div>
              <div class="field">
                {{ Form::submit('Update Job', ['class' => 'btn btn-primary m-t-10']) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
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
</script>
@endsection
