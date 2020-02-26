@extends('employee.layout.auth')
@section('content')
<section class="register">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="user-form">
						<h4>Hello, Join us!</h4>
						<p>Register and find your dream job</p>
            <form class="login-form" method="post" action="{{ route('login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
							<div class="form-group">
								<div class="row">
									<div class="col-md-12 mb-3">
                
                    <input type="email" class="form-control" name="email" placeholder="Enter your Email address">
                    @if ($errors->has('email'))
                     <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
									</div>
									<div class="col-md-12">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your Password">
                    @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                   @endif
									</div>
								</div>
							</div>
							<div class="form-group form-check d-flex justify-content-between">
								<label class="form-check-label">
								<input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
                <!-- {{ __('Remember Me') }} -->
								<a href="{{ route('password.request') }}" class="font-weight-bold text-decoration-none outline" style="color:#fb4907; font-size: 14px;">Forgot Password ?</a>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-info signup">Login</button>
							</div>
							<div class="text-center social">
								<div class="mb-2"><span>Or</span></div>
								<a href="{{ url('/redirect/google') }}" target="_blank"><button type="button" class="btn btn-default commn"><img src="{{url('')}}/images/employee/google.png">Signup with google</button></a>

								<!-- <a href="{{ url('/redirect') }}" class="btn btn-primary">Login With Google</a> -->

								<a href="redirect/facebook" ><button type="button" class="btn btn-default commn"><img src="{{url('')}}/images/employee/facebook.png">Signup with facebook</button></a>
								
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-block">
						<img src="{{url('')}}/images/employee/user.png" alt="user-image" class="img-fluid mb-2">
						<h4>Find jobs that match your skills across top employers in  the country</h4>
						<div class="text-center">
							<a href="register.html" target="_blank"><button type="submit" class="btn btn-info signup">New to Recruiter? Sign Up</button></a>
						</div>
						<!-- <ul class="list">
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>AI in Recruiting Technology</li>
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>Conversational UI</li>
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>Create a Ready to Hire talent pipeline for  your sourcing needs</li>
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>Data Security</li>
						</ul> -->
					</div>
				</div>
			</div>
		</div>
	</section>
       
@stop
