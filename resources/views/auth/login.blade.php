@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="img-logo">
          <a href="{{route('login')}}"><img src="" class="img-fluid" ></a>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center">Dashboard Portal</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                              <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@webstitching.com" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                              <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" placeholder="********" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                            <a class="text-center text-muted" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <section class="footer">
          <p class="text-center">Developed By <a href="http://webstitching.com" target="_blank">Web Stitching</a>&copy; {{date('Y')}} </p>
        </section>
      </div>
    </div>
</div>
@endsection
