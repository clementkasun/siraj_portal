<?php

namespace App\Repositories\applicantLanguage;

interface ApplicantLanguageInterface{
   public function store($request);
   public function update($request, $id);
   public function show($id);
   public function destroy($id);
}
