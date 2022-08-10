<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2016 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getlocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $setting->translate(app()->getlocale())->describtion }}">
    <meta name="keyword" content="{{ $setting->translate(app()->getlocale())->title }}">
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}">
    <!--<link rel="shortcut icon" href="assets/ico/favicon.png">-->
    <title>{{ $setting->translate(app()->getlocale())->title }} | @yield('title')</title>
    <!-- Icons -->
    <link href="{{ asset('dashboard/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('dashboard/css/' . getFloder() . '.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dashboard/datatables/datatable.bootstrab4.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/datatables/responsive.bootstrap4.min.css') }}">

    @yield('style')
</head>
<!-- BODY options, add following classes to body to change options
         1. 'compact-nav'     	  - Switch sidebar to minified version (width 50px)
         2. 'sidebar-nav'		  - Navigation on the left
             2.1. 'sidebar-off-canvas'	- Off-Canvas
                 2.1.1 'sidebar-off-canvas-push'	- Off-Canvas which move content
                 2.1.2 'sidebar-off-canvas-with-shadow'	- Add shadow to body elements
         3. 'fixed-nav'			  - Fixed navigation
         4. 'navbar-fixed'		  - Fixed navbar
     -->

<body class="navbar-fixed sidebar-nav fixed-nav">

    @include('dashboard.includes.header')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('dashboard.includes.sidebar')

    @yield('content')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('dashboard.includes.footer')

    @notify_js
    @notify_render



    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/pace.min.js') }}"></script>

    <!-- Plugins and scripts required by all views -->
    <script src="{{ asset('dashboard/js/libs/Chart.min.js') }}"></script>


    <script src="{{ asset('dashboard/js/libs/ckeditor.js') }}"></script>
    <!-- CoreUI main scripts -->

    <script src="{{ asset('dashboard/js/app.js') }}"></script>
    <script src="{{ asset('dashboard/js/img-script.js') }}"></script>

    <!-- Plugins and scripts required by this views -->
    <!-- Grunt watch plugin -->
    <script src="//localhost:35729/livereload.js"></script>
    <script src="{{ asset('dashboard/datatables/jquery.datatables.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/datatables.bootstrab4.js') }}"></script>
    <script type="text/javascript" language="javascript"
        src="{{ asset('dashboard/datatables/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" language="javascript"
        src="{{ asset('dashboard/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script>
        //      $(document).ready( function () {
        //     $('#myTable').DataTable();
        // } );
        var allEditors = document.querySelectorAll('#editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


    @stack('javascripts')
</body>

</html>
