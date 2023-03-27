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
        // if (Gate::denies('update-online-applicant', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to update online applicant related details!');
        // }
        return view('applicant.online_applicant_response', ['online_applicant_id' => $id]);
    }

    public function store($request)
    {
        // if (Gate::denies('update-online-applicant', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to update online applicant related details!');
        // }
        $log = [
            'route' => '/api/save_online_applicant_resp',
        ];
        try {
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

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving online applicant response is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving online applicant is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving online applicant was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving online applicant was unsuccessful!');
        }
    }

    public function show()
    {
        // if (Gate::denies('update-online-applicant', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to update online applicant related details!');
        // }
        $log = [
            'route' => '/api/get_online_applicant_responses',
        ];
        return OnlineApplicantResponse::with(['OnlineApplicant', 'Designation', 'AddedBy'])->get();
    }
}
