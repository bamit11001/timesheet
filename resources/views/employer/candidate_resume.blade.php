@extends('employer.layout.default')
@section('content')
<?php $index = 0; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card" id="">
                <div class="header">                    
                    <div class="row">
                    <form action="{{ route('canditate.resume') }}">
                        {{ csrf_field()}}
                        <div class="col-md-6">
                            <div class="rcvd-rsm">
                                <h2>Received Resumes For </h2>
                                <div class="form-group">
                                    <select name="job" onchange="this.form.submit()" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($applied_jobs_title as $applied_jobs_title)
                                        <option <?php if($job ==$applied_jobs_title->id ) echo "selected='selected'"; ?> value="{{ $applied_jobs_title->id ?? '' }}">{{ $applied_jobs_title->title ?? 'N/A' }}</option>
                                    @endforeach    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">                                    
                            <div class="rcvd-rsm">
                                <h2>Sort By Status</h2>
                                <div class="form-group">
                                
                                        <select name="q" onchange="this.form.submit()" class="form-control form-control-sm" >
                                        <option value="">Select</option>
                                            @foreach(['pending', 'rejected', 'selected', 'invited', 'waiting'] as $status)
                                            <option  value="{{ $status }}" <?php if($q ==$status ) echo "selected='selected'"; ?>>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>     
                                </div>           
                                        </div>
                                    </div>
                                    </form>
                            </div>
                        </div>
                </div>
                <div class="succes" id="msg-success" style="display:none" >
                    <a href="#" class="msg-success"></a>
                </div>
                <div class="boy-data">
                    <div class="table-responsive usr-data">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                <th>No.</th>
                                <th>Candidate Name</th>
                                <th>Position & Exp.</th>
                                <th>Skills Match</th>
                                <th>Job Apply Date</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!$applied_jobs->isempty())
                            @foreach($applied_jobs as $index=>$applied_job)
                                <tr>
                                    <td>{{$index + $applied_jobs->firstItem()}}</td>
                                    <td>{{$applied_job->user->name}}  {{$applied_job->user->lname}}</td>
                                    <td>{{ $applied_job->user->designation ?? '' }} ({{ $applied_job->user->total_exp ?? 'N/A' }})</td>
                                    <td>10/9 Match</td>
                                    <td>{{ $applied_job->created_at->format('d M, Y')  }} </td>   
                                    <td class="dropdown status">
                                        <button class="btn btn-default dropdown-toggle" id="status-dropdown" type="button" data-toggle="dropdown">
                                        @if($applied_job->status == 'invited')Invite
                                        @elseif($applied_job->status == 'waiting')Waiting List
                                        @elseif($applied_job->status == 'selected')Selected
                                        @elseif($applied_job->status == 'rejected')Rejected
                                        @else
                                        Pending
                                        @endif<span class="caret"></span></button>                                                                         
                                        <ul class="dropdown-menu">
                                            <li><a href="" data-toggle="modal" value="invite" data-target=".int_sd_{{$applied_job->id}}">Invite</a></li>

                                            <li><a href="#" data-id="{{$applied_job->id}}" value="waiting" onclick="enableTxt(this)" name="waiting_{{$applied_job->id}}">Waiting List</a></li>

                                            <li><a href="#" data-id="{{$applied_job->id}}" value="selected" onclick="enableTxt(this)" name="selected_{{$applied_job->id}} ">Selected</a></li>
                                            
                                            <li><a href="#" data-toggle="modal" value="rejected" data-target=".int_rjct_{{$applied_job->id}}">Reject</a></li>
                                        </ul>
                                    </td>
                                    <td class="action">
                                        <a href="{{route('candidate.profile', ['id' => encrypt($applied_job->user_id)])}}" class=""><img src="{{ url('') }}/images/employer/View.png" alt=""></a>

                                        <!-- <img src="{{ url('') }}/images/employer/message.png" id="user_{{$applied_job->user_id}}" onclick="enableChat(this)" company_id="{{ $company_id }}" user_id="{{ $applied_job->user->id }}" alt=""> -->
                                        <img src="{{ url('') }}/images/employer/message.png" id="user_{{$applied_job->user_id}}" onclick="enableChat(this)" company_id="{{ $company_id }}" user_id="{{ $applied_job->user->id }}" alt="" class="sd">

                                        <a href="#" id="{{ $applied_job->id }}" class="" onclick="<?php if($applied_job->status != 'rejected'){ echo 'return false'; } else { echo 'deletejob(this)'; } ?>"  data-toggle="confirmation"><img src="{{ url('') }}/images/employer/Delete.png" alt=""></a>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="empty-row"><td class="empty-colum">No Record Found</td></tr>
                                        @endif
                            </tbody>
                            
                        </table>
                        <div class="paginations">
                        <p class="pull-left lst-show">Showing {{ $applied_jobs->firstItem() }} to {{$index + $applied_jobs->firstItem()}}  of {{ $applied_jobs->total() }} entries</p>
                                <ul class="pagination pull-right">
                                    {{ $applied_jobs->links() }}
                                </ul> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="chat-popup" id="myForm">
    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
    <button type="button" class="close" id="closeButton">&times;</button>
        <div class="form-container">
        <div class="msg-rcbr">
            <a id="username"  href="#" class="updwn">
                Petey Cruiser
                <i class="fa fa-angle-down"></i>
            </a>

        </div>
        <div class="main-box" id="main-box">
        
        </div>
        <div class="msg-snd">
            <textarea placeholder="Type message.." id="message" name="msg"></textarea>
            <!-- <input type="file" id="file" accept="application/pdf, image/*, .doc, .docx" name="file"> -->
            <p class="position-relative file-info">               
                <a href="javascript:void(0)">							
                    <i class="fa fa-paperclip"></i>
                    <input type="file" id ="file" accept=".png, .jpg, .jpeg, .doc, .docx,.pdf" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent; cursor: pointer;" name="file_source" size="10" onchange="$(&quot;#upload-file-info&quot;).html($(this).val());">
                </a>
                <span class='label label-info' id="upload-file-info"></span>
            </p>
            <button type="submit" onclick="sendmsg(this)" class="btn snds">Send</button>
        </div>
        <!-- <button type="button" class="btn cancel" onclick="closeForm()">Close</button> -->
      </div>
    </div>


 


    <!-- The Rejecting Modal -->
    @foreach($applied_jobs as $applied_job)
    <!-- The Rejecting Modal -->

    <div class="modal int_rjct_{{$applied_job->id}}" id="reject">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Rejected Email For <span style="color: #F60;">Paul Molive</span></h4>
                </div>
                <div class="modal-header">
                    <p>Application For</p>
                    <strong>{{ $applied_job->user->designation }} at {{ $applied_job->interview_venue }} .</strong>                   
                   
                    <form action="" style="margin-bottom:0;" id="rejected_form_{{$applied_job->id}}" name="rejected_form_{{$applied_job->id}}">
                    @csrf
                    <input type="hidden" name="applied_id" value="{{$applied_job->id}}">
                    <input type="hidden" name="status" value="rejected"> 
                        <div class="form-group" style="margin:0;">
                            <p style="margin-top: 10px;">Reason For Rejection</p>
                            <select class="form-control" name="reason" id="sel1">
                                <option>Technical Skills Not Match</option>
                                <option>Technical Skills</option>
                                <option>Technical Skills Match</option>
                            </select>
                        </div> 
                </div>
                <!-- Modal body -->
                <div class="rj-body">
                    <h4>Job Description</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor.</p>
                    <div class="sincr">
                        <p style="margin-bottom:0;">Sincerly</p>
                        <p>{{ $auth_name }}</p>
                    </div>
                </div>
                <div class="sbmt-btn">
                <div class="success-rjct" id="success-msg-rjct">
                    <p class="success-msg-rjct"></p>
                </div>
                    <button type="button" class="btn btn-defaultb dismiss-model" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="rejectedformsubmit({{$applied_job->id}})" class="btn btn-info">Send Invitation</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@foreach($applied_jobs as $applied_job)
    <!-- The Modal for invite -->
    <div class="modal int_sd_{{$applied_job->id}}"  id="int-sd">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inviting For Interview</h4>
            </div>
            <div class="modal-header">
                <p style="float:left;">Candidate Name: {{$applied_job->user->name}}  {{$applied_job->user->lname}}</p>
                <p class="text-center">Total Experience: {{ $applied_job->user->total_exp }}</p>
                <p>Position: {{ $applied_job->user->designation }}</p>
                <strong>Skills</strong>
                @foreach($applied_job->user->users_skill as $skill)                
                {{ $skill->skills->name }}, 
                @endforeach
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="invite-intrvw">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form action="{{ route('candidate.interview.status') }}" class="invite-form" id="invite-form_{{$applied_job->id}}" name="invite-form_{{$applied_job->id}}">
                    @csrf
                    <input type="hidden" name="applied_id" value="{{$applied_job->id}}">
                    <input type="hidden" name="status" value="invited">
                    <input type="hidden" name="name" value="{{ $applied_job->user->name }} {{ $applied_job->user->lname }}">
                    <input type="hidden" name="email" value="{{ $applied_job->user->email }}">
                    <input type="hidden" name="address" value="{{ $applied_job->user->email }}">
                   <!--  <input type="hidden" name="message" value="Welcome"> -->     
                    <label>Interview Type</label>
                        <div class="intrvw-typ">
                            <div class="checkbox c-actv">
                                <input type="radio" name="invite" value="FTF">
                                <span class="checkmark"></span><span class="f-fce">FACE TO FACECE</span>
                            </div>
                            <div class="checkbox">
                                <input type="radio" name="invite" value="telephonic">
                                <span class="checkmark"></span><span class="f-fce">TELEPHONE</span>
                            </div>
                            <div class="checkbox">
                                <input type="radio" name="invite" value="FTF">
                                <span class="checkmark"></span><span class="f-fce">Video</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Date</label>
                                    <input type="date"  name="date" class="form-control dt" placeholder="DD/MM/YY">
                                    <span style="color:red;">
                                        <span class="invalid-feedbackkk" role="alert">
                                        </span>
                                    </span>                                
                                </div>
                                <div class="col-md-4">
                                    <label>Start Time</label>
                                    <input type="time" name="start_time" class="form-control dt" placeholder="11:30" value="09:00">
                                </div>
                                <div class="col-md-4">
                                    <label>End Time</label>
                                    <input type="time" name="end_time" class="form-control dt" placeholder="12:30" value="06:00">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Interview Address*</label>
                                    <textarea class="form-control" rows="3" id="comment" name="address" placeholder="Enter Address " style="resize: none;">{{ $applied_job->interview_venue }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Message</label>
                                    <textarea class="form-control" name="message" rows="3" id="comment" placeholder="Enter message" style="resize: none;"></textarea>                               
                                </div>
                            </div>
                        </div><hr>
                        <div class="intrvwr-dtl">
                            <p style="font-weight:500;">Interviewer ID</p>  
                            <input type="email" class="form-control" name="interviewer_id" placeholder="cypress24@gmail.com"> 
                        <div class="success" id="success-msg">
                            <p class="success-msg"></p>
                        </div>
                        <div class="smt-btn">
                            <button type="button" class="btn btn-default dismiss-model" data-dismiss="modal">Cancel</button>
                            <button type="button" onclick="formsubmit({{$applied_job->id}})" class="btn btn-info">Send Invitation</button>
                        </div>          
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
@endforeach

<!-- rejecting candidate -->
<script type="text/javascript">   
    function rejectedformsubmit(id){
        //event.preventDefault()
        var $inputs = $('#rejected_form_'+id+' :input');

        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });
        
        $.ajax({
            type     : "POST",
            url      : "{{route('candidate.interview.status')}}",
            data     : values,
            cache    : false,

            success  : function(data) { 
                $("#status-dropdown").html('Rejected <span class="caret"></span>');
                $(".success-msg-rjct").append(data.success);      
                    setTimeout(function(){ $("div.success-rjct").remove(); $(".dismiss-model").click(); }, 2000 );  
                
            }
        });
        return false;
    } 
</script>

<!-- inviting candidate -->

<script type="text/javascript">    
    function formsubmit(id){
        //event.preventDefault()
        var $inputs = $('#invite-form_'+id+' :input');

        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });
        
        $.ajax({
            type     : "POST",
            url      : "{{route('candidate.interview.status')}}",
            data     : values,
            cache    : false,

            success  : function(data) { 
                if($.isEmptyObject(data.error)){
                    $("#status-dropdown").html('Invite <span class="caret"></span>');
                    $(".success-msg").append(data.success); 
                    setTimeout(function(){ $("div.success").remove(); $(".dismiss-model").click(); }, 2000 );
                    
                }else{
                printErrorMsg(data.error);
                }                    
            }

        });
        return false;
    }
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

            });
    }
</script>

<!-- update waiting -->

<script>
    function enableTxt(elem) 
    {
        var text = $(elem).text();
        var applied_id = $(elem).attr("data-id");
        var status = $(elem).attr("value");
        var rr = $(elem).attr('');
        $.ajax({
            type:'POST',
            url:"{{ route('candidate.interview.status') }}",
            data:{applied_id:applied_id, status:status, _token: '{{csrf_token()}}'},
            success:function(data){
                $("#status-dropdown").html(text + '<span class="caret"></span>');
                $(".msg-success").append(data.success);  
                    $('#msg-success').show();     
                        setTimeout(function(){ $("div.succes").remove(); }, 5000 ); 
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
            url:"{{ route('delete.appliedjob') }}",
            data:{id:id,  _token: '{{csrf_token()}}'},
            success:function(data){
               console.log(data);
            }
        });

        }

    }
</script>

<script>
    $(document).ready(function(){
        $(".checkbox").click(function(){
            $(".checkbox").removeClass("c-actv");
            $(this).addClass("c-actv");
        });
    });

    function enableChat(elem) 
    {
               
        var user_id = $(elem).attr("user_id");
        var company_id = $(elem).attr("company_id");

        $.ajax({
            type:'POST',
            url:"{{ route('employer.enable.chat') }}",
            data:{user_id:user_id,  _token: '{{csrf_token()}}'},
            success:function(data){
                console.log(data);
                if(data.data.length > 0){
                    document.getElementById("myForm").style.display = "block";
                    
                    var main = $('<div class="send_msgg"></div>');
                    
                    $.each(data.data, function (index , value) {
                    if(value.message !== null || value.file !== null){    
                    if(value.company_id == value.sent_by){
                        var name = value.company.name;
                    }else{
                        var name = value.user.name;

                    }

                    if(value.file !== null){
                        var files = value.file;
                        var extanction = value.file.split(".");
                      if(extanction[1] == 'png' || extanction[1] == 'jpg' || extanction[1] == 'jpeg'|| extanction[1] == 'gif'){
                        var file = '<img class="chat-box-image" style="width: 20%;" src="{{ url('') }}/images/chat/'+ value.file +'"';
                       }else if (extanction[1] == 'pdf'){
                        var file = '<img class="chat-box-pdf" style="width: 10%;" src="{{ url('') }}/images/Adobe_PDF_file_icon.PNG"'+value.file + '';
                       }else{
                        var file = '<img class="chat-box-pdf" style="width: 10%;" src="{{ url('') }}/images/docx-icon.PNG"'+value.file + '';
                       }

                    }else{
                        var file = '';
                    }

                    
                    if(value.message !== null){
                      var message = value.message;
                    }else{
                        var message = '';
                    }
                       var d = value.created_at;
                       var  dateTimeParts = d.split(' ');
                       var user_name = value.user.name;


                       var cc = $("<div class = 'cc'><p>" + message +"</p><a href='{{ url('') }}/images/chat/"+ file +"' download>" + file + "</a><span>" + name + "</span><span>" + dateTimeParts[1] + "</span></div><input type='hidden' id='user_id' name='user_id' value="+ value.user.id +"><input type='hidden' name='company_id' id='company_id' value="+ value.company_id +">")
                       main.append(cc);
                
                  $("#username").html(value.user.name +" <i class='fa fa-angle-down'></i>");
              }
                    });
                    $("#main-box").html(main);
                    $('#main-box').animate({
                    scrollTop: $('#main-box')[0].scrollHeight}, "slow");  
    
                }else{

                    document.getElementById("myForm").style.display = "block";
                    if(data.user[0].lname === 'NULL'){
                        var lname = data.user[0].lname;
                    }else{
                        var lname = '';
                    }
                    $("#username").html(data.user[0].name + lname);
                    var main = $('<div class="send_msgg"><input type="hidden" id="user_id" name="user_id" value="'+ user_id +'"><input type="hidden" name="company_id" id="company_id" value="' + company_id +'"></div>');
                    $("#main-box").html(main);
                }
            
            }
        });


    }

    function sendmsg(elem) 
    {

        var user_id = $('#user_id').attr("value");
        var company_id = $('#company_id').attr("value");
        var message = $.trim($("#message").val());

        var formData = new FormData();
        formData.append('user_id', user_id);
        formData.append('company_id', company_id);
        formData.append('message', message);
        formData.append('imageFile', $('#file')[0].files[0]);
        formData.append('_token', '{{csrf_token()}}');
        

            $.ajax({
                type:'POST',
                url:"{{ route('employer.send.message') }}",
                data:formData,
                processData: false,
                contentType: false,
                success:function(data){
                if(data.success != 'failed'){
                    $(".msg-snd").removeClass("error-msg");
                    $('#main-box').animate({
                    scrollTop: $('#main-box')[0].scrollHeight}, "slow");
                    $("#message").val('');
                    $("#upload-file-info").html('');
                    $("#user_"+user_id).click();
                }else{
                     $(".msg-snd").addClass("error-msg");
                }
                }
            });

    }

    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    </script>

<script>
    $(document).ready(function(){
        $(".updwn").click(function(){
            //alert("Hello");
            $(".main-box").toggleClass("box-act");
        });
    });
</script>
<script>
    $(document).ready(function(){
        //$(".sd").click(function(){
            //alert("Hello");
            $(this).addClass("bg-colors");

        });
    });
</script>
<script>
document.getElementById('closeButton').addEventListener('click', function(e) {
    e.preventDefault();
    this.parentNode.style.display = 'none';
}, false);
</script>

@stop