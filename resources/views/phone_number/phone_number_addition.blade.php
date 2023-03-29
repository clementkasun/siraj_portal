@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
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
                    <div class="col-md-12">
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
                    <div class="col-12 col-md-12">
                        <table class="table table-striped" id="phone_number_tbl">
                            <thead>
                                <th>#</th>
                                <th>Phone Number</th>
                                <th>Name</th>
                                <th>Insert By</th>
                                <th>Assigned To</th>
                                <th>Response</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                                </tr>
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
    $(document).ready(function() {
        let privillages = {
            'is_read' : '{{ Gate::allows("view-phone-number") }}',
            'is_update' : '{{ Gate::allows("update-phone-number") }}',
            'is_delete' : '{{ Gate::allows("delete-phone-number") }}'
        };
        load_phone_number_tbl(privillages);
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