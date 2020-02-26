<!DOCTYPE html>
<html>
<head>
    @include('employee.includes.head')
</head>
<body class="theme-blue">
        @include('employee.includes.header')
        @yield('content')
        @include('employee.includes.footer')
</body>
</html>