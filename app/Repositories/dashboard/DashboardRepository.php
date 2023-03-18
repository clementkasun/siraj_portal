<?php

namespace App\Repositories\dashboard;

use App\Models\Applicant;
use App\Models\ApplicationStaffResponse;
use App\Models\Candidate;
use App\Models\CandidateResponse;
use App\Models\Commission;
use App\Models\Contact;
use App\Models\ContactResponse;
use App\Models\User;
use App\Models\Vacancy;
use App\Repositories\dashboard\DashboardInterface;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Storage;

class DashboardRepository implements DashboardInterface
{
    public function index()
    {
        return view('dashboard', [
            'counts' => [
                'vacancy_count' => Vacancy::all()->count(),
                'applicant_count' => Applicant::all()->count(),
                'application_staff_count' => ApplicationStaffResponse::all()->count(),
                'commission_count' => Commission::all()->count(),
                'candidate_count' => Candidate::all()->count(),
                'candidate_resp_count' => CandidateResponse::all()->count(),
                'contact_count' => Contact::all()->count(),
                'contact_resp_count' => ContactResponse::all()->count(),
                'user_count' => User::all()->count()
            ]
        ]);
    }
}
