<?php

namespace App\Repositories\applicant;

use Exception;
use App\Models\Applicant;
use App\Models\ApplicantEducationalQualification;
use App\Models\ApplicantLanguage;
use App\Models\ApplicantPreviousEmployeement;
use App\Models\ApplicationStaffResponse;
use App\Repositories\applicant\ApplicantInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SystemNotification;
use Nette\Utils\Random;

class ApplicantRepository implements ApplicantInterface
{
    public function getZeroPaddedNumber($value, $padding, $pad_type = STR_PAD_LEFT) {
        return str_pad($value, $padding, "0", STR_PAD_LEFT);
    }

    public function store($request)
    {
        // if (Gate::denies('create-applicant', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to applicant!');
        // }
        $log = [
            'route' => '/api/save_applicant',
        ];
        try {
            $request->validate([
                'full_name' => 'nullable|sometimes|string|max: 255',
                'address' => 'nullable|sometimes|string|max: 255',
                'phone_no_one' => 'nullable|sometimes|string|max: 10',
                'phone_no_two' => 'nullable|sometimes|string|max: 10',
                'nic' => 'required|string|max: 20',
                'passport_number' => 'nullable|sometimes|string|max: 100',
                'passport_issue_date' => 'nullable|sometimes|string|max: 255',
                'passport_exp_date' => 'nullable|sometimes|string|max: 255',
                'birth_date' => 'nullable|sometimes|string|max: 255',
                'gender' => 'nullable|sometimes|string|max: 8',
                'weight' => 'nullable|sometimes|string|max: 5',
                'complexion' =>  'nullable|sometimes|string|max: 255',
                'nationality' => 'nullable|sometimes|string|max: 255',
                'religion' => 'nullable|sometimes|string|max: 255',
                'maritial_status' => 'nullable|sometimes|string|max: 10',
                'number_of_children' => 'nullable|sometimes|string|max: 2',
                'applied_post' => 'nullable|sometimes|string|max: 255',
                'applied_country' => 'nullable|sometimes|string|max: 255',
                'post_status' => 'nullable|sometimes|string|max: 1',
                'passport_pdf' => 'nullable|sometimes',
                'nic_pdf' => 'nullable|sometimes',
                'police_record_pdf' => 'nullable|sometimes',
                'gs_certificate_pdf' => 'nullable|sometimes',
                'family_back_pdf' => 'nullable|sometimes',
                'visa_pdf' => 'nullable|sometimes',
                'medical_pdf' => 'nullable|sometimes',
                'aggreement_pdf' => 'nullable|sometimes',
                'personal_form_pdf' => 'nullable|sometimes',
                'job_order_pdf' => 'nullable|sometimes',
                'ticket_pdf' => 'nullable|sometimes',
                'applicant_image' => 'nullable|sometimes',
                'agency_aggrement_pdfagency_aggrement_pdf' => 'nullable|sometimes',
                'commision_price' => 'nullable|string',
                'decorating' => 'nullable|sometimes|string',
                'baby_sitting' => 'nullable|sometimes|string',
                'cleaning' => 'nullable|sometimes|string',
                'cooking' => 'nullable|sometimes|string',
                'sewing' => 'nullable|sometimes|string',
                'washing' => 'nullable|sometimes|string',
                'driving' => 'nullable|sometimes|string'
            ]);

            $applicant = Applicant::create([
                'full_name' => $request->full_name,
                'address' => $request->address,
                'phone_no_01' => $request->phone_no_one,
                'phone_no_02' => $request->phone_no_two,
                'nic' => $request->nic,
                'passport_no' => $request->passport_number,
                'passport_issue_date' => $request->passport_issue_date,
                'passport_exp_date' => $request->passport_exp_date,
                'birth_date' => $request->birth_date,
                'sex' => $request->gender,
                'weight' => $request->weight,
                'complexion' => $request->complexion,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'maritial_status' => $request->maritial_status,
                'number_of_children' => $request->number_of_children,
                'applied_post' => $request->applied_post,
                'applied_country' => $request->applied_country,
                'post_status' => $request->post_status,
                'commision_price' => $request->commision_price,
                'decorating' => ($request->decorating == 'true') ? 1 : 0,
                'baby_sitting' => ($request->baby_sitting == 'true') ? 1 : 0,
                'cleaning' => ($request->cleaning == 'true') ? 1 : 0,
                'cooking' => ($request->cooking == 'true') ? 1 : 0,
                'sewing' => ($request->sewing == 'true') ? 1 : 0,
                'washing' => ($request->washing == 'true') ? 1 : 0,
                'driving' => ($request->driving == 'true') ? 1 : 0
            ]);

            $applicant->reff_no = $this->getZeroPaddedNumber($applicant->id,10);
            $applicant->save();

            $documents = [
                'passport_pdf' => $request->passport_pdf,
                'nic_pdf' => $request->nic_pdf,
                'police_record_pdf' => $request->police_record_pdf,
                'gs_certificate_pdf' => $request->gs_certificate_pdf,
                'family_back_pdf' => $request->family_back_pdf,
                'visa_pdf' => $request->visa_pdf,
                'medical_pdf' => $request->medical_pdf,
                'aggreement_pdf' => $request->aggreement_pdf,
                'personal_form_pdf' => $request->personal_form_pdf,
                'job_order_pdf' => $request->job_order_pdf,
                'ticket_pdf' => $request->ticket_pdf,
                'agency_aggrement_pdf' => $request->agency_aggrement_pdf
            ];

            foreach ($documents as $key => $document) {
                if ($request->hasFile($key)) {
                    $path = 'applicant/' . $applicant->id;
                    Storage::disk('public')->makeDirectory($path);
                    $path = Storage::disk('public')->put($path . '/', $request->file($key));
                    $applicant->$key = $path;
                    $applicant->save();
                }
            }

            if ($request->hasFile('applicant_image')) {
                $path = public_path('/storage/applicant/' . $applicant->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($applicant->id);

                $applicant_img     = $request->file('applicant_image');
                $applicant_img_ext    = $applicant_img->extension();

                // I am saying to create the dir if it's not there.
                $applicant_img = \Image::make($applicant_img->getRealPath())->resize(500, 500);
                $applicant_img->save($path . $random_name . '.' . $applicant_img_ext);
                $applicant_img_path = '/storage/applicant/' . $applicant->id . '/' . $random_name . '.' . $applicant_img_ext;
                $applicant->applicant_image = $applicant_img_path;
                $applicant->save();
            }

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving applicant is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving applicant is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving candidate was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving applicant was unsuccessful!');
        }
    }

    public function editApplicant($id)
    {
        return view('applicant.registration', array('applicant_data' => Applicant::find($id)));
    }

    public function update($request, $id)
    {
        // if (Gate::denies('update-applicant', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to applicant!');
        // }
        $log = [
            'route' => '/api/update_applicant/id/' . $id,
        ];
        try {
            $request->validate([
                'full_name' => 'nullable|sometimes|string|max: 255',
                'address' => 'nullable|sometimes|string|max: 255',
                'phone_no_one' => 'nullable|sometimes|string|max: 10',
                'phone_no_two' => 'nullable|sometimes|string|max: 10',
                'nic' => 'required|string|max: 20',
                'passport_number' => 'nullable|sometimes|string|max: 100',
                'passport_issue_date' => 'nullable|sometimes|string|max: 255',
                'passport_exp_date' => 'nullable|sometimes|string|max: 255',
                'birth_date' => 'nullable|sometimes|string|max: 255',
                'gender' => 'nullable|sometimes|string|max: 8',
                'weight' => 'nullable|sometimes|string|max: 5',
                'complexion' =>  'nullable|sometimes|string|max: 255',
                'nationality' => 'nullable|sometimes|string|max: 255',
                'religion' => 'nullable|sometimes|string|max: 255',
                'maritial_status' => 'nullable|sometimes|string|max: 10',
                'number_of_children' => 'nullable|sometimes|string|max: 2',
                'applied_post' => 'nullable|sometimes|string|max: 255',
                'applied_country' => 'nullable|sometimes|string|max: 255',
                'post_status' => 'nullable|sometimes|string|max: 1',
                'passport_pdf' => 'nullable|sometimes',
                'nic_pdf' => 'nullable|sometimes',
                'police_record_pdf' => 'nullable|sometimes',
                'gs_certificate_pdf' => 'nullable|sometimes',
                'family_back_pdf' => 'nullable|sometimes',
                'visa_pdf' => 'nullable|sometimes',
                'medical_pdf' => 'nullable|sometimes',
                'aggreement_pdf' => 'nullable|sometimes',
                'personal_form_pdf' => 'nullable|sometimes',
                'job_order_pdf' => 'nullable|sometimes',
                'ticket_pdf' => 'nullable|sometimes',
                'agency_aggrement_pdf' => 'nullable|sometimes',
                'commision_price' => 'nullable|string',
                'decorating' => 'nullable|sometimes|string',
                'baby_sitting' => 'nullable|sometimes|string',
                'cleaning' => 'nullable|sometimes|string',
                'cooking' => 'nullable|sometimes|string',
                'sewing' => 'nullable|sometimes|string',
                'washing' => 'nullable|sometimes|string',
                'driving' => 'nullable|sometimes|string'
            ]);

            $applicant = Applicant::find($id);
            $applicant->full_name = $request->full_name;
            $applicant->address = $request->address;
            $applicant->phone_no_01 = $request->phone_no_one;
            $applicant->phone_no_02 = $request->phone_no_two;
            $applicant->nic = $request->nic;
            $applicant->passport_no = $request->passport_number;
            $applicant->passport_issue_date = $request->passport_issue_date;
            $applicant->passport_exp_date = $request->passport_exp_date;
            $applicant->birth_date = $request->birth_date;
            $applicant->sex = $request->gender;
            $applicant->weight = $request->weight;
            $applicant->complexion = $request->complexion;
            $applicant->nationality = $request->nationality;
            $applicant->religion = $request->religion;
            $applicant->maritial_status = $request->maritial_status;
            $applicant->number_of_children = $request->number_of_children;
            $applicant->applied_post = $request->applied_post;
            $applicant->applied_country = $request->applied_country;
            $applicant->post_status = $request->post_status;
            $applicant->commision_price = $request->commision_price;
            $applicant->decorating = ($request->decorating == 'true') ? 1 : 0;
            $applicant->baby_sitting = ($request->baby_sitting == 'true') ? 1 : 0;
            $applicant->cleaning = ($request->cleaning == 'true') ? 1 : 0;
            $applicant->cooking = ($request->cooking == 'true') ? 1 : 0;
            $applicant->sewing = ($request->sewing == 'true') ? 1 : 0;
            $applicant->washing = ($request->washing == 'true') ? 1 : 0;
            $applicant->driving = ($request->driving == 'true') ? 1 : 0;
            $applicant->save();
            
            $documents = [
                'passport_pdf' => $request->passport_pdf,
                'nic_pdf' => $request->nic_pdf,
                'police_record_pdf' => $request->police_record_pdf,
                'gs_certificate_pdf' => $request->gs_certificate_pdf,
                'family_back_pdf' => $request->family_back_pdf,
                'visa_pdf' => $request->visa_pdf,
                'medical_pdf' => $request->medical_pdf,
                'aggreement_pdf' => $request->aggreement_pdf,
                'personal_form_pdf' => $request->personal_form_pdf,
                'job_order_pdf' => $request->job_order_pdf,
                'ticket_pdf' => $request->ticket_pdf,
                'agency_aggrement_pdf' => $request->agency_aggrement_pdf
            ];

            foreach ($documents as $key => $document) {
                if ($request->hasFile($key)) {
                    $path = '/applicant/' . $applicant->id;
                    Storage::disk('public')->makeDirectory($path);
                    $path = Storage::disk('public')->put($path . '/', $request->file($key));
                    $applicant->$key = $path;
                    $applicant->save();
                }
            }

            if ($request->hasFile('applicant_image')) {
                $path = public_path('/storage/applicant/' . $applicant->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($applicant->id);

                $applicant_img     = $request->file('applicant_image');
                $applicant_img_ext    = $applicant_img->extension();

                // I am saying to create the dir if it's not there.
                $applicant_img = \Image::make($applicant_img->getRealPath())->resize(500, 500);
                $applicant_img->save($path . $random_name . '.' . $applicant_img_ext);
                $applicant_img_path = '/storage/applicant/' . $applicant->id . '/' . $random_name . '.' . $applicant_img_ext;
                $applicant->applicant_image = $applicant_img_path;
                $applicant->save();
            }

            $user = auth()->user();
            $msg = $log['msg'];
            Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating applicant is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating candidate is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating applicant was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating applicant was unsuccessful!');
        }
    }

    public function getApplicantDetail($id)
    {
        // if (Gate::denies('view-applicant', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view applicants!');
        // }
        $log = [
            'route' => '/api/get_applicant/id/' . $id,
            'msg' => 'Successfully accessed the applicant details!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Applicant::find($id);
    }

    public function applicantProfile($id)
    {
        // if (Gate::denies('view-applicant', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view applicant!');
        // }
        $log = [
            'route' => '/api/applicant_profile/id/' . $id,
            'msg' => 'Successfully accessed the applicant details!',
        ];
        Log::channel('daily')->info(json_encode($log));

        $applicant_data = Applicant::find($id);
        return view('applicant.applicant_profile', array('applicant_data' => $applicant_data));
    }

    public function viewApplication($id)
    {
        $applicant_details = Applicant::where('id', $id)
            ->with([
                'ApplicantEducationalQualification',
                'ApplicantLanguage',
                'ApplicantPreviousEmployeement',
                'ApplicationStaffResponse',
                'Commission'
            ])->first();
        return view('applicant.applicant_application', array('applicant_details' => $applicant_details));
    }

    public function show()
    {
        // if (Gate::denies('view-applicants', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view applicants!');
        // }
        $log = [
            'route' => '/api/get_applicants',
            'msg' => 'Successfully accessed the applicants!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Applicant::all();
    }

    public function destroy($id)
    {
        // if (Gate::denies('delete-applicant', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to delete applicant!');
        // }
        $log = [
            'route' => '/api/delete_applicant/id/' . $id,
            'msg' => 'Successfully deleted the applicant!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = Applicant::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the applicant!');
        } else {
            return array('status' => 0, 'msg' => 'Applicant deletion was unsuccessful!');
        }
    }
}
