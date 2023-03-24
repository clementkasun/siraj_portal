<?php

namespace App\Repositories\phoneNumber;

interface PhoneNumberInterface{
   public function index();
   public function store($request);
   public function update($id, $request);
   public function phoneNumberProfile($id);
   public function show();
   public function getPhoneNumberDetails($id);
   public function destroy($id);
}
