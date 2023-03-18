<?php

namespace App\Http\Controllers;

use App\Repositories\educationalQualification\EducationalQualificationRepository;
use Illuminate\Http\Request;

class ApplicantEducationalQualificationController extends Controller
{
    private $educationalQualification;

    function __construct(EducationalQualificationRepository $educationalQualification)
    {
        $this->educationalQualification = $educationalQualification;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->educationalQualification->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->educationalQualification->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEducationalQualification($id)
    {
        return $this->educationalQualification->getEducationalQualification($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->educationalQualification->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->educationalQualification->destroy($id);
    }
}
