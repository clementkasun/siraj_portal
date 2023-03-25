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
        if (Gate::denies('create-previous-emp', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to create previous employeement!');
        }
        $log = [
            'route' => '/api/save_previous_employeement',
        ];
        try {

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

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving previous employeement is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving previous employeement is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving previous employeement was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving previous employeement was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-previous-emp', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to update previous employeement!');
        }
        $log = [
            'route' => '/api/update_previous_employeement/id/' . $id,
        ];
        try {
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

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating previous employeement is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating previous employeement is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating previous employeement was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating previous employeement was unsuccessful!');
        }
    }

    public function getPreviousEmployeement($id)
    {
        if (Gate::denies('view-previous-employeement', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view previous employeement!');
        }
        $log = [
            'route' => '/api/get_previous_experience/id/'.$id,
            'msg' => 'Successfully accessed the previous employeement!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantPreviousEmployeement::where('id', $id)->with('AddedBy')->first();
    }

    public function show($id)
    {
        if (Gate::denies('view-previous-emp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view previous employeement!');
        }
        $log = [
            'route' => '/api/get_previous_employeements/id/'>$id,
            'msg' => 'Successfully accessed the previous employeements!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantPreviousEmployeement::where('applicant_id', $id)->with('AddedBy')->get();
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-previous-emp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to delete previous employeement!');
        }
        $log = [
            'route' => '/api/delete_previous_employeement/id/' . $id,
            'msg' => 'Successfully deleted the previous employeement!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $delete_record = ApplicantPreviousEmployeement::find($id);
        $delete_record->deleted_by = auth()->user()->id;
        $delete_record->save();

        $status = $delete_record->delete();
        if($status == true){
            return array('status' => 1, 'msg' => 'Successfully deleted the previous employeement!');
        }else{
            return array('status' => 0, 'msg' => 'Previous employeement deletion was unsuccessful!');
        }
    }
}
