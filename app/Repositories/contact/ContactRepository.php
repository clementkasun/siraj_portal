<?php

namespace App\Repositories\contact;

use App\Repositories\contact\ContactInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Storage;

class ContactRepository implements ContactInterface
{
    public function index()
    {
        try {
            if (Gate::denies('view-contact-us', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view contacts!');
            }
            return view('contact.registered_contacts', ['contacts' => Contact::all()]);
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'accessing contact us was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
        }
    }

    public function store($request)
    {
        try {
            $request->validate([
                'contact_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'companey_name' => 'sometimes|nullable|string|max:255',
                'phone_number' => 'required|string|max:10',
                'subject' => 'required|string|max:255',
                'file' => 'required',
                'message' => 'required|string|max:255',
            ]);

            $contact = Contact::create([
                'contact_name' => $request->contact_name,
                'email' => $request->email,
                'companey_name' => $request->companey_name,
                'phone_number' => $request->phone_number,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            if ($request->hasFile('file')) {
                $path = '/contact/' . $contact->id;
                Storage::disk('public')->makeDirectory($path);
                $path = Storage::disk('public')->put($path . '/', $request->file);
                $contact->file = $path;
                $contact->save();
            }

            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            Log::channel('daily')->info(json_encode($log));
            $log['msg'] = 'Saving contact is successful!';

            return array('status' => 1, 'msg' => 'Saving contact is successful!');
        } catch (Exception $ex) {
            $log['msg'] = 'Saving contact was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving Contact was unsuccessful!');
        }
    }

    public function show()
    {
        try {
            if (Gate::denies('view-contact-us', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to view contacts!');
            }
            $log = [
                'URI' => '/api/get_contacts',
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => 'Accessing contact details was unsuccessful!'
            ];
            $log['msg'] = 'Accessing contact details was unsuccessful!';
            Log::channel('daily')->info(json_encode($log));
            
            return Contact::all();
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing contact details was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }
}
