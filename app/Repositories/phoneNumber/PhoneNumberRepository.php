<?php

namespace App\Repositories\phoneNumber;

use App\Repositories\phoneNumber\PhoneNumberInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Storage;

class PhoneNumberRepository implements PhoneNumberInterface
{
    public function index()
    {
        if (Gate::denies('view-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to add phone number!');
        }
        return view('phone_number.phone_number_addition');
    }

    public function store($request)
    {
        if (Gate::denies('create-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to add phone number!');
        }
        $log = [
            'route' => '/api/add_phone_number',
        ];
        try {
            $request->validate([
                'phone_number' => 'required|string|max:12',
                'name' => 'sometimes|nullable|string|max:255',
            ]);

            $phone_number = PhoneNumber::create([
                'phone_number' => $request->phone_number,
                'name' => $request->name,
                'added_by' => auth()->user()->id,
            ]);

            $this->assignStaffMember($phone_number->id);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Adding phone number is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Adding phone number is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Adding phone number was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Adding phone number was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to edit phone number!');
        }
        $log = [
            'route' => '/api/update_phone_number/id/' . $id,
        ];
        try {
            $request->validate([
                'phone_number' => 'sometimes|nullable|string|max:12',
                'name' => 'sometimes|nullable|string|max:255',
            ]);

            $phone_number = PhoneNumber::find($id);
            $phone_number->phone_number = $request->phone_number;
            $phone_number->name = $request->name;
            $phone_number->updated_by = auth()->user()->id;
            $phone_number->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Editing phone number details is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Editing phone number details is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Editing phone number details was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Editing phone number details was unsuccessful!');
        }
    }

    public function phoneNumberProfile($id)
    {
        if (Gate::denies('view-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to view phone number!');
        }
        $log = [
            'route' => '/api/phone_number_profile/id/' . $id,
        ];
        Log::channel('daily')->error(json_encode($log));
        $phone_num_details = PhoneNumber::where('id', $id)->with([
            'AddedBy', 'PhoneNumberResponse' => function ($phone_num_resp) {
                $phone_num_resp->orderBy('id', 'DESC');
            },
            'PhoneNumberResponse.Designation',
            'PhoneNumberResponse.User',
            'AssignedTo'
        ])->first();
        return view('phone_number.phone_number_profile', ['phone_number_details' => $phone_num_details]);
    }

    public function show()
    {
        if (Gate::denies('view-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to view phone numbers!');
        }
        $log = [
            'route' => '/api/get_phone_numbers',
        ];
        Log::channel('daily')->error(json_encode($log));
        return PhoneNumber::with(['AddedBy', 'AssignedTo', 'PhoneNumberResponse' => function ($phone_num_resp) {
            $phone_num_resp->orderBy('id', 'DESC')->limit(1);
        }])->get();
    }

    public function getPhoneNumberDetails($id)
    {
        if (Gate::denies('view-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to view phone number!');
        }
        $log = [
            'route' => '/api/get_phone_number/id/' . $id,
        ];
        Log::channel('daily')->error(json_encode($log));
        return PhoneNumber::find($id);
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-phone-number', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to delete phone number!');
        }
        $phone_number = PhoneNumber::find($id);
        $phone_number->deleted_by = auth()->user()->id;
        $phone_number->save();

        $status = $phone_number->delete();

        if ($status) {
            return array('status' => 1, 'msg' => 'Successfully deleted the phone number!');
        } else {
            return array('status' => 0, 'msg' => 'Phone number deletion is successful!');
        }
    }

    public function assignStaffMember($id)
    {
        $assignable_users = User::where('role_id', 5)->orWhere('role_id', 6)->get();
        $user_count = $assignable_users->count();

        if ($user_count > 0) {
            $random_user_index = rand(1, $user_count);
            $user_array = $assignable_users->toArray();
            $selected_user = $user_array[$random_user_index-1]['id'];
            
            $phone_number = PhoneNumber::where('id', $id)->first();
            $phone_number->assigned_staff_member = $selected_user;
            $phone_number->save();
        }
    }
}
