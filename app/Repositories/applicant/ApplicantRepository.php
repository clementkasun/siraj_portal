<?php

namespace App\Repositories\applicant;

use Exception;
use App\Models\Applicant;
use App\Models\ApplicantPreviousEmployeement;
use App\Models\Commission;
use App\Repositories\applicant\ApplicantInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SystemNotification;
use Nette\Utils\Random;

class ApplicantRepository implements ApplicantInterface
{
    public function getZeroPaddedNumber($value, $padding, $pad_type = STR_PAD_LEFT)
    {
        return str_pad($value, $padding, "0", STR_PAD_LEFT);
    }

    public function store($request)
    {
        try {
            $logged_user = auth()->user();
            if (Gate::denies('create-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create applicants  as staff member!');
            }
            $request->validate([
                'full_name' => 'nullable|sometimes|string|max: 255',
                'address' => 'nullable|sometimes|string|max: 255',
                'phone_no_one' => 'nullable|sometimes|string|max: 10',
                'phone_no_two' => 'nullable|sometimes|string|max: 10',
                'nic' => 'required|string|max: 20',
                'passport_number' => 'nullable|sometimes|string|max: 100',
                'passport_issue_date' => 'nullable|sometimes|string|max: 255',
                'passport_place_of_issue' => 'nullable|sometimes|string|max: 255',
                'passport_exp_date' => 'nullable|sometimes|string|max: 255',
                'birth_date' => 'nullable|sometimes|string|max: 255',
                'gender' => 'nullable|sometimes|string|max: 8',
                'height' => 'nullable|sometimes|string|max: 20',
                'weight' => 'nullable|sometimes|string|max: 5',
                'complexion' =>  'nullable|sometimes|string|max: 255',
                'nationality' => 'nullable|sometimes|string|max: 255',
                'religion' => 'nullable|sometimes|string|max: 255',
                'maritial_status' => 'nullable|sometimes|string|max: 10',
                'number_of_children' => 'nullable|sometimes|string|max: 2',
                'applied_post' => 'nullable|sometimes|string|max: 255',
                'applied_country' => 'nullable|sometimes|string|max: 255',
                'post_status' => 'nullable|sometimes|string|max: 1',
                'edu_qualifications' => 'nullable|sometimes|string|max: 255',
                'monthly_sallary' => 'nullable|sometimes|string|max: 255',
                'passport_pdf' => 'nullable|sometimes',
                'nic_pdf' => 'nullable|sometimes',
                'police_record_pdf' => 'nullable|sometimes',
                'gs_certificate_pdf' => 'nullable|sometimes',
                'family_back_pdf' => 'nullable|sometimes',
                'visa_pdf' => 'nullable|sometimes',
                'medical_pdf' => 'nullable|sometimes',
                'agreement_pdf' => 'nullable|sometimes',
                'personal_form_pdf' => 'nullable|sometimes',
                'job_order_pdf' => 'nullable|sometimes',
                'ticket_pdf' => 'nullable|sometimes',
                'applicant_image' => 'nullable|sometimes',
                'agency_agreement_pdf' => 'nullable|sometimes',
                'other_pdf' => 'nullable|sometimes',
                'hform_pdf' => 'nullable|sometimes',
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
                'passport_place_of_issue' => $request->passport_place_of_issue,
                'passport_exp_date' => $request->passport_exp_date,
                'birth_date' => $request->birth_date,
                'sex' => $request->gender,
                'height' => $request->height,
                'weight' => $request->weight,
                'complexion' => $request->complexion,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'maritial_status' => $request->maritial_status,
                'number_of_children' => $request->number_of_children,
                'applied_post' => $request->applied_post,
                'edu_qaulification' => $request->edu_qualifications,
                'applied_country' => $request->applied_country,
                'post_status' => $request->post_status,
                'monthly_sallary' => $request->monthly_sallary,
                'commision_price' => $request->commision_price,
                'decorating' => ($request->decorating == 'true') ? 1 : 0,
                'baby_sitting' => ($request->baby_sitting == 'true') ? 1 : 0,
                'cleaning' => ($request->cleaning == 'true') ? 1 : 0,
                'cooking' => ($request->cooking == 'true') ? 1 : 0,
                'sewing' => ($request->sewing == 'true') ? 1 : 0,
                'washing' => ($request->washing == 'true') ? 1 : 0,
                'driving' => ($request->driving == 'true') ? 1 : 0,
                'added_by' => auth()->user()->id,
            ]);

            $applicant->reff_no = $this->getZeroPaddedNumber($applicant->id, 5);

            $documents = [
                'passport_pdf' => $request->passport_pdf,
                'nic_pdf' => $request->nic_pdf,
                'police_record_pdf' => $request->police_record_pdf,
                'gs_certificate_pdf' => $request->gs_certificate_pdf,
                'family_back_pdf' => $request->family_back_pdf,
                'visa_pdf' => $request->visa_pdf,
                'medical_pdf' => $request->medical_pdf,
                'agreement_pdf' => $request->aggreement_pdf,
                'personal_form_pdf' => $request->personal_form_pdf,
                'job_order_pdf' => $request->job_order_pdf,
                'ticket_pdf' => $request->ticket_pdf,
                'agency_agreement_pdf' => $request->agency_agreement_pdf,
                'other_pdf' => $request->other_pdf,
                'hform_pdf' => $request->hform_pdf
            ];

            foreach ($documents as $key => $document) {
                if ($request->hasFile($key)) {
                    $path = 'applicant/' . $applicant->id;
                    Storage::disk('public')->makeDirectory($path);
                    $applicant->$key = Storage::disk('public')->put($path . '/', $request->file($key));
                }
            }

            if ($request->hasFile('applicant_image_passport')) {
                $path = public_path('/storage/applicant/' . $applicant->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($applicant->id);

                $applicant_img     = $request->file('applicant_image_passport');
                $applicant_img_ext    = $applicant_img->extension();

                // I am saying to create the dir if it's not there.
                $applicant_img = \Image::make($applicant_img->getRealPath());
                $applicant_img->save($path . $random_name . '.' . $applicant_img_ext);
                $applicant_img_path = '/storage/applicant/' . $applicant->id . '/' . $random_name . '.' . $applicant_img_ext;
                $applicant->applicant_image_passport = $applicant_img_path;
            }

            if ($request->hasFile('applicant_image_full_size')) {
                $path = public_path('/storage/applicant/' . $applicant->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($applicant->id);

                $applicant_img     = $request->file('applicant_image_full_size');
                $applicant_img_ext    = $applicant_img->extension();

                // I am saying to create the dir if it's not there.
                $applicant_img = \Image::make($applicant_img->getRealPath());
                $applicant_img->save($path . $random_name . '.' . $applicant_img_ext);
                $applicant_img_path = '/storage/applicant/' . $applicant->id . '/' . $random_name . '.' . $applicant_img_ext;
                $applicant->applicant_image_full_size = $applicant_img_path;
            }

            $applicant->save();

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Saving applicant is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Saving applicant is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Applicant saving was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving applicant was unsuccessful!');
        }
    }

    public function editApplicant($id)
    {
        try {
            if (Gate::denies('update-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to update the applicant as a staff member!');
            }
            return view('applicant.registration', array('applicant_data' => Applicant::find($id)));
        } catch (Exception $ex) {
            $log['msg'] = 'Edit Applicant was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to applicant!');
            }
            $request->validate([
                'full_name' => 'nullable|sometimes|string|max: 255',
                'address' => 'nullable|sometimes|string|max: 255',
                'phone_no_one' => 'nullable|sometimes|string|max: 10',
                'phone_no_two' => 'nullable|sometimes|string|max: 10',
                'nic' => 'required|string|max: 20',
                'passport_number' => 'nullable|sometimes|string|max: 100',
                'passport_issue_date' => 'nullable|sometimes|string|max: 255',
                'passport_place_of_issue' => 'nullable|sometimes|string|max: 255',
                'passport_exp_date' => 'nullable|sometimes|string|max: 255',
                'birth_date' => 'nullable|sometimes|string|max: 255',
                'gender' => 'nullable|sometimes|string|max: 8',
                'height' => 'nullable|sometimes|string|max: 20',
                'weight' => 'nullable|sometimes|string|max: 5',
                'complexion' =>  'nullable|sometimes|string|max: 255',
                'nationality' => 'nullable|sometimes|string|max: 255',
                'religion' => 'nullable|sometimes|string|max: 255',
                'maritial_status' => 'nullable|sometimes|string|max: 10',
                'number_of_children' => 'nullable|sometimes|string|max: 2',
                'applied_post' => 'nullable|sometimes|string|max: 255',
                'applied_country' => 'nullable|sometimes|string|max: 255',
                'post_status' => 'nullable|sometimes|string|max: 1',
                'edu_qualifications' => 'nullable|sometimes|string|max: 255',
                'monthly_sallary' => 'nullable|sometimes|string|max: 255',
                'passport_pdf' => 'nullable|sometimes',
                'nic_pdf' => 'nullable|sometimes',
                'police_record_pdf' => 'nullable|sometimes',
                'gs_certificate_pdf' => 'nullable|sometimes',
                'family_back_pdf' => 'nullable|sometimes',
                'visa_pdf' => 'nullable|sometimes',
                'medical_pdf' => 'nullable|sometimes',
                'agreement_pdf' => 'nullable|sometimes',
                'personal_form_pdf' => 'nullable|sometimes',
                'job_order_pdf' => 'nullable|sometimes',
                'ticket_pdf' => 'nullable|sometimes',
                'agency_agreement_pdf' => 'nullable|sometimes',
                'other_pdf' => 'nullable|sometimes',
                'hform_pdf' => 'nullable|sometimes',
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
            $applicant->passport_place_of_issue = $request->passport_place_of_issue;
            $applicant->passport_exp_date = $request->passport_exp_date;
            $applicant->birth_date = $request->birth_date;
            $applicant->sex = $request->gender;
            $applicant->height = $request->height;
            $applicant->weight = $request->weight;
            $applicant->complexion = $request->complexion;
            $applicant->nationality = $request->nationality;
            $applicant->religion = $request->religion;
            $applicant->maritial_status = $request->maritial_status;
            $applicant->number_of_children = $request->number_of_children;
            $applicant->applied_post = $request->applied_post;
            $applicant->edu_qaulification = $request->edu_qualifications;
            $applicant->applied_country = $request->applied_country;
            $applicant->post_status = $request->post_status;
            $applicant->monthly_sallary = $request->monthly_sallary;
            $applicant->commision_price = $request->commision_price;
            $applicant->decorating = ($request->decorating == 'true') ? 1 : 0;
            $applicant->baby_sitting = ($request->baby_sitting == 'true') ? 1 : 0;
            $applicant->cleaning = ($request->cleaning == 'true') ? 1 : 0;
            $applicant->cooking = ($request->cooking == 'true') ? 1 : 0;
            $applicant->sewing = ($request->sewing == 'true') ? 1 : 0;
            $applicant->washing = ($request->washing == 'true') ? 1 : 0;
            $applicant->driving = ($request->driving == 'true') ? 1 : 0;
            $applicant->updated_by = auth()->user()->id;

            $documents = [
                'passport_pdf' => $request->passport_pdf,
                'nic_pdf' => $request->nic_pdf,
                'police_record_pdf' => $request->police_record_pdf,
                'gs_certificate_pdf' => $request->gs_certificate_pdf,
                'family_back_pdf' => $request->family_back_pdf,
                'visa_pdf' => $request->visa_pdf,
                'medical_pdf' => $request->medical_pdf,
                'agreement_pdf' => $request->aggreement_pdf,
                'personal_form_pdf' => $request->personal_form_pdf,
                'job_order_pdf' => $request->job_order_pdf,
                'ticket_pdf' => $request->ticket_pdf,
                'agency_agreement_pdf' => $request->agency_agreement_pdf,
                'other_pdf' => $request->other_pdf,
                'hform_pdf' => $request->hform_pdf
            ];

            foreach ($documents as $key => $document) {
                if ($request->hasFile($key)) {
                    $path = 'applicant/' . $applicant->id;
                    Storage::disk('public')->makeDirectory($path);
                    $applicant->$key = Storage::disk('public')->put($path . '/', $request->file($key));
                }
            }

            if ($request->hasFile('applicant_image_passport')) {
                $path = public_path('/storage/applicant/' . $applicant->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($applicant->id);

                $applicant_img     = $request->file('applicant_image_passport');
                $applicant_img_ext    = $applicant_img->extension();

                // I am saying to create the dir if it's not there.
                $applicant_img = \Image::make($applicant_img->getRealPath());
                $applicant_img->save($path . $random_name . '.' . $applicant_img_ext);
                $applicant_img_path = '/storage/applicant/' . $applicant->id . '/' . $random_name . '.' . $applicant_img_ext;
                $applicant->applicant_image_passport = $applicant_img_path;
            }

            if ($request->hasFile('applicant_image_full_size')) {
                $path = public_path('/storage/applicant/' . $applicant->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($applicant->id);

                $applicant_img     = $request->file('applicant_image_full_size');
                $applicant_img_ext    = $applicant_img->extension();

                // I am saying to create the dir if it's not there.
                $applicant_img = \Image::make($applicant_img->getRealPath());
                $applicant_img->save($path . $random_name . '.' . $applicant_img_ext);
                $applicant_img_path = '/storage/applicant/' . $applicant->id . '/' . $random_name . '.' . $applicant_img_ext;
                $applicant->applicant_image_full_size = $applicant_img_path;
            }

            $applicant->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Saving applicant is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Updating candidate is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Updating applicant was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Updating applicant was unsuccessful!');
        }
    }

    public function getApplicantDetail($id)
    {
        try {
            if (Gate::denies('view-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view applicants as staff!');
            }
            return Applicant::find($id);
        } catch (Exception $ex) {
            $log['msg'] = 'Updating applicant was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function applicantProfile($id)
    {
        try {
            if (Gate::denies('view-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view applicant as staff!');
            }

            $applicant_data = Applicant::find($id);
            return view('applicant.applicant_profile', [
                'applicant_data' => $applicant_data,
                'commision_price' => $applicant_data->commision_price,
                'paid_total_commision' => Commission::where('applicant_id', $id)->sum('price'),
                'post_status_array' => Applicant::find($id)->post_status_array,
                'previous_emp_count' => ApplicantPreviousEmployeement::where('applicant_id', $id)->count()
            ]);
        } catch (Exception $ex) {
            $log['msg'] = 'accessing applicant profile was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function viewApplication($id)
    {
        try {
            if (Gate::denies('view-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view applicants as staff!');
            }
            $applicant_details = Applicant::where('id', $id)
                ->with([
                    'ApplicantEducationalQualification',
                    'ApplicantLanguage',
                    'ApplicantPreviousEmployeement' => function ($prev_emp) {
                        $prev_emp->orderBy('id', 'DESC')->limit(3);
                    },
                    'ApplicationStaffResponse',
                    'Commission'
                ])
                ->first();
            return view('applicant.application', array('applicant_details' => $applicant_details));
        } catch (Exception $ex) {
            $log['msg'] = 'accessing applicant application was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function show()
    {
        try {
            if (Gate::denies('view-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view applicants as staff!');
            }
            $log = [
                'route' => '/api/get_applicants',
                'msg' => 'Successfully accessed the applicants!',
            ];
            Log::channel('daily')->info(json_encode($log));
            return Applicant::all();
        } catch (Exception $ex) {
            $log['msg'] = 'accessing applicants details was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-offline-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete applicant as staff!');
            }
            $log = [
                'route' => '/api/delete_applicant/id/' . $id,
                'msg' => 'Successfully deleted the applicant!',
            ];
            Log::channel('daily')->info(json_encode($log));
    
            $logged_user = auth()->user();
            $applicant = Applicant::find($id);
            $applicant->deleted_by = $logged_user->id;
            $applicant->save();
            $status = $applicant->delete();

            $log['msg'] = 'Successfully deleted the applicant!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return array('status' => 1, 'msg' => 'Successfully deleted the applicant!');
        }catch(Exception $ex){
            $logged_user = auth()->user();
            $log['msg'] = 'Applicant deletion was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Applicant deletion was unsuccessful!');
        }
    }
}
