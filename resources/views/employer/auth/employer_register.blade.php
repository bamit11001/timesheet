@extends('employer.layout.auth')
@section('content') 
<section class="compny_signup">
    <div class="container">
      <div class="row main_row">
        <div class="col-md-12 p-0">
          <div class="px-3" style="border-bottom: 1px solid #ccc;">
            <h5 class="mb-3">Sign Up Your a Business Account</h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="user-form"> 
            <h4 class="my-4">Hello, Join us!</h4>
            <p>Enter your business contact information</p>
             @if (session('status'))
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                    </div>
                @endif
            <form class="employer-register-form" method="post" action="{{ route('employer.register.submit') }}">
             @csrf
              <div class="form-group">
                <div class="row">                 
                  <div class="col-md-12 mb-3">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="Email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="Mobile">{{ __('Mobile Number') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

                  @error('phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="password">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" name="terms" value="true" {{ !old('terms') ?: 'checked' }}>{{ __('By joining I agree with ') }} <a href="#">Private Policy3</a>
                    <br>
                    

                    @error('terms')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </label>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-info btn-primary">{{ __('Create An Account') }}</button>
              </div>
              <a href="#">Fogot Password</a>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="text-center right-block">
            <h5 class="mt-4">Hire the Right Talent, with Right Skills</h5>
            <h4 class="mb-4">Hiring is Simpler, Smarter & Faster with Cypress</h4>
            <img src="{{ url('') }}/images/employer/comp-signup.png" alt="user-image" class="img-fluid mb-2">
            <p class="my-3">Already have an account ? <a href="{{ route('employer.login') }}" style="color:#f60;">Sign In</a></p>
          </div>
        </div>
      </div>
    </div>
  </section> 
@stop
