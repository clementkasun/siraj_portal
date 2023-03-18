<?php

namespace App\Repositories\candidate;

interface CandidateInterface{
   public function index();
   public function store($request);
   public function show();
}
