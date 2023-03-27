<?php

namespace App\Repositories\onlineApplicantResponse;

interface OnlineApplicantResponseInterface{
   public function index($id);
   public function store($request);
   public function show();
}
