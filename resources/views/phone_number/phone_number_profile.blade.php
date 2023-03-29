@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
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
                            <li class="nav-item"><a class="nav-link active" href="#phone_resp_history" data-toggle="tab">Phone Number Responses</a></li>
                            <li class="nav-item"><a class="nav-link" href="#status_change" data-toggle="tab">Status Change</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="phone_resp_history">
                                <table class="table table-striped" id="phone_number_response_tbl">
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
                            <div class="tab-pane" id="status_change">
                                @can('update-phone-number')
                                <form id="status_change_form">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-4">
                                            <label>Phone Number Status</label>
                                            <select class="custom-select" id="phone_number_status">
                                                <option value=""> Select the status of the phone number </option>
                                                <option value="New"> New </option>
                                                <option value="Ongoing"> Ongoing </option>
                                                <option value="Complete"> Complete </option>
                                            </select>
                                            <button type="button" class="btn btn-warning mt-2" id="phone_status_change" data-id="{{ $phone_number_details->id }}">Update</button>
                                        </div>
                                        <?php $status_color_arr = ['New' => 'badge-primary', 'Ongoing' => 'badge-warning', 'Complete' => 'badge-success']; ?>
                                        <div class="col-12 col-md-4 text-center">
                                            <label for="current_status">Current Status</label></br>
                                            <span id="current_status" class="badge {{ $status_color_arr[$phone_number_details->status] }} text-center" style="width: 100px; height: 40px; padding-top: 12px">{{ $phone_number_details->status }}</span>
                                        </div>
                                    </div>
                                </form>
                                @endcan
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
    // $('#phone_number_response_tbl').DataTable({
    //     "pageLength": 10,
    //     "destroy": true,
    //     "retrieve": true
    // });

    let PHONE_NUMBER_STATUS = '{{ $phone_number_details->status }}';

    $('#phone_number_status').val(PHONE_NUMBER_STATUS);

    $('#phone_status_change').click(function() {
        let phone_number_id = $(this).attr('data-id');
        change_phone_num_status(phone_number_id);
    });

    change_phone_num_status = (phone_number_id) => {
        let data = {
            'status': $('#phone_number_status').val()
        };
        ulploadFileWithData('/api/change_phone_num_status/id/' + phone_number_id, data, function(result) {
            if (result.status) {
                toastr.success('Phone number satus change is successful!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                toastr.error('Phone number satus change is unsuccessful!')
            }
        });
    }

    $('a[data-toggle="tab"]').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('selectedTab', id)
    });

    var selectedTab = localStorage.getItem('selectedTab');
    if (selectedTab != null) {
        $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
    }
</script>
@endsection