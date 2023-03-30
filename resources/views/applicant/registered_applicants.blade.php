@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')
<!-- start link from staff livish -->
<link rel="stylesheet" href="https://staff.livish.lk/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://staff.livish.lk/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://staff.livish.lk/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('content')
<?php

use Illuminate\Support\Carbon; ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Registered Applicants</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped display responsive nowrap" id="applicant_tbl" style="width:100%">
                    <thead>
                        <th style="font-size: 14px;">#</th>
                        <th style="font-size: 14px;">Reff. No</th>
                        <th style="font-size: 14px;">User Image</th>
                        <th style="font-size: 14px;">Full Name</th>
                        <th style="font-size: 14px;">Tel No 1</th>
                        <th style="font-size: 14px;">NIC</th>
                        <th style="font-size: 14px;">Passport No</th>
                        <th style="font-size: 14px;">Status</th>
                        <th style="font-size: 14px;">Created at</th>
                        <th style="font-size: 14px;">Action</th>
                    </thead>
                    <tbody>
                        @forelse($applicants as $key => $applicant)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ '#'.$applicant->reff_no }}</td>
                            <td>
                                <img src="{{ (isset($applicant->applicant_image_passport )) ? $applicant->applicant_image_passport : url('/dist/img/avatar5.png') }}" alt="applicant image" class="image-responsive" style="width: 70px; height: 70px" />
                            </td>
                            <td>{{ $applicant->full_name }}</td>
                            <td>{{ $applicant->phone_no_01 }}</td>
                            <td>{{ $applicant->nic }}</td>
                            <td>{{ $applicant->passport_no }}</td>
                            <?php $status_style = (isset($applicant->post_status)) ? $post_status_array[$applicant->post_status]['color'] : '' ?>
                            <td><span class="badge rounded-pill" style="<?php echo 'background-color:' . $status_style ?>"><b>{{ (isset($applicant->post_status)) ? $post_status_array[$applicant->post_status]['name'] : '' }}</b></span></td>
                            <td>{{ Carbon::parse($applicant->created_at) }}</td>
                            <td>    
                                    <div style="padding-top: 2px;"><a href="/applicant_profile/id/{{ $applicant->id }}" class="btn btn-success btn-sm"><i class="fas fa-user-alt"></i> Profile</a></div>
                                @can('update-offline-applicant')
                                    <div style="padding-top: 2px;">
                                        <a href="/edit_applicant/id/{{ $applicant->id }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a> 
                                    </div>
                                @endcan
                                    <div style="padding-top: 2px;">
                                        <a href="/view_application/id/{{ $applicant->id }}" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Print</a>
                                    </div>
                                    
                                <!-- <button type="button" class="btn btn-danger del" data-id="">Delete</button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-bold"><span>No Data</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <th>#</th>
                        <th style="font-size: 14px;">Reff. No</th>
                        <th>Profile</th>
                        <th style="font-size: 14px;">Full Name</th>
                        <th style="font-size: 14px;">Phone No</th>
                        <th style="font-size: 14px;">NIC</th>
                        <th style="font-size: 14px;">Passport No</th>
                        <th style="font-size: 14px;">Status</th>
                        <th style="font-size: 14px;">Created at</th>
                        <th style="font-size: 14px;">Action</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pageScripts')
<script src="https://staff.livish.lk/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="https://staff.livish.lk/plugins/jszip/jszip.min.js"></script>
<script src="https://staff.livish.lk/plugins/pdfmake/pdfmake.min.js"></script>
<script src="https://staff.livish.lk/plugins/pdfmake/vfs_fonts.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="https://staff.livish.lk/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script>
    // $('#applicant_tbl').DataTable({
    //     "responsive": true,
    //     "lengthChange": false,
    //     "autoWidth": false,
    //     "buttons": ["copy", "csv", "excel", "pdf", "print"]
    // })

    $(function() {
        $("#applicant_tbl").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons()
            .container()
            .appendTo('#applicant_tbl_wrapper .col-md-6:eq(0)');
    });
</script> -->
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- end datatables -->
@endsection