@extends('employee.layout.auth')
@section('content')
<section class="register">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="user-form">
						<h4>Hello, Join us!</h4>
						<p>Register and find your  job</p>
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<!-- <input type="text" class="form-control" placeholder="Name"> -->
										<input id="name"  placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<!-- <input type="text" class="form-control" placeholder="Enter your Email address"> -->
										<input id="email" type="email" placeholder="Enter your Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<!-- <input type="password" class="form-control" placeholder="Enter your Password"> -->
										<input id="password" placeholder="Enter your Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
											@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<!-- <input type="password" class="form-control" placeholder="Confirm password"> -->
										<input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
									</div>
								</div>
							</div>
							<div class="form-group form-check">
								<label class="form-check-label">
								  <input class="form-check-input" type="checkbox">By joining I agree with <a href="#">Private Policy</a>
								</label>
							</div>
							<div class="text-center">
								<!-- <button type="submit" class="btn btn-info signup">Signup</button> -->
								<button type="submit" class="btn btn-info signup">
                                    {{ __('Register') }}
                                </button>
							</div>
							<div class="text-center social">
								<div class="mb-2"><span>Or</span></div>
								<a href="#" target="_blank"><button type="button" class="btn btn-default commn"><img src="{{url('')}}/images/employee/google.png">Signup with google</button></a>
								<a href="#" target="_blank"><button type="button" class="btn btn-default commn"><img src="{{url('')}}/images/employee/facebook.png">Signup with facebook</button></a>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-block">
						<img src="{{url('')}}/images/employee/user.png" alt="user-image" class="img-fluid mb-2">
						<h4>Find jobs that match your skills across top employers in  the country</h4>
						<ul class="list">
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>AI in Recruiting Technology</li>
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>Conversational UI</li>
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>Create a Ready to Hire talent pipeline for  your sourcing needs</li>
							<li class="nav-item"><span><img src="images/rectangle.png" alt=""></span>Data Security</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

@stop
