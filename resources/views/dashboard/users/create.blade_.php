@extends('layouts.backend')

@section('content')
<div class="container-fluid">
  <div class="row m-t-10">
    <div class="col-lg-12">
        @if (session('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        <i class="fa fa-plus"> Create New User</i>
      </h3>
      <ol class="breadcrumb">
        <li class="">
            <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Manage Users</a>
        </li>
        <li class="">
            <i class="fa fa-plus"> New User</i>
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <!-- Create form -->
  <div class="row">
    <div class="col-lg-12">
      <form action="{{route('users.store')}}" method="post">
        {{ csrf_field() }}

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>Add New User</strong></div>
              <div class="card-body">

                <div class="field">
                  <label for="first_name" class="m-t-10">First Name</label>
                  <input type="text" name='first_name' id="first_name" class="form-control" required >
                </div>

                <div class="field">
                  <label for="last_name" class="m-t-10">Last Name</label>
                  <input type="text" name='last_name' id="last_name" class="form-control" required >
                </div>

                <div class="field">
                  <label for="email" class="m-t-10">Email</label>
                  <input type="email" name='email' id="email"  class="form-control" required >
                </div>

                <div class="field">
                  <label for="phone_number" class="m-t-10">Phone Number</label>
                  <input type="text" name='phone_number' id="phone_number" class="form-control" required >
                </div>

                <div class="field">
                  <label for="password" class="m-t-10">Password</label>
                  <div class="row">
                    <div class="col-lg-12 ">
                    <input type="password" class="form-control" name="password" id="password" v-if="!auto_password" placeholder="Create Password Manually" required>
                    <label for="password_confirmation" class="m-t-10" v-if="!auto_password">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" v-if="!auto_password" placeholder="Repeat Password" required>
                    <input type="checkbox" class="m-t-10" v-model="auto_password" > Auto Generate Password

                    <div class="input-group" v-if="auto_password">
                      <span class="input-group-addon">
                        <span class="fa fa-lock"></span>
                      </span>
                      <input :type="type" class="form-control" :placeholder="placeholder" :value="password" name="auto_password" required />
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary" @click="generate()">
                          <span class="fa fa-refresh"></span>
                        </button>
                      </span>

                      <span class="input-group-btn">
                        <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Copy to Clipboard"
                         v-clipboard:copy="password"
                         v-clipboard:success="done">Copy!
                        </button>
                      </span>
                    </div>

                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- user Details -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>User Address</strong></div>
              <div class="card-body">
                <input type="hidden" name="user_id">
               <div class="field">
                  <label for="address1" class="m-t-10">Address Line 1</label>
                  <input type="text" name='address1' id="address1" class="form-control" placeholder="123 N Main St" required >
                </div>

                <div class="field">
                  <label for="address2" class="m-t-10">Address Line 2</label>
                  <input type="text" name='address2' id="address2" class="form-control" placeholder="Apartment, suite, unit, floor, building, etc." >
                </div>

                <div class="field">
                  <label for="city" class="m-t-10">City</label>
                  <input type="text" name='city' id="city" class="form-control" required >
                </div>

                  <div class="field">
                    <label for="state" class="m-t-10">State</label>
                      <select name="state" class="form-control" required>
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                          <option name="state" id="state" value="{{$state->state}}">{{$state->state}}</option>
                        @endforeach
                        <!-- <option name="state" id="state" v-for="state in states" :value="state.state" required>@{{state.state}} - @{{state.state_code}}</option> -->
                      </select>
                  </div>

                <div class="field">
                  <label for="zipcode" class="m-t-10">Zip Code</label>
                  <input type="text" name='zipcode' id="zipcode" class="form-control" required >
                </div>

              </div>
            </div>
          </div>
        </div><!--/.row -->

        <!-- Permissions -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>Select Permissions</strong></div>
              <div class="card-body">
                <input type="hidden" v-model="selectedPermissions" name="permissions">
                  @foreach ($permissions as $permission)
                <div class="field">
                  <input type="checkbox" value="{{$permission->id}}" v-model="selectedPermissions"> {{$permission->display_name}}
                </div>
                  @endforeach

              </div>
            </div>
          </div>

          <!-- Roles -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>Select Roles</strong></div>
              <div class="card-body">
                <input type="hidden" v-model="selectedRoles" name="roles">
                  @foreach ($roles as $role)
                <div class="field">
                  <input type="checkbox" value="{{$role->id}}" v-model="selectedRoles"> {{$role->display_name}}
                </div>
                  @endforeach
                  <button type="submit" class="btn btn-primary m-t-10" >Create New User</button>
              </div>
            </div>
          </div>
      </div><!--/.row -->
      </form>
    </div><!--/.col-lg-12 -->
  </div><!--/.row -->

</div><!--/.container -->
@endsection

@section('scripts')
  <script>

  var app = new Vue({
      el: '#app',
      data: {
        selectedRoles: [],
        selectedPermissions: [],
        auto_password: true,
        password: this.value
      },
      props: {
        type: {
          type: String,
          default: 'text'
        },
        size: {
          type: String,
          default: '18'
        },
        characters: {
          type: String,
          default: 'a-z,A-Z,0-9'
        },
        placeholder: {
          type: String,
          default: 'Auto generate password'
        },
        auto: [String, Boolean],
        value: ''
      },
      mounted: function() {
        if(this.auto == 'true' || this.auto == 1) {
          this.generate();
        }
      },

      methods: {

        generate: function() {
          let charactersArray = this.characters.split(',');
          let CharacterSet = '';
          let password = '';

          if( charactersArray.indexOf('a-z') >= 0) {
            CharacterSet += 'abcdefghijklmnopqrstuvwxyz';
          }
          if( charactersArray.indexOf('A-Z') >= 0) {
            CharacterSet += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          }
          if( charactersArray.indexOf('0-9') >= 0) {
            CharacterSet += '0123456789';
          }
          // if( charactersArray.indexOf('#') >= 0) {
          //   CharacterSet += '![]{}()%&*$#^<>~@|';
          // }

          for(let i=0; i < this.size; i++) {
            password += CharacterSet.charAt(Math.floor(Math.random() * CharacterSet.length));
          }
          this.password = password;
        },
        done: function () {
          alert('The Password has been Copied to Clipboard!')
        }
      }
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endsection
