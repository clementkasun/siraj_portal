@section('navbar')
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Welcome to the PORTAL of SIRAJ MANPOWER SERVICES </a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    @php
    $notifications = App\Models\Notification::getSummary(auth()->user()->id);
    @endphp
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="far fa-bell"></i>
            @if ($notifications['count'] > 0)
            <span class="badge badge-success text-white navbar-badge">{{ $notifications['count'] }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            @if ($notifications['count'] > 0)
            <span class="dropdown-item dropdown-header">{{ $notifications['count'] }} Notifications</span>
            <div class="dropdown-divider"></div>
            @endif
            @forelse ($notifications['notifications'] as $notification)
            <a href="#" class="dropdown-item" style="white-space: normal;">
                <i class="fas fa-envelope mr-2"></i>
                {{ $notification->data['msg'] }}
                <span class="text-muted text-sm d-block">{{ $notification->created_at->diffForHumans() }}
                </span>
            </a>
            <div class="dropdown-divider"></div>
            @empty
            <span class="dropdown-item dropdown-header">No Notifications</span>
            @endforelse
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Settings</span>
            <div class="dropdown-divider"></div>
            <a href="{{ url('/user_profile') }}" class=" dropdown-item">
                <i class="fas fa-address-card mr-2"></i>My Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ url('/logout_user') }}" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i> Sign Out
            </a>
        </div>
    </li>
</ul>

<!-- /.navbar -->
@endsection