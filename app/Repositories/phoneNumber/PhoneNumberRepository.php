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
        try {
            if (Gate::denies('view-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view phone number details!');
            }
            $phone_number_data = PhoneNumber::with(['AddedBy', 'AssignedTo', 'PhoneNumberResponse' => function ($phone_num_resp) {
                $phone_num_resp->orderBy('id', 'DESC')->limit(1);
            }])->get();

            $log['msg'] = 'Phone number detail has accessed successfully!';
            Log::channel('daily')->info(json_encode($log));
            return view('phone_number.phone_number_addition', ['phone_number_data' => $phone_number_data]);
        } catch (Exception $ex) {
            $log['msg'] = 'Phone number detail accessing was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function store($request)
    {
        try {
            if (Gate::denies('create-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to add phone number!');
            }
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

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Adding phone number is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Adding phone number is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Adding phone number was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'Adding phone number was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to edit phone number!');
            }
            $request->validate([
                'phone_number' => 'sometimes|nullable|string|max:12',
                'name' => 'sometimes|nullable|string|max:255',
            ]);

            $phone_number = PhoneNumber::find($id);
            $phone_number->phone_number = $request->phone_number;
            $phone_number->name = $request->name;
            $phone_number->updated_by = auth()->user()->id;
            $phone_number->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Editing phone number details was unsuccessful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Editing phone number details is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Editing phone number details was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Editing phone number details was unsuccessful!');
        }
    }

    public function phoneNumberProfile($id)
    {
        try {
            if (Gate::denies('view-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view phone number!');
            }
            $phone_num_details = PhoneNumber::where('id', $id)->with([
                'AddedBy', 'PhoneNumberResponse' => function ($phone_num_resp) {
                    $phone_num_resp->orderBy('id', 'DESC');
                },
                'PhoneNumberResponse.Designation',
                'PhoneNumberResponse.User',
                'AssignedTo'
            ])->first();
            return view('phone_number.phone_number_profile', ['phone_number_details' => $phone_num_details]);
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing phone number profile is successful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Accessing phone number profile is successful!');
        }
    }

    public function show()
    {
        try {
            if (Gate::denies('view-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view phone numbers!');
            }
            return PhoneNumber::with(['AddedBy', 'AssignedTo', 'PhoneNumberResponse' => function ($phone_num_resp) {
                $phone_num_resp->orderBy('id', 'DESC')->limit(1);
            }])->get();
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing phone numbers is successful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Accessing phone numbers is successful!');
        }
    }

    public function getPhoneNumberDetails($id)
    {
        try {
            if (Gate::denies('view-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view phone number!');
            }
            return PhoneNumber::find($id);
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing phone number details is successful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Accessing phone number details is successful!');
        }
    }

    public function destroy($id)
    {
        try {
            if (Gate::denies('delete-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete phone number!');
            }
            $phone_number = PhoneNumber::find($id);
            $phone_number->deleted_by = auth()->user()->id;
            $phone_number->save();
            $phone_number->delete();

            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_phone_number/id/' . $id,
                'METHOD' => 'DELETE',
                'REQUEST_BODY' => [],
                'RESPONSE' => ['status' => 1, 'msg' => 'Successfully deleted the phone number!']
            ];

            $log['msg'] = 'Phone number deletion is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Successfully deleted the phone number!');
        } catch (Exception $ex) {
            $log['msg'] = 'Phone number deletion is unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Phone number deletion is successful!');
        }
    }

    public function assignStaffMember($id)
    {
        try{
            $logged_user = auth()->user();
            $assignable_users = User::where('role_id', 5)->orWhere('role_id', 6)->get();
            $user_count = $assignable_users->count();
            
            if ($user_count > 0) {
                $random_user_index = rand(1, $user_count);
                $user_array = $assignable_users->toArray();
                $selected_user = $user_array[$random_user_index - 1]['id'];
                
                $phone_number = PhoneNumber::where('id', $id)->first();
                $phone_number->assigned_staff_member = $selected_user;
                $status = $phone_number->save();
                
                if ($status == true) {
                    $log['msg'] = 'Assigning staff is successful!';
                    Log::channel('daily')->info(json_encode($log));
                    Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
                } else {
                    $log['msg'] = 'Assign phone number is unsuccessful!';
                    Log::channel('daily')->error(json_encode($log));
                    Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
                }
            }
        }catch(Exception $ex){
            $log['msg'] = 'Assign phone number is unsuccessful!';
            $logged_user = auth()->user();
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function changePhoneNumberStatus($request, $id){
        try{
            if (Gate::denies('update-phone-number', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to update phone number status!');
            }
            $request->validate([
                'status' => 'required|string|max:255',
            ]);

            $phone_number = PhoneNumber::find($id);
            $phone_number->status = $request->status;
            $phone_number->updated_by = auth()->user()->id;
            $phone_number->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Phone Number Status change is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Phone Number Status change is successful!');
        }catch(Exception $ex){
            $logged_user = auth()->user();
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            $log['msg'] = 'Phone Number Status change was unsuccessful!';
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'Phone Number Status change was unsuccessful!');
        }
    }
}
