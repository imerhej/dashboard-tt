@extends('layouts.backend')

@section('content')
<div class="container-fluid">
<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-cog"></i> Manage Job
      </h3>
      <ol class="breadcrumb">
        <li class="">
          <a href="{{route('jobs.index')}}"><i class="fa fa-cog"></i> Jobs</a>
        </li>
        <li class="">
        <i class="fa fa-cog"></i> Manage Job
        </li>
      </ol>
    </div>
  </div><!--/.row -->

      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <strong>Job Details:
                @if ($job->status == "complete")
                  <i class="btn btn-danger btn-xs">Complete</i>
                  @elseif ($job->status == "in process")
                  <i class="btn btn-success btn-xs">In Process</i>
                @endif
              </strong>
              @canAndOwns('job-owner', $job)
              <a href="{{route('jobs.edit', $job->id)}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-pencil"></i> Edit Job </a>
              @endOwns
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <label for="first_name">Job Name:</label>
                  <h5>{{$job->name}}</h5>
                </div>
                <div class="col-lg-6">
                  <label for="first_name">Job Type:</label>
                  <h5>{{$job->type}}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <label for="start">Starting Date & Time:</label>
                  <h5>{{date('M j Y h:i a', strtotime($job->start))}}</h5>
                </div>
                <div class="col-lg-6">
                  <label for="start">Starting Date & Time:</label>
                  <h5>{{date('M j Y h:i a', strtotime($job->end))}}</h5>
                </div>
              </div>

              <div class="field">
                <label for="description">Description:</label>
                <h5>{{$job->description}}</h5>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label for="created_at">Created At:</label>
                  <h5>{{date('F j Y', strtotime($job->created_at))}}</h5>
                </div>

                <div class="col-lg-6">
                  <label for="updated_at">Updated At:</label>
                  <h5>{{date('F j Y', strtotime($job->updated_at))}}</h5>
                </div>
              </div>
            </div>
          </div>
        </div><!--/.col-lg-6 -->
        <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <strong>Job Tasks:</strong>
                <!-- <a href="{{route('tasks.create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-pencil"></i> Add Task </a> -->
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <!-- <div class="field">
                      <input type="checkbox" v-model="displayTitle">
                     <label for="">Task Name</label>
                    </div> -->
                    <!-- <div class="field">
                      <input type="checkbox" v-model="displayAddTasks">
                     <label for="">Add New Task</label>
                    </div> -->
                    <div class="field">
                      <input type="checkbox" v-model="displayTaskStatistics">
                     <label for="">Task Status</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <!-- <div class="field">
                        <input type="checkbox" v-model="displayTasks">
                        <label for="">Display Tasks</label>
                    </div> -->
                    <div class="field">
                        <input type="checkbox" v-model="displayProgressBar">
                        <label for="">Show Progress Bar</label>
                    </div>
                    <!-- <div class="field">
                      <input type="text" :value="appTitle" v-on:input="changeAppTitle" class="form-control">
                      <label for="">Job Title</label>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" v-on:submit="addTask">
                          {{ csrf_field() }}
                          <div class="col-lg-8">
                            <input type="hidden" v-model="tasks" name="tasks">
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <input type="text" name="name" class="form-control" v-model="tasks.name">
                          </div>
                          <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary" >Add Task</button>
                          </div>
                        </form>
                        <!-- {!! Form::open(array('route' => 'tasks.store')) !!}
                         {{ Form::hidden('job_id', $job->id) }}
                          <div class="field">
                          {{ Form::label('name', 'Task Name:') }}
                          {{ Form::text('name', null, ['class' => 'form-control', 'required' =>'']) }}
                          </div>

                          {{ Form::submit('Submit', ['class' => 'btn btn-primary m-t-10']) }}
                        {!! Form::close() !!} -->
                    </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div v-if="displayProgressBar">
                      <div>
                        <h5 class="text-center">Completion Progress Bar</h5>
                      </div>

                      <div class="">
                        <div class="col-lg-12">
                          <div class="completionProgressGreyBar">
                            <div class="completionProgressGreenBar text-center" :style="{ width: percentageOfTasksCompleted + '%' }">@{{ Math.round(percentageOfTasksCompleted) }}%</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-12" v-if="displayTaskStatistics">
                          <div class="col-sm-6">
                            <p>Total Tasks: @{{ tasks.length }}</p>
                            <p>Tasks Left: @{{ leftToDo }}</p>
                          </div>
                          <div class="col-sm-6">
                            <p>Finished Tasks: @{{ checkMarkedTasks }}</p>
                            <p>Deleted Tasks: @{{ this.deletedTasks }}</p>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <!-- <h3>@{{ displayedTasksStatView }}</h3> -->
                          <!-- <h5 style="padding: 10px;" v-bind: class="manageable" class="green">@{{ leftToDo < 15 ? 'Manageable' : 'Tasks Overload' }}</h5> -->
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <table class="table table-hover table-striped table-responsive" v-if="displayTasks && tasks.length > 0">
                          <thead>
                            <th>Check Done</th>
                            <th>Task Name</th>
                            <th>Delete</th>
                          </thead>

                          <tbody>
                            <tr v-for="task in tasks">
                              <td><input type="checkbox" v-model="task.done"></td>
                              <td><span :class="{ taskDone: task.done }">@{{ task.name }}</span></td>
                              <td><button class="btn btn-danger btn-xs" v-on:click="deleteTask(task)">Delete</button></td>
                            </tr>
                          </tbody>
                        </table>
                        <h4 class="text-center" v-else>There are no tasks to display</h4>
                      </div>
                    </div>
                  </div>
                </div>

            </div><!--/.col-lg-6 -->
        </div><!--/.row -->

        <!-- <div class="col-lg-3">
            <div class="card">
              <div class="card-header">
                <strong>Employees:</strong>
              </div>
              <div class="card-body">


              </div>
            </div>
        </div> -->
        <!--/.col-lg-3 -->

        <!-- Delete Button -->
        <div class="row">
          <div class="col-lg-12">
            @role(['superadministrator'])
            @canAndOwns('job-owner', $job)
            <div class="field">
              {!! Form::open(['route' => ['jobs.destroy', $job->id], 'method' => 'DELETE', 'class' => 'job_delete']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right']) !!}
              {!! Form::close() !!}
            </div>
            @endOwns
            @endrole
          </div>
        </div><!--/.row -->
      </div> <!--/.container-fluid -->


@endsection

@section('scripts')
  <script>
    var app = new Vue({
      el:'#app',
      data: {
      // appTitle: 'Todo Task List App',
      displayTitle: true,
      displayTasks: true,
      displayProgressBar: true,
      displayAddTasks: true,
      displayTaskStatistics: true,
      displayedTasksStat: 'totalTasks',
      deletedTasks: 0,
      tasks: [],
      newTasks: {!! $job->id !!}
    },
    // ready: function() {
    //   this.created();
    // },
    // created: function () {
    //   axios.get('http://localhost:8000/dashboard/jobs/')
    //   .then (response =>  {
    //     console.log(response);
    //     this.tasks = response.data;
    //   }).catch(function (error) {
    //     console.log(error);
    //   });
    // },
    methods: {
      // changeAppTitle: function(event) {
      //   this.appTitle = event.target.value;
      // },
      addTask: function(event) {
        event.preventDefault();

        if (this.tasks.name !== '' && this.tasks.name !== undefined) {
          this.tasks.push({
            name: this.tasks.name,
            job_id: {!! $job->id !!},
            done: false,
          });
          axios.post('http://localhost:8000/dashboard/tasks/', {
            name: this.tasks.name,
            job_id: {!! $job->id !!},
            done: false

          }).then(function (response) {
            if (response.status === 200) {
              alert('Saved Successfully');
            }
          }).catch(function (error) {
            console.log(error);
          });
        }
      },
      deleteTask: function(task) {
        this.tasks.splice(this.tasks.indexOf(task), 1);
        this.deletedTasks++;
      },
      changeTotalTasks: function() {
        this.displayedTasksStat = 'totalTasks';
      },
      changeLeftToDo: function() {
        this.displayedTasksStat = 'leftToDo';
      },
      changeCheckMarked: function() {
        this.displayedTasksStat = 'checkMarked';
      },
      changeDeleted: function() {
        this.displayedTasksStat = 'deletedTasks';
      }
    },
    computed: {
      checkMarkedTasks: function() {
        let count = 0;
        for (let i = 0; i < this.tasks.length; ++i) {
          if (this.tasks[i].done == true) {
            count ++;
          }
        }
        return count;
      },
      leftToDo: function() {
        return this.tasks.length - this.checkMarkedTasks;
      },
      displayedTasksStatView: function() {
        if (this.displayedTasksStat == 'totalTasks') {
          return 'Total Tasks: ' + this.tasks.length;
        } else if (this.displayedTasksStat == 'leftToDo') {
          return 'Tasks Left: ' + this.leftToDo;
        } else if (this.displayedTasksStat == 'checkMarked') {
          return 'Check Marked Tasks: ' + this.checkMarkedTasks;
        } else if (this.displayedTasksStat == 'deletedTasks') {
          return 'Deleted Tasks: ' + this.deletedTasks;
        }
      },
      // manageable: function() {
      //   if (this.leftToDo < 15) {
      //     return 'green';
      //   } else {
      //     return 'red';
      //   }
      // },
      percentageOfTasksCompleted: function() {
        if (this.tasks.length == 0) {
          return 0;
        } else {
          return (this.checkMarkedTasks / this.tasks.length) * 100;
        }
      }
    }
  });
  </script>
@endsection
