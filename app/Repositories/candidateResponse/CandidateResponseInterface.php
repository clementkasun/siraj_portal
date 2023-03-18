<?php

namespace App\Repositories\candidateResponse;

interface CandidateResponseInterface{
   public function index($id);
   public function store($request);
   public function update($request, $id);
   public function show();
   public function getCandidate($id);
   public function destroy($id);
}
