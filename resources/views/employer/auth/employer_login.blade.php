@extends('employer.layout.auth')
@section('content') 
<section class="compny_signup">
  <div class="container">
    <div class="row main_row">
      <div class="col-md-12 p-0">
        <div class="px-3" style="border-bottom: 1px solid #ccc;">
          @if (session('status'))
                    <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                    </div>
                @endif
          <h5 class="mb-3">Sign In Your a Business Account</h5>
        </div>
      </div>
      <div class="col-md-6">
        <div class="user-form">     
          <h4 class="my-4">Hello! Welcome Back</h4>

        <form class="employer-login-form" method="post" action="{{ route('employer.login.submit') }}">
          <div class="form-group">
            <div class="row">                 
              <div class="col-md-12 mb-3">
                <label for="name">Enter Email</label>
                <input id="email" type="email" type="text" class="form-control" placeholder="Enter Email" name="email">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
              </div>
              <div class="col-md-12 mb-3">
                <label for="password">Enter Password</label>
                <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password" required>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
              </div>
            </div>
            <div class="form-group form-check d-flex justify-content-between">
              <label class="form-check-label" for="remember">
              <input type="checkbox" class="form-check-input">
              <!-- <small>Remember Me</small> -->
              <input class="form-check-input" type="checkbox" name="remember" id="remember" >
              {{ __('Remember Me') }}
              </label>
              @if (Route::has('password.request'))
              <a href="{{ url('employer/reset') }}" class="font-weight-bold text-decoration-none outline" style="color:#fb4907; font-size: 14px;">Forgot Password ?</a>
              @endif                    
            </div>
          </div>
          <div class="text-center"> 
            <button type="submit" name="Login" value="Login" class="btn btn-info signup">
              {{ __('Login') }} 
            </button>
            
            <p class="my-3">Not a member? <a href="{{ route('employer.register') }}" style="color:#f60;">Sign Up</a></p>
            @if (Route::has('password.request'))
            <p class="my-3"><a href="{{route('password.request')}}" style="color:#f60;"></a>                   
            </p>
            @endif 
                <!-- @if (Route::has('password.request')) -->
                <!-- @endif -->
          </div>
        </form>
        </div>
        </div>
        <div class="col-md-6">
          <div class="text-center right-block">

            <img src="{{url('')}}/images/employer/hr.png" alt="user-image" class="img-fluid my-3">
            <h5 class="my-2">Find jobs that match your skills across top<br> Employers in the country</h5>
          </div>
        </div>
    </div>
  </div>
</section> 

@stop
