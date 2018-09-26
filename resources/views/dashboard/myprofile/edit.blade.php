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
      {!! Form::model($user, ['route' => ['myprofile.update', $user->id], 'method' => 'PUT']) !!}

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>Edit {{$user->first_name}} Details</strong></div>
              <div class="card-body">

                <div class="field">
                {{ Form::label('first_name', 'First Name:') }}
      					{{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'required' =>'']) }}
                </div>
                <div class="field">
                {{ Form::label('last_name', 'Last Name:') }}
      					{{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'required' =>'']) }}
                </div>
                <div class="field">
                  {{ Form::label('email', 'Email:') }}
        					{{ Form::email('email', $user->email, ['class' => 'form-control', 'required' =>'']) }}
                </div>

                <div class="field">
                  {{ Form::label('phone_number', 'Phone Number:') }}
        					{{ Form::text('phone_number', $userAddress->phone_number, ['class' => 'form-control', 'required' =>'']) }}
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
                <!-- <button type="submit" class="btn btn-primary pull-right m-t-10" >Save Changes</button> -->
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
                   {{ Form::label('address1', 'Address Line 1:') }}
         					 {{ Form::text('address1', $userAddress->address1, ['class' => 'form-control', 'required' =>'', 'placeholder' => '123 N Main St']) }}
                 </div>

                 <div class="field">
                   {{ Form::label('address2', 'Address Line 2:') }}
         					 {{ Form::text('address2', $userAddress->address2, ['class' => 'form-control', 'placeholder' => 'Apartment, suite, unit, floor, building, etc.']) }}
                 </div>

                 <div class="field">
                   {{ Form::label('city', 'City:') }}
                    {{ Form::text('city', $userAddress->city, ['class' => 'form-control', 'required' => '']) }}
                 </div>

                  <div class="field">
                      {{ Form::label('state', 'State:') }}
                      {{ Form::select('state', $states, $userAddress->state,  ['class' => 'form-control', 'placeholder' => 'Select State', 'required' => '']) }}
                  </div>

                  <div class="field">
                     {{ Form::label('zipcode', 'Zip Code:') }}
                     {{ Form::text('zipcode', $userAddress->zipcode, ['class' => 'form-control', 'required' => '']) }}
                  </div>
                  {{ Form::submit('Save Changes', ['class' => 'btn btn-primary m-t-10']) }}
                </div>
              </div>
            </div>
          </div><!--/.row -->

        <!-- <div class="row">
          <div class="col-lg-6">
            <div class="card">
              @role('superadministrator')
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
            @endrole

          </div>
        </div> -->
      {!! Form::close() !!}
    </div><!--/.col-lg-12 -->
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
