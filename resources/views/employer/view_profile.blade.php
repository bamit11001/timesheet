@extends('employer.layout.default')
@section('content')  
<section class="content">
        @if (session('status'))
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                            </div>
         @endif
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header job_list-head">
                        <form action="{{ route('filter.job') }}" id="searchform">    
                        {{ csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <h2>User Profile</h2>
                                    </div>
                                </div>
                                <div class="col-md-6 right-data">
                                    <div class="">
                                       <a href="{{route('employer.update')}}" class=""><img src="{{ url('') }}/images/employer/Edit.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                                       
                        <div class="joblist_body view_profile"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Name</h4>
                                    <span>{{$data[0]->name}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Last Name</h4>
                                    <span>{{$data[0]->lname ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Username</h4>
                                    <span>{{$data[0]->username ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Email ID</h4>
                                    <span>{{$data[0]->email}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Contact No</h4>
                                    <span>{{$data[0]->phone}}</span>
                                </div>
                                <!-- <div class="col-md-6">
                                    <h4>Password</h4>
                                    <span></span>
                                </div> -->
                                <div class="col-md-6">
                                    <h4>Address</h4>
                                    <span>{{$data[0]->address ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Zip</h4>
                                    <span>{{$data[0]->zip ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Country</h4>
                                    <!-- <span>{{$data[0]->country ?? 'N/A'}} </span> -->
                                    <select class="form-control" name="country" id="country"> 
                                        @foreach ($countries as $country) 
                                            <option value="{{$country->id}}">
                                            {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h4>State</h4>
                                    <span>{{$data[0]->state ?? 'N/A'}} </span>
                                    <select class="form-control" name="state" id="state"> 
                                        @foreach ($countries as $state) 
                                            <option value="{{$state->id}}">
                                            {{$state->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h4>City</h4>
                                    <span>{{$data[0]->city ?? 'N/A'}} </span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header job_list-head">
                        <form action="{{ route('filter.job') }}" id="searchform">    
                        {{ csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <h2>Employer Profile</h2>
                                    </div>
                                </div>
                                <div class="col-md-6 right-data">
                                    <div class="">
                                       <a href="{{route('employer.update_profile')}}" class=""><img src="{{ url('') }}/images/employer/Edit.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                                       
                        <div class="joblist_body view_profile"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Company Name</h4>
                                    <span>{{$data[0]->company->name}}</span>
                                </div>
                                <div class="col-md-6">
                                <h4>Email ID</h4>
                                    <span>{{$data[0]->company->email}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Nature of Business</h4>
                                    <span>{{$data[0]->company->nature_of_business}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Company Address</h4>
                                    <!-- <span>sdf</span> -->
                                    <span>{{$data[0]->company->address}}</span>
                                </div>
                                
                                <div class="col-md-6">
                                    <h4>Country</h4>
                                    <span>{{$data[0]->company->country ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>State</h4>
                                    <span>{{$data[0]->company->state ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>City</h4>
                                    <span>{{$data[0]->company->city ?? 'N/A'}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Zip</h4>
                                    <span>{{$data[0]->company->zip}}</span>
                                </div>
                                
                                <div class="col-md-6">
                                    <h4>About Comapny</h4>
                                    <span>{{$data[0]->company->about}}</span>
                                </div>
                                <div class="col-md-6">
                                    <h4>Number of Employees</h4>
                                    <span>{{$data[0]->company->no_of_employee}}</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>

<!-- update ststus -->

<!-- Delete job -->

@stop