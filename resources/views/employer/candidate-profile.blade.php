@extends('employer.layout.default')
@section('content')
<section class="candidate-profile">
		<div class="container">
			<div class="row-body">            
				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<h3 class="title">My Profile</h3>
						<div class="card persnl-info">
							<div class="hedr">
								<p style="margin:0;">{{$value[0]->name ?? 'N/A'}}</p>
							</div>
							<div class="row data-row">
								<div class="col-md-3">
									<div class="image">
										@if(!is_null($value[0]->profile_img))
										<img style="width: 57%; border-radius: 52%;" src="{{asset('images')}}/employee/{{ $value[0]->profile_img }}" class="rounded-circle">
										@else
										<img style="width: 57%; border-radius: 52%;" src="{{asset('images')}}/dummy-user.png" class="rounded-circle">
										@endif
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-4">
											<p style="margin: 0;">Name:</p>
											<strong class="mb-2 d-block">{{$value[0]->name ?? 'N/A'}}</strong>
										</div>
										<div class="col-md-4">
											<p style="margin: 0;">Date of Birth:</p>
											<strong class="mb-2 d-block"><?php echo date('d M Y', strtotime($value[0]->dob)); ?></strong>
										</div>
										<div class="col-md-4">
											<p style="margin: 0;">Home Town:</p>
											<strong class="mb-2 d-block">{{$value[0]->address ?? 'N/A'}}</strong>
										</div>

										<div class="col-md-4">
											<p style="margin:0;">Gender:</p>
											<strong class="mb-2 d-block">
												@if($value[0]->gender == 'm')
													Male
												@elseif($value[0]->gender == 'f')
													Female
												@else
													Other
												@endif
											</strong>
										</div>
										<div class="col-md-4">
											<p style="margin: 0;">Nationality:</p>
											<strong class="mb-2 d-block">{{$value[0]->nationality ?? 'N/A'}}</strong>
										</div>
										<div class="col-md-4">
											<p style="margin:0;">Permanent Address :</p>
											<strong class="mb-2 d-block">{{$value[0]->address_permanent ?? 'N/A'}}</strong>
										</div>


										<div class="col-md-4">
											<p style="margin:0;">Marital Status :</p>
											<strong class="mb-2 d-block">{{$value[0]->marital_status ?? 'N/A'}}</strong>
										</div>
										<div class="col-md-4">
											<p style="margin:0;">Language known :</p>
											<strong class="mb-2 d-block">{{$value[0]->language ?? 'N/A'}}</strong>
										</div>

									</div>
								</div>
								<div class="col-md-12 mt-3">
									<h4>About Me</h4>
                                     
									<p>{{$value[0]->about_me ?? 'N/A'}}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
         
				<div class="row mb-2">
				@if(!is_null($value[0]->resume))
					<div class="col-md-12 pxx">
						<div class="card persnl-info resume">
							<div class="hedr">
								<p style="margin:0;">Resume</p>
							</div>
							<div class="row data-row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-2">
											<div class="docs">
												<img src="{{asset('images')}}/employee/doc.png" alt="doc-image" class="rounded-circle">
											</div>
										</div>
										<div class="col-md-10">
											<div class="docs-links">
												<p class="mb-0">{{ $value[0]->resume }}</p>
												<a href="{{asset('images')}}/resume/{{ $value[0]->resume }}" class="mr-3" download>Download<i class="fa fa-arrow-down ml-1"></i></a>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>
					@endif
				</div>
				
				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info skillls">
							<div class="hedr">
								<p style="margin:0;">Skills</p>
							</div>
							<div class="row data-row">
								<div class="col-md-12">
									<div class="usr-skills">
										@if(!$value[0]->users_skill->isEmpty())
										<div class="slct">
										 @foreach($value[0]->users_skill as $skill)  
											<p>{{$skill->skills->name}}</p>
										@endforeach 
										</div>
										@else
										<div class="slct">
										N/A
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info resume">
							<div class="hedr">
								<p style="margin:0;">Job Preference</p>
							</div>
							<div class="row data-row">
								<div class="col-md-4 col-sm-4">
									<div class="data">
										<p style="margin:0;">Industry:</p>
										<strong class="mb-2 d-block">{{$value[0]->job_preference->industry ?? 'N/A'}}</strong>
										<p style="margin:0;">Role:</p>
										<strong class="mb-2 d-block">{{$value[0]->designation ?? 'N/A'}}</strong>
										<p style="margin:0;">Employment Type:</p>
										<strong class="mb-2 d-block">Full time</strong>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="data">
										<p style="margin:0;">Function:</p>
										<strong class="mb-2 d-block">Information Technology</strong>
										<p style="margin:0;">Experience:</p>
										<strong class="mb-2 d-block">{{$value[0]->total_exp ?? 'N/A'}}</strong>
										<p style="margin:0;">Current Salary:</p>
										<strong class="mb-2 d-block">
											<?php 
												$n = $value[0]->current_salary;
												if ($n < 10000) {
													echo	$n_format = number_format($n);													
												} else if ($n < 10000000) {
													echo	$n_format = number_format($n / 1000, 1) . 'K';
												} else {
													echo	$n_format = number_format($n / 1000000, 1) . 'L';
												}
											?>
										</strong>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="data">
										<p style="margin:0;">Function:</p>
										<strong class="mb-2 d-block">Information Technology</strong>
										<p style="margin:0;">Job Type:</p>
										<strong class="mb-2 d-block">									
										{{$value[0]->job_preference->job_type ?? 'N/A'}}</strong>
										<p style="margin:0;">Expected Salary:</p>
										<strong class="mb-2 d-block">
											<?php 
												$n = $value[0]->min_salary;
												if ($n < 10000) {												
													echo	$n_format = number_format($n);												
												} else if ($n < 10000000) {
													echo	$n_format = number_format($n / 1000, 1) . 'K';
												} else {												
													echo	$n_format = number_format($n / 1000000, 1) . 'L';
												}

											?>
											to 
											<?php 
												$n = $value[0]->max_salary;
												if ($n < 10000) {
													echo	$n_format = number_format($n);
												} else if ($n < 10000000) {
													echo	$n_format = number_format($n / 1000, 1) . 'K';
												} else {
													echo	$n_format = number_format($n / 1000000, 1) . 'L';
												}
											?>
										</strong>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info work-exp">
							<div class="hedr">
								<p style="margin:0;">Work Experience</p>
							</div>
							@if(!$value[0]->users_company->isEmpty())
							<div class="row data-row">
							@foreach($value[0]->users_company as $userscompany)
								<div class="col-md-12">
									<div class="app-inno">
										<strong class="d-block">{{ $userscompany->designation ?? 'N/A'}}</strong>
										<strong class="">{{ $userscompany->joined_on ?? 'N/A'}} @if(is_null($userscompany->left_on )) - Present now @else to  {{ $userscompany->left_on ?? 'N/A'}} @endif</strong>
										<p>{{ $userscompany->company ?? 'N/A' }}</p>
									</div>
								</div>
							@endforeach		
							</div>
							@else
							<div class="row data-row">
								<div class="col-md-12">
									<div class="app-inno">
								N/A
							</div>
						</div>
							</div>
							@endif
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info resume edu-detail">
							<div class="hedr">
								<p style="margin:0;">Educational Details</p>
							</div>
							@if(!$value[0]->users_qualification->isEmpty())
							<div class="row data-row">
							@foreach($value[0]->users_qualification as $qualifications )
								<div class="col-md-12">
									<div class="edu-info">
										<p><strong class="d-block">	{{ $qualifications->from_university ?? 'N/A'}}</p>
										<p><strong class="d-block">{{$qualifications->qualification ?? 'N/A'}}</strong>
										<p><strong class="d-block"> {{ $qualifications->passing_year}} ({{ $qualifications->type ?? 'N/A'}})
										</strong><p><br>
									</div>
								</div>
							@endforeach	
							</div>
							@else
							<div class="row data-row">
								<div class="col-md-12">
									<div class="edu-info">
										N/A <br>
									</div>
								</div>
					@endif
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

<style>
.candidate-profile .row-body {

width: 93%;
margin-left: 13%;

}
</style>
@stop
