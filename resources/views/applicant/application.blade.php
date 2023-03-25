<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- API Token -->
    <meta name="api-token" content="{{ (auth()->user() != null) ? auth()->user()->createToken('auth-token')->plainTextToken : '' }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="{{url('./dist/img/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            /** chrome , safari 6 -15.3 and Edge */
            color-adjust: exact !important;
            /** Firefox 48 -96 */
            print-color-adjust: exact !important;
            /** Firefox 97+, Safari 15.4+ */
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 2px;

        }

        table {
            margin: 10px;
            width: 97%;
        }

        .title {
            color: red;
        }

        .comp-1 {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: end;
            position: relative;
        }

        .comp1-L {
            flex: 5;
        }

        .comp1-R {
            flex: 5;

        }

        .img1 {
            position: absolute;
            right: 5px;
            bottom: 45px;
            border-style:groove;
            border-width: 5px;
            border-color: red
        }

        td:nth-child(even) {
            color: blue;
            text-align: right;
            font-weight: bold;
        }

        .comp2 {
            width: 100%;
            display: flex;
            justify-content: right;
            position: relative;
        }

        .comp2-L {
            flex: 5;
        }

        .comp2-R {
            flex: 5;
        }

        .img2 {
            position: relative;
            left: 10px;
            top: -6px;
            width: 480px;
            height: 800px;
            border-style:groove;
            border-width: 5px;
            border-color: red
        }

        .comp3 {
            width: 50%;
            display: block;
            justify-content: right;
            position: relative;
            top: -290px;
        }

        .comp3-L {
            flex: 5;
        }

        .comp3-R {
            flex: 5;
        }

        /* .footer {
            font-size: 10px;
            text-align: center;
            color: blue;
        } */

        .comp4 {
            position: relative;
            top: -280px;
        }

        /* .ft {
            position: relative;
            top: -225px;
        } */
    </style>
</head>

<body>
    <div style="border-width: 5px; border-style: solid; border-color: blue">
        <div style="border-width: 5px; border-style: solid; border-color: green">
            <div style="border-width: 10px; border-style: solid; border-color: red;" class="pl-2 pt-2 pr-2">
                <img src="{{url('./dist/img/SirajWebLogo.png')}}" alt="logo" width="800px">
                <div id="h1">
                    <h3 class="title">APPLICATION FOR EMPLOYMENT</h3>
                </div>
                <div class="comp-1">
                    <div class="comp1-L">
                        <table class="t1">
                            <tr>
                                <td style="width: 45%">COUNTRY</td>
                                <td class="center" colspan="2">{{ (isset($applicant_details->applied_country)) ? $applicant_details->applied_country : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">POST APPLIED FOR</td>
                                <td class="center" colspan="2">{{ (isset($applicant_details->applied_post)) ? $applicant_details->applied_post : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">MONTHLY SALARY</td>
                                <td class="center" colspan="2">{{ (isset($applicant_details->monthly_sallary)) ? $applicant_details->monthly_sallary : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">CONTACT PERIOD</td>
                                <td class="center" colspan="2">{{ (isset($applicant_details->ApplicantPreviousEmployeement[0])) ? (isset($applicant_details->ApplicantPreviousEmployeement[0]->period)) ? $applicant_details->ApplicantPreviousEmployeement[0]->period : '-' : '' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                        </table>
                    </div>


                    <div class="comp1-R">
                        <div class="comp-1-T">
                            <img src="{{ (isset($applicant_details->applicant_image_passport)) ? $applicant_details->applicant_image_passport : url('/dist/img/no-image.jpg') }}" alt="profile" width="200px" height="200px" class="img1">
                        </div>

                        <table class="t2 comp-1-B">
                            <tr>
                                <td>REF. NO</td>
                                <td class="center"># {{ (isset($applicant_details->reff_no)) ? $applicant_details->reff_no : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div>
                    <table>
                        <tr>
                            <td style="width: 22.5%">NAME IN FULL</td>
                            <td style="width: 77.5%"> {{ (isset($applicant_details->full_name)) ? $applicant_details->full_name : '-' }} </td>
                        </tr>
                    </table>
                </div>

                <div class="comp2">
                    <div class="comp2-L">
                        <h5>DETAILS OF APPLICATION</h5>
                        <TABLE>
                            <tr>
                                <td style="width: 45%">NATIONALITY</td>
                                <td colspan="2">{{ (isset($applicant_details->nationality)) ? $applicant_details->nationality : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">RELIGION</td>
                                <td colspan="2">{{ (isset($applicant_details->religion)) ? $applicant_details->religion : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td>DATE OF BIRTH</td>
                                <td colspan="2">{{ (isset($applicant_details->birth_date)) ? $applicant_details->birth_date : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <?php

                            use Illuminate\Support\Carbon; ?>
                            <tr>
                                <td style="width: 45%">AGE</td>
                                <td colspan="2">{{ (isset($applicant_details->birth_date)) ? Carbon::parse($applicant_details->birth_date)->age : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">MARTIAL STATUS</td>
                                <td colspan="2">{{ (isset($applicant_details->maritial_status)) ? ucfirst($applicant_details->maritial_status) : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">NO. OF CHILDREN</td>
                                <td colspan="2">{{ (isset($applicant_details->number_of_children)) ? $applicant_details->number_of_children : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">WEIGHT</td>
                                <td colspan="2"> {{ (isset($applicant_details->weight)) ? $applicant_details->weight.' Kg ' : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">HEIGHT</td>
                                <td colspan="2"> {{ (isset($applicant_details->height)) ? $applicant_details->height. ' cm ' : '-' }} </td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">COMPLEXION</td>
                                <td colspan="2">{{ (isset($applicant_details->complexion)) ? $applicant_details->complexion : '-' }}</td>
                                <!-- <td>Language</td> -->
                            </tr>
                            <tr>
                                <td style="width: 45%">EDCATION QUALIFICATION</td>
                                <td colspan="2"> {{ (isset($applicant_details->edu_qaulification)) ? $applicant_details->edu_qaulification : '-' }} </td>
                                <!-- <td>Language</td> -->
                            </tr>
                        </TABLE>
                    </div>

                    <div class="comp2-R">
                        <div>
                            <h5>PASSPORT DETAILS</h5>
                            <table>
                                <tr>
                                    <td style="width: 50%">PASSPORT NO</td>
                                    <td style="width: 50%" colspan="2"> {{ (isset($applicant_details->passport_no)) ? $applicant_details->passport_no : '' }} </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">DATE OF ISSUE</td>
                                    <td style="width: 50%" colspan="2"> {{ (isset($applicant_details->passport_issue_date)) ? $applicant_details->passport_issue_date : '' }} </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">PLACE OF ISSUE</td>
                                    <td style="width: 50%" colspan="2"> {{ (isset($applicant_details->passport_place_of_issue)) ? $applicant_details->passport_place_of_issue : '' }} </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%">DATE OF EXPIRE</td>
                                    <td style="width: 50%" colspan="2"> {{ (isset($applicant_details->passport_exp_date)) ? $applicant_details->passport_exp_date : '' }} </td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <img src="{{ (isset($applicant_details->applicant_image_full_size)) ? $applicant_details->applicant_image_full_size : url('/dist/img/no-image.jpg') }}" alt="standing image" width="480px" height="500px" class="img2">
                        </div>
                    </div>
                </div>
                <div class="comp3" style="top: -580px;">
                    <div class="comp3-L">
                        <h5>KNOWLEDGE OF LANGUAGES</h5>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Language</td>
                                    <td style="text-align: center;">Poor</td>
                                    <td style="font-weight: bold; text-align: center; color: blue;">Fair</td>
                                    <td style="text-align: center;">Fluent</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applicant_details->ApplicantLanguage as $language)
                                <tr>
                                    <td colspan="2"> <?php echo (isset($language->language_name)) ? $language->language_name : '-' ?> </td>
                                    <td class="text-success text-center" style="font-weight: bold;"> <?php echo (isset($language->poor) && $language->poor == 1) ? '&#10003;' : '' ?> </td>
                                    <td class="text-success text-center" style="font-weight: bold;"> <?php echo (isset($language->fair) && $language->fair == 1) ?  '&#10003;' : '' ?> </td>
                                    <td class="text-success text-center" style="font-weight: bold;"> <?php echo (isset($language->fluent) && $language->fluent == 1) ? '&#10003;' : '' ?> </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><b>No Data</b></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="comp3-R">
                        <h5>PREVIOUS EMPLOYMENT IN ABOARD</h5>
                        <table>
                            <thead>
                                <tr>
                                    <th>COUNTRY</th>
                                    <th>PERIOD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applicant_details->ApplicantPreviousEmployeement as $previous_employeement)
                                <tr>
                                    <td>{{$previous_employeement->country}}</td>
                                    <td>{{$previous_employeement->period}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center"><b>No Data</b></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <h5>WORKING EXPERIENCE</h5>
                        <table>
                            <tr>
                                <td style="width: 25%">DECORATING</td>
                                <td style="width: 25%" class="text-success text-center"><?php echo ($applicant_details->decorating == 1) ? '&#10003;' : '' ?></td>
                                <td>WASHING</td>
                                <td class="text-success text-center"><?php echo ($applicant_details->washing == 1) ? '&#10003;' : '' ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%">SEWING</td>
                                <td style="width: 25%" class="text-success text-center"><?php echo ($applicant_details->sewing == 1) ? '&#10003;' : ''  ?></td>
                                <td style="width: 25%">DRIVING</td>
                                <td style="width: 25%" class="text-success text-center"><?php echo ($applicant_details->driving == 1) ? '&#10003;' : ''  ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%">COOKING</td>
                                <td style="width: 25%" class="text-success text-center"><?php echo ($applicant_details->cooking == 1) ? '&#10003;' : ''  ?></td>
                                <td style="width: 25%">BABY SITTING</td>
                                <td style="width: 25%" class="text-success text-center"><?php echo ($applicant_details->baby_sitting == 1) ? '&#10003;' : '' ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%">CLEANING</td>
                                <td style="width: 25%" class="text-success text-center"><?php echo ($applicant_details->cleaning == 1) ? '&#10003;' : '' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            print();
        };
    </script>

</html>