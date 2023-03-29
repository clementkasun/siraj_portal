@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<?php

use Illuminate\Support\Carbon;
?>
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
                                    <?php (isset($applicant_data->applicant_image_passport)) ? $img_path = $applicant_data->applicant_image_passport : $img_path = asset('/dist/img/avatar5.png'); ?>
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
                                <?php $status_style = (isset($applicant_data->post_status)) ? $post_status_array[$applicant_data->post_status]['color'] : '' ?>
                                <strong><i class="fas fa-shield-alt"></i> Applicant Status </strong>
                                <p class="text-muted">
                                    <span class="btn btn-sm rounded text-white ml-3 mt-1" style="<?php echo 'background-color:' . $status_style ?>">{{ (isset($applicant_data->post_status)) ? $post_status_array[$applicant_data->post_status]['name'] : '' }}</span>
                                </p>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address </strong>
                                <p class="text-muted">
                                    <span>{{ (isset($applicant_data->address)) ? $applicant_data->address : '-' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-mobile mr-1"></i> Mobile No 01 </strong>
                                <p class="text-muted">
                                    <span class="phone_no">{{ (isset($applicant_data->phone_no_01)) ? $applicant_data->phone_no_01 : '' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-mobile mr-1"></i> Mobile No 02 </strong>
                                <p class="text-muted">
                                    <span class="phone_no">{{ (isset($applicant_data->phone_no_01)) ? $applicant_data->phone_no_01 : '' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-envelope-open-text mr-1"></i> Email</strong>
                                <p class="text-muted">
                                    <span>{{ (isset($applicant_data->email)) ? $applicant_data->email : '' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-venus-mars mr-1"></i> Gender </strong>
                                <?php $gender = ['Female', 'Male']; ?>
                                <p class="text-muted">
                                    <span>{{ (isset($applicant_data->sex)) ? $gender[$applicant_data->sex] : '' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-star-half-alt mr-1"></i> Maritial Status </strong>
                                <p class="text-muted">
                                    <span>{{ (isset($applicant_data->maritial_status)) ? ucfirst($applicant_data->maritial_status) : '' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-id-card mr-1"></i> NIC </strong>
                                <p class="text-muted">
                                    <span>{{ (isset($applicant_data->nic)) ? $applicant_data->nic : '' }}</span>
                                </p>

                                <hr>
                                <strong><i class="fas fa-birthday-cake mr-1"></i> DOB </strong>
                                <p class="text-muted">
                                    <span class="ml-2">{{ (isset($applicant_data->birth_date)) ? $applicant_data->birth_date : '' }}</span>
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
                                    <!-- <li class="nav-item col-12 col-md-3 text-center"><a class="nav-link" href="#educational_qaulifications" data-toggle="tab"><b>Educational Qualifications</b></a></li> -->
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
                                                            <span class="float-right pr-5"> {{ (isset($applicant_data->full_name)) ? $applicant_data->full_name : '-' }} </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport No: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->passport_no)) ? $applicant_data->passport_no : '-' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport Issue Date: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->passport_issue_date)) ? $applicant_data->passport_issue_date : '-' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport Place Of Issue: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->passport_place_of_issue)) ? $applicant_data->passport_place_of_issue : '-' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Passport Expire Date: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->passport_exp_date)) ? $applicant_data->passport_exp_date : '-' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Height: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->height)) ? $applicant_data->height : '-' }}</span>
                                                            <!-- <p class="text-muted"></p> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Weight: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->weight)) ? $applicant_data->weight : '-' }}</span>
                                                            <!-- <p class="text-muted"></p> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Complexion: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->complexion)) ? $applicant_data->complexion : '-' }}</span>
                                                            <!-- <p class="text-muted"></p> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nationality: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->nationality)) ? $applicant_data->nationality : '-' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Religion: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->religion)) ? $applicant_data->religion : '-' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No of children: </label>
                                                            <span class="ml-2 float-right pr-5">{{ (isset($applicant_data->number_of_children)) ? $applicant_data->number_of_children : '-' }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php $exp_array = ['No Experience', 'Experience']; ?>
                                                        <div class="form-group mt-2">
                                                            <label>Decorating: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->decorating)) ? ($applicant_data->decorating == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->decorating)) ? $exp_array[$applicant_data->decorating] : '' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Baby Sitting: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->baby_sitting)) ? ($applicant_data->baby_sitting == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->baby_sitting)) ? $exp_array[$applicant_data->baby_sitting] : '' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cleaning: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->cleaning)) ? ($applicant_data->cleaning == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->cleaning)) ? $exp_array[$applicant_data->cleaning] : '' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cooking: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->cooking)) ? ($applicant_data->cooking == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->cooking)) ? $exp_array[$applicant_data->cooking] : '' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sewing: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->sewing)) ? ($applicant_data->sewing == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->sewing)) ? $exp_array[$applicant_data->sewing] : '' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Washing: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->washing)) ? ($applicant_data->washing == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->washing)) ? $exp_array[$applicant_data->washing] : '' }}</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Driving: </label>
                                                            <span class="float-right p-2 rounded {{(isset($applicant_data->driving)) ? ($applicant_data->driving == 0) ? 'badge-danger' : 'badge-success' : ''}}">{{ (isset($applicant_data->driving)) ? $exp_array[$applicant_data->driving] : '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-success">
                                            <div class="card-header">Attachments</div>
                                            <div class="card-body row">
                                                @if(!isset($applicant_data->passport_pdf) && !isset($applicant_data->nic_pdf) && !isset($applicant_data->police_record_pdf) && !isset($applicant_data->gs_certificate_pdf) && !isset($applicant_data->family_back_pdf) && !isset($applicant_data->visa_pdf) && !isset($applicant_data->medical_pdf) && !isset($applicant_data->agreement_pdf) && !isset($applicant_data->personal_form_pdf) && !isset($applicant_data->job_order_pdf) && !isset($applicant_data->ticket_pdf) && !isset($applicant_data->agency_agreement_pdf) && !isset($applicant_data->hform_pdf) && !isset($applicant_data->other_pdf))
                                                <div>No attachments available</div>
                                                @endif
                                                @if(isset($applicant_data->passport_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->passport_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Passport PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->passport_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->nic_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->nic_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>NIC PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->nic_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->police_record_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->police_record_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Police Record PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->police_record_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->gs_certificate_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->gs_certificate_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>GS Certificate PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->gs_certificate_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->family_back_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->family_back_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Family Background PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->family_back_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->visa_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->visa_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Visa PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->visa_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->medical_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->medical_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Medical PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->medical_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->agreement_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->agreement_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Agreement PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->agreement_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->personal_form_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->personal_form_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Personal Form PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->personal_form_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->job_order_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->job_order_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Job Order PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->job_order_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->ticket_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->ticket_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Ticket PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->ticket_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->agency_agreement_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->agency_agreement_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Agency Agreement PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->agency_agreement_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->other_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->other_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>Other PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->other_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                                @if(isset($applicant_data->hform_pdf))
                                                <div class="form-group col-md-3">
                                                    <embed src="{{'/storage/'.$applicant_data->hform_pdf}}" class="border" width="250px" height="250px" /><br>
                                                    <span><b>H-FORM PDF</b></span><br>
                                                    <a href="{{'/storage/'.$applicant_data->hform_pdf}}" target="blank" class="btn btn-success">More</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- <div class="tab-pane" id="educational_qaulifications">
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
                                    </div> -->
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="previous_employeements">
                                        <div class="row">
                                            <div class="{{ Gate::denies('view-previous-emp') ? 'col-12' : 'col-12 col-md-3' }}">
                                                @can('create-previous-emp')
                                                @if(!($previous_emp_count > 4))
                                                <form id="previous_employeement_form">
                                                    <div class="form-group">
                                                        <label for="job_type">Job type *</label>
                                                        <input type="text" class="form-control" id="job_type" name="job_type" placeholder="Enter job type of employeement" required/>
                                                        <!-- <div>
                                                            <select class="form-select form-control" id="job_type" name="job_type" aria-label="Choose a job type" required>
                                                                <option selected value="">Choose a job category</option>
                                                                <option value="Home maid (New)">Home maid (New)</option>
                                                                <option value="Home maid (Experienced)">Home maid (Experienced)</option>
                                                                <option value="Driver">Driver</option>
                                                                <option value="Chef">Chef</option>
                                                                <option value="Welder">Welder</option>
                                                                <option value="Electrician">Electrician</option>
                                                                <option value="Civil Engineer">Civil Engineer</option>
                                                                <option value="Software Engineer">Software Engineer</option>
                                                                <option value="Mason">Mason</option>
                                                                <option value="Doctor">Doctor</option>
                                                                <option value="Carpentor">Carpentor</option>
                                                                <option value="WoodCraftmen">WoodCraftmen</option>
                                                                <option value="Waiter">Waiter</option>
                                                                <option value="Bartender">Bartender</option>
                                                                <option value="Teacher">Teacher</option>
                                                                <option value="Accountant">Accountant</option>
                                                                <option value="HR Manager">HR Manager</option>
                                                                <option value="Sales Manager">Sales Manager</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="period">Period *</label>
                                                        <div><input type="text" class="form-control" name="period" id="period" placeholder="Please enter the period of employed" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country">Country *</label>
                                                        <div>
                                                            <select class="form-select form-control select2 select2-purple" aria-label="Select the country" id="country" name="country" required>
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
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="save_previous_emp" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                        @can('update-previous-emp')
                                                        <button id="update_previous_emp" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                        @endcan
                                                    </div>
                                                </form>
                                                @endif
                                                @endcan
                                            </div>
                                            <div class="{{ Gate::denies('create-previous-emp') ?  'col-12' : 'col-12 col-md-9'}}">
                                                @can('view-previous-emp')
                                                <table class="table table-striped" id="previous_emp_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Job Type</th>
                                                        <th>Country</th>
                                                        <th>Period</th>
                                                        <th>Added by</th>
                                                        <th>Created at</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($applicant_data->ApplicantPreviousEmployeement))
                                                        @forelse($applicant_data->ApplicantPreviousEmployeement as $key => $previous_emp)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $previous_emp->job_type }}</td>
                                                            <td>{{ $previous_emp->country }}</td>
                                                            <td>{{ $previous_emp->period }}</td>
                                                            <td>{{ (isset($previous_emp->AddedBy)) ? ($previous_emp->AddedBy->preffered_name != null) ? $previous_emp->AddedBy->preffered_name : '': '' }}</td>
                                                            <td>{{ Carbon::parse($previous_emp->created_at)->format('Y-m-d') }}</td>
                                                            <td>
                                                                @can('update-previous-emp')
                                                                <button type="button" class="btn btn-primary btn-sm edit-previous-emp m-1" data-id="{{ $previous_emp->id }}"> Edit </button>
                                                                @endcan
                                                                @can('delete-previous-emp')
                                                                <button type="button" class="btn btn-danger btn-sm delete-prev-emp m-1" data-id="{{ $previous_emp->id }}'"> Delete </button>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                        @endforelse
                                                        @endif
                                                    </tbody>
                                                </table>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="languages">
                                        <div class="row">
                                            <div class="col-md-4">
                                                @can('create-applicant-language')
                                                <form id="languages_form">
                                                    <div class="form-group">
                                                        <label for="language">Language*</label>
                                                        <select class="custom-select select2 select2-purple" data-dropdown-css-class="select2-purple" id="language" name="language" required>
                                                            <option value="">Select the post language</option>
                                                            <option value="english">English</option>
                                                            <option value="arabic">Arabic</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="poor">Poor</label>
                                                        <input type="radio" id="poor" name="language_status" class="float-right" required /><br>
                                                        <label for="fair">Fair</label>
                                                        <input type="radio" id="fair" name="language_status" class="float-right" required /><br>
                                                        <label for="fluent">Fluent</label>
                                                        <input type="radio" id="fluent" name="language_status" class="float-right" required />
                                                    </div>
                                                    <button id="save_language" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                    @can('update-applicant-language')
                                                    <button id="update_language" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                    @endcan
                                                </form>
                                                @endcan
                                            </div>
                                            <div class="col-md-8">
                                                @can('view-applicant-language')
                                                <table class="table table-striped" id="language_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Language Name</th>
                                                        <th>Poor</th>
                                                        <th>Fair</th>
                                                        <th>Fluent</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($applicant_data->ApplicantLanguage))
                                                        @forelse($applicant_data->ApplicantLanguage as $key => $language)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $language->language_name }}</td>
                                                            <td><?php echo ($language->poor == 1) ?  '<span class="badge badge-info pl-2 pr-2">Yes</span>' :  '<span class="badge badge-warning pl-2 pr-2">No</span>'; ?></td>
                                                            <td><?php echo ($language->fair == 1) ?  '<span class="badge badge-info pl-2 pr-2">Yes</span>'  :  '<span class="badge badge-warning pl-2 pr-2">No</span>'; ?></td>
                                                            <td><?php echo ($language->fluent == 1) ?  '<span class="badge badge-info pl-2 pr-2">Yes</span>' :  '<span class="badge badge-warning pl-2 pr-2">No</span>'; ?></td>
                                                            <td>
                                                                @can('update-applicant-language')
                                                                <button type="button" class="btn btn-primary btn-sm edit-app-lan m-1" data-id="{{ $language->id }}"> Edit </button>
                                                                @endcan
                                                                @can('delete-applicant-language')
                                                                <button type="button" class="btn btn-danger btn-sm delete-app-lan m-1" data-id="{{ $language->id }}"> Delete </button>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                        @endforelse
                                                        @endif
                                                    </tbody>
                                                </table>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="staff_response">
                                        <div class="row">
                                            @can('create-application-staff-resp')
                                            <div class="col-md-3">
                                                <form id="staff_response_form">
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
                                            @endcan
                                            @can('view-application-staff-resp')
                                            <div class="col-md-9">
                                                <table class="table table-striped" id="app_staff_resp_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Response</th>
                                                        <th>Created at</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="commission">
                                        <div class="row">
                                            <div class="col-md-3">
                                                @can('create-commission')
                                                <form id="commission_form">
                                                    <div class="form-group">
                                                        <label for="com_price">Price *</label>
                                                        <div><input type="number" class="form-control" name="com_price" id="com_price" min="0" placeholder="Please enter the price" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="com_response">Response *</label>
                                                        <div><input type="text" class="form-control" name="com_response" id="com_response" placeholder="Please enter the staff response" required></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="save_comission" type="button" class="btn btn-success pl-5 pr-5" data-id="{{ $applicant_data->id }}">Save</button>
                                                        @can('update-commission')
                                                        <button id="update_comission" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                                                        @endcan
                                                    </div>
                                                </form>
                                                @endcan
                                            </div>
                                            <div class="col-md-9">
                                                @can('view-commission')
                                                <table class="table table-striped" id="commission_tbl">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Installment</th>
                                                        <th>Response</th>
                                                        <th>Created at</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($applicant_data->Commission))
                                                        @forelse($applicant_data->Commission as $key => $commission)
                                                        <tr>
                                                            <td> {{ ++$key }} </td>
                                                            <td> {{ $commission->AddedBy->preffered_name }} </td>
                                                            <td> {{ $commission->Designation->preffered_name }} </td>
                                                            <td> {{ $commission->price }} </td>
                                                            <td> {{ $commission->response }} </td>
                                                            <td> {{ Carbon::parse($commission->created_at)->format('Y-m-d') }} </td>
                                                            <td>
                                                                @can('update-commission')
                                                                <button type="button" class="btn btn-primary btn-sm edit-comission m-1" data-id="{{ $commission->id }}"> Edit </button>
                                                                @endcan
                                                                @can('delete-commission')
                                                                <button type="button" class="btn btn-danger btn-sm delete-comission m-1" data-id="{{ $commission->id }}"> Delete </button>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                                                        </tr>
                                                        @endforelse
                                                        @endif
                                                    </tbody>
                                                </table>
                                                @endcan
                                            </div>
                                        </div>
                                        @can('view-commission')
                                        <div class="row float-right">
                                            <span class="col-4">Promised Total Commission:</span><span class="col-8"><b>{{ number_format($commision_price,2, '.', '') }}</b></span>
                                            <span class="col-4">Paid Total Commission:</span><span class="col-8"><b>{{ number_format($paid_total_commision,2, '.', '') }}</b></span>
                                            <span class="col-4">Available Commission:</span><span class="col-8"><b>{{ number_format(($commision_price - $paid_total_commision),2, '.', '') }}</b></span>
                                        </div>
                                        @endcan
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

    $('#previous_emp_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });

    $('#language_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });

    $('a[data-toggle="tab"]').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('selectedTab', id)
    });

    var selectedTab = localStorage.getItem('selectedTab');
    if (selectedTab != null) {
        $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
    }
</script>
@endsection