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
        // if (Gate::denies('create-previous-employeement', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to previous employeement!');
        // }
        $log = [
            'route' => '/api/save_previous_employeement',
        ];
        try {

            $request->validate([
                'job_type' => 'nullable|sometimes|string|max:255',
                'period' => 'nullable|sometimes|string|max:255',
                'monthly_sallary' => 'nullable|sometimes|string|max:255',
                'contract_period' => 'nullable|sometimes|string|max:255',
                'country' => 'nullable|sometimes|string|max:255',
                'applicant_id' => 'nullable|sometimes|string|max:255'
            ]);

            $previous_edu_qualifications = ApplicantPreviousEmployeement::create([
                'job_type' => $request->job_type,
                'period' => $request->period,
                'monthly_salary' => $request->monthly_sallary,
                'contract_period' => $request->contract_period,
                'country' => $request->country,
                'applicant_id' => $request->applicant_id
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
        // if (Gate::denies('update-previous-employeement', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to previous employeement!');
        // }
        $log = [
            'route' => '/api/update_previous_employeement/id/' . $id,
        ];
        try {
            $request->validate([
                'job_type' => 'nullable|sometimes|string|max:255',
                'period' => 'nullable|sometimes|string|max:255',
                'monthly_sallary' => 'nullable|sometimes|string|max:255',
                'contract_period' => 'nullable|sometimes|string|max:255',
                'country' => 'nullable|sometimes|string|max:255',
                'applicant_id' => 'nullable|sometimes|string|max:255'
            ]);

            $previous_emp = ApplicantPreviousEmployeement::find($id);
            $previous_emp->job_type = $request->job_type;
            $previous_emp->period = $request->period;
            $previous_emp->monthly_salary = $request->monthly_sallary;
            $previous_emp->contract_period = $request->contract_period;
            $previous_emp->country = $request->country;
            $previous_emp->applicant_id = $request->applicant_id;
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
        // if (Gate::denies('view-previous-employeement', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view previous employeement!');
        // }
        $log = [
            'route' => '/api/get_previous_experience/id/'.$id,
            'msg' => 'Successfully accessed the previous employeement!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantPreviousEmployeement::find($id);
    }

    public function show($id)
    {
        // if (Gate::denies('view-previous-employeement', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view previous employeement!');
        // }
        $log = [
            'route' => '/api/get_previous_employeements/id/'>$id,
            'msg' => 'Successfully accessed the previous employeements!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantPreviousEmployeement::where('applicant_id', $id)->get();
    }

    public function destroy($id)
    {
        // if (Gate::denies('delete-previous-employeement', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to delete previous employeement!');
        // }
        $log = [
            'route' => '/api/delete_previous_employeement/id/' . $id,
            'msg' => 'Successfully deleted the previous employeement!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = ApplicantPreviousEmployeement::find($id)->delete();
        if($status == true){
            return array('status' => 1, 'msg' => 'Successfully deleted the previous employeement!');
        }else{
            return array('status' => 0, 'msg' => 'Previous employeement deletion was unsuccessful!');
        }
    }
}
