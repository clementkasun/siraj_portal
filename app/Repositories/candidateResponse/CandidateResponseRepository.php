<?php

namespace App\Repositories\candidateResponse;

use App\Repositories\candidateResponse\CandidateResponseInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\CandidateResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;

class CandidateResponseRepository implements CandidateResponseInterface
{
    public function index($id){
       return view('candidate.candidate_response', ['candidate_id' => $id]);
    }

    public function store($request)
    {
        // if (Gate::denies('create-contact', auth()->user())) {
        //     return array('status' => 0, 'msg' => 'You are not authorised to register candidate!');
        // }
        $log = [
            'route' => '/api/save_candidate_response',
        ];
        try {
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'designation' => 'required|string|max:255',
                'response' => 'required|string|max:255',
                'candidate_id' => 'required|string|max:255',
            ]);

            CandidateResponse::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'response' => $request->response,
                'candidate_id' => $request->candidate_id
            ]);

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Saving candidate response is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving candidate response is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving candidate response was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));
            
            return array('status' => 0, 'msg' => 'Saving candidate response was unsuccessful!');
        }
    }
    
    public function update($request, $id)
    {
        // if (Gate::denies('update-candidate response', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view updae candidate responses!');
        // }
        $log = [
            'route' => '/api/update_candidate_response/id/'.$id,
        ];
        try {
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'designation' => 'required|string|max:255',
                'response' => 'required|string|max:255',
                'candidate_id' => 'required|string|max:255',
            ]);

            $candidate_response = CandidateResponse::find($id);
            $candidate_response->name = $request->name;
            $candidate_response->designation = $request->designation;
            $candidate_response->response = $request->response;
            $candidate_response->candidate_id = $request->candidate_id;
            $candidate_response->save();

            // $user = auth()->user();
            // $msg = $log['msg'];
            // Notification::send($user, new SystemNotification($user, $msg));
            $log['msg'] = 'Updating candidate response is successful!';
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating candidate response is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating candidate response was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));
            
            return array('status' => 0, 'msg' => 'Updating candidate response was unsuccessful!');
        }
    }

    public function show()
    {
        // if (Gate::denies('view-candidate-response', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view view candidate reponses!');
        // }
        $log = [
            'route' => '/api/get_candidate_responses',
            'msg' => 'Successfully accessed the candidate responses!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return CandidateResponse::all();
    }

    public function getCandidate($id)
    {
        // if (Gate::denies('view-candidate-reponse', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to view view candidate response!');
        // }
        $log = [
            'route' => '/api/get_candidate_reponse/id/'.$id,
            'msg' => 'Successfully accessed the candidate responses!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return CandidateResponse::find($id);
    }


    public function destroy($id)
    {
        // if (Gate::denies('delete-condidate-response', auth()->user())) {
        //     return array('status' => 2, 'msg' => 'You are not authorised to delete candidate response!');
        // }
        $log = [
            'route' => '/api/delete_candidate_reponse/id/'.$id,
            'msg' => 'Successfully delete the candidate response!',
        ];
        Log::channel('daily')->info(json_encode($log));
        $status = CandidateResponse::find($id)->delete();
        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the candidate response!');
        } else {
            return array('status' => 0, 'msg' => 'Candidate response deletion was unsuccessful!');
        }
    }
}
