@extends('employee.layout.default')
@section('content')    

	<section class="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h2>Find Your Dream Jobs</h2>
						<p>Over 400 000 jobs in 17000 company.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="find-job">
						<form method="get" action="{{ route('employee.joblist') }}">
						<!-- {{ csrf_field() }} -->
							<div class="form-group">
								<div class="row">
									<div class="col-md-5 p-0">
										<input type="text" name="q" class="form-control in-1" placeholder="Job title, keywords, or company">
									</div>
									<div class="col-md-5 p-0">
										<input type="text" name="l" class="form-control in-2" placeholder="city, state">
									</div>
									<div class="col-md-2 p-0">
										<button type="submit" class="btn btn-info finds" >Find Job</button>
										<!-- <a href="job_list.html" class="btn btn-info">Find Job</a> -->
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="job-categories">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="row">
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/software.png" alt="" class="">
								<p>IT - Software</p>
							</div>
						</div>
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/salebd.png" alt="" class="">
								<p>Sales / BD</p>
							</div>
						</div>
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/hotel.png" alt="" class="">
								<p>Hotel / Restaurant</p>
							</div>
						</div>
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/finance.png" alt="" class="">
								<p>Finance / Accounts</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/hrrecruit.png" alt="" class="" style="height: 50px;">
								<p>HR / Recruitment</p>
							</div>
						</div>
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/medical.png" alt="" class="">
								<p>Medical/Healthcare</p>
							</div>
						</div>
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/customer.png" alt="" class="">
								<p>Customer Service</p>
							</div>
						</div>
						<div class="col-md-3 pxx">
							<div class="text-center box">
								<img src="{{url('')}}/images/employee/jornalism.png" alt="" class="">
								<p>Journalism </p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right pxx mt-2">
							<a href="#">View More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@stop

