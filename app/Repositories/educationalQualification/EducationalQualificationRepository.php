<?php

namespace App\Repositories\educationalQualification;

use App\Models\ApplicantEducationalQualification;
use Exception;
use App\Models\EducationalQualification;
use App\Repositories\educationalQualification\EducationalQualificationInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SystemNotification;

class EducationalQualificationRepository implements EducationalQualificationInterface
{
    public function store($request)
    {
        if (Gate::denies('create-educational-qualification', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to educational qualification!');
        }
        $log = [
            'route' => '/api/save_educational_qualification',
        ];
        try {

            $request->validate([
                'institute' => 'nullable|sometimes|string|max:255',
                'course' => 'nullable|sometimes|string|max:255',
                'start_date' => 'nullable|sometimes|string|max:255',
                'end_date' => 'nullable|sometimes|string|max:255',
                'result' => 'nullable|sometimes|string|max:255',
                'applicant_id' => 'required|string|max:255'
            ]);

            ApplicantEducationalQualification::create([
                'institute' => $request->institute,
                'course' => $request->course,
                'start_date' =>  $request->start_date,
                'end_date' => $request->end_date,
                'result' => $request->result,
                'applicant_id' => $request->applicant_id
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving edcuational qualification saving is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving edcuational qualification is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving edcuational qualification was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving edcuational qualification was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-educational-qualification', auth()->user())) {
            return array('status' => 0, 'msg' => 'You are not authorised to educational qualification!');
        }
        $log = [
            'route' => '/api/update_educational_qualification/id/' . $id,
        ];
        try {
            $request->validate([
                'institute' => 'nullable|sometimes|string|max:255',
                'course' => 'nullable|sometimes|string|max:255',
                'start_date' => 'nullable|sometimes|string|max:255',
                'end_date' => 'nullable|sometimes|string|max:255',
                'result' => 'nullable|sometimes|string|max:255',
                'applicant_id' => 'required|string|max:255'
            ]);

            $educational_qualification = ApplicantEducationalQualification::find($id);
            $educational_qualification->institute = $request->institute;
            $educational_qualification->course = $request->course;
            $educational_qualification->start_date = $request->start_date;
            $educational_qualification->end_date = $request->end_date;
            $educational_qualification->result = $request->result;
            $educational_qualification->applicant_id = $request->applicant_id;
            $educational_qualification->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating educational qualification is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating educational qualification is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating educational qualification was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating educational qualification was unsuccessful!');
        }
    }

    public function getEducationalQualification($id)
    {
        if (Gate::denies('view-edcuational-qualification', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view educational qualification!');
        }
        $log = [
            'route' => '/api/get_educational_qualification/id/'.$id,
            'msg' => 'Successfully accessed the educational qualification!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantEducationalQualification::find($id);
    }

    public function show($id)
    {
        if (Gate::denies('view-applicants', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view applicants!');
        }
        $log = [
            'route' => '/api/get_educational_qualification/id/'.$id,
            'msg' => 'Successfully accessed the educational qualifications!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ApplicantEducationalQualification::where('applicant_id', $id)->get();
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-applicant', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to delete applicant!');
        }
        $log = [
            'route' => '/api/delete_educational_qualification/id/' . $id,
            'msg' => 'Successfully deleted the educational qualificaition!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = ApplicantEducationalQualification::find($id)->delete();
        if($status == true){
            return array('status' => 1, 'msg' => 'Successfully deleted the educational qualification!');
        }else{
            return array('status' => 0, 'msg' => 'Educational Qualificaition deletion was unsuccessful!');
        }
    }
}
