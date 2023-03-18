<?php

namespace App\Http\Controllers;

use App\Repositories\staffResponse\StaffResponseRepository;
use Illuminate\Http\Request;

class ApplicationStaffResponseController extends Controller
{
    private $applicationStaffResponse;

    function __construct(StaffResponseRepository $applicationStaffResponse)
    {
        $this->applicationStaffResponse = $applicationStaffResponse;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->applicationStaffResponse->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($applicant_id)
    {
        return $this->applicationStaffResponse->show($applicant_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getApplicationStaffResponse($application_staff_resp_id)
    {
        return $this->applicationStaffResponse->getApplicationStaffResponse($application_staff_resp_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->applicationStaffResponse->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->applicationStaffResponse->destroy($id);
    }
}
