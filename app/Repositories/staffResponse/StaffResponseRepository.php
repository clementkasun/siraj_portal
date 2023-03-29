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
        try {
            if (Gate::denies('create-application-staff-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create application staff response!');
            }
            $request->validate([
                'response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            ApplicationStaffResponse::create([
                'staff_mem_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'designation' => auth()->user()->role_id,
                'response' => $request->response,
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
            $log['msg'] = 'Saving application staff response was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving application staff response was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-application-staff-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to application staff response!');
            }
            $request->validate([
                'response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            $application_staff_response = ApplicationStaffResponse::find($id);
            $application_staff_response->staff_mem_name = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $application_staff_response->designation = auth()->user()->role_id;
            $application_staff_response->response = $request->response;
            $application_staff_response->applicant_id = $request->applicant_id;
            $application_staff_response->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Updating application staff response is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Updating application staff response is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Updating application staff response was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Updating application staff response was unsuccessful!');
        }
    }

    public function show($id)
    {
        try {
            if (Gate::denies('view-application-staff-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view application staff response!');
            }
            $log = [
                'URI' => '/api/get_application_staff_response/id/' . $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            return ApplicationStaffResponse::where('applicant_id', $id)->with(['Applicant', 'designation'])->get();
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing is applicant reponse was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->info(json_encode($log));
        }
    }

    public function getApplicationStaffResponse($applicant_lan_id)
    {
        try {
            if (Gate::denies('view-application-staff-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view application staff response!');
            }
            $log = [
                'URI' => '/api/get_application_staff_response/id/' . $applicant_lan_id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            Log::channel('daily')->info(json_encode($log));
            return ApplicationStaffResponse::where('applicant_id', $applicant_lan_id)->with(['Applicant', 'designation'])->first();
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing is applicant staff response was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->info(json_encode($log));
        }
    }

    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-application-staff-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete application staff response!');
            }
            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_application_staff_response/id/' . $id,
                'METHOD' => 'DELETE',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            ApplicationStaffResponse::find($id)->delete();
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Successfully deleted the application staff response!');
        }catch(Exception $ex){
            $logged_user = auth()->user();
            $log['msg'] = 'Application staff response deletion was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return array('status' => 0, 'msg' => 'Application staff response deletion was unsuccessful!');
        }
    }
}
