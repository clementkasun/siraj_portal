@section('sidebar')
<?php
use App\Models\OnlineApplicant;
use App\Models\Contact;
use App\Models\Candidate;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/dist/img/sirajmanpower-round-logo.png" alt="siraj manpower logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIRAJ - PORTAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (isset(auth()->user()->user_image)) ? auth()->user()->user_image : url('/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php
                $first_name = (isset(auth()->user()->first_name)) ? auth()->user()->first_name : '';
                $last_name = (isset(auth()->user()->last_name)) ? auth()->user()->last_name : '';
                ?>
                <a href="#" class="d-block">{{ $first_name .' '. $last_name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('./dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">APPLICANT MANAGEMENT</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Applicants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create-offline-applicant')
                        <li class="nav-item">
                            <a href="{{ url('/applicant_registration') }}" class="nav-link  {{ Request::is('applicant_registration') ? 'active' : '' }}">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>New Registration</p>
                            </a>
                        </li>
                        @endcan
                        @can('view-offline-applicant')
                        <li class="nav-item">
                            <a href="{{ url('/registered_applicants') }}" class="nav-link {{ Request::is('registered_applicants') ? 'active' : '' }}">
                                <i class="fas fa-file-alt  nav-icon"></i>
                                <p>All Registrations</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-header">CALL CENTER</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-mobile-alt"></i>
                        <p>
                            Mobile Numbers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    @can('create-phone-number')
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/phone_number_registration') }}" class="nav-link {{ Request::is('phone_number_registration') ? 'active' : '' }}">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Insert Mobile Numbers</p>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </li>
                <li class="nav-header">USER MANAGEMENT</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create-user')
                        <li class="nav-item">
                            <a href="/users_list" class="nav-link {{ Request::is('users_list') ? 'active' : '' }}">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @can('create-blog-post')
                <li class="nav-header">FRONT WEBSITE</li>
                <li class="nav-item">
                    <a href="{{ url('/blog_post_registration') }}" class="nav-link {{ Request::is('blog_post_registration') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>Blog Post</p>
                    </a>
                </li>
                @endcan
                @can('create-vacancy')
                <li class="nav-item">
                    <a href="{{ url('/vacancy_registration') }}" class="nav-link {{ Request::is('vacancy_registration') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>Vacancy</p>
                    </a>
                </li>
                @endcan
                @can('view-online-applicant')
                <li class="nav-item">
                    <a href="{{ url('/registered_online_applicants') }}" class="nav-link {{ url('/registered_online_applicants') }}">
                        <i class="nav-icon fas fa-portrait"></i>
                        <p>Online Applicants</p> <span class="badge badge-info right">{{OnlineApplicant::all()->count()}}</span>
                    </a>
                </li>
                @endcan
                @can('view-contact-us')
                <li class="nav-item">
                    <a href="{{ url('/registered_contacts') }}" class="nav-link {{ Request::is('registered_contacts') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Contacts</p> <span class="badge badge-info right"> {{ Contact::all()->count() }}</span>
                    </a>
                </li>
                @endcan
                <li class="nav-header">SETTINGS</li>
                @can('view-user')
                <li class="nav-item">
                    <a href="{{ url('/user_profile') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@endsection