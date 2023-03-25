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
        if (Gate::denies('view-contact-us', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view contacts!');
        }
        return view('contact.registered_contacts', ['contacts' => Contact::all()]);
    }

    public function store($request)
    {
        // if (Gate::denies('create-contact-us', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to register contact!');
        // }
        $log = [
            'route' => '/api/save_contact',
        ];
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

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving contact is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving contact is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving Contact was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving Contact was unsuccessful!');
        }
    }

    public function show()
    {
        if (Gate::denies('view-contact-us', auth()->user())) {
            return array('status' => 2, 'msg' => 'You are not authorised to view contacts!');
        }
        $log = [
            'route' => '/api/get_contacts',
            'msg' => 'Successfully accessed the contacts!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Contact::all();
    }
}
