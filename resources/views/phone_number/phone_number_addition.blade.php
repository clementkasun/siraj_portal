@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<!-- datatables -->
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- end datatables -->
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h5>Insert New Phone Number</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('create-phone-number')
                    <div class="{{ (Gate::denies('view-phone-number')) ? 'col-12' : 'col-12 col-md-3' }}">
                        <form id="phone_number_form">
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="phone_number">Phone Number <span style="color:red;">*</span></label>
                                <div><input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Please enter the phone number" required></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="name">Name</label>
                                <div><input type="text" class="form-control" name="name" id="name" placeholder="Please enter the name"></div>
                            </div><br>
                            <div class="row">
                            <div class="form-group col-1">
                                <button id="save_phone_number" type="button" class="btn btn-success pl-5 pr-5 m-2">Save</button>
                                <button id="update_phone_number" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <h5>All Phone Numbers</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('view-phone-number')
                    <div class="{{ (Gate::denies('create-phone-number')) ? 'col-12' : 'col-12 col-md-9' }}">
                        <table class="table table-striped" id="phone_number_tbl">
                            <thead>
                                <th>#</th>
                                <th>Phone Number</th>
                                <th>Name</th>
                                <th>Insert By</th>
                                <th>Assigned To</th>
                                <th>Response</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $status_color_arr = ['New' => 'badge-primary', 'Ongoing' => 'badge-warning', 'Complete' => 'badge-success']; ?>
                                @forelse($phone_number_data as $key=> $phone_number)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td style="width: 8em">{{ $phone_number->phone_number }}</td>
                                    <td>{{ (isset($phone_number->name)) ? $phone_number->name : '' }}</td>
                                    <td>{{ (isset($phone_number->AddedBy)) ? ($phone_number->AddedBy->preffered_name != null) ? $phone_number->AddedBy->preffered_name : '' : '' }}</td>
                                    <td>{{ (isset($phone_number->AssignedTo)) ? ($phone_number->AssignedTo->preffered_name != null) ? $phone_number->AssignedTo->preffered_name : '' : '' }}</td>
                                    <td>{{ (isset($phone_number->PhoneNumberResponse)) ? (isset($phone_number->PhoneNumberResponse[0])) ? $phone_number->PhoneNumberResponse[0]->response : '' : '' }}</td>
                                    <td><span class="badge badge-sm {{$status_color_arr[$phone_number->status]}} text-center" style="width: 100px; height: 30px; padding-top: 10px">{{ $phone_number->status }}</span></td>
                                    <td>
                                        @can('update-phone-number')
                                        <button type="button" class="btn btn-primary btn-sm edit" data-id="{{ $phone_number->id }}"> Edit </button>
                                        @endcan
                                        @can('create-phone-number-resp')
                                        <a href="/phone_number_response/id/{{ $phone_number->id }}" class="btn btn-secondary btn-sm">Response</a>
                                        @endcan
                                        @can('delete-phone-number')
                                        <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $phone_number->id }}"> Delete </button>
                                        @endcan
                                        @can('view-phone-number')
                                        <a href="/phone_number_profile/id/{{ $phone_number->id }}" class="btn btn-success btn-sm">Profile</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-bold"><span>No Data</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <th>#</th>
                                <th>Phone Number</th>
                                <th>Name</th>
                                <th>Insert By</th>
                                <th>Assigned To</th>
                                <th>Response</th>
                                <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pageScripts')
<script src="{{asset('js/phone_number.js')}}"></script>
<script>
    $('#phone_number_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
<!-- start datatables -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
@endsection