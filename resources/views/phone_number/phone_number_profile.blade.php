@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
@extends('layouts.footer')
@section('content')
<!-- Content Header (Page header) -->
<!-- datatables -->
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- end datatables -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Phone Number Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Phone Number Profile</li>
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
                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body mt-2">
                        <strong><i class="fas fa-book mr-1"></i> Phone Number </strong>
                        <p class="text-muted">
                            {{ $phone_number_details->phone_number }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-user mr-1"></i> Name </strong>
                        <p class="text-muted"> {{ $phone_number_details->phone_number }} </p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Created user </strong>
                        <p class="text-muted"> {{ (isset($phone_number_details->AddedBy)) ?  $phone_number_details->AddedBy->first_name.' '.$phone_number_details->AddedBy->last_name : '' }} </p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Assigned user </strong>
                        <p class="text-muted"> {{ (isset($phone_number_details->AssignedTo)) ? $phone_number_details->AssignedTo->first_name.' '.$phone_number_details->AssignedTo->last_name : '' }} </p>
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
                            <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="timeline">
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <th>#</th>
                                        <th>Response</th>
                                        <th>User</th>
                                        <th>Designation</th>
                                        <th>Created at</th>
                                    </thead>
                                    <tbody>
                                        @forelse($phone_number_details->PhoneNumberResponse as $key => $phone_number_response)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $phone_number_response->response }}</td>
                                            <td>{{ $phone_number_response->User->first_name.' '.$phone_number_response->User->last_name }}</td>
                                            <td>{{ $phone_number_response->Designation->name }}</td>
                                            <td>{{ $phone_number_response->created_at }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-bold"><b>No Data</b></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
@section('pageScripts')
<!-- start datatables -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- <script>
    $('#applicant_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script> -->
<!-- DataTables  & Plugins -->
<script src="https://portal.sirajmanpower.lk/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/jszip/jszip.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/pdfmake/pdfmake.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/pdfmake/vfs_fonts.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- end datatables -->
<!-- 
<script>
    $('#phone_number_response_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script> -->
@endsection