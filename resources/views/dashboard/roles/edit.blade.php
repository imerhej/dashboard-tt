@extends('layouts.backend')

@section('content')
<div class="container-fluid">

<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-pencil"></i> Edit {{$role->display_name}} Role
      </h3>
      <ol class="breadcrumb">
        <li class="">
            <a href="{{route('roles.index')}}"><i class="fa fa-users"></i> Manage Roles</a>
        </li>
        <li class="">
            <i class="fa fa-pencil"> Edit {{$role->display_name}} Role</i>
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <!-- Edit Role Form -->
<form action="{{route('roles.update', $role->id)}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header"><strong>Edit {{$role->display_name}} Role</strong></div>
            <div class="card-body">
                    <div class="form-group">
                        <label for="display_name">Role Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" value="{{$role->display_name}}">
                    </div>

                    <div class="form-group">
                        <label for="name">Slug (Can not be changed)</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$role->name}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description" value="{{$role->description}}">
                    </div>
                    <input type="hidden" v-model="permissionsSelected" name="permissions">
            </div>
        </div>
    </div><!-- /.col-md-6-->
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header"><strong>Select Permissions</strong></div>
            <div class="card-body">
              @foreach ($permissions as $permission)
                <div class="field">
                  <input type="checkbox" value="{{$permission->id}}" v-model="permissionsSelected"> {{$permission->display_name}} - <em>({{$permission->name}})</em>
                </div>
              @endforeach
              <button type="submit" class="btn btn-primary">Update Role</button>
                </div><!--/.card-body -->
            </div><!--/.card -->
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
  </form>
 </div><!-- /.container -->



@endsection

@section('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
            permissionsSelected: {!!$role->permissions->pluck('id') !!}
      }
    });
  </script>
@endsection
