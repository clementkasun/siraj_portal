@section('sidebar')
<!-- Sidebar user (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ (isset(auth()->user()->user_image)) ? auth()->user()->user_image : '/dist/img/no-image.jpg' }}" class="img-circle elevation-2" alt="user_image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboards
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Main dashboard</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Vacancy
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('create-vacancy')
                <li class="nav-item">
                    <a href="{{ url('/vacancy_registration') }}" class="nav-link {{ Request::is('vacancy_registration') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Vacancy Registration</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-blog"></i>
                <p>
                    Blog Post Item
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('create-blog-post')
                <li class="nav-item">
                    <a href="{{ url('/blog_post_registration') }}" class="nav-link {{ Request::is('blog_post_registration') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Blog Post Registration</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Applicant
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('create-applicant')
                <li class="nav-item">
                    <a href="{{ url('/applicant_registration') }}" class="nav-link {{ Request::is('applicant_registration') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Applicant Registration</p>
                    </a>
                </li>
                @endcan
                @can('view-applicant')
                <li class="nav-item">
                    <a href="{{ url('/registered_applicants') }}" class="nav-link {{ Request::is('registered_applicants') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Registered Applicants</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Candidates
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('view-candidate')
                <li class="nav-item">
                    <a href="{{ url('/registered_candidates') }}" class="nav-link {{ Request::is('registered_candidates') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Registered Candidates</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-phone"></i>
                <p>
                    Contacts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('view-contact')
                <li class="nav-item">
                    <a href="{{ url('/registered_contacts') }}" class="nav-link {{ Request::is('registered_contacts') ? 'active' : '' }}">
                        <i class="fas fa-bookmark nav-icon"></i>
                        <p>Registered Contacts</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('create-user')
                <li class="nav-item">
                    <a href="/users_list" class="nav-link {{ Request::is('users_list') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Create User</p>
                    </a>
                </li>
                @endcan
                @can('create-role')
                <li class="nav-item">
                    <a href="/rolls" class="nav-link {{ Request::is('rolls') ? 'active' : '' }}">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Create Role</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

@endsection