<section>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info" style="display: none;" >
                <div class="image">
                    <img src="{{asset('admin')}}/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email">john.doe@example.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->



            <!-- Menu Side bar Left-->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        <a href="dfgdsfg">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/admin')}}/review">
                            <i class="material-icons">text_fields</i>
                            <span>Overview</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('/admin')}}/review">
                            <i class="material-icons">text_fields</i>
                            <span>Jobs</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('/admin')}}/review">
                            <i class="material-icons">text_fields</i>
                            <span>Candidates</span>
                        </a>
                    </li>

                     <li>
                        <a href="{{url('/admin')}}/review">
                            <i class="material-icons">text_fields</i>
                            <span>Career Page</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Review</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{url('/admin')}}/review">Review</a>
                            </li>
                        </ul>
                    </li>

                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Jobs</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{url('/admin')}}/job">Jobs</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Messages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{url('/admin')}}/message">Messages</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
     
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <!-- <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li> -->
            </ul>
            
        </aside>
        <!-- #END# Right Sidebar -->
           
        <!-- Widgets -->
        
    </section>