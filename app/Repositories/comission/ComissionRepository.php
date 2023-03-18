<?php

namespace App\Repositories\comission;

use Exception;
use App\Models\Commission;
use App\Repositories\comission\ComissionInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class ComissionRepository implements ComissionInterface
{
    public function store($request)
    {
        // if (Gate::denies('create-comission', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to create comission!');
        // }
        $log = [
            'route' => '/api/save_comission',
        ];
        try {
            $request->validate([
                'staff_mem_name' => 'nullable|sometimes|string|max: 255',
                'com_designation' => 'nullable|sometimes|string|max: 255',
                'com_price' => 'nullable|sometimes|string|max: 255',
                'com_response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            Commission::create([
                'staff_mem_name' => $request->staff_mem_name,
                'designation' => $request->com_designation,
                'price' => $request->com_price,
                'response' => $request->com_response,
                'applicant_id' => $request->applicant_id,
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving comission is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving comission is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving comission was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving comission was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        // if (Gate::denies('update-comission', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to comission!');
        // }
        $log = [
            'route' => '/api/update_comission/id/' . $id,
        ];
        try {
            $request->validate([
                'staff_mem_name' => 'nullable|sometimes|string|max: 255',
                'com_designation' => 'nullable|sometimes|string|max: 255',
                'com_price' => 'nullable|sometimes|string|max: 255',
                'com_response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            $commision = Commission::find($id);
            $commision->staff_mem_name = $request->staff_mem_name;
            $commision->designation = $request->com_designation;
            $commision->price = $request->com_price;
            $commision->response = $request->com_response;
            $commision->applicant_id = $request->applicant_id;
            $commision->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating comission is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating comission is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating comission was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating comission was unsuccessful!');
        }
    }

    public function show($id)
    {
        // if (Gate::denies('view-comission', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view comissions!');
        // }
        $log = [
            'route' => '/api/get_comission/id/' . $id,
            'msg' => 'Successfully accessed the comissions!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Commission::where('applicant_id', $id)->get();
    }

    public function getComission($applicant_lan_id)
    {
        // if (Gate::denies('view-comission', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view comission!');
        // }
        $log = [
            'route' => '/api/get_comission/id/' . $applicant_lan_id,
            'msg' => 'Successfully accessed the comission!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Commission::find($applicant_lan_id);
    }

    public function destroy($id)
    {
        // if (Gate::denies('delete-comission', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to delete comission!');
        // }
        $log = [
            'route' => '/api/delete_comission/id/' . $id,
            'msg' => 'Successfully deleted the comission!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = Commission::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the comission language!');
        } else {
            return array('status' => 0, 'msg' => 'Comission deletion was unsuccessful!');
        }
    }
}
