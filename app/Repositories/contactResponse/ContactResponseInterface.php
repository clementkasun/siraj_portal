<?php

namespace App\Repositories\contactResponse;

interface ContactResponseInterface
{
   public function index($id);
   public function store($request);
   public function update($request, $id);
   public function show();
   public function destroy($id);
}
