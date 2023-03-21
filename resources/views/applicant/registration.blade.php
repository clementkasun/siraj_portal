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
                <h2>Applicant Registration</h2>
            </div>
            <div class="card-body">
                <form id="applicant_form">
                    <div class="row">
                        <div class="form-group col-md-4 col-12">
                            <label for="full_name">Full Name </label>
                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Please enter the full name" maxlength="255" value="{{ (isset($applicant_data->full_name)) ? $applicant_data->full_name : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Please enter the address" maxlength="255" value="{{ (isset($applicant_data->address)) ? $applicant_data->address : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="phone_no_one">Phone Number 01</label>
                            <input type="text" id="phone_no_one" name="phone_no_one" class="form-control" maxlength="10" placeholder="Please enter the phone number one" value="{{ (isset($applicant_data->address)) ? $applicant_data->phone_no_01 : ''}}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="phone_no_two">Phone Number 02</label>
                            <input type="text" id="phone_no_two" name="phone_no_two" class="form-control" maxlength="10" placeholder="Please enter the phone number two" value="{{ (isset($applicant_data->address)) ? $applicant_data->phone_no_02 : ''}}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="nic">NIC</label>
                            <input type="text" id="nic" name="nic" class="form-control" maxlength="20" placeholder="Please enter the nic" maxlength="20" value="{{ (isset($applicant_data->nic)) ? $applicant_data->nic : ''}}" required>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="passport_number">Passport No</label>
                            <input type="text" id="passport_number" name="passport_number" class="form-control" placeholder="Please enter the passport number" maxlength="100" value="{{ (isset($applicant_data->passport_no)) ? $applicant_data->passport_no : ''}}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="passport_issue_date">Passport Issue Date</label>
                            <input type="date" id="passport_issue_date" name="passport_issue_date" class="form-control" value="{{ (isset($applicant_data->passport_issue_date)) ? $applicant_data->passport_issue_date : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="passport_exp_date">Passport Expire Date</label>
                            <input type="date" id="passport_exp_date" name="passport_exp_date" class="form-control" value="{{ (isset($applicant_data->passport_exp_date)) ? $applicant_data->passport_exp_date : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ (isset($applicant_data->birth_date)) ? $applicant_data->birth_date : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="sex">Gender</label>
                            <select id="sex" name="sex" class="custom-select">
                                <option value="">Select the gender</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="complexion">Complexion</label>
                            <input type="text" id="complexion" name="complexion" class="form-control" placeholder="Please enter the complexion of applicant" maxlength="5" value="{{( isset($applicant_data->complexion)) ? $applicant_data->complexion : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="weight">Weight</label>
                            <input type="text" id="weight" name="weight" class="form-control" placeholder="Please enter the weight of applicant" maxlength="5" value="{{( isset($applicant_data->weight)) ? $applicant_data->weight : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="nationality">Nationality</label>
                            <input type="text" id="nationality" name="nationality" class="form-control" placeholder="Please enter the nationality of applicant" value="{{( isset($applicant_data->nationality)) ? $applicant_data->nationality : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="religion">Religion</label>
                            <input type="text" id="religion" name="religion" class="form-control" placeholder="Please enter the religion of applicant" value="{{( isset($applicant_data->religion)) ? $applicant_data->religion : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="maritial_status">Maritial Status </label>
                            <select id="maritial_status" name="maritial_status" class="custom-select">
                                <option value="married">Married</option>
                                <option value="unmarried">Unmarried</option>
                                <option value="devorced">Devorced</option>
                                <option value="widow">Widow</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="number_of_children">No Of Children</label>
                            <input type="text" id="number_of_children" name="number_of_children" class="form-control" placeholder="Please enter the number of childrens" value="{{( isset($applicant_data->number_of_children)) ? $applicant_data->number_of_children : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applied_post">Applied Post</label>
                            <input type="text" id="applied_post" name="applied_post" class="form-control" placeholder="Please enter the applied post" value="{{( isset($applicant_data->applied_post)) ? $applicant_data->applied_post : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applied_country">Country</label>
                            <input type="text" id="applied_country" name="applied_country" class="form-control" placeholder="Please enter the applied country" value="{{( isset($applicant_data->applied_country)) ? $applicant_data->applied_country : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="post_status">Status</label>
                            <select class="custom-select" id="post_status" name="post_status">
                                <option value="">Select the post status</option>
                                <option value="0">Pending</option>
                                <option value="1">Working</option>
                                <option value="2">Leaved</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="commision_price">Commission Price</label>
                            <input type="text" id="commision_price" name="commision_price" class="form-control" placeholder="Please enter the commission price" value="{{( isset($applicant_data->commision_price)) ? $applicant_data->commision_price : '' }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col-md-4 col-12">
                            <label for="passport_pdf">Passport PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="passport_pdf" name="passport_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="passport_pdf">Passport PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="nic_pdf">NIC PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="nic_pdf" name="nic_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="nic_pdf">NIC PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="police_record_pdf">Police Record PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="police_record_pdf" name="police_record_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="police_record_pdf">Police Record PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="gs_certificate_pdf">GS Certificate PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="gs_certificate_pdf" name="gs_certificate_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="gs_certificate_pdf">GS Certificate PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="family_back_pdf">Family Background PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="family_back_pdf" name="family_back_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="family_back_pdf">Family Background PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="visa_pdf">Visa PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="visa_pdf" name="visa_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="visa_pdf">Visa PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="medical_pdf">Medical PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="medical_pdf" name="medical_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="medical_pdf">Medical PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="aggreement_pdf">Aggreement PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="aggreement_pdf" name="aggreement_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="aggreement_pdf">Aggreement PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="personal_form_pdf">Personal Form PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="personal_form_pdf" name="personal_form_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="personal_form_pdf">Personal Form PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="job_order_pdf">Job Order PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="job_order_pdf" name="job_order_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="job_order_pdf">Job Order PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="ticket_pdf">Ticket PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="ticket_pdf" name="ticket_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="ticket_pdf">Ticket PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="agency_aggrement_pdf">Agency Aggreement PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="agency_aggrement_pdf" name="agency_aggrement_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="agency_aggrement_pdf">Agency Aggreement PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applicant_image">Applicant Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="applicant_image" name="applicant_image" class="form-control image" accept=".jpeg, .jpg, .png">
                                    <label class="custom-file-label" for="applicant_image">Applicant Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <label>Experience </label>
        <div class="row p-2">
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="decorating">
                <label class="form-check-label" for="decorating">
                    Decorating
                </label>
            </div>
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="baby_sitting">
                <label class="form-check-label" for="baby_sitting">
                    Baby Sitting
                </label>
            </div>
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="cleaning">
                <label class="form-check-label" for="cleaning">
                    Cleaning
                </label>
            </div>
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="cooking">
                <label class="form-check-label" for="cooking">
                    Cooking
                </label>
            </div>
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="washing">
                <label class="form-check-label" for="washing">
                    Washing
                </label>
            </div>
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="sewing">
                <label class="form-check-label" for="sewing">
                    Sewing
                </label>
            </div>
            <div class="form-check col-md-2">
                <input class="form-check-input" type="checkbox" id="driving">
                <label class="form-check-label" for="driving">
                    Driving
                </label>
            </div>
        </div>
        <div class="row">
            <button type="button" class="btn btn-success btn-md m-1" id="save_applicant">Save Applicant</button>
            <button type="button" class="btn btn-warning btn-md m-1 d-none" id="update_applicant">Update Applicant</button>
        </div>
        </form>
    </div>
    </div>
</section>
@endsection

@section('pageScripts')
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('js/application.js') }}"></script>
<script>
    var APPLICANT_ID = "{{ isset($applicant_data->id) ? $applicant_data->id : '' }}";
    var GENDER = "{{ isset($applicant_data->sex) ? $applicant_data->sex : '' }}";
    var MARITIAL_STATUS = "{{ isset($applicant_data->maritial_status) ? $applicant_data->maritial_status : '' }}";
    var POST_STATUS = "{{ isset($applicant_data->post_status) ? $applicant_data->post_status : '' }}";
    var DECORATING = "{{ isset($applicant_data->decorating) ? $applicant_data->decorating : ''  }}";
    var BABY_SITTING = "{{ isset($applicant_data->baby_sitting) ? $applicant_data->baby_sitting : '' }}";
    var CLEANING = "{{ isset($applicant_data->cleaning) ? $applicant_data->cleaning : '' }}";
    var COOKING = "{{ isset($applicant_data->cooking) ? $applicant_data->cooking : '' }}";
    var WASHING = "{{ isset($applicant_data->washing) ? $applicant_data->washing : '' }}";
    var SEWING = "{{ isset($applicant_data->sewing) ? $applicant_data->sewing : '' }}";
    var DRIVING = "{{ isset($applicant_data->driving) ? $applicant_data->driving : '' }}";


    $(function() {
        bsCustomFileInput.init();

        if (APPLICANT_ID != '') {
            $('#sex').val(GENDER);
            $('#maritial_status').val(MARITIAL_STATUS);
            $('#post_status').val(POST_STATUS);
            $('#save_applicant').addClass('d-none');
            $('#update_applicant').removeClass('d-none');

            if (DECORATING == 1) {
                $('#decorating').prop("checked", true);
            }

            if (BABY_SITTING == 1) {
                $('#baby_sitting').prop("checked", true);
            }

            if (CLEANING == 1) {
                $('#cleaning').prop("checked", true);
            }

            if (COOKING == 1) {
                $('#cooking').prop("checked", true);
            }

            if (WASHING == 1) {
                $('#washing').prop("checked", true);
            }

            if (SEWING == 1) {
                $('#sewing').prop("checked", true);
            }

            if (DRIVING == 1) {
                $('#driving').prop("checked", true);
            }
        }
    });
</script>
@endsection