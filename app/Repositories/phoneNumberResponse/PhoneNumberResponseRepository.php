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
        try {
            if (Gate::denies('view-phone-number-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create phone number response!');
            }
            return view('phone_number.phone_number_response', ['phone_number_id' => $id]);
        } catch (Exception $ex) {
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function store($request)
    {
        try {
            if (Gate::denies('create-phone-number-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create phone number response!');
            }
            
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
                'added_by' => auth()->user()->id
            ]);

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Making contact response is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Making contact response is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Making contact response is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Making contact response is unsuccessful!');
        }
    }

    public function show($id)
    {
        try{
            if (Gate::denies('view-phone-number-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view phone number responses!');
            }
            return PhoneNumberResponse::where('phone_number_id', $id)->with(['PhoneNumber', 'Designation', 'User'])->get();
        }catch(Exception $ex){
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }
}
