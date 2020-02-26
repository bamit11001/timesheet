@extends('employee.layout.default')
@section('content')   

<section class="banner cand-hedr">
		<div class="container">
			<div class="row-body">
				<div class="row">
					<div class="col-md-12">
						<div class="find-job">
							<form>
								<div class="form-group">
									<div class="row">
										<div class="col-md-5 p-0">
											<input type="text" class="form-control in-1" placeholder="Web Designer">
										</div>
										<div class="col-md-5 p-0">
											<input type="text" class="form-control in-2" placeholder="Mohali, Punjab">
										</div>
										<div class="col-md-2 p-0">
											<button class="btn btn-info findi">Find Job</button>
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

<section class="candidate-profile">
		<div class="container">
			<div class="row-body">
            <?php // print_r($data[0]->skills );  die;?>
				

				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<h3 class="title">My Profile</h3>
						<form action="{{route('employee.posteditprofile')}}" name="edit-form" method="post">
						<div class="card persnl-info">
							<div class="hedr">
								<p class="mb-0">{{ $data[0]->name ?? 'N/A' }}							
								<a href="{{route('employee.editprofile', [$data[0]->id])}}" class="pull-right" style="color:#000;"><i class="fa fa-pencil"></i></a>
								</p>	
							</div>
							<div class="row data-row">
								<div class="col-md-3">
									<div class="image">
										<img src="@if(!empty($data[0]->profile_img)){{asset('images/employee')}}/{{$data[0]->profile_img}}@else{{asset('images')}}{{'/employee/peter.png'}}@endif" id="preview_image" height="150px" width="150px" class="rounded-circle">
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-4">
											<p class="mb-0">Name:</p>
											<strong class="mb-2 d-block">{{ $data[0]->name ?? 'N/A'}}</strong>
										</div>
										<div class="col-md-4">
											<p class="mb-0">Date of Birth:</p>
											<strong class="mb-2 d-block"> {!! date('d M Y', strtotime( $data[0]->dob ?? 'N/A' )); !!} </strong>
										</div>
										<div class="col-md-4">
											<p class="mb-0">Home Town:</p>
											<strong class="mb-2 d-block">{{$data[0]->address ?? 'N/A'}}</strong>
										</div>

										<div class="col-md-4">
											<p class="mb-0">Gender:</p>
											<strong class="mb-2 d-block">
												@if($data[0]->gender == 'm' ?? 'N/A')
													Male
												@elseif($data[0]->gender == 'f'  ?? 'N/A')
													Female
												@else
													N/A
												@endif
											</strong>
										</div>
										<div class="col-md-4">
											<p class="mb-0">Nationality:</p>
											<strong class="mb-2 d-block">{{$data[0]->nationality ?? 'N/A' }}</strong>
										</div>
										<div class="col-md-4">
											<p class="mb-0">Permanent Address :</p>
											<strong class="mb-2 d-block">{{$data[0]->address_permanent ?? 'N/A' }}</strong>
										</div>


										<div class="col-md-4">
											<p class="mb-0">Marital Status :</p>
											<strong class="mb-2 d-block">{{$data[0]->marital_status ?? 'N/A' }}</strong>
										</div>
										<div class="col-md-4">
											<p class="mb-0">Language known :</p>
											<strong class="mb-2 d-block">{{$data[0]->language ?? 'N/A' }}</strong>
										</div>

									</div>
								</div>
								<div class="col-md-12 mt-3">
									<h4>About Me</h4>
                                     
									<p>{{$data[0]->about_me ?? 'N/A' }}</p>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
         
				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info resume">
							<div class="hedr">
								<p class="mb-0">Resume</p>
							</div>
							<div class="row data-row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-2">
										<div class="col-md-2">
											<div class="docs">
												<img src="@if(!empty($data[0]->resume)){{asset('images/resume/favicon.png')}}/{{$data[0]->resume}}@else{{asset('images')}}{{'/resume/photo/favicon.png'}}@endif" id="" alt="doc-image" class="rounded-circle">
												<!-- <i class="fas fa-file" style="color:orange;  40%;top: 40%;" class="rounded-circle"></i> -->
												<i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
											</div>
										</div>
										</div>
										<div class="col-md-10">
											<div class="docs-links">
												<p class="mb-0"> {{$data[0]->resume ?? 'N/A' }}</p>

												<a href="{{asset('images/resume')}}/{{$data[0]->resume}}"  class="mr-3" download>Download<i class="fa fa-arrow-down ml-1" ></i> </a>
												 
												 <a href="javascript:void(0)" id="{{ $data[0]->id }}" style="color: #f60;"  onclick="deleteresume(this)" data-toggle="confirmation">Delete<i class="fa fa-times ml-1"></i></a>

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 text-right">
									<div class="upload-rsm">
										<!-- <span class="rsm">Designer_resume.pdf</span> -->
										<p class="position-relative">
											
											<a href='javascript:void(0)'>											<span class='label label-info' id="upload-file-info"></span>
													<button class="btn btn-info mt-n1">Choose File</button>
													<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent; cursor: pointer;' name="resume" id="resume" size="10"  >
												
												</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info skillls">
							<div class="hedr">
								<p class="mb-0 pull-left">Skills</p>
								<a href="" class="pull-right" style="color:#000;"></a>
							</div>
							<div class="row data-row">
								<div class="col-md-9">
									<div class="usr-skills">
										<div class="slct">
											<p>{{$data[0]->skills}}</p>
										</div>
										<div class="slct">
											<p>HtmL5</p>
										</div>
										<div class="slct">
											<p>Bootstrap4</p>
										</div>
										<!-- <select class="js-multiselect w-100 px-2" name="states[]" multiple="multiple">
											<option data="AL">Photoshop</option>
											<option value="WY">HTML 5</option>
											<option value="WY">Bootstrap 4</option>
										</select> -->
									</div>
								</div>
								<div class="col-md-3 text-right">
									<div class="add-skills">
										<!-- <a href="#"><i class="fa fa-plus mr-1"></i>Add Skills</a> -->
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
								<p class="mb-0 pull-left">Job Preference</p>
								<a href="" class="pull-right" style="color:#000;"></a>
							</div>
							<div class="row data-row">
								<div class="col-md-4 col-sm-4">
									<div class="data">
										<p class="mb-0">Industry:</p>
										<strong class="mb-2 d-block">{{ $data[0]->job_preference->industry ?? 'N/A' }}</strong>
										<p class="mb-0">Role:</p>
										<strong class="mb-2 d-block">{{$data[0]->designation ?? 'N/A' }}</strong>
										<p class="mb-0">Employment Type:</p>
										<strong class="mb-2 d-block">Full time</strong>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="data">
										<p class="mb-0">Function:</p>
										<strong class="mb-2 d-block">Information Technology</strong>
										<p class="mb-0">Experience:</p>
										<strong class="mb-2 d-block">{{$data[0]->total_exp ?? 'N/A' }}</strong>
										<p class="mb-0">Current Salary:</p>
										<strong class="mb-2 d-block">
											{!!
												$n = $data[0]->current_salary ;
												if ($n < 10000) {
													echo	$n_format = number_format($n);													
												} else if ($n < 10000000) {
													echo	$n_format = number_format($n / 1000, 1) . 'K';
												} else {
													echo	$n_format = number_format($n / 1000000, 1) . 'L';
												}
											!!}
										</strong>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="data">
										<p class="mb-0">Function:</p>
										<strong class="mb-2 d-block">Information Technology</strong>
										<p class="mb-0">Job Type:</p>
										<strong class="mb-2 d-block">									
										{{$data[0]->job_preference->job_type}}</strong>
										<p class="mb-0">Expected Salary:</p>
										<strong class="mb-2 d-block">
											{!! 
												$n = $data[0]->min_salary;
												if ($n < 10000) {												
													echo	$n_format = number_format($n);												
												} else if ($n < 10000000) {
													echo	$n_format = number_format($n / 1000, 1) . 'K';
												} else {												
													echo	$n_format = number_format($n / 1000000, 1) . 'L';
												}

												!!}
											to 
											{!!
												$n = $data[0]->max_salary;
												if ($n < 10000) {
													echo	$n_format = number_format($n);
												} else if ($n < 10000000) {
													echo	$n_format = number_format($n / 1000, 1) . 'K';
												} else {
													echo	$n_format = number_format($n / 1000000, 1) . 'L';
												}
											!!}
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
								<p class="mb-0 pull-left">Work Experience</p>
								<a href="" class="pull-right" style="color:#000;"></a>
							</div>
							<div class="row data-row">
								<div class="col-md-12">
									<div class="app-inno">
										<a href="#">App innovation</a>
										<strong class="d-block">Web Designer Graphic Designer</strong>
										<strong class="d-block">01 May, 2017 to 30 Nov, 2019</strong>
										<p>Mobile App Designer and UI UX Psd Designer & dashboard designer and Front-end Developer</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="app-inno">
										<a href="#">App innovation</a>
										<strong class="d-block">Web Designer Graphic Designer</strong>
										<strong class="d-block">01 May, 2017 to 30 Nov, 2019</strong>
										<p>Mobile App Designer and UI UX Psd Designer & dashboard designer and Front-end Developer</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-12 pxx">
						<div class="card persnl-info resume edu-detail">
							<div class="hedr">
								<p class="mb-0 pull-left">Educational Details</p>
								<a href="" class="pull-right" style="color:#000;"></a>
							</div>
							<div class="row data-row">
								<div class="col-md-12">
									<div class="edu-info">
										<a href="#">{{$data[0]->users_qualification[0]->from_university ?? 'N/A' }}</a>
										<strong class="d-block">{{$data[0]->users_qualification[0]->qualification ?? 'N/A' }}</strong>
										<strong class="d-block">									
										{{ date('Y', strtotime($data[0]->users_qualification[0]->passing_year) ?? 'N/A' )   }}
										{{ $data[0]->users_qualification[0]->type  ?? 'N/A' }}
										</strong>
									</div>
								</div>
								<!-- <div class="col-md-12">
									<div class="my-3 edu-info">
										<a href="#">Punjabi University<i class="fa fa-pencil ml-2" style="color:#000;"></i></a>
										<strong class="d-block">Bachelor Of Computer Application (B.C.A) (Computers)</strong>
										<strong class="d-block">2008 (Full time)</strong>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>


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
    function deleteresume(elem) 
    {
        var id = $(elem).attr("id");
		alert(id);

        var result = confirm("Are you sure you Want to delete this Resume");
        if(result) {
            $.ajax({
            type:'POST',
            url:"{{ route('employee.delete.resume') }}",
            data:{id:id,  _token: '{{csrf_token()}}'},
            success:function(data){
				console.log(data);
                
            }
        });

        }

    }
</script>

<script type="text/javascript" >
 $('#resume').change(function () {
        if ($(this).val() != '') {
            upload(this);

        }
    });
    function upload(img) {
        var form_data = new FormData();
        form_data.append('resume', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');
        $('#loading').css('display', 'block');
        $.ajax({
            url: "{{route('employee.saveresume')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', '{{asset('images')}}/resume');
                    alert(data.errors['file']);
                }
                else {
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', '{{asset('images/resume')}}/' + data);
					location.reload(); 
                }
                $('#loading').css('display', 'none');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
				console.log(xhr.responseText);
				
                $('#preview_image').attr('src', '{{asset('images')}}/resume');
            }
        });
    }
</script>
@stop
