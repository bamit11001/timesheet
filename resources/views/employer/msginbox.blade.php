@extends('employer.layout.default')
@section('content')   
<section class="content msg-inbox">
    <div class="container-fluid">
        <div class="card">
            <div class="header">                    
                <h2>Message Box</h2>
            </div>
            <div class="body">
                <div class="message">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="left-side">
                                <form action="" class="form-inline">
                                    <div class="form-group">                                 
                                        <input type="text" id="searchInput" onkeyup="searchUser()" class="form-control" placeholder="Search for names..">                                  
                                    </div>
                                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </form>
                                <div class="tabs">
                                    <ul class="nav nav-tabs" id="userUL">
                                        @foreach($messages as $message)
                                        <li href="#home" id="user_{{ $message->user->id }}" class="active" data-toggle="tab" onclick="enableTxt({{ $message->user_id }})">
                                            
                                                <div class="box">
                                                    <div class="img-box user-img">
                                                    @if($message->user->profile_img != '')
                                                        <img style="width:100%;" src="{{ url('') }}/images/employee/{{$message->user->profile_img }}" alt="image">
                                                    @else
                                                        <img src="{{asset('images')}}/ICON.png" alt="image">
                                                    @endif    
                                                    </div>
                                                    <div class="content">
                                                        <p>{{ $message->user->name ?? 'N/A' }}</p>
                                                        <p>{{ $message->user->designation ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="right-side">
                                <div class="bodyy" id="message-box">
                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active main-inbox">
                                        </div>
                                    </div>
                                </div>
                                <div class="footer send-message snd-msg">
                                    <div class="input-group">
                                        <textarea name="message-box" id="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                        <!-- <div class="input-group-append"> -->
                                            <div class="upload-rsm">                                               
                                                <!-- <input type="file" id="file" accept="application/pdf, image/*, .doc, .docx" name="file"> -->
                                                <p class="position-relative file-infomsg">               
                                                    <a href="javascript:void(0)">							
                                                        <i class="fa fa-paperclip"></i>
                                                        <input type="file" id ="file" accept=".png, .jpg, .jpeg, .doc, .docx,.pdf" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent; cursor: pointer;" name="file_source" size="10" onchange="$(&quot;#upload-file-info&quot;).html($(this).val());">
                                                    </a>
                                                    <span class='label label-info' id="upload-file-info"></span>
                                                </p>
                                            </div>
                                            <button type="button" onclick="sendmsg(this)" class="btn btn-info send-btn">SEND</button>                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!---End card-->
    </div>
</section>
<script>
    function enableTxt(user_id) 
    {
        
        $(".footer").removeClass("send-message");

        $.ajax({
            type:'POST',
            url:"{{ route('employer.inbox.message') }}",
            data:{user_id:user_id,  _token: '{{csrf_token()}}'},
            success:function(data){
                var main = $("<div class='usercontents'></div>");

                $.each(data.data, function (index , value) {
                if(value.message !== null || value.file !== null){    
                    if(value.company_id == value.sent_by){
                       var name = value.company.name;
                       var  empimg = "{{ url('') }}/images/ICON.png";
                    }else{
                        if(value.user.lname != '' && value.user.lname!= null){
                        var name = value.user.name +'  '+ value.user.lname ;
                        }else {
                            var name = value.user.name  ;
                        }
                        if(value.user.profile_img != '' && value.user.profile_img != null){
                          var  empimg = "{{ url('') }}/images/employee/" +value.user.profile_img;
                        }else{
                          var  empimg = "{{ url('') }}/images/ICON.png";
                        }
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
                   
                    var rr = "<div class='usercontents'><div class='usr-imgg'><img style='width:100%;' src='"+empimg+"' alt='usr-image'></div><div class='usr-contt'><h5 class='user-name'>";
                    var d = value.created_at;
                    var  dateTimeParts = d.split(' ');      
                    rr += name;
                    rr += "</h5><span class='msg-time'>" + dateTimeParts[1] + "</span><div class='content msg-content'><p class='user-message'>" + message + "</p><p class='user-message'><a href='{{ url('') }}/images/chat/"+ files +"' download>" + file + "</a></p></div><input type='hidden' id='user_id' name='user_id' value="+ value.user.id +"><input type='hidden' name='company_id' id='company_id' value="+ value.company_id +"></div></div>";
                   main.append(rr);
                  // console.log(rr);
              }
                    });
                $(".main-inbox").html(main);
                $('#message-box').animate({
                    scrollTop: $('#message-box')[0].scrollHeight}, "slow");
            }
        });
    }

    setInterval(function()
    {
        var user_id = $('#user_id').attr("value");
        if(user_id && user_id!=''){
            enableTxt(user_id) ;
        }
     
    }, 5000); //10000 milliseconds = 10 seconds

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
                    $(".snd-msg").removeClass("error-msg");
                    $('#message-box').animate({

                    scrollTop: $('#message-box')[0].scrollHeight}, "slow");
                    $("#message").val('');
                    $("#upload-file-info").html('');
                    $("#user_"+user_id).click();
                }else{

                     $(".snd-msg").addClass("error-msg");
                }

                }
            });

    }

    function searchUser() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("userUL");
        li = ul.getElementsByTagName("li");

        for (i = 0; i < li.length; i++) {
            p = li[i].getElementsByTagName("p")[0];
            txtValue = p.textContent || p.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
@stop