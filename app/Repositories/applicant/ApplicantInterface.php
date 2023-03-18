<?php

namespace App\Repositories\applicant;

interface ApplicantInterface{
   public function store($request);
   public function editApplicant($id);
   public function update($request, $id);
   public function show();
   public function getApplicantDetail($id);
   public function applicantProfile($id);
   public function viewApplication($id);
   public function destroy($id);
}
