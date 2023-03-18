<?php

namespace App\Repositories\candidate;

use Exception;
use App\Models\Candidate;
use App\Repositories\candidate\CandidateInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class CandidateRepository implements CandidateInterface
{

    public function index(){
       return view('candidate.registered_candidates', ['candidates' => Candidate::all()]);
    }

    public function store($request)
    {
        // if (Gate::denies('create-contact', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to register contact!');
        // }
        $log = [
            'route' => '/api/save_candidate',
        ];
        try {
            $request->validate([
                'candidate_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:10',
                'passport_number'=> 'required|string|max:255',
                'birth_day' => 'required|string',
                'job_type' => 'required|string|max:255',
                'country' => 'required|string|max:255',
            ]);

            Candidate::create([
                'candidate_name' => $request->candidate_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'passport_number'=> $request->passport_number,
                'birth_day' => $request->birth_day,
                'job_type' => $request->job_type,
                'country' => $request->country,
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving candidate is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving candidate is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving candidate was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving candidate was unsuccessful!');
        }
    }

    public function show()
    {
        // if (Gate::denies('view-candidate', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view candidate!');
        // }
        $log = [
            'route' => '/api/get_candidates',
            'msg' => 'Successfully accessed the candidates!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return Candidate::all();
    }
}
