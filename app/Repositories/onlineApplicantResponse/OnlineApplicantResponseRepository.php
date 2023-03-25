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
    public function store($request)
    {
        if (Gate::denies('create-application-staff-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to create online application staff response!');
        }
        $log = [
            'route' => '/api/save_online_applicant_resp',
        ];
        try {
            $request->validate([
                'name',
                'designation',
                'response',
                'online_applicant_id'
            ]);

            OnlineApplicantResponse::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'response' => $request->response,
                'online_applicant_id' => $request->online_applicant_id
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
}
