<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Application</title>
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <?php

    use Illuminate\Support\Carbon; ?>
    <!-- Google Font: Source Sans Pro -->
    <style>
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 250mm;
            max-height: 800mm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: 210mm;
                max-height: 297mm;
                min-height: 297mm;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            .page-breack {
                padding-bottom: 18em;
            }

            .passport-section{
                padding-top: 50px;
            }
        }

        .cell-border {
            border-style: solid;
            border-width: 2px;
            border-color: #484848
        }
    </style>

<body class="container text-center page" style="background-color: #ffe6e6">
    <div class="row">
        <div class="col-2">
            <img class="img-responsive mt-4" src="/dist/img/logo1.png" width="100%" height="150px" />
        </div>
        <div class="col-8">
            <div class="row">
                <img class="img-responsive mt-4" src="/dist/img/siraj_name.jpeg" width="100%" height="120px" />
            </div>
        </div>
        <div class="col-2">
            <img class="img-responsive mt-4" src="/dist/img/slbfe_award.png" width="100%" height="150px" />
        </div>
    </div>
    <div class="row mt-1" style="background-color: grey;">
        <div class="col-12">&nbsp;</div>
    </div>
    <div class="row" style="background-color: darkgrey;">
        <div class="col-12 text-center" style="font-size: 14px;  font-family: Lucida Console, Courier New, monospace; font-weight: bold">www.sirajmanpower.com</div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="row mt-1">
                <div class="col-5 cell-border">
                    <label><b>Refference No:</b></label>
                </div>
                <div class="col-7 cell-border">
                    <label>{{(isset($applicant_details->reff_no)) ? $applicant_details->reff_no : '-'}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-5 cell-border">
                    <label><b>Sex:</b></label>
                </div>
                <?php $gender_array = ['Female', 'Male']; ?>
                <div class="col-7 cell-border">
                    <label>{{ (isset($applicant_details->sex)) ? $gender_array[$applicant_details->sex] : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-5 cell-border">
                    <label><b>Age:</b></label>
                </div>
                <div class="col-7 cell-border">
                    <label>{{ (isset($applicant_details->birth_date)) ? Carbon::parse($applicant_details->birth_date)->age : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-5 cell-border">
                    <label><b>Post Applied For</b>:</label>
                </div>
                <div class="col-7 cell-border">
                    <label> - </label>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-3 cell-border">
                    <label><b>Full Name:</b></label>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-8 mt-1 pl-2 pr-2 cell-border pt-5">
                    <span style="font-size: 16px;"> <b>APPLICATION FOR EMPLOYEMENT</b> </span>
                </div>
                <div class="col-4 mt-1 cell-border">
                    <img class="img-responsive" src="{{ (isset($applicant_details->applicant_image)) ? $applicant_details->applicant_image : '/dist/img/no-image.jpg' }}" width="100%" height="128px" />
                </div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">
                    <label><b>Monthly Sallary:</b></label>
                </div>
                <div class="col-6 cell-border">
                    <?php
                    if ((isset($applicant_details->ApplicantPreviousEmployeement))) {
                        $record_count = count($applicant_details->ApplicantPreviousEmployeement);
                        if ($record_count > 0) {
                            $applicant_details->ApplicantPreviousEmployeement[$record_count - 1]->monthly_salary;
                        }
                    }
                    ?>
                </div>
                <div class="col-12 p-3 cell-border">
                    <label>{{ (isset($applicant_details->full_name)) ? $applicant_details->full_name : '-' }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 text-center" style="background-color: #484848; color: white; padding: 2px">
            <span>Details of Applicants</span>
        </div>
    </div>
    <div class="row page-breack">
        <div class="col-4">
            <div class="row">
                <div class="col-6 cell-border">
                    <label><b>Nationality:</b></label>
                </div>
                <div class="col-6 cell-border">
                    <label>{{ (isset($applicant_details->nationality)) ? $applicant_details->nationality : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">
                    <label><b>Date of Birth:</b></label>
                </div>
                <div class="col-6 cell-border">
                    <label>{{ (isset($applicant_details->birth_date)) ? $applicant_details->birth_date : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">
                    <label><b>Place Of Birth:</b></label>
                </div>
                <div class="col-6 cell-border">
                    <label>-</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">
                    <label><b>Maritial Status:</b></label>
                </div>
                <div class="col-6 cell-border">
                    <label>{{(isset($applicant_details->maritial_status)) ? $applicant_details->maritial_status : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">
                    <label><b>Complexion:</b></label>
                </div>
                <div class="col-6 cell-border">
                    <label>{{(isset($applicant_details->complexion)) ? $applicant_details->complexion : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
            <div class="row">
                <div class="col-6 cell-border">&nbsp</div>
                <div class="col-6 cell-border">&nbsp</div>
            </div>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-3 cell-border">
                    <label><b>Religion:</b></label>
                </div>
                <div class="col-3 cell-border">
                    <label>{{ (isset($applicant_details->religion)) ? $applicant_details->religion : '-' }}</label>
                </div>
                <div class="col-3 cell-border">
                    <label></label>
                </div>
                <div class="col-3 cell-border">
                    <label></label>
                </div>
            </div>
            <div class="row">
                <div class="col-3 cell-border">
                    <label><b>Tel no 01:</b></label>
                </div>
                <div class="col-3 cell-border">
                    <label>{{ (isset($applicant_details->phone_no_01)) ? $applicant_details->phone_no_01 : '-' }}</label>
                </div>
                <div class="col-3 cell-border">
                    <label></label>
                </div>
                <div class="col-3 cell-border">
                    <label></label>
                </div>
            </div>
            <div class="row">
                <div class="col-3 cell-border">
                    <label><b>Tel no 02:</b></label>
                </div>
                <div class="col-3 cell-border">
                    <label>{{ (isset($applicant_details->phone_no_01)) ? $applicant_details->phone_no_02 : '-' }}</label>
                </div>
                <div class="col-3 cell-border">
                    <label>SMK 2092</label>
                </div>
                <div class="col-3 cell-border">
                    <label>SMK 2092</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 pt-3 cell-border" style="padding-bottom: 200px">
                    <label><b>Educational:</b></label>
                </div>
                <div class="col-8 pt-3 cell-border">
                    <ul>
                        @if((isset($applicant_details->ApplicantEducationalQualification)))
                        @foreach($applicant_details->ApplicantEducationalQualification as $applicantEducationalQualifications)
                        <li>{{$applicantEducationalQualifications->course}}</li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-4 pt-3 cell-border" style="padding-bottom: 100px">
                    <label><b>Languages :</b></label>
                </div>
                <div class="col-8 pt-3 cell-border">
                    <ul>
                        @if((isset($applicant_details->ApplicantLanguage)))
                        @foreach($applicant_details->ApplicantLanguage as $applicant_language)
                        <li>{{$applicant_language->language_name}}</li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2 passport-section">
        <div class="col-6 text-center" style="background-color: #484848; color: white; padding: 2px">
            <span>Passport Details</span>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Passport No:</b></label>
                </div>
                <div class="col-8 cell-border">
                    <label>{{ (isset($applicant_details->passport_no)) ? $applicant_details->passport_no : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Date of issue:</b></label>
                </div>
                <div class="col-8 cell-border">
                    <label>{{ (isset($applicant_details->passport_issue_date)) ? $applicant_details->passport_issue_date : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Date of expire:</b></label>
                </div>
                <div class="col-8 cell-border">
                    <label>{{ (isset($applicant_details->passport_exp_date)) ? $applicant_details->passport_exp_date : '-' }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Place of issue:</b></label>
                </div>
                <div class="col-8 cell-border">
                    <label></label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-center" style="background-color: #484848; color: white; padding: 2px">
                    <span>Working Experience Overseas</span>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Country</b></label>
                </div>
                <div class="col-4 cell-border">
                    <label><b>Period</b></label>
                </div>
                <div class="col-4 cell-border">
                    <label><b>Job Title</b></label>
                </div>
            </div>
            @if($applicant_details->ApplicantPreviousEmployeement)
            @foreach($applicant_details->ApplicantPreviousEmployeement as $previousEmployeement)
            <div class="row">
                <div class="col-4 cell-border">
                    <label>{{$previousEmployeement->country}}</label>
                </div>
                <div class="col-4 cell-border">
                    <label>{{$previousEmployeement->period}}</label>
                </div>
                <div class="col-4 cell-border">
                    <label>{{$previousEmployeement->job_type}}</label>
                </div>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-4 cell-border">
                    <label></label>
                </div>
                <div class="col-4 cell-border">
                    <label></label>
                </div>
                <div class="col-4 cell-border">
                    <label></label>
                </div>
            </div>
            @endif
            <div class="row mt-2">
                <div class="col-12 text-center" style="background-color: #484848; color: white; padding: 2px">
                    <span>Working Experience</span>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Decorating:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->decorating) && $applicant_details->decorating == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4 cell-border">
                    <label><b>Baby Sitting:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->baby_sitting) && $applicant_details->baby_sitting == '1') ? print '&#10004;' : '' ?> </label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Cleaning:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->cleaning) && $applicant_details->cleaning == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4 cell-border">
                    <label><b>Cooking:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->cooking) && $applicant_details->cooking == '1') ? print '&#10004;' : '' ?> </label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Washing:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->washing) && $applicant_details->washing == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4 cell-border">
                    <label><b>Sewing:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->sewing) && $applicant_details->sewing == '1') ? print '&#10004;' : '' ?> </label>
                </div>
            </div>
            <div class="row">
                <div class="col-4 cell-border">
                    <label><b>Driving:</b></label>
                </div>
                <div class="col-2 cell-border">
                    <label><?php (isset($applicant_details->driving) && $applicant_details->driving == '1') ? print '&#10004;' : '' ?> </label>
                </div>
                <div class="col-4 cell-border">
                    <label></label>
                </div>
                <div class="col-2 cell-border">
                    <label></label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-center" style="background-color: #484848; color: white; padding: 2px">
                    <span>Remarks </span>
                </div>
            </div>
            @forelse($applicant_details->ApplicationStaffResponse as $application_staff_response)
            <div class="row">
                <div class="col-12 cell-border">
                    {{ $application_staff_response->response }}
                </div>
            </div>
            @empty
            <div class="row">
                <div class="col-12 text-center cell-border">
                    <b>No Data</b>
                </div>
            </div>
            @endforelse
        </div>
        <div class="col-6">
            <img src="{{ (isset($applicant_details->applicant_image)) ? $applicant_details->applicant_image : '/dist/img/no-image.jpg' }}" width="100%" height="720px" />
        </div>
    </div>
</body>

</html>