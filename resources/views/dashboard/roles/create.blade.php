@extends('layouts.backend')

@section('content')
<div class="container-fluid">

<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-plus"> Create New Role</i>
      </h3>
      <ol class="breadcrumb">
        <li class="">
            <a href="{{route('roles.index')}}"><i class="fa fa-users"></i> Manage Roles</a>
        </li>
        <li class="">
            <i class="fa fa-plus"> New Role</i>
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <!-- Create New Role Form -->
<form action="{{route('roles.store')}}" method="POST">
    {{ csrf_field() }}
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-header"><strong>Create Role</strong></div>
            <div class="card-body">
                    <div class="form-group">
                        <label for="display_name">Role Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" value="{{old('display_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="name">Slug (Can not be changed)</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description" value="{{old('description')}}">
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
                      <input type="checkbox" value="{{$permission->id}}"  v-model="permissionsSelected"> {{$permission->display_name}} <em> - ({{$permission->description}})</em>
                  </div>
              @endforeach

                <button type="submit" class="btn btn-primary">Create New Role</button>
            </div>
        </div>
    </div><!-- /.col-md-6-->
 </div><!-- /.row -->
 </form>

</div><!-- /.container -->

@endsection

@section('scripts')
<script>
  var app = new Vue({
    el: '#app',
    data: {
      permissionsSelected: []
    }
  });
</script>
@endsection
