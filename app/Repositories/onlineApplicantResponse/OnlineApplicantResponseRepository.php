<?php

namespace App\Repositories\onlineApplicantResponse;

use App\Repositories\onlineApplicantResponse\OnlineApplicantResponseInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\OnlineApplicantResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Storage;

class OnlineApplicantResponseRepository implements OnlineApplicantResponseInterface
{
    public function index($id)
    {
        return view('applicant.online_applicant_response', ['online_applicant_id' => $id]);
    }

    public function store($request)
    {
        try {

            if (Gate::denies('create-application-staff-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to created online applicant responses!');
            }

            $request->validate([
                'designation',
                'response',
                'online_applicant_id'
            ]);

            OnlineApplicantResponse::create([
                'designation' => auth()->user()->role_id,
                'response' => $request->response,
                'online_applicant_id' => $request->online_applicant_id,
                'added_by' => auth()->user()->id
            ]);

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Online Applicant Response created successfully!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Saving online applicant is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Online Applicant Response creating was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Online Applicant Response creating was failed!');
        }
    }

    public function show()
    {
        try {
            $log['msg'] = 'Online applicant response accessed successfully!';
            Log::channel('daily')->info(json_encode($log));
            return OnlineApplicantResponse::with(['OnlineApplicant', 'Designation', 'AddedBy'])->get();
        } catch (Exception $ex) {
            $log['msg'] = 'Online applicant response accessing was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }
}
