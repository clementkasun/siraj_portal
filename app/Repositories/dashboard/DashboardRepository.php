<?php

namespace App\Repositories\dashboard;

use App\Models\Applicant;
use App\Models\ApplicationStaffResponse;
use App\Models\Commission;
use App\Models\Contact;
use App\Models\ContactResponse;
use App\Models\OnlineApplicant;
use App\Models\PhoneNumber;
use App\Models\User;
use App\Models\Vacancy;
use App\Repositories\dashboard\DashboardInterface;

class DashboardRepository implements DashboardInterface
{
    public function index()
    {
        return view('dashboard', [
            'counts' => [
                'vacancy_count' => Vacancy::all()->count(),
                'applicant_count' => Applicant::all()->count(),
                'application_staff_count' => ApplicationStaffResponse::all()->count(),
                'online_applicant_count' => OnlineApplicant::all()->count(),
                'phone_number_count' => PhoneNumber::all()->count(),
                'commission_count' => Commission::all()->count(),
                'contact_count' => Contact::all()->count(),
                'contact_resp_count' => ContactResponse::all()->count(),
                'user_count' => User::all()->count()
            ]
        ]);
    }
}
