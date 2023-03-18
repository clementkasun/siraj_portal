<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<?php

use Illuminate\Support\Carbon; ?>

<body class="container" style="width: 245mm; height: 297mm; background-color: #ffe6e6">
    <div class="row">
        <div class="col-md-3">
            <img class="img-responsive mt-4" src="/dist/img/logo1.png" width="150px" height="150px" />
        </div>
        <div class="col-md-6">
            <div class="row">
                <img class="img-responsive mt-4" src="/dist/img/siraj_name.jpeg" width="100px" height="150px" />
            </div>
        </div>
        <div class="col-md-3">
            <img class="img-responsive mt-4" src="/dist/img/slbfe_award.png" width="150px" height="150px" />
        </div>
    </div>
    <div class="row mt-1" style="background-color: grey;">
        <div class="col-12">&nbsp;</div>
    </div>
    <div class="row" style="background-color: darkgrey;">
        <div class="col-12 text-center" style="font-size: 12px;  font-family: Lucida Console, Courier New, monospace">www.sirajmanpower.com</div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="row mt-1">
                <div class="col-3 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Refference Name:</b></label>
                </div>
                <div class="col-2 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{(isset($applicant_details->reff_name)) ? $applicant_details->reff_name : '-'}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-3 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Sex:</b></label>
                </div>
                <?php $gender_array = ['Female', 'Male']; ?>
                <div class="col-2 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->sex)) ? $gender_array[$applicant_details->sex] : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-3 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Age:</b></label>
                </div>
                <div class="col-2 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->birth_date)) ? Carbon::parse($applicant_details->birth_date)->age : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-3 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Post Applied For</b>:</label>
                </div>
                <div class="col-2 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                    <label> - </label>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Full Name:</b></label>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-8 w-70 mt-4 pl-2">
                    <span style="font-size: 16px;"> <b>APPLICATION FOR EMPLOYEMENT</b> </span>
                    <div class="row" style="margin-top: 39px">
                        <div class="col-6 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                            <label><b>Monthly Sallary:</b></label>
                        </div>
                        <div class="col-6 w-50" style="border-style: solid; border-width: 2px; border-color:black">
                            <?php
                            if ((isset($applicant_details->ApplicantPreviousEmployeement))) {
                                $record_count = count($applicant_details->ApplicantPreviousEmployeement);
                                if($record_count > 0){
                                    $applicant_details->ApplicantPreviousEmployeement[$record_count-1]->monthly_salary;
                                }
                            }
                            ?>
                        </div>
                        <div class="col-12 p-3" style="border-style: solid; border-width: 2px; border-color:black">
                            <label>{{ (isset($applicant_details->full_name)) ? $applicant_details->full_name : '-' }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-4 w-45 mt-1" style="border-style: solid; border-width: 2px; border-color:black">
                    <img class="img-responsive" src="{{ $applicant_details->applicant_image }}" width="130px" height="160px" />
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 text-center" style="background-color: #484848; color: white; padding: 2px">
            <span>Details of Applicants</span>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Nationality:</b></label>
                </div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->nationality)) ? $applicant_details->nationality : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Date of Birth:</b></label>
                </div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->birth_date)) ? $applicant_details->birth_date : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Place Of Birth:</b></label>
                </div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>-</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Maritial Status:</b></label>
                </div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{(isset($applicant_details->maritial_status)) ? $applicant_details->maritial_status : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Complexion:</b></label>
                </div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{(isset($applicant_details->complexion)) ? $applicant_details->complexion : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
                <div class="col-6" style="border-style: solid; border-width: 2px; border-color:black">&nbsp</div>
            </div>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Religion:</b></label>
                </div>
                <div class="col-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->religion)) ? $applicant_details->religion : '-' }}</label>
                </div>
                <div class="col-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
            </div>
            <div class="row">
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Tel no 01:</b></label>
                </div>
                <div class="col-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->phone_no_01)) ? $applicant_details->phone_no_01 : '-' }}</label>
                </div>
                <div class="col-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
            </div>
            <div class="row">
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Tel no 02:</b></label>
                </div>
                <div class="col-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->phone_no_01)) ? $applicant_details->phone_no_02 : '-' }}</label>
                </div>
                <div class="col-3" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>SMK 2092</label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>SMK 2092</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black; padding-bottom: 200px">
                    <label><b>Educational:</b></label>
                </div>
                <div class="col-8" style="border-style: solid; border-width: 2px; border-color:black;">
                    @if((isset($applicant_details->ApplicantEducationalQualification)))
                    @foreach($applicant_details->ApplicantEducationalQualification as $applicantEducationalQualifications)
                    {{$applicantEducationalQualifications->course.','}}
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black; padding-bottom: 100px">
                    <label><b>Languages :</b></label>
                </div>
                <div class="col-8" style="border-style: solid; border-width: 2px; border-color:black">
                    @if((isset($applicant_details->ApplicantLanguage)))
                    @foreach($applicant_details->ApplicantLanguage as $applicant_language)
                    {{$applicant_language->language_name.','}}
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6 text-center" style="background-color: #484848; color: white; padding: 2px">
            <span>Passport Details</span>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Passport No:</b></label>
                </div>
                <div class="col-8" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->passport_no)) ? $applicant_details->passport_no : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Date of issue:</b></label>
                </div>
                <div class="col-8" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->passport_issue_date)) ? $applicant_details->passport_issue_date : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Date of expire:</b></label>
                </div>
                <div class="col-8" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{ (isset($applicant_details->passport_exp_date)) ? $applicant_details->passport_exp_date : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Place of issue:</b></label>
                </div>
                <div class="col-8" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="text-center" style="background-color: #484848; color: white; padding: 2px">
                    <span>Working Experience Overseas</span>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Country</b></label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Period</b></label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Job Title</b></label>
                </div>
            </div>
            @if($applicant_details->ApplicantPreviousEmployeement)
            @foreach($applicant_details->ApplicantPreviousEmployeement as $previousEmployeement)
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{$previousEmployeement->country}}</label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{$previousEmployeement->period}}</label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label>{{$previousEmployeement->job_type}}</label>
                </div>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
            </div>
            @endif
            <div class="row mt-2">
                <div class="text-center" style="background-color: #484848; color: white; padding: 2px">
                    <span>Working Experience</span>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Decorating:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->decorating) && $applicant_details->decorating == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Baby Sitting:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->baby_sitting) && $applicant_details->baby_sitting == '1') ? print '&#10004;' : '' ?> </label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Cleaning:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->cleaning) && $applicant_details->cleaning == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Cooking:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->cooking) && $applicant_details->cooking == '1') ? print '&#10004;' : '' ?> </label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Washing:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->washing) && $applicant_details->washing == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Sewing:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->sewing) && $applicant_details->sewing == '1') ? print '&#10004;' : '' ?> </label>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><b>Driving:</b></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label><?php (isset($applicant_details->driving) && $applicant_details->driving == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
                <div class="col-2" style="border-style: solid; border-width: 2px; border-color:black">
                    <label></label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="text-center" style="background-color: #484848; color: white; padding: 2px">
                    <span>Remarks </span>
                </div>
            </div>
            @forelse($applicant_details->ApplicationStaffResponse as $application_staff_response)
            <div class="row">
                <div class="col-12" style="border-style: solid; border-width: 2px; border-color:black">
                    {{ $application_staff_response->response }}
                </div>
            </div>
            @empty
            <div class="row">
                <div class="col-12 text-center" style="border-style: solid; border-width: 2px; border-color:black">
                    <b>No Data</b>
                </div>
            </div>
            @endforelse
        </div>
        <div class="col-6">
            <img src="{{ $applicant_details->applicant_image }}" width="450px" height="720px" />
        </div>
    </div>
</body>

</html>