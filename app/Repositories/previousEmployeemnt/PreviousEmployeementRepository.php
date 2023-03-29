<?php

namespace App\Repositories\previousEmployeemnt;

use App\Models\ApplicantPreviousEmployeement;
use Exception;
use App\Repositories\previousEmployeemnt\PreviousEmployeementInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SystemNotification;

class PreviousEmployeementRepository implements PreviousEmployeementInterface
{
    public function store($request)
    {
        try {
            if (Gate::denies('create-previous-emp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create previous employeement!');
            }

            $request->validate([
                'job_type' => 'nullable|sometimes|string|max:255',
                'country' => 'nullable|sometimes|string|max:255',
                'period' => 'nullable|sometimes|string|max:255',
                'applicant_id' => 'nullable|sometimes|string|max:255'
            ]);

            ApplicantPreviousEmployeement::create([
                'job_type' => $request->job_type,
                'country' => $request->country,
                'period' => $request->period,
                'added_by' => auth()->user()->id,
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

            $log['msg'] = 'Saving previous employeement is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));;

            return array('status' => 1, 'msg' => 'Saving previous employeement is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Saving previous employeement was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving previous employeement was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-previous-emp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to update previous employeement!');
            }
            $request->validate([
                'job_type' => 'nullable|sometimes|string|max:255',
                'period' => 'nullable|sometimes|string|max:255',
                'country' => 'nullable|sometimes|string|max:255',
                'applicant_id' => 'nullable|sometimes|string|max:255'
            ]);

            $previous_emp = ApplicantPreviousEmployeement::find($id);
            $previous_emp->job_type = $request->job_type;
            $previous_emp->country = $request->country;
            $previous_emp->period = $request->period;
            $previous_emp->added_by = auth()->user()->id;
            $previous_emp->applicant_id = $request->applicant_id;
            $previous_emp->updated_by = auth()->user()->id;
            $previous_emp->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Updating previous employeement is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Updating previous employeement is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Updating previous employeement was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Updating previous employeement was unsuccessful!');
        }
    }

    public function getPreviousEmployeement($id)
    {
        try{
            if (Gate::denies('view-previous-emp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view previous employeement!');
            }
            $log = [
                'URI' => '/api/get_previous_experience/id/' . $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => ApplicantPreviousEmployeement::where('id', $id)->with('AddedBy')->first() 
            ];
    
            $log['msg'] = 'Access previous employeement is successful!';
            Log::channel('daily')->info(json_encode($log));
            return ApplicantPreviousEmployeement::where('id', $id)->with('AddedBy')->first();
        }catch(Exception $ex){
            $log['msg'] = 'Access previous employeement is successful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function show($id)
    {
        try{
            if (Gate::denies('view-previous-emp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view previous employeement!');
            }
            $log = [
                'URI' => '/api/get_previous_employeements/id/'. $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => ApplicantPreviousEmployeement::where('applicant_id', $id)->with('AddedBy')->get() 
            ];
            $log['msg'] = 'Access previous employeements is successful!';
            Log::channel('daily')->info(json_encode($log));
            return ApplicantPreviousEmployeement::where('applicant_id', $id)->with('AddedBy')->get();
        }catch(Exception $ex){
            $log['msg'] = 'Access previous employeements is successful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-previous-emp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete previous employeement!');
            }
            $delete_record = ApplicantPreviousEmployeement::find($id);
            $delete_record->deleted_by = auth()->user()->id;
            $delete_record->save();
    
            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_previous_employeement/id/' . $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
    
            $delete_record->delete();
            $log['msg'] = 'Successfully deleted the previous employeement!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 1, 'msg' => 'Successfully deleted the previous employeement!');
        }catch(Exception $ex){
            $logged_user = auth()->user();
            $log['msg'] = 'Deleting previous employeement is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Deleting previous employeement is unsuccessful!');
        }
    }
}
