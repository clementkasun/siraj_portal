@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        @can('create-vacancy')
        <div class="card card-primary">
            <div class="card-header">
                <h2>Vacancy Registration</h2>
            </div>
            <div class="card-body">
                <form id="vacancy_form">
                    <div class="row">
                        <div class="form-group col-md-3 col-12">
                            <label for="title">Title *</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Please enter the vacancy title" required>
                        </div>
                        <div class="form-group col-md-2 col-12">
                            <label for="salary">Salary *</label>
                            <input type="text" id="salary" name="salary" class="form-control" placeholder="Please enter the salary" required>
                        </div>
                        <div class="form-group col-md-2 col-12">
                            <label for="period">Period *</label>
                            <input type="text" id="period" name="period" class="form-control" placeholder="Please enter the period" required>
                        </div>
                        <div class="form-group col-md-2 col-12">
                            <label for="location">Country *</label>
                            <select class="form-select form-control" aria-label="Select the country" id="location" name="location">
                                <option selected value="">Choose Country</option>
                                <option value="srilanka">Sri Lanka</option>
                                <option value="india">India</option>
                                <option value="bangladesh">Bangladesh</option>
                                <option value="maldives">Maldives</option>
                                <option value="singapore">Singapore</option>
                                <option value="malaysia">Malaysia</option>
                                <option value="thailand">Thailand</option>
                                <option value="china">China</option>
                                <option value="kuwait">Kuwait</option>
                                <option value="quatar">Quatar</option>
                                <option value="lebonon">Lebanon</option>
                                <option value="turkey">Turkey</option>
                                <option value="uae">UAE</option>
                                <option value="dubai">Dubai</option>
                                <option value="baharen">Baharen</option>
                                <option value="iran">Iran</option>
                                <option value="syria">Syria</option>
                                <option value="afghanisthan">Afghnisthan</option>
                                <option value="ishrael">Ishrael</option>
                                <option value="pakisthan">Pakisthan</option>
                                <option value="nepal">Nepal</option>
                                <option value="russia">Russia</option>
                                <option value="usa">USA</option>
                                <option value="spain">Spain</option>
                                <option value="france">France</option>
                                <option value="germany">Germaney</option>
                                <option value="ukraine">Ukraine</option>
                                <option value="poland">Poland</option>
                                <option value="italy">Italy</option>
                                <option value="uk">UK</option>
                                <option value="brazil">Brazil</option>
                                <option value="panama">Panama</option>
                                <option value="cuba">Cuba</option>
                                <option value="westindies">West Indies</option>
                                <option value="Austrailia">Austrailia</option>
                                <option value="Newzealand">New Zealand</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-12">
                            <label for="vacancy_image">Vacancy Image * <code> ( 850 pixel x 540 pixel ) </code> </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="vacancy_image" name="vacancy_image" class="form-control" accept=".jpeg, .jpg, .png">
                                    <label class="custom-file-label" for="vacancy_image">Applicant Image </label>
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
        @endcan
        @can('view-vacancy')
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
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endcan
    </div>
</section>
@endsection

@section('pageScripts')
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/vacancy.js')}}"></script>
<script src="{{ asset('plugins/checkImageSize/jquery.checkImageSize.min.js') }}"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
        load_vacancy_table();
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