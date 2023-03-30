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
                            <td style="width: 8em; font-weight: bold">{{ '#'.$applicant->reff_no }}</td>
                            <td>
                                <img src="{{ (isset($applicant->applicant_image_passport )) ? $applicant->applicant_image_passport : url('/dist/img/avatar5.png') }}" alt="applicant image" class="image-responsive" style="width: 100px; height: 100px" />
                            </td>
                            <td style="width: 15em">{{ $applicant->full_name }}</td>
                            <td>{{ $applicant->phone_no_01 }}</td>
                            <td>{{ $applicant->nic }}</td>
                            <td>{{ $applicant->passport_no }}</td>
                            <?php $status_style = (isset($applicant->post_status)) ? $post_status_array[$applicant->post_status]['color'] : '' ?>
                            <td><span class="btn btn-sm rounded text-dark" style="<?php echo 'background-color:' . $status_style ?>"><b>{{ (isset($applicant->post_status)) ? $post_status_array[$applicant->post_status]['name'] : '' }}</b></span></td>
                            <td>{{ Carbon::parse($applicant->created_at) }}</td>
                            <td>
                                <a href="/applicant_profile/id/{{ $applicant->id }}" class="btn btn-success btn-sm">Profile</a>
                                @can('update-offline-applicant')
                                <a href="/edit_applicant/id/{{ $applicant->id }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                <a href="/view_application/id/{{ $applicant->id }}" class="btn btn-primary btn-sm">View Application</a>
                                <!-- <button type="button" class="btn btn-danger del" data-id="">Delete</button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-bold"><span>No Data</span></td>
                        </tr>
                        @endforelse
                    </tbody>
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
</script>
@endsection