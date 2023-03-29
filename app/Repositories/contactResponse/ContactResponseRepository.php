<?php

namespace App\Repositories\contactResponse;

use App\Repositories\contactResponse\ContactResponseInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\ContactResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class ContactResponseRepository implements ContactResponseInterface
{
    public function index($id)
    {
        if (Gate::denies('view-contact-us-resp', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to view contact response!');
        }
        return view('contact.contact_response', ['contact_id' => $id, 'contact_responses' => ContactResponse::where('contact_id', $id)->with(['Designation', 'AddedBy'])->get()]);
    }

    public function store($request)
    {
        try {
            if (Gate::denies('create-contact-us-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to register contact response!');
            }
            $request->validate([
                'response' => 'required|string|max:255',
                'contact_id' => 'required|string',
            ]);

            ContactResponse::create([
                'designation' => auth()->user()->role_id,
                'response' => $request->response,
                'contact_id' => $request->contact_id,
                'added_by' => auth()->user()->id
            ]);

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Contact Response saved Successfully!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Contact Response saved Successfully!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Contact Response saving was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Contact Response saving was failed!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-contact-us-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to update contact response!');
            }
            $request->validate([
                'response' => 'required|string|max:255',
                'contact_id' => 'required|string',
            ]);

            $contact = ContactResponse::find($id);
            $contact->designation = auth()->user()->role_id;
            $contact->response = $request->response;
            $contact->contact_id = $request->contact_id;
            $contact->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Contact Response updated Successfully!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Contact Response updated Successfully!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Contact Response updating was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Contact Response updated was failed!');
        }
    }

    public function show()
    {
        try {
            if (Gate::denies('view-contact-us-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view contact responses!');
            }
            $log = [
                'URI' => '/api/get_contact_responses',
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            Log::channel('daily')->info(json_encode($log));
            
            return ContactResponse::with('Designation')->get();
        } catch (Exception $ex) {
            $log['msg'] = 'Contact Responses accessing was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function getContactResponse($id)
    {
        try {
            if (Gate::denies('view-contact-us-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view contact response!');
            }
            $log = [
                'URI' => '/api/get_contact_response/id/' . $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            Log::channel('daily')->info(json_encode($log));
            return ContactResponse::find($id);
        } catch (Exception $ex) {
            $log['msg'] = 'Contact Response accessing was failed!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }


    public function destroy($id)
    {
        try {
            if (Gate::denies('delete-contact-us-resp', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete contact response!');
            }
            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_contact_response/id/'.$id,
                'METHOD' => 'DELETE',
                'REQUEST_BODY' => [],
                'RESPONSE' => ['status' => 1, 'msg' => 'Successfully deleted the contact response!'] 
            ];

            $log['msg'] = 'Contact Response deleted Successfully!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 1, 'msg' => 'Successfully deleted the contact response!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Contact response deletion was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Contact response deletion was unsuccessful!');
        }
    }
}
