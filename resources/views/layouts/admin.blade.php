<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- API Token -->
    <meta name="api-token" content="{{ (auth()->user() != null) ? auth()->user()->createToken('auth-token')->plainTextToken : '' }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            @yield('navbar')
        </nav>
        <!-- Navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevaprimarytion-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ (isset(auth()->user()->user_image)) ? auth()->user()->user_image : '/dist/img/no-image.jpg' }}" alt="user_image" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> Agency Management System </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                @yield('sidebar')
                <!-- /.sidebar -->
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @yield('footer')
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @yield('scripts')
    @yield('pageScripts')
</body>

</html>