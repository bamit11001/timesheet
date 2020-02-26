@extends('employer.layout.default')
@section('content')  
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <form class="employer-profile-form" method="post" action="{{ route('employer.update.submit') }}">
                        @csrf
                            <div class="header job_list-head">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <h2>Update User Profile</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-6 right-data">
                                    </div>
                                </div>
                            </div>
                                        
                            <div class="joblist_body view_profile"> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Name</h4>
                                            <input type="text" class="form-control" name="name" value="{{$data[0]->name }}" placeholder="Name" autofocus>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Last Name</h4>
                                            <input type="text" class="form-control" name="lname" value="{{$data[0]->lname }}" placeholder="Last Name">
                                            
                                        
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Username</h4>
                                            <input type="text" class="form-control" name="username" value="{{$data[0]->username }}" placeholder="Username">
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Email ID</h4>
                                            <input type="text" class="form-control" value="{{$data[0]->email }}" placeholder="Email" readonly>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Contact No</h4>
                                            <input type="text" class="form-control" name="phone" value="{{$data[0]->phone }}" placeholder="Contact No">
                                            
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <h4>Password</h4>
                                            <input type="text" class="form-control" name="address" value="{{$data[0]->password  }}" placeholder="Password">

                                            <span></span>
                                        </div> -->
                                        <div class="col-md-6">
                                            <h4>Address</h4>
                                            <input type="text" class="form-control" name="address" value="{{$data[0]->address  }}" placeholder="Address">
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Zip</h4>
                                            <input type="text" class="form-control" class="form-control" name="zip" value="{{$data[0]->zip }}" placeholder="Zip">
                                        </div>
                                        <div class="col-md-6">                                           
                                            <h4>Country</h4>                                                  
                                            <select class="form-control" name="country" id="country"> 
                                                @foreach ($countries as $country) 
                                                    <option value="@if($country->id == $data[0]->country ) selected='selected' @endif">{!! $country->name !!}</option>
                                                    <option value="{{$country->id}}">
                                                    {{$country->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>State</h4>                                                    
                                            <select class="form-control" name="state" id="state">
                                                <option value="">
                                                        Select
                                                    </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>City</h4>                                           
                                            <select class="form-control" name="city" id="city" >
                                                    <option value="">
                                                    Select
                                                    </option>
                                            </select>
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="col-md-12 p-0">			
                                <div class="px-3 d-flex justify-content-between hedr"  style="border-bottom: 1px solid #ccc;">
                                    <button type="submit" class="btn btn-info m-0 pull-right" style="border-bottom: 1px solid #ccc; background:green;" >Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>

<!-- update ststus -->

<!-- Delete job -->

<script type="text/javascript">
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
			                	$("#city").append('<option value="'+value.name+'">'+value.name+'</option>');
                                
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