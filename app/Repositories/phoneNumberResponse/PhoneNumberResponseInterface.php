<?php

namespace App\Repositories\phoneNumberResponse;

interface PhoneNumberResponseInterface{
   public function index($id);
   public function store($request);
   public function show($id);
}
