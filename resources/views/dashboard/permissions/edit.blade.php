@extends('layouts.backend')

@section('content')
<div class="container-fluid">

<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-pencil"> Edit {{$permission->display_name}}</i>
      </h3>
      <ol class="breadcrumb">
        <li class="">
            <a href="{{route('permissions.index')}}"><i class="fa fa-pencil"></i> Manage Permissions</a>
        </li>
        <li class="">
            <i class="fa fa-pencil"> Edit {{$permission->display_name}}</i>
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <!-- Create form -->
  <form action="{{route('permissions.update', $permission->id)}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
          <div class="card-body">
            <div class="card-header"><strong>Edit Permission</strong></div>

          <!-- <div class="field m-t-10 m-b-10">
            <input type="radio" name="permission_type" value="basic" v-model="permissionType"> Basic permission
            <input type="radio" name="permission_type" value="crud" v-model="permissionType"> CRUD permission
          </div> -->

          <div class="field m-t-10" v-if="permissionType == 'basic'">
            <!-- <div class="field m-t-10"> -->
            <label for="display_name">Name (Display Name)</label>
            <p>
              <input type="text" name="display_name" id="display_name" class="form-control" value="{{$permission->display_name}}" required>
            </p>
          </div>

          <div class="field" v-if="permissionType == 'basic'">
            <label for="name">Slug</label>
            <p>
              <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}" required disabled>
            </p>
          </div>

          <div class="field" v-if="permissionType == 'basic'">
            <label for="description">Description</label>
            <p>
              <input type="text" name="description" id="description" class="form-control" value="{{$permission->description}}" placeholder="Describe what this permission does!" required>
            </p>
          </div>
          <button type="submit" class="btn btn-primary">Save Permission</button>
      </div>
    </div>
    <!-- <div class="card">
      <div class="card-body">
        <div class="field" v-if="permissionType == 'crud'">
          <label for="resource">Resource</label>
          <p>
            <input type="text" name="resource" id="resource" v-model="resource" class="form-control" placeholder=" The name of the resource!">
          </p>
        </div>

        <div class="field" v-if="permissionType == 'crud'">
          <div class="field">
            <input type="checkbox" name="create" value="create" v-model="crudSelected"> Create
          </div>
          <div class="field">
            <input type="checkbox" name="read" value="read" v-model="crudSelected"> Read
          </div>
          <div class="field">
            <input type="checkbox" name="update" value="update" v-model="crudSelected"> Update
          </div>
          <div class="field">
            <input type="checkbox" name="delete" value="delete" v-model="crudSelected"> Delete
          </div>
        </div>
        <input type="hidden" name="crud_selected" v-model="crudSelected">

        <div class="field">
          <table class="table" v-if="resource.length >= 3">
            <thead>
              <th>Name</th>
              <th>Slug</th>
              <th>Description</th>
            </thead>
            <tbody>
              <tr v-for="item in crudSelected">
                <td v-text="crudName(item)"></td>
                <td v-text="crudSlug(item)"></td>
                <td v-text="crudDescription(item)"></td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div> -->

 </div>
</div><!--/.row -->
</form>
</div><!--/.container -->
@endsection

<!-- @section('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        permissionType: 'basic',
        resource: '',
        crudSelected: ['create', 'read', 'update', 'delete']
      },
      methods: {
        crudName: function(item) {
          return item.substr(0,1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
        },
        crudSlug: function(item) {
          return item.toLowerCase() + "-" + app.resource.toLowerCase();
        },
        crudDescription: function(item) {
          return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
        }
      }
    });
  </script>
@endsection -->
