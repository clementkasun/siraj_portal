@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Vacancy Registration</h2>
            </div>
            <div class="card-body">
                <form id="vacancy_form">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="title">Title *</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Please enter the vacancy title" required>
                        </div>
                        <div class="form-group col-2">
                            <label for="salary">Salary *</label>
                            <input type="text" id="salary" name="salary" class="form-control" placeholder="Please enter the salary" required>
                        </div>
                        <div class="form-group col-2">
                            <label for="period">Period *</label>
                            <input type="text" id="period" name="period" class="form-control" placeholder="Please enter the period" required>
                        </div>
                        <div class="form-group col-2">
                            <label for="location">Location *</label>
                            <input type="text" id="location" name="location" class="form-control" placeholder="Please enter the location" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="vacancy_image">Vacancy Image *</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="vacancy_image" name="vacancy_image" class="form-control" accept=".jpeg, .jpg, .png" required>
                                    <label class="custom-file-label" for="vacancy_image">Applicant Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row float-right">
                        <button type="button" class="btn btn-success btn-lg pl-5 pr-5 m-1" id="save_vacancy">Save</button>
                        <button type="button" class="btn btn-warning btn-lg pl-5 pr-5 m-1 d-none" id="update_vacancy">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-success">
            <div class="card-header">
                <h2>Vacancies</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="vacancy_tbl">
                    <thead>
                        <th>#</th>
                        <th>image</th>
                        <th>title</th>
                        <th>salary</th>
                        <th>period</th>
                        <th>location</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pageScripts')
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/vacancy.js')}}"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        load_vacancy_table();
    });
</script>
@endsection