<?php

namespace App\Repositories\vacancy;

interface VacancyInterface{
   public function index();
   public function store($request);
   public function update($request, $id);
   public function getVacancy($id);
   public function getPaginatedVacancy($request);
   public function show();
   public function destroy($id);
}
