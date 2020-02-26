    <div class="overlay"></div>
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{asset('employer')}}">
                    <img src="{{asset('admin')}}/images/logo.png">
                </a>


            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">

                <ul class="nav navbar-nav navbar-right">

                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count notification-count"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body" id="notification_list">    
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle help" data-toggle="dropdown" role="button">
                            <i class="material-icons">help</i><span>Help</span>
                        </a>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="user_pic dropdown">
                        <a href="javascript:void(0);" class="js-right-sidebar" data-close="true" data-toggle="dropdown">
                            <div class="user_info">
                                <span>{{ Auth::user()->name }} {{ Auth::user()->lname }}
                                    <b>admin</b>
                                </span>
                                <span class="usr_img">

                                    <img src="{{asset('images')}}/ICON.png" alt="profile-image">   
                                </span> 
                            </div>                                  
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="{{route('employer.view_profile')}}">View Profile</a></li>
                        <li class="dropdown">
                            <a href="{{ url('/employer/logout')}}">
                                Log Out                               
                            </a>
                        </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  
<script>
$(document).ready(function(){
     addada();
    function addada(){
          $.ajax({
                url: "{{ route('employer.notification') }}", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data : { _token: '{{ csrf_token()}}' },
                success: function(data){
                    if($.isEmptyObject(data.error)){   
                    var li = $("<ul class='menu'></ul>"); 
                    var notification_count = data.data.length;
                    $(".notification-count").text(notification_count);
                    
                    $.each(data.data, function (index , value) {

                    var rr = $("<li id = 'notification_"+value.id+"'><a href='' onclick=' notificationstatus(this);' id = '"+value.id+"'><div class='icon-circle bg-light-green'><i class='material-icons'>person_add</i></div><div class='menu-info'><h4>"+ value.message +"</h4><p><i class='material-icons'>access_time</i> <time class='timeago' datetime=''>'"+ value.created_at +"'</time></p></div></a></li>");
                    li.append(rr);
                    }); 
                      $("#notification_list").html(li);   
                    }else{
                    alert('error');
                    }   
                    var dateAux;
                  $(".timeago").each(function(i,item){
                      dateAux = moment($(item).html(),'YYYY-MM-DD hh:mm:ss');
                      $(item).attr('datetime',dateAux.toISOString());
                  })  
                  $("time.timeago").timeago();
                },
            });
    }
    setInterval(function()
    {
      addada();
    }, 10000); //10000 milliseconds = 10 seconds
});


    function notificationstatus(elem) 
    {
        var id = $(elem).attr("id");
        $.ajax({
            type:'POST',
            url:"{{ route('update.employer.notification') }}",
            data:{id:id, status:'3', _token: '{{csrf_token()}}'},
            success:function(data){
                console.log(data);
            }
        });

    }
</script>




