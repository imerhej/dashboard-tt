@extends('layouts.backend')

@section('content')
<div class="container-fluid">

<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-pencil"> Edit My Account</i>
      </h3>
      <ol class="breadcrumb">
        <li class="">
            <a href="{{route('myprofile.index')}}"><i class="fa fa-user"></i> My Profile</a>
        </li>
        <li class="">
            <i class="fa fa-pencil"> Edit {{$user->first_name}}</i>
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <!-- Create form -->
  <div class="row">
    <div class="col-lg-12">
      <form action="{{route('myprofile.update', $user->id)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="row">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header"><strong>Edit {{$user->first_name}} Details</strong>

              </div>
              <div class="card-body">

                <div class="field">
                  <label for="first_name" class="m-t-10">First Name</label>
                  <input type="text" name='first_name' id="first_name" value="{{$user->first_name}}" class="form-control" required >
                </div>

                <div class="field">
                  <label for="last_name" class="m-t-10">Last Name</label>
                  <input type="text" name='last_name' id="last_name" value="{{$user->last_name}}" class="form-control" required >
                </div>

                <div class="field">
                  <label for="email" class="m-t-10">Email</label>
                  <input type="email" name='email' id="email" value="{{$user->email}}" class="form-control" required >
                </div>

                <div class="field">
                  <label for="password" class="m-t-10">Password</label>
                  <div class="field">
                    <input type="radio" name="password_options" value="keep" v-model="password_options"> Do not change password
                  </div>

                  <div class="field">
                    <input type="radio" name="password_options" value="auto" v-model="password_options"> Auto generate password
                  </div>

                  <div class="input-group" v-if="password_options == 'auto'">
                    <span class="input-group-addon">
                      <span class="fa fa-lock"></span>
                    </span>
                    <input :type="type" class="form-control" :placeholder="placeholder" :value="password" name="auto_password" />
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

                  <div class="field">
                    <input type="radio" name="password_options" value="manual" v-model="password_options"> Manually change password
                  </div>

                  <p>
                    <input type="password" class="form-control m-t-10" name="password" id="password" v-if="password_options == 'manual'" placeholder="Create Password Manually" required>
                    <label for="password_confirmation" class="m-t-10" v-if="password_options == 'manual'">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" v-if="password_options == 'manual'" placeholder="Repeat Password" required>
                  </p>
                </div>
                <button type="submit" class="btn btn-primary pull-right m-t-10" >Save Changes</button>
              </div>

            </div>

          </div>
          @role('superadministrator')
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header"><strong>Select Roles</strong></div>
              <div class="card-body">
                <input type="hidden" v-model="selectedRoles" name="roles">
                  @foreach ($roles as $role)
                <div class="field">
                  <input type="checkbox" value="{{$role->id}}" v-model="selectedRoles"> {{$role->display_name}}
                </div>
                  @endforeach

              </div>
            </div>
          </div>
          @endrole
      </div>


      </form>
    </div>
  </div><!--/.row -->

</div><!--/.container -->
@endsection

@section('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        selectedRoles: {!! $user->roles->pluck('id') !!},
        password_options: 'keep',
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
          default: 'Auto generated password'
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
