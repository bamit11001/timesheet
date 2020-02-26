@extends('employee.layout.default')
@section('content') 
	<section class="search_top">
		<div class="container">
			<div class="row">
				<div class="main_body">
					<div class="col-md-12">
						<div class="find-job">
							<form>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 p-0">
											<input type="text" class="form-control in-1"
												placeholder="Job title, keywords, or company">
										</div>
										<div class="col-md-5 p-0">
											<input type="text" class="form-control in-2 city" placeholder="city, state">
										</div>
										<div class="col-md-1 p-0">
											<button class="btn btn-info" style="display:none;">Find Job</button>
											<a href="job_list.html" class="btn btn-info find">Find Job</a>
										</div>
									</div>
								</div>
							</form>
						</div>

					</div>

				</div>
			</div>
		</div>
	</section>


	<section class="search_result">
		<div class="container">
			<div class="main_body">
				<div class="row">
					<h3 class="job-title">185 Web Designing Jobs in Chandigarh</h3>
				</div>
				<!---Job List---->
				<div class="job row">
					<div class="col-md-12 pl-10">
						<h2>{{$job->title}}</h2>
						<h4>{{$job->company->name}}</h4>
						<div class="experience_salary">
							<h5><span><img src="{{url('')}}/images/employee/job.png" alt="job-image"> </span>{{$job->min_experience}} to {{$job->max_experience}} /Yrs <span class="rupay">
									<img src="{{url('')}}/images/employee/rupay.png" alt="rupay-image"> </span> Rs {{$job->salary_range_from}} - {{$job->salary_range_to}} /{{$job->salary_range_per}} </h5>
						</div>
					</div>

					<div class="col-md-12 job-desc pl-10 job-detail">
						<p><strong>Skills</strong> : {{$job->skills}}</p>
						<button type="button" class="btn btn-info"  onclick="applyjob({{$job->id}},{{$job->company->id}})" >Apply Now</button>
					</div><hr>

					<div class="col-md-12 pl-10">
						<div class="job-detail2">
							<h4 class="font-weight-bold">Job Description</h4>
							<p>{{$job->job_summary}}</p>
							<h4 class="font-weight-bold d-inline">Job Type :</h4><p class="d-inline ml-2">{{$job->job_type}}</p>
							<div class="exp">
								<h4 class="font-weight-bold">Experience :</h4>
								<p>{{$job->benefits}}</p>
							</div>
							<div class="exp">
								<h4 class="font-weight-bold">Education :</h4>
								<ul class="">
									<li class="">{{$job->qualification_required}} ({{$job->qualification_type}})</li>
								</ul>
							</div>	
							<div class="exp">
								<h4 class="font-weight-bold">Industry :</h4>
								<ul class="">
									<li class="">{{$job->company->nature_of_business}}</li>
								</ul>
							</div>
							<div class="save-job">
								<p> {{$job->company->created_at->diffForHumans() }}  -<a href="">save job - there a problem with this job?</a></p>
							</div>
						</div>
					</div>
				</div>
				<!--- Job List End---->

				<!---Job List---->
				<!-- <div class="job row">
					<div class="col-md-10 pl-10">
						<h2>Web & Graphic Designer</h2>
						<h4>Boffin Coders PVT. LTD, at Mohali, Punjab</h4>
						<div class="experience_salary">
							<h5><span><img src="{{url('')}}/images/employee/job.png" alt="job-image"> </span>2 to 7 Yrs <span class="rupay">
									<img src="{{url('')}}/images/employee/rupay.png" alt="rupay-image"> </span> Rs 1.5 - 3.5 Lakh/Yr </h5>
						</div>
					</div>

					<div class="col-md-2 text-center">
						<button type="button" class="btn btn-light">Apply</button>
					</div>

					<div class="col-md-12 job-desc pl-10">
						<h6>Job Description</h6>
						<p>
							We are looking for Smart Young & Energetic Web Designers & Developers with SEO and Digital
							Marketing Experience.Short Term Goals- Apart from Long Term projects in web development,
							candidate should be well versed in.
						</p>
					</div>
					<hr>
					<div class="col-md-12 pl-10">
						<p class="Skills">
							<span>Skills :</span> web designing, web technologies, html, css, jquery
						</p>
					</div>
				</div> -->
				<!--- Job List End---->

			</div>
		</div>
		<!---End/.container---->
	</section>



<!-- This Modal for apply_jb-->
<div class="modal" id="apply_jb">
	<div class="modal-dialog">
	  <div class="modal-content">
		<!-- Modal Header -->
		<div class="modal-header d-block text-center border-none">
		  <img src="{{url('')}}/images/employee/thumb.png" alt="thumb-img">
		  <h5 class="font-weight-bold mt-2 mb-0">Your application has been submitted successfully.</h5>
		</div>
		<!-- Modal body -->
		<div class="modal-body">
			<p class="mb-0 text-center">The company may try to reach you at mangat.cypress@gmail.com or 9478810300.</p>
		</div>
		<!-- Modal footer -->
		<div class="modal-footer d-block text-center" style="border: none;">
		  <button type="button" class="btn btn-info" data-dismiss="modal">Back To Home</button>
		</div>
  
	  </div>
	</div>
  </div>
  <script type="text/javascript">
//   $(document).ready(function(){
   function applyjob(jobid, companyid){
	postApplyJob(jobid, companyid);
   }
   
   
	$('#timepicker1').timepicker();
	// jQuery(document).ready(function(){
        	function postApplyJob(jobid, companyid){
        		// e.preventDefault();
        		jQuery.ajaxSetup({
        			headers: { 'csrftoken' : '{{ csrf_token() }}' }
        		});
        		jQuery.ajax({
        			url: "{{ route('employee.postapplyjob') }}",
        			method: 'post',
        			data: {
        				company_id: companyid,
        				job_id: jobid,
        				_token: "{{ csrf_token() }}"
        			},
        			success: function(data){
        				if(data.success){
        					$("#apply_jb").modal('show');;
        				}else{
							$("#apply_jb").modal('toggle');
        				}

        			}

        		});
			
        	}
		//  });
</script>


@stop

