@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{(isset($user->user_image)) ? $user->user_image : url('/dist/img/avatar5.png') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name }}</h3>
                        <p class="text-muted text-center">{{ $user->Role->name }}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <strong><i class="fas fa-book mr-1"></i> Full Name</strong>

                        <p class="text-muted">{{ (isset($user->full_name)) ?  $user->full_name : ''}}</p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Preffered Name </strong>

                        <p class="text-muted">{{ (isset($user->preffered_name)) ?  $user->preffered_name : '' }}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Address </strong>

                        <p class="text-muted">{{ (isset($user->address)) ?  $user->address : '' }}</p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Mobile No </strong>

                        <p class="text-muted"> {{ (isset($user->mobile_no)) ?  $user->mobile_no : '' }} </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> land No </strong>

                        <p class="text-muted"> {{ (isset($user->land_no)) ?  $user->land_no : '' }} </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> NIC </strong>

                        <p class="text-muted"> {{ (isset($user->nic)) ?  $user->nic : '' }} </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Email </strong>

                        <p class="text-muted"> {{ (isset($user->email)) ?  $user->email : '' }} </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Birth Date </strong>

                        <p class="text-muted"> {{ (isset($user->birth_date)) ?  $user->birth_date : '' }} </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#attachements" data-toggle="tab">Attachments</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="attachements">

                                <strong><i class="fas fa-book mr-1"></i> NIC Front Image</strong><br>

                                <img src="{{ (isset($user->nic_front_image)) ?  $user->nic_front_image : '/dist/img/no-image.jpg'}}" alt="nic front image" width="50%" height="50%" />

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> NIC Back Image </strong><br>

                                <img src="{{ (isset($user->nic_back_image)) ?  $user->nic_back_image : '/dist/img/no-image.jpg'}}" alt="nic back image" width="50%" height="50%" />

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection