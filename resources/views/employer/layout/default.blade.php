<!DOCTYPE html>
<html>
<head>
    @include('employer.includes.head_default')
</head>
<body class="theme-blue">
		
        @include('employer.includes.header_default')
        @include('employer.includes.sidebar_default')

    	
        @yield('content')
           
        @include('employer.includes.footer')
        
        
</body>
</html>