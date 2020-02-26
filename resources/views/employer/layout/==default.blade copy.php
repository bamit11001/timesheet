<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name', 'Admin Lite') }}</title>


    <!-- jQuery 3 --> 
    <!-- <script src="{{ url('/public') }}/js/jquery.min.js"></script> -->
    <!-- Bootstrap 3.3.7 -->
    <!-- <script src="{{ url('/public') }}/js/bootstrap.min.js"></script> -->
    <!-- iCheck -->
    <script src="{{ url('/public') }}/js/icheck.min.js"></script>
</head>

<body class="hold-transition login-page hold-transition skin-blue sidebar-mini hold-transition register-page">
<div class="wrapper" style="height: auto; min-height: 100%;">
   @include('employer.includes.header')
    @include('employer.includes.head')
   @include('employer.includes..sidebar')
   @yield('content')

   @include('employer.includes.footer')

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</div>
</body>
</html>

