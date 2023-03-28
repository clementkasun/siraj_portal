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
        try {
            if (Gate::denies('create-commission', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create comission!');
            }
            $request->validate([
                'com_price' => 'nullable|sometimes|string|max: 255',
                'com_response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            Commission::create([
                'staff_mem_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                'designation' => auth()->user()->role_id,
                'price' => $request->com_price,
                'response' => $request->com_response,
                'applicant_id' => $request->applicant_id,
                'added_by' => auth()->user()->id
            ]);

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Saving comission was unsuccessful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Saving comission was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving comission was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-commission', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to comission!');
            }
            $request->validate([
                'com_price' => 'nullable|sometimes|string|max: 255',
                'com_response' => 'nullable|sometimes|string|max: 255',
                'applicant_id' => 'nullable|sometimes|string|max: 255',
            ]);

            $commision = Commission::find($id);
            $commision->staff_mem_name = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $commision->designation = auth()->user()->role_id;
            $commision->price = $request->com_price;
            $commision->response = $request->com_response;
            $commision->applicant_id = $request->applicant_id;
            $commision->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

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
        try {
            if (Gate::denies('view-commission', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view comissions!');
            }
            $logged_user = auth()->user();
            $log = [
                'URI' => '/get_comissions/id/'.$id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];

            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return Commission::where('applicant_id', $id)->with(['Applicant', 'Designation'])->get();
        } catch (Exception $ex) {
            $log['msg'] = 'accessing comissions was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            return [];
        }
    }
    
    public function getComission($applicant_lan_id)
    {
        try{
            if (Gate::denies('view-commission', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view comission!');
            }
            $log = [
                'URI' => '/get_comission/id/'.$applicant_lan_id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            Log::channel('daily')->info(json_encode($log));
            return Commission::find($applicant_lan_id);
        }catch(Exception $ex){
            $log['msg'] = 'Accessing comission was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            return [];
        }
    }
    
    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-commission', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete comission!');
            }
            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_comission/id/'.$id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => ['status' => 1, 'msg' => 'Successfully deleted the comission language!']
            ];
            Log::channel('daily')->info(json_encode($log));
            Commission::find($id)->delete();
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Successfully deleted the comission language!');
        }catch(Exception $ex){
            $log['msg'] = 'Deleting commission was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Comission deletion was unsuccessful!');
        }
    }
}
