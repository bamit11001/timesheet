@extends('employe.layout.auth')
@section('content') 
<section class="compny_signup">
  <div class="container">
    <div class="row main_row">
      <div class="col-md-12 p-0">
        <div class="px-3" style="border-bottom: 1px solid #ccc;">
          <h5 class="mb-3">Forgot Password</h5>
        </div>
      </div>
      <div class="col-md-6">
        <div class="user-form">     
          <h4 class="my-4"></h4>
        <form class="employer-login-form" method="post" action="">
          <div class="form-group">
            <div class="row">                 
              <div class="col-md-12 mb-3">
                <label for="name">Enter Email</label>
                <input id="email" type="email" type="text" class="form-control" placeholder="Enter Email" name="email">
                <!-- @if ($errors->has('email')) -->
                <!-- <span class="text-danger">{{ $errors->first('email') }}</span> -->
                <!-- @endif -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
              </div>
              
            </div>
            <div class="form-group form-check d-flex justify-content-between">
              <label class="form-check-label" for="remember">
              <input type="checkbox" class="form-check-input">
              <!-- <small>Remember Me</small> -->
                                 
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="Login" value="Login" class="btn btn-info signup">
            </button>
            <p class="my-3"><a href="company_signup.html" style="color:#f60;">Click to Send Mail</a></p>
          </div>
        </form>
        </div>
        </div>
        <div class="col-md-6">
          <div class="text-center right-block">
            <img src="{{url('')}}/images/employer/hr.png" alt="user-image" class="img-fluid my-3">
          </div>
        </div>
    </div>
  </div>
</section> 
@stop
