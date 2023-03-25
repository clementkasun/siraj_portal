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
            return array('status' => 2, 'msg' => 'You are not authorised to view contact response!');
        }
        return view('contact.contact_response', ['contact_id' => $id]);
    }

    public function store($request)
    {
        if (Gate::denies('create-contact-us-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to register contact response!');
        }
        $log = [
            'route' => '/api/save_contact_response',
        ];

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'response' => 'required|string|max:255',
                'contact_id' => 'required|string',
            ]);

            ContactResponse::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'response' => $request->response,
                'contact_id' => $request->contact_id,
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Contact Response saved Successfully!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Contact Response saved Successfully!');
        } catch (Exception $e) {
            $log['error']  = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Contact Response saving was failed!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-contact-us-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to update contact response!');
        }
        $log = [
            'route' => '/api/save_contact_response',
        ];

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'response' => 'required|string|max:255',
                'contact_id' => 'required|string',
            ]);

            $contact = ContactResponse::find($id);
            $contact->name = $request->name;
            $contact->designation = $request->designation;
            $contact->response = $request->response;
            $contact->contact_id = $request->contact_id;
            $contact->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Contact Response updated Successfully!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Contact Response updated Successfully!');
        } catch (Exception $e) {
            $log['error']  = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Contact Response updated was failed!');
        }
    }

    public function show()
    {
        if (Gate::denies('view-contact-us-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view contact responses!');
        }
        $log = [
            'route' => '/api/get_contact_responses',
            'msg' => 'Successfully accessed the contact responses!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ContactResponse::all();
    }

    public function getContactResponse($id)
    {
        if (Gate::denies('view-contact-us-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view contact response!');
        }
        $log = [
            'route' => '/api/get_contact_response/id/' . $id,
            'msg' => 'Successfully accessed the contact response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return ContactResponse::find($id);
    }


    public function destroy($id)
    {
        if (Gate::denies('delete-contact-us-resp', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to delete contact response!');
        }
        $log = [
            'route' => '/api/delete_contact_response/id/' . $id,
            'msg' => 'Successfully delete the contact response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = ContactResponse::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the contact response!');
        } else {
            return array('status' => 0, 'msg' => 'Contact response deletion was unsuccessful!');
        }
    }
}
