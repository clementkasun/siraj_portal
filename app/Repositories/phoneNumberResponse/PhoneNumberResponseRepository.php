<?php

namespace App\Repositories\phoneNumberResponse;

use App\Repositories\phoneNumberResponse\PhoneNumberResponseInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\PhoneNumberResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Storage;

class PhoneNumberResponseRepository implements PhoneNumberResponseInterface
{
    public function index($id)
    {
        if (Gate::denies('view-phone-number-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to create phone number response!');
        }
        return view('phone_number.phone_number_response', ['phone_number_id' => $id]);
    }

    public function store($request)
    {
        if (Gate::denies('create-phone-number-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to create phone number response!');
        }
        $log = [
            'route' => '/api/save_phone_number_response',
        ];
        try {
            $request->validate([
                'response' => 'required|string|max:255',
            ]);

            $user = auth()->user();
            $user_name = $user->first_name . ' ' . $user->last_name;

            PhoneNumberResponse::create([
                'user_name' => $user_name,
                'designation' => $user->role_id,
                'response' => $request->response,
                'user_id' => $user->id,
                'phone_number_id' => $request->phone_number_id,
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving phone number response is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Making contact response is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Making contact response is successful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving online applicant was unsuccessful!');
        }
    }

    public function show($id)
    {
        if (Gate::denies('view-phone-number-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view phone number responses!');
        }
        return PhoneNumberResponse::where('phone_number_id', $id)->with(['PhoneNumber', 'Designation' , 'User'])->get();
    }
}
