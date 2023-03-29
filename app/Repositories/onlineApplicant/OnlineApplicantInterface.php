<?php

namespace App\Repositories\onlineApplicant;

interface OnlineApplicantInterface{
   public function index();
   public function store($request);
   public function changeOnlineAppStatus($request, $id);
}
