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
        if (Gate::denies('create-applicant-language', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to create applicant language!');
        }
        $log = [
            'route' => '/api/save_applicant_language',
        ];
        try {
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
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving applicant language is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving applicant language is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving applicant language was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving applicant language was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-applicant-language', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to applicant language!');
        }
        $log = [
            'route' => '/api/update_applicant_language/id/' . $id,
        ];
        try {
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
            $applicant_language->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating applicant language is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating applicant language is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating applicant language was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating applicant language was unsuccessful!');
        }
    }

    public function show($id)
    {
        if (Gate::denies('view-applicant-language', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view applicant languages!');
        }
        $log = [
            'route' => '/api/get_applicant_languages/id/' . $id,
            'msg' => 'Successfully accessed the applicant languages!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantLanguage::where('applicant_id', $id)->get();
    }

    public function getApplicantLanguage($applicant_lan_id)
    {
        if (Gate::denies('view-applicant-languages', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view applicant languages!');
        }
        $log = [
            'route' => '/api/get_applicant_language/id/' . $applicant_lan_id,
            'msg' => 'Successfully accessed the applicant languages!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantLanguage::find($applicant_lan_id);
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-applicant-language', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to delete applicant language!');
        }
        $log = [
            'route' => '/api/delete_application_language/id/' . $id,
            'msg' => 'Successfully deleted the applicant language!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = ApplicantLanguage::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the applicant language!');
        } else {
            return array('status' => 0, 'msg' => 'Applicant language deletion was unsuccessful!');
        }
    }
}
