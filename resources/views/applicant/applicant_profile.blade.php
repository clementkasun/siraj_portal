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
                <h2>Applicant Profile</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <?php (isset($applicant_data->applicant_image)) ? $img_path = $applicant_data->applicant_image : $img_path = asset('/dist/img/avatar5.png'); ?>
                                    <img class="img-fluid img-circle elevation-2" src="{{ $img_path }}" alt="Student Profile Picture" width="200px" height="200px">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Basic Infomation</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address </strong>
                                <p class="text-muted">
                                    <span>{{(isset($applicant_data->address)) ? $applicant_data->address : '-'}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-mobile mr-1"></i> Mobile No 01 </strong>
                                <p class="text-muted">
                                    <span class="phone_no">{{(isset($applicant_data->phone_no_01)) ? $applicant_data->phone_no_01 : ''}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-mobile mr-1"></i> Mobile No 02 </strong>
                                <p class="text-muted">
                                    <span class="phone_no">{{(isset($applicant_data->phone_no_01)) ? $applicant_data->phone_no_01 : ''}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-envelope-open-text mr-1"></i> Email</strong>
                                <p class="text-muted">
                                    <span>{{(isset($applicant_data->email)) ? $applicant_data->email : ''}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-venus-mars mr-1"></i> Gender </strong>
                                <?php $gender = ['Female', 'Male']; ?>
                                <p class="text-muted">
                                    <span>{{(isset($applicant_data->sex)) ? $gender[$applicant_data->sex] : ''}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-star-half-alt mr-1"></i> Maritial Status </strong>
                                <p class="text-muted">
                                    <span>{{(isset($applicant_data->maritial_status)) ? $applicant_data->maritial_status : ''}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-id-card mr-1"></i> NIC </strong>
                                <p class="text-muted">
                                    <span>{{(isset($applicant_data->nic)) ? $applicant_data->nic : ''}}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-birthday-cake mr-1"></i> DOB </strong>
                                <p class="text-muted">
                                    <span class="ml-2">{{(isset($applicant_data->birth_date)) ? $applicant_data->birth_date : ''}}</span>
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills row bg-light">
                                    <li class="nav-item col-12 col-md-2 text-center"><a class="nav-link active" href="#other_info" data-toggle="tab"><b>Other Info</b></a></li>
                                    <li class="nav-item col-12 col-md-3 text-center"><a class="nav-link" href="#educational_qaulifications" data-toggle="tab"><b>Educational Qualifications</b></a></li>
                                    <li class="nav-item col-12 col-md-3 text-center"><a class="nav-link" href="#previous_employeements" data-toggle="tab"><b>Previous Employeements</b></a></li>
                                    <li class="nav-item col-12 col-md-2 text-center"><a class="nav-link" href="#languages" data-toggle="tab"><b>Languages</b></a></li>
                                    <li class="nav-item col-12 col-md-2 text-center"><a class="nav-link" href="#staff_response" data-toggle="tab"><b>Staff Response</b></a></li>
                                    <li class="nav-item col-12 col-md-2 text-center"><a class="nav-link" href="#commission" data-toggle="tab"><b>Commission</b></a></li>
                                </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="other_info">
                                        <div class="card card-primary">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Full Name: </label>
                                                            <span> {{(isset($applicant_data->full_name)) ? $applicant_data->full_name : ''}} </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport No: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->passport_no)) ? $applicant_data->passport_no : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport Issue Date: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->passport_issue_date)) ? $applicant_data->passport_issue_date : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport Expire Date: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->passport_exp_date)) ? $applicant_data->passport_exp_date : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Weight: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->weight)) ? $applicant_data->weight : ''}}</span>
                                                            <!-- <p class="text-muted"></p> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Complexion: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->complexion)) ? $applicant_data->complexion : ''}}</span>
                                                            <!-- <p class="text-muted"></p> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nationality: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->nationality)) ? $applicant_data->nationality : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Religion: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->religion)) ? $applicant_data->religion : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No of children: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->number_of_children)) ? $applicant_data->number_of_children : ''}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php $exp_array = ['Experienced', 'No Experience']; ?>
                                                        <div class="form-group mt-2">
                                                            <label>Decorating: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->decorating)) ? $exp_array[$applicant_data->decorating] : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Baby Sitting: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->baby_sitting)) ? $exp_array[$applicant_data->baby_sitting] : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cleaning: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->cleaning)) ? $exp_array[$applicant_data->cleaning] : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cooking: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->baby_sitting)) ? $exp_array[$applicant_data->baby_sitting] : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sewing: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->sewing)) ? $exp_array[$applicant_data->sewing] : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Washing: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->washing)) ? $exp_array[$applicant_data->washing] : ''}}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Driving: </label>
                                                            <span class="ml-2">{{(isset($applicant_data->driving)) ? $exp_array[$applicant_data->driving] : ''}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-success">
                                            <div class="card-header">Attachments</div>
                                            <div class="card-body row">
                                                @if(isset($applicant_data->passport_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->passport_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->passport_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->nic_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->nic_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->nic_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->police_record_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->police_record_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->police_record_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->gs_certificate_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->gs_certificate_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->gs_certificate_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->family_back_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->family_back_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->family_back_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->visa_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->visa_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->visa_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->medical_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->medical_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->medical_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->aggreement_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->aggreement_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->aggreement_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->personal_form_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->personal_form_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->personal_form_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->job_order_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->job_order_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->job_order_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->ticket_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->ticket_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->ticket_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->agency_aggrement_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->agency_aggrement_pdf}}" class="border" width="250px" height="250px" />
                                                    <a href="{{'/storage/'.$applicant_data->agency_aggrement_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="educational_qaulifications">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <form id="qualifications_form">
                                                    <div class="form-group">
                                                        <label for="institute">Institute*</label>
                                                        <div><input type="text" class="form-control" name="institute" id="institute" placeholder="Please enter institute name" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course">Course*</label>
                                                        <div><input type="text" class="form-control" name="course" id="course" placeholder="Please enter course name" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date*</label>
                                                        <div><input type="date" class="form-control" name="start_date" id="start_date" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="end_date">End Date*</label>
                                                        <div><input type="date" class="form-control" name="end_date" id="end_date" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="result">Result*</label>
                                                        <div><input type="text" class="form-control" name="result" id="result" placeholder="Please Enter your result" equired></div>
                                                    </div>
                                                    <button id="save_qualification" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                    <button id="update_qualification" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                </form>
                                            </div>
                                            <div class="col-md-9">
                                                <table class="table table-striped" id="edu_qualifications_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Institute</th>
                                                        <th>Course</th>
                                                        <th>Result</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
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
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="previous_employeements">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <form id="previous_employeement_form">
                                                    <div class="form-group">
                                                        <label for="job_type">Job Type *</label>
                                                        <div><input type="text" class="form-control" name="job_type" id="job_type" placeholder="Please enter the job type" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="period">Period *</label>
                                                        <div><input type="text" class="form-control" name="period" id="period" placeholder="Please enter the period of employed" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="monthly_sallary">Monthly Salary *</label>
                                                        <div><input type="text" class="form-control" name="monthly_sallary" id="monthly_sallary" placeholder="Please enter the monthly sallary" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contract_period">Contract Period *</label>
                                                        <div><input type="text" class="form-control" name="contract_period" id="contract_period" placeholder="Please enter the contract period" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country *</label>
                                                        <div><input type="text" class="form-control" name="country" id="country" placeholder="Please enter the country applicant employeed" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="save_previous_emp" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                        <button id="update_previous_emp" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-9">
                                                <table class="table table-striped" id="previous_emp_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Job Type</th>
                                                        <th>Period</th>
                                                        <th>Monthly Salary</th>
                                                        <th>Contract Period</th>
                                                        <th>Country</th>
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
                                    <div class="tab-pane" id="languages">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form id="languages_form">
                                                    <div class="form-group">
                                                        <label for="language">Language*</label>
                                                        <input type="text" class="form-control" name="language" id="language" placeholder="Please enter the language" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status*</label>
                                                        <select id="status" name="status" class="custom-select" required>
                                                            <option value="">Select the lanaguage level</option>
                                                            <option value="beginner">Beginner</option>
                                                            <option value="moderate">Moderate</option>
                                                            <option value="fluent">Fluent</option>
                                                            <option value="Excellent">Excellent</option>
                                                        </select>
                                                    </div>
                                                    <button id="save_language" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                    <button id="update_language" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                </form>
                                            </div>
                                            <div class="col-md-8">
                                                <table class="table table-striped" id="language_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Language Name</th>
                                                        <th>Status</th>
                                                        <th>action</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="4" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="staff_response">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <form id="staff_reponse_form">
                                                    <div class="form-group">
                                                        <label for="staff_name">Staff Member Name *</label>
                                                        <div><input type="text" class="form-control" name="staff_name" id="staff_name" placeholder="Please enter the staff member name" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="designation">Designation *</label>
                                                        <div><input type="text" class="form-control" name="designation" id="designation" placeholder="Please enter the designation" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="price">Price *</label>
                                                        <div><input type="text" class="form-control" name="price" id="price" placeholder="Please enter the price" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="response">Response *</label>
                                                        <div><input type="text" class="form-control" name="response" id="response" placeholder="Please enter the staff response" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="save_staff_response" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                        <button id="update_staff_response" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-9">
                                                <table class="table table-striped" id="app_staff_resp_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Price</th>
                                                        <th>Response</th>
                                                        <th>action</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="6" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="commission">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <form id="commission_form">
                                                    <div class="form-group">
                                                        <label for="staff_mem_name">Staff Member Name *</label>
                                                        <div><input type="text" class="form-control" name="staff_mem_name" id="staff_mem_name" placeholder="Please enter the staff member name" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="com_designation">Designation *</label>
                                                        <div><input type="text" class="form-control" name="com_designation" id="com_designation" placeholder="Please enter the designation" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="com_price">Price *</label>
                                                        <div><input type="text" class="form-control" name="com_price" id="com_price" placeholder="Please enter the price" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="com_response">Response *</label>
                                                        <div><input type="text" class="form-control" name="com_response" id="com_response" placeholder="Please enter the staff response" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="save_comission" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                        <button id="update_comission" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-9">
                                                <table class="table table-striped" id="commission_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Price</th>
                                                        <th>Response</th>
                                                        <th>action</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="6" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    </div>
</section>
@endsection

@section('pageScripts')
<script src="{{ asset('js/educational_qaulifications.js') }}"></script>
<script src="{{ asset('js/previous_employeements.js') }}"></script>
<script src="{{ asset('js/applicant_languages.js') }}"></script>
<script src="{{ asset('js/application_staff_response.js') }}"></script>
<script src="{{ asset('js/commission.js') }}"></script>
<script>
    var APPLICANT_ID = '{{ $applicant_data->id }}';

    $(document).ready(function() {
        load_edu_qualifications_table(APPLICANT_ID);
        load_previous_employeement_table(APPLICANT_ID);
        load_language_table(APPLICANT_ID);
        load_application_staff_table(APPLICANT_ID);
        load_comission_tbl(APPLICANT_ID);
    });
</script>
@endsection