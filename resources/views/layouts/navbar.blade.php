@section('navbar')
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo url('/dashboard'); ?>" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- SEARCH FORM Below Disabled! -->


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-cog"></i>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Settings</span>
                <div class="dropdown-divider"></div>
                <a href="/user/profile" class=" dropdown-item">
                    <i class="fas fa-address-card mr-2"></i>My Profile

                </a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item">
                    <i class="fas fa-power-off mr-2"></i> Sign Out

                </a>


            </div>
        </li>
    </ul>

    <!-- /.navbar -->
@endsection
