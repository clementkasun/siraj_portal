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
        @can('create-vacancy')
        <div class="card card-primary">
            <div class="card-header">
                <h5>Create New Vacancy</h5>
            </div>
            <div class="card-body">
                <form id="vacancy_form">
                    <div class="row">
                        <div class="form-group col-md-3 col-12">
                            <label for="title">Title <span style="color: red;">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Please enter the vacancy title" required>
                        </div>
                        <div class="form-group col-md-2 col-12">
                            <label for="salary">Salary <span style="color: red;">*</span></label>
                            <input type="text" id="salary" name="salary" class="form-control" placeholder="Please enter the salary" required>
                        </div>
                        <div class="form-group col-md-2 col-12">
                            <label for="period">Period <span style="color: red;">*</span></label>
                            <input type="text" id="period" name="period" class="form-control" placeholder="Please enter the period" required>
                        </div>
                        <div class="form-group col-md-2 col-12">
                            <label for="location">Country <span style="color: red;">*</span></label>
                            <select class="form-select form-control" aria-label="Select the country" id="location" name="location">
                                <option selected value="">Choose Country</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="India">India</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Thailand">Thailand</option>
                                <option value="China">China</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Egypt">Egypt</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Oman">Oman</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Syria">Syria</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Quatar">Qutar</option>
                                <option value="Lebonon">Lebanon</option>
                                <option value="Turkey">Turkey</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="Baharen">Baharain</option>
                                <option value="Iran">Iran</option>
                                <option value="Syria">Syria</option>
                                <option value="Afghanisthan">Afghnisthan</option>
                                <option value="Israel">Israel</option>
                                <option value="Pakisthan">Pakisthan</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Russia">Russia</option>
                                <option value="USA">USA</option>
                                <option value="Spain">Spain</option>
                                <option value="France">France</option>
                                <option value="Germany">Germaney</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="Poland">Poland</option>
                                <option value="Italy">Italy</option>
                                <option value="UK">UK</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Panama">Panama</option>
                                <option value="Cuba">Cuba</option>
                                <option value="West Indies">West Indies</option>
                                <option value="Austrailia">Austrailia</option>
                                <option value="New zealand">New Zealand</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-12">
                            <label for="vacancy_image">Vacancy Image <span style="color: red;">*</span><code style="font-size:11px;color: red;">(850 pixel x 540 pixel)</code></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="vacancy_image" name="vacancy_image" class="form-control" accept=".jpeg, .jpg, .png">
                                    <label class="custom-file-label" for="vacancy_image">Vacancy Image </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row float-right">
                        <button type="button" class="btn btn-success pl-3 pr-3 m-2" id="save_vacancy"><i class="fas fa-save"></i> Save</button>
                        @can('update-vacancy')
                        <button type="button" class="btn btn-warning pl-5 pr-5 m-1 d-none" id="update_vacancy">Update</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
        @endcan
        @can('view-vacancy')
        <div class="card card-success">
            <div class="card-header">
                <h5>All Vacancies</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="vacancy_tbl">
                    <thead>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Salary</th>
                        <th>Period</th>
                        <th>Location</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($vacancies as $key => $vacancy)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><img src="{{ (isset($vacancy->vacancy_image)) ? $vacancy->vacancy_image : './dist/img/no-image.jpg' }}" alt="vacancy image" style="width: 100px; height: 100px" /></td>
                            <td style="width: 15em"> {{ $vacancy->title }} </td>
                            <td style="width: 15em"> {{ $vacancy->salary }} </td>
                            <td style="width: 15em"> {{ $vacancy->period }} </td>
                            <td style="width: 15em"> {{ $vacancy->location }}</td>
                            <td>
                                @can('update-vacancy')
                                <button type="button" class="btn btn-primary btn-sm edit m-1" data-id="{{$vacancy->id}}"> Edit </button>
                                @endcan
                                @can('delete-vacancy')
                                <button type="button" class="btn btn-danger btn-sm delete m-1" data-id="{{$vacancy->id}}"> Delete </button>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Salary</th>
                        <th>Period</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tfoot>
                </table>
            </div>
        </div>
        @endcan
    </div>
</section>
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
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/vacancy.js')}}"></script>
<script src="{{ asset('plugins/checkImageSize/jquery.checkImageSize.min.js') }}"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    $('#vacancy_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });

    $("#vacancy_image").checkImageSize({
        minWidth: 850,
        minHeight: 540,
        maxWidth: 850,
        maxHeight: 540,
        showError: true,
        ignoreError: false
    });
</script>
@endsection