@extends('employer.layout.default')
@section('content')        

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>Post Job</h2> -->
            </div>
            <div class="card" id="post_job">
               <!--  @if(Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Success!</strong> {{ Session::get('message', '') }}
                    </div>
                @endif -->
                @if (session('status'))
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                    </div>
                @endif
                   
            <form role="form" method="POST" id="my-form" action="{{ route('employer.jobpost.create') }}" >
                        {{ csrf_field()}}
                        <input type="hidden" name="job_id" value="{{isset($job)?$job->id:'' }}">
                <div class="header">
                    <h2>
                    Post New Job
                    </h2>
                    <div class="pull-right ">
                        <button class = "btn btn-primary btn-lg"  form="my-form" type="submit"  name="submit"> Post Job</button>
                    </div>
                </div>
                
               <!--  <div class="alert alert-success">
                  <strong>Success!</strong> Indicates a successful or positive action.
                </div> -->
                 <div class="body">
                    <p class="lead"></p>                    
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Job Title</label>
                                        <div>
                                            <input type="text" class="form-control @error('jobtitle') is-invalid @enderror" placeholder="Job Title" name="jobtitle" value="{{isset($job)?$job->title:''  }}">
                                            <span style="color:red;">@error('jobtitle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Company Address</label>
                                        <div>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{isset($job)?$job->company_address:''  }}" placeholder="Company Address" >
                                            <span style="color:red;">@error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Job Type</label>
                                        
                                        <select name="job_type" class="form-control @error('job_type') is-invalid @enderror">
                                                <option value="fulltime" @if(isset($job) && $job->job_type == 'fulltime') selected @endif>Full-Time</option>
                                                <option value="parttime" @if(isset($job) && $job->job_type == 'parttime') selected @endif>Part Time</option>
                                        </select>
                                        @error('job_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 pd">
                                     <label class="col-form-label col-md-12">Salary</label>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <input type="text" class="form-control @error('salary_min') is-invalid @enderror" value="{{isset($job)?$job->salary_range_from:''  }}" placeholder=" 25000" name="salary_min">
                                                <span style="color:red;"> @error('salary_min')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <input type="text" class="form-control @error('salary_max') is-invalid @enderror" value="{{isset($job)?$job->salary_range_to:''  }}" placeholder=" 35000" name="salary_max">
                                                <span style="color:red;">@error('salary_max')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pL">
                                        <div class="form-group">
                                            <select class="form-control @error('anual') is-invalid @enderror" name="anual" >
                                                <option value="Month" @if(isset($job) && $job->salary_range_per == 'Month') selected @endif>Per Month</option>
                                                <option value="Year" @if(isset($job) && $job->salary_range_per == 'Year') selected @endif>Annual</option>
                                            </select>
                                            @error('anual')
                                                <span class="invaYearlid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pd">
                                    <label class="col-form-label col-md-12">Min Expe.</label>
                                    <div class="col-md-3">
                                        <div class="form-group">                                       
                                          <select  class="form-control @error('min_exp_year') is-invalid @enderror" name="min_exp_year">
                                                    <option value="1" @if(isset($job) && $job->min_experience == '1') selected @endif>1 Year</option>
                                                    <option value="2" @if(isset($job) && $job->min_experience == '2') selected @endif>2 Year</option>
                                          </select>
                                          @error('min_exp_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 pL">
                                        <div class="form-group">
                                            <select  class="form-control @error('min_exp_preferred') is-invalid @enderror" name="min_exp_preferred">
                                                <option value="preferred" @if(isset($job) &&  $job->max_experience_type == 'preferred') selected @endif>Preferred</option>
                                                <option value="not_preferred" @if(isset($job) &&  $job->max_experience_type == 'not_preferred') selected @endif>Not Preferred</option>
                                            </select>
                                            @error('min_exp_preferred')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control @error('exp_max_yer') is-invalid @enderror" name="exp_max_yer">
                                                <option value="3"  @if(isset($job) &&  $job->max_experience == '3') selected @endif>3 Year</option>
                                                <option value="5" @if( isset($job) &&  $job->max_experience == '5') selected @endif>5 Year</option>
                                            </select>
                                            @error('exp_max_yer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 pL">
                                        <div class="form-group">
                                            <select  class="form-control @error('exp_preferred') is-invalid @enderror" name="exp_preferred">
                                                <option value="preferred" @if(isset($job) && $job->max_experience_type == 'preferred') selected @endif>Preferred</option>
                                                <option value="not_preferred" @if(isset($job) && $job->max_experience_type == 'not_preferred') selected @endif>Not Preferred</option>
                                            </select>
                                            @error('exp_preferred')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">How many hires do you want to make this position ?</label>
                                        <select  class="form-control @error('openings') is-invalid @enderror"  name="openings">
                                                <option value="4" @if(isset($job) && $job->openings == '4') selected @endif>2 - 4 hires</option>
                                                <option value="10" @if(isset($job) && $job->openings == '10') selected @endif>5 - 10 hires</option>
                                                <option value="20" @if(isset($job) && $job->openings == '20') selected @endif>15 - 20 hires</option>
                                                <option value="40" @if(isset($job) && $job->openings == '40') selected @endif>25 - 40 hires</option>
                                        </select>
                                        @error('openings')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 pd">
                                    <label class="col-form-label col-md-12">Education Lavel</label>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <select class="form-control @error('edu_minmum') is-invalid @enderror" name="edu_minmum">

                                                @foreach($qualifications as $qualification)
                                                    <option value="{{$qualification->name}}">{{$qualification->name}}</option>
                                                @endforeach }
                                            </select>
                                            @error('edu_minmum')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 pL">
                                        <div class="form-group">
                                            <select class="form-control @error('edu_preferred') is-invalid @enderror" name="edu_preferred">
                                                <option value="Preferred" @if(isset($job) && $job->qualification_type == 'Preferred') selected @endif>Preferred</option>
                                                <option value="Not Preferred" @if(isset($job) && $job->qualification_type == 'Not Preferred') selected @endif>Not Preferred</option>
                                            </select>
                                            @error('edu_preferred')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Receive Applications Email ID</label>
                                        <div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{isset($job)?$job->receive_email:''  }}" placeholder="cypress_hr@gmail.com" name="email">
                                            <span style="color:red;">@error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Job Summary</label>
                                        <textarea rows="5" cols="50" name="job_summary" class="form-control @error('job_summary') is-invalid @enderror" value="{{isset($job)?$job->job_summary:''}}" placeholder="Describe the position, what your company does, team size, location and provide a URL to your company page.">{{isset($job)?$job->job_summary:''}}</textarea>
                                        @error('job_summary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Responsibilities and Duties</label>
                                        <textarea rows="5" cols="50" name="duties" value="{{isset($job)?$job->responsibility:'' }}" class="form-control" placeholder="Describe the work that the candidate is supposed to perform.">{{isset($job)?$job->responsibility:'' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Required Experience, Skills and Qualifications</label>
                                        <textarea rows="5" cols="50" name="skills" class="form-control @error('skills') is-invalid @enderror" value="{{isset($job)?$job->skills:''  }}" placeholder="This may include education, previous job experience, certifications and technical skills.">{{isset($job)?$job->skills:''}}</textarea>
                                        @error('skills')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Benifits</label>
                                        <textarea rows="5" cols="50" name="benifits" value="{{isset($job)?$job->benefits:''  }}" class="form-control" placeholder="This may include training, mentoring, health insurance,commuting support, lunch service, etc.">{{isset($job)?$job->benefits:''  }}</textarea>
                                    </div>
                                </div>

                            </div>                       
                </div>
                </form>     
            </div>
        </div>
    </section>
@stop
    
    <!-- footer bar start -->

