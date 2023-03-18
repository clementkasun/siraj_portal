<?php

namespace App\Http\Controllers;

use App\Repositories\applicant\ApplicantRepository;
use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{

    private $applicantRepository;

    function __construct(ApplicantRepository $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('applicant.registration');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registeredApplicants(Applicant $applicant)
    {
        return view('applicant.registered_applicants', array('applicants' => $applicant->all()));
    }


    public function viewApplication($id){
        return $this->applicantRepository->viewApplication($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->applicantRepository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->applicantRepository->show();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function showgetApplicantDetail($id)
    {
        return $this->applicantRepository->getApplicantDetail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function editApplicant($id)
    {
        return $this->applicantRepository->editApplicant($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function applicantProfile($id)
    {
        return $this->applicantRepository->applicantProfile($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->applicantRepository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->applicantRepository->destroy($id);
    }
}
