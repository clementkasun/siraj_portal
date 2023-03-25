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
                            <label for="phone_no_one">Phone Number 01</label>
                            <input type="text" id="phone_no_one" name="phone_no_one" class="form-control" maxlength="10" placeholder="Please enter the phone number one" value="{{ (isset($applicant_data->address)) ? $applicant_data->phone_no_01 : ''}}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="phone_no_two">Phone Number 02</label>
                            <input type="text" id="phone_no_two" name="phone_no_two" class="form-control" maxlength="10" placeholder="Please enter the phone number two" value="{{ (isset($applicant_data->address)) ? $applicant_data->phone_no_02 : ''}}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="address">Address</label>
                            <textarea type="text" id="address" name="address" class="form-control" placeholder="Please enter the address" maxlength="255">{{ (isset($applicant_data->address)) ? $applicant_data->address : '' }}</textarea>
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
                            <label for="passport_place_of_issue">Passport Place of Issue</label>
                            <input type="text" id="passport_place_of_issue" name="passport_place_of_issue" class="form-control" placeholder="Please enter the passport place of issue" value="{{ (isset($applicant_data->passport_place_of_issue)) ? $applicant_data->passport_place_of_issue : '' }}">
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
                            <select id="complexion" name="complexion" class="custom-select select2 select2-purple">
                                <option value="">Select the complexion</option>
                                <option value="extreamly fair">Extreamly Fair</option>
                                <option value="fair">Fair</option>
                                <option value="medium">Medium</option>
                                <option value="olive">Olive</option>
                                <option value="deep">Deep</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="height">Height</label>
                            <input type="number" id="height" name="height" class="form-control" placeholder="Please enter the height of applicant" min="0" max="200" value="{{( isset($applicant_data->height)) ? $applicant_data->height : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="weight">Weight</label>
                            <input type="number" id="weight" name="weight" class="form-control" placeholder="Please enter the weight of applicant" min="45" max="100" value="{{( isset($applicant_data->weight)) ? $applicant_data->weight : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="nationality">Nationality</label>
                            <select id="nationality" name="nationality" class="custom-select select2 select2-purple">
                                <option value="Sri Lankan">Sri Lankan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="religion">Religion</label>
                            <select id="religion" name="religion" class="custom-select select2 select2-purple">
                                <option value="">Select the Religion</option>
                                <option value="Buddhist">Buddhist</option>
                                <option value="Christian">Christian</option>
                                <option value="Catholic">Catholic</option>
                                <option value="Christian">Islam</option>
                                <option value="Hindu">Hindu</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="maritial_status">Maritial Status </label>
                            <select id="maritial_status" name="maritial_status" class="custom-select select2 select2-purple">
                                <option value="">Select the maritial status</option>
                                <option value="married">Married</option>
                                <option value="unmarried">Unmarried</option>
                                <option value="devorced">Devorced</option>
                                <option value="widow">Widow</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="number_of_children">No of children</label>
                            <input type="text" id="number_of_children" name="number_of_children" class="form-control" placeholder="Please enter the number of childrens" value="{{( isset($applicant_data->number_of_children)) ? $applicant_data->number_of_children : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applied_post">Applied Post</label>
                            <input type="text" id="applied_post" name="applied_post" class="form-control" placeholder="Please enter the applied post" value="{{( isset($applicant_data->applied_post)) ? $applicant_data->applied_post : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="edu_qualifications">Educational Qualification <code>(Highest)</code> </label>
                            <input type="text" id="edu_qualifications" name="edu_qualifications" class="form-control" placeholder="Please enter the highest educational qualification" value="{{( isset($applicant_data->edu_qaulification)) ? $applicant_data->edu_qaulification : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applied_country">Country</label>
                            <select class="form-select form-control select2 select2-purple" aria-label="Select the country" id="applied_country" name="applied_country">
                                <option selected value="">Choose Country</option>
                                <option value="Srilanka">Sri Lanka</option>
                                <option value="India">India</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Thailand">Thailand</option>
                                <option value="China">China</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Quatar">Quatar</option>
                                <option value="Lebonon">Lebanon</option>
                                <option value="Turkey">Turkey</option>
                                <option value="UAE">UAE</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Baharen">Baharen</option>
                                <option value="Iran">Iran</option>
                                <option value="Syria">Syria</option>
                                <option value="Afghanisthan">Afghnisthan</option>
                                <option value="Ishrael">Ishrael</option>
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
                                <option value="Westindies">West Indies</option>
                                <option value="Austrailia">Austrailia</option>
                                <option value="New zealand">New Zealand</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="post_status">Status</label>
                            <select class="custom-select select2 select2-purple" data-dropdown-css-class="select2-purple" id="post_status" name="post_status">
                                <option value="">Select the post status</option>
                                <option value="0">Registered</option>
                                <option value="1">Application Send</option>
                                <option value="2">Visa Granted</option>
                                <option value="3">Assign to Embassy</option>
                                <option value="4">Assign to Medical Test</option>
                                <option value="5">Assign to SLBFE Registration</option>
                                <option value="6">Ready to Dispatch</option>
                                <option value="7">Dispatched</option>
                                <option value="8">Cancelled</option>
                                <option value="9">Returned the Passport</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="monthly_sallary">Monthly Sallary</label>
                            <input type="text" id="monthly_sallary" name="monthly_sallary" class="form-control" placeholder="Please enter the monthly sallary" value="{{( isset($applicant_data->monthly_sallary)) ? $applicant_data->monthly_sallary : '' }}">
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="commision_price">Promised Commission Price</label>
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
                            <label for="agreement_pdf">Agreement PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="agreement_pdf" name="agreement_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="agreement_pdf">Agreement PDF</label>
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
                            <label for="agency_agreement_pdf">Agency Agreement PDF</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="agency_agreement_pdf" name="agency_agreement_pdf" class="form-control" accept=".pdf">
                                    <label class="custom-file-label" for="agency_agreement_pdf">Agency Agreement PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applicant_image_passport">Applicant Passport Size Image <code>(300*300 pixels)</code></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="applicant_image_passport" name="applicant_image_passport" class="form-control image" accept=".jpeg, .jpg, .png">
                                    <label class="custom-file-label" for="applicant_image_passport">Applicant Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label for="applicant_image_full_size">Applicant Image <code>(436*580 pixels)</code></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="applicant_image_full_size" name="applicant_image_full_size" class="form-control image" accept=".jpeg, .jpg, .png">
                                    <label class="custom-file-label" for="applicant_image_full_size">Applicant Image</label>
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
    </div>
</section>
@endsection

@section('pageScripts')
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('js/application.js') }}"></script>
<script src="{{ asset('plugins/checkImageSize/jquery.checkImageSize.min.js') }}"></script>
<script>
    var APPLICANT_ID = "{{ isset($applicant_data->id) ? $applicant_data->id : '' }}";
    var GENDER = "{{ isset($applicant_data->sex) ? $applicant_data->sex : '' }}";
    var MARITIAL_STATUS = "{{ isset($applicant_data->maritial_status) ? $applicant_data->maritial_status : '' }}";
    var RELIGION = "{{ isset($applicant_data->religion) ? $applicant_data->religion : '' }}";
    var COMPLEXION = "{{ isset($applicant_data->complexion) ? $applicant_data->complexion : '' }}";
    var COUNTRY = "{{ isset($applicant_data->applied_country) ? $applicant_data->applied_country : '' }}";
    var POST_STATUS = "{{ isset($applicant_data->post_status) ? $applicant_data->post_status : '' }}";
    var DECORATING = "{{ isset($applicant_data->decorating) ? $applicant_data->decorating : ''  }}";
    var BABY_SITTING = "{{ isset($applicant_data->baby_sitting) ? $applicant_data->baby_sitting : '' }}";
    var CLEANING = "{{ isset($applicant_data->cleaning) ? $applicant_data->cleaning : '' }}";
    var COOKING = "{{ isset($applicant_data->cooking) ? $applicant_data->cooking : '' }}";
    var WASHING = "{{ isset($applicant_data->washing) ? $applicant_data->washing : '' }}";
    var SEWING = "{{ isset($applicant_data->sewing) ? $applicant_data->sewing : '' }}";
    var DRIVING = "{{ isset($applicant_data->driving) ? $applicant_data->driving : '' }}";

    $(function() {
        $("#applicant_image_passport").checkImageSize({
            minWidth: 300,
            minHeight: 300,
            maxWidth: 300,
            maxHeight: 300,
            showError: true,
            ignoreError: false
        });
        $("#applicant_image_full_size").checkImageSize({
            minWidth: 436,
            minHeight: 580,
            maxWidth: 436,
            maxHeight: 580,
            showError: true,
            ignoreError: false
        });
        bsCustomFileInput.init();

        if (APPLICANT_ID != '') {
            $('#sex').val(GENDER);
            $('#maritial_status').val(MARITIAL_STATUS);
            $('#post_status').val(POST_STATUS);
            $('#religion').val(RELIGION);
            $('#complexion').val(COMPLEXION);
            $('#applied_country').val(COUNTRY);
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