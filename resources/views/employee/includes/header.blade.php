<header class="header">
		<nav class="navbar navbar-expand-md bg-white">
			<div class="container-fluid">
			<!-- Below line for Left side Logo -->
			<a class="navbar-brand" href="#">
				<img src="{{asset('frontend/image')}}/logo.png" alt="logo-image">
			</a>
			<button class="navbar-toggler outline" type="button" data-toggle="collapse" data-target="#steel" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">☰</span>
			</button>
			<!-- Below line for Right side Logo -->
			<!-- <a class="navbar-brand" href="#">Navbar</a> -->
				<div class="collapse navbar-collapse justify-content-start" id="steel">
					<ul class="navbar-nav left-navlist">
						<li class="nav-item">
							<a class="nav-link" href="#">Find Jobs</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Company Reviews</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Find Salaries</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Find Resume</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto right-navlist">
						<li class="nav-item">
							<a class="nav-link" href="#">Sign in</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Employers/Post Job</a>
						</li>
					</ul>
				</div>
			</div><!---End/.container---->
		</nav>
	</header>









<!-- <nav class="navbar navbar-expand-md bg-light">
			<div class="container-fluid">
			<!- - Below line for Left side Logo -- >
			<a class="navbar-brand" href="#">
				<img src="{{asset('frontend/image')}}/logo.png" alt="logo-image">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#steel" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">☰</span>
			</button>
			<!- - Below line for Right side Logo - ->
			<! -- <a class="navbar-brand" href="#">Navbar</a> - ->
				<div class="collapse navbar-collapse justify-content-start" id="steel">
					<ul class="navbar-nav left-navlist">
						<li class="nav-item">
							<a class="nav-link" href="{{url('/job')}}">Find Jobs</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{url('/review')}}">Company Reviews</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{url('/salary')}}">Find Salaries</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{url('/resume')}}">Find Resume</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto right-navlist">
						<li class="nav-item">
							<a class="nav-link" href="{{url('employee/login')}}">Sign in</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{url('employee/register')}}">Employere/Post Job</a>
						</li>
					</ul>
				</div>
			</div><!- --End/.container--- ->
		</nav> -->