<?php

namespace App\Repositories\contact;

interface ContactInterface{
   public function index();
   public function store($request);
   public function show();
   public function changeContactStatus($request, $id);
}
