@extends('employer.layout.auth')
@section('content')    
<section class="compny_signup compny_profile">
	<div class="container">

	 @if (session('status'))
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                    </div>
                @endif

		<form class="employer-profile-form" method="post" action="{{ route('employer.profile.submit') }}">
			@csrf
		<div class="row main_row">
			<div class="col-md-12 p-0">			
				<div class="px-3 d-flex justify-content-between hedr" style="border-bottom: 1px solid #ccc;">
					<h5>Complete Company Profile</h5>
					<button type="submit" class="btn btn-info m-0">Save</button>
				</div>
			</div>
			<div class="col-md-6">
				<div class="user-form">
					<div class="form-group">
						<div class="row">									
							<div class="col-md-12 mb-3">
								<label for="name">{{ __('Company Name') }}</label>
								<input type="text" class="form-control" placeholder="Enter Company Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12 mb-3">
								<label for="Mobile">{{ __('Email ID') }}</label>
								<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your Email address" value="{{ old('email') }}" required autocomplete="name" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12 mb-3">
								<table class="table table-bordered" name="contact[]" id="dynamic_contact_field">  
								<label for="contact">Contact No</label>
			                    <tr>
			                    	<i class="fa fa-plus" id="add_contact">Add More</i>
			                      <td><input type="text" name="contact[]"  placeholder="Enter your Phone Number" class="form-control name_contact_list @error('contact') is-invalid @enderror" />
									@error('contact')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
			                      </td> 
			                    </tr>  
			                	</table>	
							</div>
							<div class="col-md-12 mb-3">
								<label for="business">Nature of Business</label>
								<select class="form-control" name="business" class="@error('business') is-invalid @enderror" id="sel1">
									<option>IT/Computers - Software</option>
									<option>Computers - Hardware</option>
									<option>Medical</option>
									<option>Other</option>
								</select>

								@error('business')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12 mb-3">
								<label for="business">About Comapny</label>
								<textarea class="form-control @error('about') is-invalid @enderror" name="about" rows="4" id="comment" style="resize: none;"></textarea>
								@error('about')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12 mb-3">
								<label for="business">Number of Employees</label>
								<select class="form-control" name="employees" class="@error('employees') is-invalid @enderror" id="sel1">
									<option>20 to 50</option>
									<option>50 to 100</option>
									<option>100 to 150</option>
									<option>150 to 200</option>
								</select>
								@error('employees')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-md-12">
							<div class="social-medialink">
								<table class="table table-bordered" name="name[]" id="dynamic_field">  
									<label for="business" class="mb-3">Social Media Links</label>
				                    <tr>
				                    	<i class="fa fa-plus" id="add">Add More</i>
				                      <td>
			                          	<select class="form-control" name="social_link[0][social]" id="">
			                          		@foreach($sociallink as $link)
												<option value="{{$link->id}}">{{$link->name}}</option>
			                          		@endforeach
				                        </select>
				                      </td>
				                      <td><input type="url" class="form-control name_list @error('social_link') is-invalid @enderror" name="social_link[0][social_link]" placeholder="Enter your Name" />
									@error('social_link')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
				                      </td> 
				                    </tr>  
				                </table>
								</div>
			            	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="address-block"> 
                        <div class="row">
							<div class="col-md-12 mb-3">
                                <label for="address">Company Address</label>
                                <input type="text" class="form-control" placeholder="Company address" name="address">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country">Country</label>
                                <select class="form-control" name="country" id="country">
									<option value="">Select Country</option>
									@foreach ($countries as $country) 
										<option value="{{$country->id}}">
										{{$country->name}}
										</option>
									@endforeach
								</select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">State</label>
                                <select class="form-control" name="state" id="state">
								<option value="">
										select
										</option>
        						</select>
                            </div>
							<div class="col-md-6 mb-3">
                                <label for="city">City</label>
                                <select class="form-control" name="city" id="city">
        						</select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="business">Zip</label>
								<input type="text" name="zip" placeholder="zip"  class="form-control">
                            </div>
                        </div>
                   
					<div class="my-3 d-flex justify-content-between">
						<h5>Opening Hours</h5>
						<!-- <input type="checkbox" class="form-check-input" value="">24 HOURS -->
						<div class="we_work">
							<label class="mr-4"><input type="checkbox" name="hours_type" class="form-check-input @error('hours_type') is-invalid @enderror" value="24">24 HOURS</label>
							@error('hours_type')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							<label><input type="checkbox" name="hours_type" class="form-check-input twlv @error('hours_type') is-invalid @enderror" value="12">12 HOURS</label>

							@error('hours_type')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="d-flex justify-content-around mb-3 timing">
						<div><h5 class="m-0">Monday</h5>
							<input type="hidden" value="1" name="timing[0][day]"></div>
						<div class="d-flex justify-content-end">
							<div class="toggle-switch">
								<div class="custom-control custom-switch position-relative p-0">
									<input type="checkbox" class="custom-control-input position-absolute nw" id="switch" name="timing[0][status]">
									<label class="custom-control-label position-absolute nw-label accept" for="switch"></label>
								</div>
							</div>
						</div>
						<div>
							<input type="time" value="09:00" name="timing[0][starttime]">
						</div>
						<div><h5 class="m-0">To</h5></div>
						<div>
							<input type="time" value="06:00" name="timing[0][endtime]">
						</div>
					</div>

					<div class="d-flex justify-content-around mb-3 timing">
						<div><h5 class="m-0">Tuesday</h5>
							<input type="hidden" value="2" name="timing[1][day]"></div>
						<div class="d-flex justify-content-end">
							<div class="toggle-switch">
								<div class="custom-control custom-switch position-relative p-0">
									<input type="checkbox" name="timing[1][status]" class="custom-control-input position-absolute nw" id="switch2">
									<label class="custom-control-label position-absolute nw-label accept" for="switch2"></label>
								</div>
							</div>
						</div>
						<div>
							<input type="time" class="" value="09:00" name="timing[1][starttime]">
						</div>
						<div><h5 class="m-0">To</h5></div>
						<div>
							<input type="time" class="" value="06:00" name="timing[1][endtime]">
						</div>
					</div>

					<div class="d-flex justify-content-around mb-3 timing">
						<div><h5 class="m-0">Wednessday</h5>
							<input type="hidden" value="3" name="timing[2][day]"></div>
						<div class="d-flex justify-content-end">
							<div class="toggle-switch">
								<div class="custom-control custom-switch position-relative p-0">
									<input type="checkbox" class="custom-control-input position-absolute nw" id="switch3" name="timing[2][status]">
									<label class="custom-control-label position-absolute nw-label accept" for="switch3"></label>
								</div>
							</div>
						</div>
						<div>
							<input type="time" class="" value="09:00" name="timing[2][starttime]">
						</div>
						<div><h5 class="m-0">To</h5></div>
						<div>
							<input type="time" class="" value="06:00" name="timing[2][endtime]">
						</div>
					</div>

					<div class="d-flex justify-content-around mb-3 timing">
						<div><h5 class="m-0">Thursday</h5>
							<input type="hidden" value="4" name="timing[3][day]"></div>
						<div class="d-flex justify-content-end">
							<div class="toggle-switch">
								<div class="custom-control custom-switch position-relative p-0">
									<input type="checkbox" class="custom-control-input position-absolute nw" id="switch4" name="timing[3][status]">
									<label class="custom-control-label position-absolute nw-label accept" for="switch4"></label>
								</div>
							</div>
						</div>
						<div>
							<input type="time" class="" value="09:00" name="timing[3][starttime]">
						</div>
						<div><h5 class="m-0">To</h5></div>
						<div>
							<input type="time" class="" value="06:00" name="timing[3][endtime]">
						</div>
				</div>
 				<div class="d-flex justify-content-around mb-3 timing">
					<div><h5 class="m-0">Friday</h5>
						<input type="hidden" value="5" name="timing[4][day]"></div>
					<div class="d-flex justify-content-end">
						<div class="toggle-switch">
							<div class="custom-control custom-switch position-relative p-0">
								<input type="checkbox" class="custom-control-input position-absolute nw" id="switch5" name="timing[4][status]">
								<label class="custom-control-label position-absolute nw-label accept" for="switch5"></label>
							</div>
						</div>
					</div>
					<div>
						<input type="time" class="" value="09:00" name="timing[4][starttime]">
					</div>
					<div><h5 class="m-0">To</h5></div>
					<div>
						<input type="time" class="" value="06:00" name="timing[4][endtime]">
					</div>
				</div>
				<div class="d-flex justify-content-around mb-3 timing">
					<div><h5 class="m-0">Saturday</h5>
						<input type="hidden" value="6" name="timing[5][day]"></div>
					<div class="d-flex justify-content-end">
						<div class="toggle-switch">
							<div class="custom-control custom-switch position-relative p-0">
								<input type="checkbox" class="custom-control-input position-absolute nw" id="switch6" name="timing[5][status]">
								<label class="custom-control-label position-absolute nw-label accept" for="switch6"></label>
							</div>
						</div>
					</div>
					<div>
						<input type="time" class="" value="09:00" name="timing[5][starttime]">
					</div>
					<div><h5 class="m-0">To</h5></div>
					<div>
						<input type="time" class="" value="06:00" name="timing[5][endtime]">
					</div>
				</div>
<!-- 				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input" name="alternate" value="1" type="checkbox">We Are Working Alternate Saturdays
					</label>
				</div> -->
				</div>	
			</div>						
		</div>
		</form>
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function(){   
      var sociallink  = <?php echo $sociallink; ?>;
      var postURL = "<?php echo url('addmore'); ?>";
      var i=0;  


      	$('#add').click(function(){
           i++;  
           var str = '<tr id="row'+i+'" class="dynamic-added"><td><select class="form-control" name="social_link['+ i +'][social]" id="">';
           for (var j = 0; j < sociallink.length; j++) {
           	var id = sociallink[j]['id'];
           	var name = sociallink[j]['name'];
           	str += ' <option value="'+id+'">'+name+'</option>';
           }
          
         

          str +=  '</select></td><td><input type="url" name="social_link['+ i +'][social_link]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>';
           $('#dynamic_field').append(str);  
      	});  
      
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
    });  



    $(document).ready(function(){

      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  

		$('#add_contact').click(function(){
		   i++;  
		   $('#dynamic_contact_field').append('<tr id="row_contact_'+i+'" class="dynamic-added"> <td><input type="text" name="contact[]" placeholder="Enter your Phone Number" class="form-control name_contact_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_contact_remove">X</button></td></tr>');  
		});  
      
	    $(document).on('click', '.btn_contact_remove', function(){  
	       var button_id = $(this).attr("id");   
	       $('#row_contact_'+button_id+'').remove();  
	  	});

    });  



	$('#timepicker1').timepicker();
	jQuery(document).ready(function(){
    	$(document).on('change', "#country", function(e){
    		var countryID = $(this).val();
    		
    		e.preventDefault();
    		jQuery.ajaxSetup({
    			headers: { 'csrftoken' : '{{ csrf_token() }}' }
    		});
    		
    		jQuery.ajax({
    			url: "{{ url('/employer/getstates') }}",
    			method: 'post',
    			data: {
    				country_id: countryID,
    				_token: "{{ csrf_token() }}"
    			},
    			success: function(data){
    				if(data.success){
    					$("#state").empty();
    					$("#state").append('<option>Select</option>');
    					$.each(data.states,function(key,value){
		                	$("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
		                });
    					$("#state").trigger('contentChanged');
    				}else{
    					$("#state").empty();
    				}

    			}

    		});
		});
			

	$(document).on('change', "#state", function(e){
		var countryID = $(this).val();
		
		e.preventDefault();
		jQuery.ajaxSetup({
			headers: { 'csrftoken' : '{{ csrf_token() }}' }
		});
		jQuery.ajax({
			url: "{{ url('/employer/getcities') }}",
			method: 'post',
			data: {
				state_id: countryID,
				_token: "{{ csrf_token() }}"
			},
			success: function(data){
				if(data.success){
					$("#city").empty();
					$("#city").append('<option>Select</option>');
					$.each(data.cities,function(key,value){
	                	$("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
	                });
					$("#city").trigger('contentChanged');
				}else{
					$("#city").empty();
				}

			}

		});
	});
        });
</script>
@stop