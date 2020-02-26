@extends('employee.layout.default')
@section('content')    
	<section class="search_top">
		<div class="container">
			<div class="row">
				<div class="main_body">
				<div class="col-md-12">
					<div class="find-job">
						<form method="get" action="{{ route('employee.joblist') }}">
						<div class="form-group">
							<div class="row">
							<div class="col-md-6 p-0">
								<input type="text" name="q" class="form-control in-1" value="{{$q ?? ''}}" placeholder="Job title, keywords, or company">
							</div>
							<div class="col-md-5 p-0">
								<input type="text" name="l" class="form-control in-2 city" value="{{$l ?? ''}}" placeholder="city, state">
							</div>
						<div class="col-md-1 p-0">
						<button class="btn btn-info find-jb" >Find Job</button>					
					</div>
					</div>
				</div>
			</form>
	 	     </div>
	       </div>
        </div>
	</div>
	</section>
	<section class="search_result">
		<div class="container">			
				<div class="main_body">
					<div class="row">						
						<h3 class="job-title">{{$jobs->total()}} {{$q ?? 'All'}} Jobs in {{$l ?? 'All'}}</h3>						
					</div>

				<!---Job List---->
				@foreach($jobs as $index=>$job)
							
						<div class="job row" >
							<div class="col-md-10 pl-10">
								<h2><a href="{{route('employee.jobdetail', ['post' => base64_encode($job->id)])}}">{{$job->title}}</a></h2>
								<h4>{{$job->company->name}}</h4>
								<div class="experience_salary">
									<h5><span><img src="{{url('')}}/images/employee/job.png" alt="job-image"> </span>{{$job->min_experience}} to {{$job->max_experience}} /Yrs  <span class="rupay"> 
									<img src="{{url('')}}/images/employee/rupay.png" alt="rupay-image"> </span> Rs {{$job->salary_range_from}} - {{$job->salary_range_to}} /{{$job->salary_range_per}} </h5>
								</div>
							</div>

							<div class="col-md-2 text-center">
								<button type="button" name="apply" onclick="applyjob({{$job->id}},{{$job->company->id}})" class="btn btn-light">Apply</button>
							</div>

							<div class="col-md-12 job-desc pl-10"> 
								<h6>Job Description</h6>
								<p>
									{{$job->job_summary}}
								</p>
							</div>
							<hr>
							<div class="col-md-12 pl-10">
							<p class="Skills">
								<span>Skills :</span> 	{{$job->skills}}
								</p>	
							</div>	
						</div>

				@endforeach
				<!--- Job List End---->
				<div class="paginations">
					<p class="pull-left lst-show">Showing {{ $jobs->firstItem() }} to {{$index + $jobs->firstItem()}}  of {{ $jobs->total() }} entries</p>
					<ul class="pagination pull-right">
						{{ $jobs->links() }}
					</ul> 
				</div>
					
		</div>
		</div>

		<?php 
		
			if(isset($_POST['apply'])){


			}


		?>
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
        					$("#apply_jb").modal('toggle');
        				}else{
							$("#apply_jb").modal('toggle');
        				}

        			}

        		});
			
        	}
		// });
</script>
@stop

