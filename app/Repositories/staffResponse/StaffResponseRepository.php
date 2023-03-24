<?php

namespace App\Repositories\staffResponse;

use Exception;
use App\Models\ApplicationStaffResponse;
use App\Repositories\staffResponse\StaffResponseInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class StaffResponseRepository implements StaffResponseInterface
{
    public function store($request)
    {
        if (Gate::denies('create-application-staff-resp', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to create application staff response!');
        }
        $log = [
            'route' => '/api/save_application_staff_response',
        ];
        try {
            $request->validate([
                'response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            ApplicationStaffResponse::create([
                'staff_mem_name' => auth()->user()->first_name.' '.auth()->user()->last_name,
                'designation' => auth()->user()->role_id,
                'response' => $request->response,
                'applicant_id' => $request->applicant_id,
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving application staff response is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving applicant language is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving application staff response was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving application staff response was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-application-staff-resp', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to application staff response!');
        }
        $log = [
            'route' => '/api/update_applicant_language/id/' . $id,
        ];
        try {
            $request->validate([
                'response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            $application_staff_response = ApplicationStaffResponse::find($id);
            $application_staff_response->staff_mem_name = auth()->user()->first_name.' '.auth()->user()->last_name;
            $application_staff_response->designation = auth()->user()->role_id;
            $application_staff_response->response = $request->response;
            $application_staff_response->applicant_id = $request->applicant_id;
            $application_staff_response->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating application staff response is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating application staff response is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating application staff response was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating application staff response was unsuccessful!');
        }
    }

    public function show($id)
    {
        if (Gate::denies('view-application-staff-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view application staff response!');
        }
        $log = [
            'route' => '/api/get_application_staff_response/id/' . $id,
            'msg' => 'Successfully accessed the application staff response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicationStaffResponse::where('applicant_id', $id)->with(['Applicant', 'designation'])->get();
    }

    public function getApplicationStaffResponse($applicant_lan_id)
    {
        if (Gate::denies('view-application-staff-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view application staff response!');
        }
        $log = [
            'route' => '/api/get_application_staff_response/id/' . $applicant_lan_id,
            'msg' => 'Successfully accessed the applicant staff response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicationStaffResponse::where('applicant_id', $applicant_lan_id)->with(['Applicant', 'designation'])->first();
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-application-staff-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to delete application staff response!');
        }
        $log = [
            'route' => '/api/delete_application_staff_response/id/' . $id,
            'msg' => 'Successfully deleted the application staff response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = ApplicationStaffResponse::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the application staff response!');
        } else {
            return array('status' => 0, 'msg' => 'Application staff response deletion was unsuccessful!');
        }
    }
}
