@extends('layouts.backend')

@section('content')

            <div class="modal fade" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"></h4>
                        </div>
                        {{ Form::open() }}
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('title', 'Event Title:') }}
                                {{ Form::text('title', old('title'), ['class' => 'form-control', 'readonly' => 'true']) }}
                            </div>
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('date_start', 'Starting Date:') }}
                                    {{ Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true']) }}
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('time_start', 'Starting Time:') }}
                                    {{ Form::text('time_start', old('time_start'), ['class' => 'form-control', 'readonly' => 'true']) }}
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('date_end', 'End Date & Time:') }}
                                {{ Form::text('date_end', old('date_end'), ['class' => 'form-control', 'readonly' => 'true']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('description', 'Event Description:') }}
                                {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 6, 'readonly' => 'true']) }}
                            </div>

                            <!-- <div class="form-group">
                                {{ Form::label('color', 'Color') }}
                                <div class="input-group colorpicker">
                                    {{ Form::text('color', old('color'), ['class' => 'form-control', 'readonly' => 'true']) }}
                                    <span class="input-group-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
          {{ Form::close() }}
<div class="container-fluid">
  <!-- Page Heading and Breadcrumb -->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header">
          <i class="fa fa-calendar"></i> Calendar
        </h3>
        <ol class="breadcrumb">
          <li class="">
            <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li class="">
          <i class="fa fa-calendar"></i> Events
          </li>
        </ol>
      </div>
    </div><!--/.row -->

    <div class="row">
      <div class="col-lg-12">
        <div id='calendar'></div>
      </div>
    </div>

</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
          height: 650,
              header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay,listWeek'
            },
            timezone: "America/New_York",
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true,
            editable: true,
            selectable: true,
            selectHelper: true,
            eventClick: function(event, jsEvent, view){
              var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
              var time_start = $.fullCalendar.moment(event.start).format('hh:mm:ss');
              var date_end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD hh:mm:ss');

              $('#modal-event #title').val(event.title);
              $('#modal-event #description').val(event.description);
              $('#modal-event #date_start').val(date_start);
              $('#modal-event #time_start').val(time_start);
              $('#modal-event #date_end').val(date_end);
              $('#modal-event #color').val(event.color);
              $('#modal-event').modal('show');
          },
            events : [
                @foreach($events as $event)
                {
                    title : '{{ $event->title }}',
                    description : '{{ $event->description }}',
                    start : '{{ $event->start }}',
                    end : '{{ $event->end }}',
                    color: '{{$event->color}}'
                },
                @endforeach
            ]
        });
    });

</script>
@endsection
