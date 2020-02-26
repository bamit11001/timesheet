<header class="header">
	<nav class="navbar navbar-expand-md bg-white">
		<div class="main_body">
			<div class="container-fluid">
				<!-- Below line for Left side Logo -->
				<a class="navbar-brand" href="#">
					<img src="{{asset('admin')}}/images/logo.png" alt="logo-image">
				</a>
				<button class="navbar-toggler outline" type="button" data-toggle="collapse" data-target="#steel" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">☰</span>
				</button>
				<!-- Below line for Right side Logo -->
				<!-- <a class="navbar-brand" href="#">Navbar</a> -->
				<div class="collapse navbar-collapse justify-content-start" id="steel">
					<ul class="navbar-nav left-navlist">
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/employee')}}">Find Jobs</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Company Reviews</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Find Salaries</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/employee')}}/message">Find Resume</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/employee')}}/message">Chat</a>
						</li>
					</ul>				
	
					<ul class="navbar-nav ml-auto right-navlist">
						<li class="nav-item dropdown">
							<!-- <a class="nav-link" href="{{ url('/employee/profile')}}">Profile</a> -->
							<a href="#" data-toggle="dropdown" class="text-decoration-none">Profile</a>
							<div class="dropdown-menu">
								<a class="nav-link" href="{{ url('/employee/profile')}}">Profile</a>
								<a href="{{ url('/employee/logout')}}" >Logout</a>
							</div>
						</li>
						<!-- <li class="nav-item">
							<a href="{{ url('/employee/logout')}}" >
								<button  style="color:Black">LogOut</button>
							</a>
						</li> -->
					</ul>
				</div>
			</div>
		</div><!---End/.container---->
	</nav>
</header>