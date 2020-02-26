@extends('employer.layout.default')
@section('content')  

<?php $index = 0; ?>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header job_list-head">
                        <form action="{{ route('filter.job') }}" id="searchform">    
                        {{ csrf_field()}}
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-2 pr-0"><label for="pwd">Job List</label></div>
                                        <div class="col-md-6 pl-0">
                                        <input class="form-control form-control-sm" placeholder="Search by job title"  type="search" name="q" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 right-data">
                                    <div class="row">
                                        <div class="col-md-2"><label for="sel1">Sort By:</label></div>
                                        <div class="col-md-6">
                                        <select name="orderBy" class="form-control form-control-sm" value="{{ $orderBy }}">
                                            @foreach(['asc', 'desc'] as $order)
                                            <option @if($order == $orderBy) selected @endif value="{{ $order }}">{{ ucfirst($order) }}</option>
                                            @endforeach
                                        </select>    
                                        <!-- <select name="s" id="sortBy" class="form-control form-control-sm" value="{{ $sortBy }}" style="visibility:hidden;">
                                            @foreach(['created_at'] as $col)
                                            <option @if($col == $sortBy) selected @endif value="{{ $col }}"></option>
                                            @endforeach
                                        </select> -->
                                        </div>
                                        <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100 btn btn-sm bg-blue">Filter</button>
                                            <!-- <button class="btn btn-primary">New Job</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                              </form>
                            </div>
                        </div>
                         @if (session('status'))
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                    </div>
                @endif</div>
                </div>
               

                        <div class="joblist_body"> 
                            <div class="table-responsive job_list_table">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                        <th>No.</th>
                                        <th>Job Title</th>
                                        <th>Received Resume</th>
                                        <th>Date</th>
                                        <th>Views</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if(!$jobs->isempty())
                                        @foreach($jobs as $index=>$job)
                                      
                                        <tr id="{{ $job->id }}">
                                            <td>{{$index + $jobs->firstItem()}}</td>
                                                <td>{{ $job->title}}</td>
                                            <form id="filter-job-{{ $job->id }}" action="{{ route('canditate.resume') }}">
                                            {{ csrf_field()}}
                                                <input type="hidden" name="job" value="{{ $job->id }}">
                                                <input type="hidden" name="q" value="">    
                                            <td  class="resume-view" onclick="document.getElementById('filter-job-{{ $job->id }}').submit();">{{count($job->jobapplied)}}</td>
                                            </form>
                                            <td>{{ $job->created_at->format('d M, Y') }}</td>
                                            <td>56</td>
                                            <td>
                                            <div class="switch radio-switch">
                                                <input type="radio" class="switch-input" data-id="{{ $job->id }}" onchange="enableTxt(this)" name="view_{{ $job->id}}" value="1" id="week_{{ $job->id}}" {{$job->status == '1' ? 'checked' : ''}}>
                                                <label for="week_{{ $job->id}}" class="switch-label switch-label-off">Active</label>
                                                <input type="radio" class="switch-input" data-id="{{ $job->id }}" onchange="enableTxt(this)" name="view_{{ $job->id}}" value="0" id="month_{{ $job->id}}"  {{$job->status == '0' ? 'checked' : ''}}>
                                                <label for="month_{{ $job->id}}" class="switch-label switch-label-on">Deactive</label>
                                                <span class="switch-selection"></span>
                                            </div>
                                                                                            
                                            </td>
                                            <td>
                                                <a data-toggle="modal" data-target="#job_post_{{$job->id}}" href="" id="formId" class=""><img src="{{ url('') }}/images/employer/View.png" alt=""></a>
                                                <a href="{{route('employer.jobpost', ['id' => encrypt($job->id)])}}" class=""><img src="{{ url('') }}/images/employer/Edit.png" alt=""></a>
                                                <a href="#" id="{{ $job->id }}" class=""  onclick="deletejob(this)" data-toggle="confirmation"><img src="{{ url('') }}/images/employer/Delete.png"   alt=""></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="empty-row"><td class="empty-colum">No Record Found</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="paginations">
                                    <p class="pull-left lst-show">Showing {{ $jobs->firstItem() }} to {{$index + $jobs->firstItem()}}  of {{ $jobs->total() }} entries</p>
                                        <ul class="pagination pull-right">
                                            {{ $jobs->links() }}
                                        </ul> 
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>
    @foreach ($jobs as $job)
    
  <!-- Modal job-post description-->
  <div class="modal fade job_post" id="job_post_{{ $job->id}}" role="dialog" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ $job->title }}</h4>
            <div class="positn">
                <p class="one">Position:<span>{{ $job->openings }}</span></p>
                @if($job->job_type == 'fulltime')
                <p>Job Type: Full-Time</p>
                @else
                <p>Job Type: Part-Time</p>
                @endif
            </div>
          <div class="yer-sell">
              <p class="yrs"><i class="fa fa-briefcase" aria-hidden="true"></i>  {{ $job->min_experience }} to {{ $job->max_experience }} Yrs</p>
            @if($job->salary_range_per == 'Month')
              <p><i class="fa fa-rupee" aria-hidden="true"></i>  Rs. {{ $job->salary_range_from }} - {{ $job->salary_range_to }} a month</p>
              @else
              <p><i class="fa fa-rupee" aria-hidden="true"></i>  Rs. {{ $job->salary_range_from }} - {{ $job->salary_range_to }} Lakh/Yr</p>
              @endif
              <p><i class="fa fa-map-marker" aria-hidden="true"></i>  {{ $job->company_address }}  </p>
          </div>
        </div>
        <div class="modal-body">
          <div class="description">
              <h4>Job Description</h4>
              <p>{{ $job->job_summary }}</p>
          </div>
          <div class="responsiblity">
              <h4>Responsibilities and Duties :</h4>
              <p>{{ $job->duties }}</p>
              <ul class="nav navbar-nav">
                  <li class="nav-item">
                  {{ $job->skills }}
                  </li>
                  <li class="nav-item">
                    {{ $job->benifits }}
                  </li>
              </ul>
          </div>
          <div class="rqrd">
              <p>Required Education :  {{ $job->qualification_required }} (Preferred)</p>
          </div>

        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>

  @endforeach 
    
<!-- update ststus -->
<script>
    function enableTxt(elem) 
    {

        var id = $(elem).attr("data-id");
        var status = $(elem).attr("value");

        $.ajax({
            type:'POST',
            url:"{{ route('update.status') }}",
            data:{id:id, status:status, _token: '{{csrf_token()}}'},
            success:function(data){
                alert(data.success);
            }
        });

    }
</script>
<!-- Delete job -->

<script>
    function deletejob(elem) 
    {
        var id = $(elem).attr("id");

        var result = confirm("Are you sure you Want to delete this job");
        if(result) {
            $.ajax({
            type:'POST',
            url:"{{ route('delete.job') }}",
            data:{id:id,  _token: '{{csrf_token()}}'},
            success:function(data){
                location.reload(); 
            }
        });

        }

    }
</script>


<script>
$('#sortBy').change(function() {
    $("#searchform").submit();
});
</script>
@stop