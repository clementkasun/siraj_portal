<?php

namespace App\Repositories\educationalQualification;

interface EducationalQualificationInterface{
   public function store($request);
   public function update($request, $id);
   public function show($id);
   public function getEducationalQualification($id);
   public function destroy($id);
}
