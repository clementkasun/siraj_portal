<?php

namespace App\Repositories\onlineApplicant;

use App\Repositories\onlineApplicant\OnlineApplicantInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\OnlineApplicant;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Storage;

class OnlineApplicantRepository implements OnlineApplicantInterface
{
    public function index(){
        try{
            if (Gate::denies('view-online-applicant', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create online applicant!');
            }
            return view('applicant.online_applicants', ['online_applicants' => OnlineApplicant::all()]);
        }catch(Exception $ex){
            $log['msg'] = 'Accessing registered online applicant view was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function store($request)
    {
        try {
            $request->validate([
                'applicant_name' => 'required|string|max:255',
                'passport_number' => 'required|string|max:50',
                'nic' => 'required|string|max:20',
                'birth_date' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone_no_01' => 'required|string|max:12',
                'phone_no_02' => 'required|string|max:12',
                'job_type' => 'required|string|max:255',
            ]);

            OnlineApplicant::create([
                'applicant_name' => $request->applicant_name,
                'passport_number' => $request->passport_number,
                'nic' => $request->nic,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'phone_no_01' => $request->phone_no_01,
                'phone_no_02' => $request->phone_no_02,
                'job_type' => $request->job_type,
            ]);

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];
            $log['msg'] = 'Saving online applicant is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving online applicant is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving  online applicant was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving online applicant was unsuccessful!');
        }
    }

    public function changeOnlineAppStatus($request, $id){
        try {
            $request->validate([
                'status' => 'required|string|max:255',
            ]);

            $online_applicant = OnlineApplicant::find($id);
            $online_applicant->status = $request->status;
            $online_applicant->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Changing status of online applicant is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return array('status' => 1, 'msg' => 'Changing status of online applicant is successful!');
        } catch (Exception $e) {
            $logged_user = auth()->user();
            $log['msg'] = 'Changing status of online applicant was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Changing status of online applicant was unsuccessful!');
        }
    }
}
