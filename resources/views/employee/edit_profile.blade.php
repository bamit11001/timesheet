
@extends('employee.layout.default')
@section('content') 

<?php //print_r($user);die; ?>   
<section class="user-profile">
		<div class="container">
			<div class="row">
				<div class="main_body">
				<div class="col-md-12">
					<h3>Build My Profile</h3>
					<form action="{{route('employee.posteditprofile')}}" name="edit-form" method="post">
						{{ csrf_field()}}
						<div class="profile">
							<div class="row">
								<div class="col-md-12">
									<div class="info"><p class="mb-0">Personal Information</p></div>
								</div>
							</div>
							<div class="row prof-rw">
								<div class="col-md-3">
									<div class="image">
										<img src="@if(!empty($user->profile_img)){{asset('images/employee')}}/{{$user->profile_img}}@else{{asset('images')}}{{'/employee/photo.png'}}@endif" id="preview_image" alt="" class="">
										<i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
										<div class="upload-rsm">
											<p class="position-relative mb-2">
												<a href='javascript:void(0)'>												
													<button class="btn btn-info mt-n1">Choose File</button>
													<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent; cursor: pointer;' name="profile_img" id="profile_img" size="10"  >
												
												</a>
											</p>
											<span style="font-size: 13px;">JPEG,PNG,GIF-2MB max</span>
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<div class="usr-infos">
										
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="name">First Name</label>
														<input type="hidden" name="id" value="{{$user->id?? ''}}">
														<input type="text" name="name" class="form-control" value="{{$user->name?? ''}}" placeholder="First name">
													</div>
													<div class="col-md-6">
														<label for="lname">Last Name</label>
														<input type="text" name="lname" class="form-control" value="{{$user->lname?? ''}}" placeholder="Last name">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="email">Email ID</label>
														<input type="text" name="email" class="form-control" value="{{$user->email ?? ''}}" placeholder="Enter email address">
													</div>
													<div class="col-md-6">
														<label for="dob">Date of Birth</label>
														<input type="date" name="dob" class="form-control" value="{{$user->dob ?? ''}}" placeholder="Date of Birth">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="nationality">Nationality</label>
														<input type="text" name="nationality" class="form-control" value="{{$user->nationality ?? ''}}" placeholder="Indian">
													</div>
													<div class="col-md-6">
														<label for="gender" class="d-block">Gender</label>
														<div class="form-check">														
															<label class="form-check-label">
																<input type="radio" class="form-check-input" value="m" name="gender"  @if($user->gender == 'm') checked=checked @endif >Male
															</label>
														</div>
														<div class="form-check">														
															<label class="form-check-label">
																<input type="radio" class="form-check-input" value="f" name="gender"  @if($user->gender == 'f') checked=checked @endif >Female
															</label>
														</div>
														<div class="form-check">														
															<label class="form-check-label">
																<input type="radio" class="form-check-input" name="gender"  value="o" @if($user->gender == 'o') checked=checked @endif>Prefer not to specify
															</label>
														</div>
													</div>
												</div>
											</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="info"><p class="mb-0">Employment</p></div>
								</div>
							</div>
							<div class="row prof-rw" class="he">
								<div class="col-md-12" id="dynamic_employment_field">
								@foreach($user->users_company as $index=>$user_companies)
								<!-- {{ $user_companies }}								 -->
									<div class="employment">
																		
											<div class="form-group" >
												<div class="row">
													<div class="col-md-6">
														<label for="designation">Designation</label>
														<input type="hidden" class="form-control" name="userscompanyid" value="{{$user_companies->id ?? ''}}">
														<input type="hidden" class="form-control" name="employment[{{ $index }}][userscompanyid]" value="{{$user_companies->id ?? ''}}">
														<input type="text" class="form-control" name="employment[{{ $index }}][designation]" value="{{$user_companies->designation ?? ''}}"  placeholder="Sr. Designer">
													</div>
													<div class="col-md-6">
														<label for="company">Company</label>
														<input type="text" class="form-control" name="employment[{{ $index }}][company]" value="{{$user_companies->company ?? ''}}" placeholder="Cypress Web India (Pvt.) Ltd">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-sm-6">
														<label for="joined_on">Started working from </label>
														<div class="row">
															<div class="col-md-12">
																<input type="date" class="form-control" name="employment[{{ $index }}][joined_on]" value="{{$user_companies->joined_on ?? ''}}" id="sel1">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<label for="salary_lakh">Salary </label>
														<div class="row">
															<div class="col-md-4">
																<select class="form-control" name="employment[{{ $index }}][salary_lakh]" id="sel1">
																	<!-- <option value="1">Less than 1 Lakh</option> -->
																@foreach(['0','1' ,'2', '3', '4', '5','6','7','8'] as $salary)
																	<option value="{{$salary}}" @if($salary == $user->users_company[0]->salary_lakh) selected='selected' @endif>{{$salary}} Lakh</option>
																	
																@endforeach	
																<!-- <option value="6">More than 6 Lakh</option> -->
																</select>
															</div>
															<div class="col-md-4">
																<select class="form-control" name="employment[{{ $index }}][salary_thousand]" id="sel1">
																	
																@foreach(['00','10', '20', '30', '40', '50', '60', '70','80', '90'] as $thousand)
																
																<option value="{{$thousand}}" @if($thousand == $user->users_company[0]->salary_thousand) selected='selected' @endif>{{$thousand}} Thousand</option>
																@endforeach	
																</select>
															</div>
															<div class="col-md-4">
																<select class="form-control" name="employment[{{ $index }}][salary_period]" id="sel1">

																	@foreach(['monthly','anually'] as $salary_time)
																	<option value="{{$salary_time}}" @if($salary_time == $user->users_company[0]->salary_period) selected='selected' @endif>{{$salary_time}} </option>
																	@endforeach	
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row" style="padding: 0 10px;">
													<div class="col-md-6">
														<div class="">
															<div class="form-group form-check">
																<label class="form-check-label">

																	<input class="form-check-input" id="iscurrent_0" name="employment[{{ $index }}][is_current]" value="0"  type="hidden" @if($user_companies->is_current == 0) unchecked @endif> 

																	<input class="form-check-input" id="iscurrent_0" name="employment[{{ $index }}][is_current]" onclick="checkCorrentCompany(this)" value="1"  type="checkbox" @if($user_companies->is_current == 1) checked @endif > This is my current company
																</label>		
															</div>
														</div>
													</div>
											</div>
											@if($user_companies->is_current == 1)
											<div class="row prof-rw">
												<div class="col-md-6">
													<div class="form-group hpd" >
														<label for="notice">Notice Period</label>
														<select class="form-control" name="employment[{{ $index }}][notice_period]  ?? 'N/A'" id="notice_period[0]">
															@foreach(['30','45'] as $notice)
															<option value="{{$notice}}" @if($notice == $user_companies->notice_period) selected='selected' @endif>{{$notice}} Days</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>		
											@else
											<div class="row" id="left_on_date">
												<div class="col-sm-12">
													<label for="left_on">End working Date </label>
												</div>
												<div class="col-sm-6">
													<input type="date" value="{{$user_companies->left_on ?? 'N/A'}}"  class="form-control" name="employment[{{ $index }}][left_on]" id="sel1">
												</div>
											</div>
										@endif	
									</div>
									@endforeach
									<i class="fa fa-plus  pull-right" id="add" >Add More</i>	
								</div>								
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="info"><p class="mb-0">Education</p></div>
								</div>
							</div>
							<div class="row prof-rw">
								<div class="col-md-12">
									<div class="education">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="email">Highest Qualification</label>
														<input type="hidden" name="usersqualificationid" value="{{$user->users_qualification[0]->id}}">
														<select class="form-control" name="qualification" id="sel1">
															@foreach(['MCA','BCA','BA','B.SC(IT)'] as $qualification)
																<option value="{{$qualification}}" @if($qualification == $user->users_qualification[0]->qualification) selected='selected' @endif>{{$qualification}} </option>
															@endforeach
										  			    </select>
													</div>
													<div class="col-md-6">
														<label for="dob">From School/University</label>
														<select class="form-control" name="from_university" id="sel1">
															@foreach(['P T U','Punjab School Education Board','Punjab Technical University'] as $univercity)
																<option value="{{$univercity}}" @if($univercity == $user->users_qualification[0]->from_university) selected='selected' @endif>{{$univercity}} </option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="email">Education Type</label>
														<select class="form-control" name="type" id="sel1">
															@foreach(['Full-time','Part-time'] as $type)
																<option value="{{$type}}" @if($type == $user->users_qualification[0]->type) selected='selected' @endif>{{$type}} </option>
															@endforeach
														</select>
													</div>
													@isset($user->users_qualification[0]->passing_year)
													@php 
													$time=strtotime($user->users_qualification[0]->passing_year); 
													$month=date("M",$time);
													$year=date("Y",$time);
													$months = ['Jan', 'Feb' , 'Mar' , 'Apr' , 'May' , 'Jun' , 'Jul' , 'Aug', 'Sep' , 'Oct' , 'Nov' , 'Dec'];
													$years = array_combine(range(date("Y"), 1990), range(date("Y"), 1990));
												@endphp
											@endisset
													<div class="col-md-6">
											        	<label for="dob">Passing Year</label>
														<div class="row">
															<div class="col-md-6">
																<select class="form-control" name="passing_year" id="sel1">
																	@foreach($months as $k => $mnth)
																	<option value="{{$k+1}}" @if($month == $mnth) selected='selected' @endif>{{$mnth}}</option>
																	@endforeach
																</select>
															</div>
															<div class="col-md-6">
																<select class="form-control" name="passing_year" id="sel1">
																@foreach($years as $k => $yr)
																<option value="{{$yr}}" @if($year == $yr) selected='selected' @endif>{{$yr}}</option>
																@endforeach
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="info"><p class="mb-0">Job Preferences</p></div>
								</div>
							</div>
							<div class="row prof-rw">
								<div class="col-md-12">
									<div class="preference">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="location">Location</label>
														<input type="hidden" name="userpreferenceid" class="form-control" value="{{$user->job_preference->id ?? ''}}">
														<input type="text" name="location" class="form-control" value="{{$user->job_preference->location?? ''}}" placeholder="Mohali,Punjab">
														<input type="hidden" name="user_id"  value="{{$job_preference->user_id?? ''}}">

													</div>
													<div class="col-md-6">
														<label for="dob">Industry</label>
														<select class="form-control" name="industry" id="sel1"> 
															@foreach(['IT/Computer-Software','Other'] as $industry)
																<option value="{{$industry}}" @if($industry == $user->job_preference->industry) selected='selected' @endif>{{$industry}} </option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label for="jobtype">Job Type</label>
														<div class="d-flex justify-content-between jobtype">
																<!-- <div class="form-group form-check">
																	<label class="form-check-label">
																		<input class="form-check-input" type="checkbox">Full Time
																	</label>
																</div> -->
															<div class="ml-3">														
															<label >
																<input type="radio" class="form-check-input" value="Full Time" name="job_type"  @if($user->job_preference->job_type == 'Full Time') checked=checked @endif >Full Time
															</label>
															</div>
															<div class="ml-3">														
															<label >
																<input type="radio" class="form-check-input" value="Part Time" name="job_type"  @if($user->job_preference->job_type == 'Part Time') checked=checked @endif >Part Time
															</label>
															</div>
															<div class="ml-3">														
															<label >
																<input type="radio" class="form-check-input" value="Both" name="job_type"  @if($user->job_preference->job_type == 'Both') checked=checked @endif >Both
															</label>
															</div>
															
														</div>
													</div>
													<div class="col-md-6">
														<label for="dob">IT Skills</label>
														<div class="form-group">                       
															<select class="js-example-basic-multiple w-100 px-2" name="name[]" multiple="multiple">
																<option selected>Null</option>
																<option value="Photoshop">Photoshop</option>
																<option value="HTML">HTML 5</option>
																<option value="Bootstrap">Bootstrap 4</option>
																<option value="PHP">PHP</option>
																<option value="Laravel">Laravel</option>
																<option value="Wordpress">Wordpress</option>
																<option value="Ajax">Ajax</option>
															</select>
														</div>
													</div>
												</div>
											</div>
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-12">
									<div class="info"><p class="mb-0">Updated Resume</p></div>
								</div>
							</div> -->
							<div class="row prof-rw">
								<div class="col-md-6">
									<!-- <div class="upload-rsm">
										<p class="position-relative">
											<span class='label label-info' id="upload-file-info"></span>
											<a href='javascript:void(0)'>							
												<button class="btn btn-info">Choose File</button>
												<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent; cursor: pointer;' name="file_source" size="10"  onchange='$("#upload-file-info").html($(this).val());'>
											</a>
										</p>
									</div> -->                    
									<!-- <div class="upload-rsm">
										<div class="text-center upload-file border d-none">
											<a class="text-muted" href="javascript:void(0)" onclick="$(this).closest('div').find('input').click()"><p class="m-0 d-block font-weight-bold">Upload your resume</p></a>
											<input class="d-none" type="file" accept="image/png, image/jpeg"  name="input-file-preview">
										</div>
										<a class="text-muted" href="javascript:void(0)" onclick="$(this).closest('div').find('input').click()" style="text-decoration: none;">
											<button type="button" class="btn btn-info">Choose File
											<input class="d-none" type="file" accept="image/png, image/jpeg, image/gif"  name="input-file-preview">
											</button>
										</a>
									</div> -->
								</div>
							</div>
						</div>
							<div class="row prf-sbmt">
								<div class="col-md-8">
									<div class="form-group form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox">By joining I agree with <a href="#">Private Policy</a>
										</label>
									</div>
								</div>
								<div class="col-md-4 text-right">
									<button type="submit" name="submit" class="btn btn-info">Submit</button>
								</div>
							</div>
					</form>	
				</div>

			</div>
		</div>
</section>
<script>
$(document).ready(function(){
 var postURL = "<?php  ?>";
 var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
 var years = ["2009", "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020"];
   var i=1;

$("#add").click(function(){
 i++; 

 var str = '<div id="employment_' + i + '" class="employment"><div class="form-group"> <div class="row"> <div class="col-md-6"> <label for="designation">Designation</label><input type="hidden" class="form-control" name="employment['+ i +'][userscompanyid]" value=""><input type="text" class="form-control" id="desig_' + i + '" name="employment['+ i +'][designation]"  placeholder="Sr. Designer"> </div> <div class="col-md-6"> <label for="company">Company</label> <input type="text" class="form-control" name="employment['+ i +'][company]"  id=" comp_'+ i + '"  placeholder="Cypress Web India (Pvt.) Ltd"> </div> </div> </div>';
	   
 
 str += '<div class="form-group"> <div class="row"><div class="col-sm-6"> <label for="joined_on">Started working from </label> <div class="row"> <div class="col-md-12"> <input type="date" class="form-control" name="employment['+ i +'][joined_on]" id="sel1"> </div> </div> </div><div class="col-md-6"> <label for="salary_lakh">Salary </label> <div class="row"> <div class="col-md-4"> <select class="form-control" name="employment['+ i +'][salary_lakh]" id="lakh_'+ i +'"><option value="Null" selected="selected">Select</option><option value="0">0 Lakh</option> <option value="1" >1 Lakh</option> <option value="2">2 Lakh</option> <option value="3">3 Lakh</option> <option value="4">4 Lakh</option> <option value="5">5 Lakh</option> <option value="6">6 Lakh</option> <option value="7">7 Lakh</option> <option value="8">8 Lakh</option> <!-- <option value="6">More than 6 Lakh</option> --> </select> </div> <div class="col-md-4"> <select class="form-control" name="employment['+ i +'][salary_thousand]"  id="thous_'+ i + '"  id="sel1" > <option value="Null" selected="selected">Select</option> <option value="10" >10 Thousand</option> <option value="20">20 Thousand</option> <option value="30">30 Thousand</option> <option value="40">40 Thousand</option> <option value="50">50 Thousand</option> <option value="60">60 Thousand</option> <option value="70">70 Thousand</option> <option value="80">80 Thousand</option> <option value="90">90 Thousand</option> </select> </div> <div class="col-md-4"> <select class="form-control"  id="anual_' + i + '"  name="employment['+ i +'][salary_period]" id="sel1"  > <option value="monthly">monthly </option> <option value="anually" selected="selected">anually </option> </select> </div> </div> </div> </div> </div> <div class="row" style="padding: 0 10px;"> <div class="col-md-6"> <div class=""> <div class="form-group form-check"> <label class="form-check-label"><input class="form-check-input" id="employment['+ i +'][iscurrent]" name="employment[{{ $index }}][is_current]" value="0"  type="hidden" @if($user_companies->is_current == 0) unchecked @endif>  <input class="form-check-input" id="employment['+ i +'][iscurrent]" name="is_current['+ i +']" type="checkbox">This is my current company </label> </div> </div> </div> </div> <div class="row prof-rw"> <div class="col-md-6"> <div class="form-group"> <label for="notice">Notice Period</label> <select class="form-control" name="employment['+ i +'][notice_period]" id="sel1"> <option value="30" selected="selected">30 Days</option> <option value="45">45 Days</option> </select> </div> </div> </div><div class="row" id="left_on_date"> <div class="col-sm-12"> <label for="left_on">End working Date </label> </div> <div class="col-sm-6"> <input type="date" class="form-control" name="employment['+ i +'][left_on]" id="sel1"> </div> </div>';

	
	str +=  '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>';
       $('#dynamic_field').append(str);  	   

		   
	   $('#dynamic_employment_field').append(str);  
	   

$(document).on('click', '.btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#employment_'+button_id +'').remove();  
  });
});
});
</script>



<!-- <script>
$(document).ready(function(){
  $("#hide").click(function(){
    $(".hpd").hide();
  });
  $("#show").click(function(){
    $("p").show();
  });
});
</script> -->


<script type="text/javascript">
    $(function () {
        $("#hide").click(function () {
            if ($(this).is(":checked")) {
                $(".hpd").show();
            } else {
                $(".hpd").hide();
            }
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#showd").click(function () {
            if ($(this).is(":unchecked")) {
                $(".datad").show();
            } else {
                $(".hpd").hide();
            }
        });
    });
</script>


<script type="text/javascript" >
 $('#profile_img').change(function () {
        if ($(this).val() != '') {
            upload(this);

        }
    });
    function upload(img) {
        var form_data = new FormData();
        form_data.append('profile_img', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');
        $('#loading').css('display', 'block');
        $.ajax({
            url: "{{route('employee.saveprofileimage')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', '{{asset('images')}}/employee/photo.png');
                    alert(data.errors['file']);
                }
                else {
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', '{{asset('images/employee')}}/' + data);
                }
                $('#loading').css('display', 'none');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
				console.log(xhr.responseText);
				
                $('#preview_image').attr('src', '{{asset('images')}}/employee/photo.png');
            }
        });
    }
</script>

<script>
	$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@stop