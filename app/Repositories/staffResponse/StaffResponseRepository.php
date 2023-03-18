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
        // if (Gate::denies('create-application-staff-response', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to create application staff response!');
        // }
        $log = [
            'route' => '/api/save_application_staff_response',
        ];
        try {
            $request->validate([
                'staff_name' => 'nullable|sometimes|string|max: 255',
                'designation' => 'nullable|sometimes|string|max: 255',
                'price' => 'nullable|sometimes|string|max: 255',
                'response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            ApplicationStaffResponse::create([
                'staff_mem_name' => $request->staff_name,
                'designation' => $request->designation,
                'price' => $request->price,
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
        // if (Gate::denies('update-applicant-language', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to applicant language!');
        // }
        $log = [
            'route' => '/api/update_applicant_language/id/' . $id,
        ];
        try {
            $request->validate([
                'staff_name' => 'nullable|sometimes|string|max: 255',
                'designation' => 'nullable|sometimes|string|max: 255',
                'price' => 'nullable|sometimes|string|max: 255',
                'response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            $application_staff_response = ApplicationStaffResponse::find($id);
            $application_staff_response->staff_mem_name = $request->staff_name;
            $application_staff_response->designation = $request->designation;
            $application_staff_response->price = $request->price;
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
        // if (Gate::denies('view-application-staff-response', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view application staff!');
        // }
        $log = [
            'route' => '/api/get_application_staff_response/id/' . $id,
            'msg' => 'Successfully accessed the application staff response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicationStaffResponse::where('applicant_id', $id)->get();
    }

    public function getApplicationStaffResponse($applicant_lan_id)
    {
        // if (Gate::denies('view-application-staff-response', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view application staff response!');
        // }
        $log = [
            'route' => '/api/get_application_staff_response/id/' . $applicant_lan_id,
            'msg' => 'Successfully accessed the applicant staff response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicationStaffResponse::find($applicant_lan_id);
    }

    public function destroy($id)
    {
        // if (Gate::denies('delete-applicant-language', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to delete applicant language!');
        // }
        $log = [
            'route' => '/api/delete_application_staff_response/id/' . $id,
            'msg' => 'Successfully deleted the application staff response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = ApplicationStaffResponse::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the application staff reponse!');
        } else {
            return array('status' => 0, 'msg' => 'Application staff response deletion was unsuccessful!');
        }
    }
}
