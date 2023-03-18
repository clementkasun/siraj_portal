<?php

namespace App\Http\Controllers;

use App\Models\ApplicantLanguage;
use App\Repositories\applicantLanguage\ApplicantLanguageRepository;
use Illuminate\Http\Request;

class ApplicantLanguagesController extends Controller
{
    private $applicantLanguage;

    function __construct(ApplicantLanguageRepository $applicantLanguage)
    {
        $this->applicantLanguage = $applicantLanguage;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->applicantLanguage->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApplicantLanguages  $applicantLanguages
     * @return \Illuminate\Http\Response
     */
    public function show($applicant_id)
    {
        return $this->applicantLanguage->show($applicant_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $applicant_language_id
     * @return \Illuminate\Http\Response
     */
    public function getApplicantLanguage($applicant_lan_id)
    {
        return $this->applicantLanguage->getApplicantLanguage($applicant_lan_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApplicantLanguages  $applicantLanguages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->applicantLanguage->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApplicantLanguages  $applicantLanguages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->applicantLanguage->destroy($id);
    }
}
