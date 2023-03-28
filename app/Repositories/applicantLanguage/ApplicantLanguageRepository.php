<?php

namespace App\Repositories\applicantLanguage;

use Exception;
use App\Models\ApplicantLanguage;
use App\Repositories\applicantLanguage\ApplicantLanguageInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class ApplicantLanguageRepository implements ApplicantLanguageInterface
{
    public function store($request)
    {
        try {
            if (Gate::denies('create-applicant-language', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create applicant language!');
            }
            $request->validate([
                'language' => 'nullable|sometimes|string|max: 255',
                'poor' => 'nullable|sometimes|string',
                'fair' => 'nullable|sometimes|string',
                'fluent' => 'nullable|sometimes|string',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            ApplicantLanguage::create([
                'language_name' => $request->language,
                'poor' => ($request->poor == 'true') ? 1 : 0,
                'fair' => ($request->fair == 'true') ? 1 : 0,
                'fluent' => ($request->fluent == 'true') ? 1 : 0,
                'applicant_id' => $request->applicant_id,
                'added_by' => auth()->user()->id
            ]);

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Saving applicant language is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Saving applicant language is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Saving applicant language was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving applicant language was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-applicant-language', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to applicant language!');
            }
            $request->validate([
                'language' => 'nullable|sometimes|string|max: 255',
                'poor' => 'nullable|sometimes|string',
                'fair' => 'nullable|sometimes|string',
                'fluent' => 'nullable|sometimes|string',
            ]);

            $applicant_language = ApplicantLanguage::find($id);
            $applicant_language->language_name = $request->language;
            $applicant_language->poor = ($request->poor == 'true') ? 1 : 0;
            $applicant_language->fair = ($request->fair == 'true') ? 1 : 0;
            $applicant_language->fluent = ($request->fluent == 'true') ? 1 : 0;
            $applicant_language->updated_by = auth()->user()->id;
            $applicant_language->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Updating applicant language is successful!';
            Log::channel('daily')->info(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Updating applicant language is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Updating applicant language was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Updating applicant language was unsuccessful!');
        }
    }

    public function show($id)
    {
        try {
            if (Gate::denies('view-applicant-language', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view applicant languages!');
            }
            return ApplicantLanguage::where('applicant_id', $id)->get();
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Accessing applicant language is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function getApplicantLanguage($applicant_lan_id)
    {
        try {
            if (Gate::denies('view-applicant-language', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view applicant languages!');
            }
            return ApplicantLanguage::find($applicant_lan_id);
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Accessing applicant language is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-applicant-language', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete applicant language!');
            }
            $log = [
                'route' => '/api/delete_application_language/id/' . $id,
                'msg' => 'Successfully deleted the applicant language!',
            ];
            Log::channel('daily')->info(json_encode($log));
            $delete_record = ApplicantLanguage::find($id);
            $delete_record->deleted_by = auth()->user()->id;
            $delete_record->save();
            $delete_record->delete();
    
            $logged_user = auth()->user();
            $log['msg'] = 'Deleting applicant language is successful!';
            Log::channel('daily')->info(json_encode($log));
    
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 1, 'msg' => 'Successfully deleted the applicant language!');
        }catch(Exception $ex){
            $logged_user = auth()->user();
            $log['msg'] = 'Accessing applicant language is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
    
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'Applicant language deletion was unsuccessful!');
        }
    }
}
