@extends('employer.layout.default')
@section('content')    
<section class="content admin-profile">
    <div class="container-fluid">
        <div class="row hed-rrow">
            <div class="col-md-12">
                <h4>Profile</h4>
                <a href="{{ route('employer.jobpost') }}" class="btn btn-info">New Job</a>
            </div>
        </div>
        <div class="card">
            <div class="header">                    
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img">
                                    <img src="{{ url('') }}/images/employer/logo3.png" alt="logo" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5>{{ $company->name }}</h5>
                                <p>{{ $company->address }}</p>
                                <p>{{ $company->about }}</p>
                                <p>Member since : {{ $company->created_at->format('M. d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="right-block">
                            <span>4.2</span>
                            <ul class="nav navbar-nav start-list">
                                <li class="nav-item"><i class="fa fa-star"></i></li>
                                <li class="nav-item"><i class="fa fa-star"></i></li>
                                <li class="nav-item"><i class="fa fa-star"></i></li>
                                <li class="nav-item"><i class="fa fa-star"></i></li>
                                <li class="nav-item"><i class="fa fa-star"></i></li>
                            </ul>
                            <ul class="nav review-list">
                                <li class=""><img src="{{ url('') }}/images/employer/star.png" alt="star-image">4 stars from 15 reviews</li>
                                <li class=""><img src="{{ url('') }}/images/employer/trophy.png" alt="trophy-image">78% Compleletion rate</li>
                                <li class=""><img src="{{ url('') }}/images/employer/bag.png" alt="bag-image">32 Completed tasks</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!---End card-->
        <h4>Overview</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="job-box">
                    <div class="avl-job">                       
                        <div class="n-job">
                            <h4>Available Job</h4>
                            <strong>{{ count($jobs) }}</strong>
                        </div>
                        <div class="img">
                            <img src="{{ url('') }}/images/employer/job-img.png" alt="">
                        </div>
                    </div>
                    <div class="v-more">
                        <a href="{{ route('employer.jobs') }}">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="job-box">
                    <div class="avl-job">                       
                        <div class="n-job">
                            <h4>Received Resume</h4>
                            <strong>{{count($appliedjob) }}</strong>
                        </div>
                        <div class="img">
                            <img src="{{ url('') }}/images/employer/resumes.png" alt="">
                        </div>
                    </div>
                    <div class="v-more">
                        <a href="{{ route('canditate.resume') }}">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="job-box">
                    <div class="avl-job">                       
                        <div class="n-job">
                            <h4>Interview Schedule</h4>
                            <strong>{{ count($job_applieds) }}</strong>
                        </div>
                        <div class="img">
                            <img src="{{ url('') }}/images/employer/int-scdule.png" alt="">
                        </div>
                    </div>
                    <div class="v-more">
                        <form id="filter-job" action="{{ route('canditate.resume') }}">
                                {{ csrf_field()}}
                                    <input type="hidden" name="job" value="">
                                    <input type="hidden" name="q" value="invited"> 
                        <a href="#" onclick="document.getElementById('filter-job').submit();">View Details</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ctjob">
            <div class="col-md-6">
                <div class="crrnt-jb">
                    <div class="hed">
                        <p>Current Job</p>
                        <a href="{{ route('employer.jobs') }}">See All</a>
                    </div>
                    <div class="skill-list">
                        <ul class="nav">
                            <?php  $i = 0;  ?>
                            @if(!$jobs->isEmpty())
                            @foreach($jobs as $job)
                            @if($i >= 6)  @break  @else
                            <li class="nav-item" id="{{ $job->id }}">
                                <div class="image left-img">
                                    <img src="{{ url('') }}/images/employer/Forma.png" alt="image">
                                </div>
                                <div class="contt">
                                    <h5>{{ $job->title }}</h5>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                    <p>{!! \Illuminate\Support\Str::words($job->job_summary, 10,'....')  !!}</p>

                                </div>
                            </li>
                            <?php $i++; ?>
                            @endif
                            @endforeach
                            @else
                            <li class="nav-item">
                                <div class="contt">
                                    <p>No Record Found</p>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div><!---end col-->
            <div class="col-md-6">
                <div class="crrnt-jb">
                    <div class="hed">
                        <p>Apply Job</p>
                        <a href="{{route('canditate.resume')}}">See All</a>
                    </div>
                    <div class="skill-list">
                        <ul class="nav">
                            @if(!$appliedjob->isEmpty())
                            <?php  $i = 0;  ?>
                            @foreach($appliedjob as $job_applied)
                            @if($i >= 6)  @break  @else
                            <li class="nav-item" id="{{ $job_applied->id }}">
                                <div class="image imgs">
                                    @if(is_null($job_applied->user->profile_img))
                                    <img src="{{ url('') }}/images/ICON.PNG" alt="image">
                                    @else
                                    <img src="{{ url('') }}/images/employee/{{ $job_applied->user->profile_img }}" alt="image">
                                    @endif
                                </div>
                                <div class="contty">
                                    <h5>{{ $job_applied->user->name }} {{ $job_applied->user->lname }}</h5>
                                    <p>{{ $job_applied->user->designation ?? 'N/A' }}</p>
                                    <span>{{ $job_applied->created_at->diffForHumans() }}</span>                                 
                                </div>
                                <div class="r-btn">
                                <form id="filter-job-{{ $job_applied->id }}" action="{{ route('canditate.resume') }}">
                                {{ csrf_field()}}
                                    <input type="hidden" name="job" value="{{ $job_applied->post_job_id }}">
                                    <input type="hidden" name="q" value=""> 
                                    <button form="filter-job-{{ $job_applied->id }}" type="submit"  name="submit" class="btn btn-default">View</button>
                                </form>    
                                </div>
                            </li>
                            <?php $i++; ?>
                            @endif
                            @endforeach
                            @else
                            <li class="nav-item">
                                <div class="contt">
                                    <p>No Record Found</p>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div><!---end col-->
        </div>
    </div>
</section>
@stop

