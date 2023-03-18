<?php

namespace App\Repositories\staffResponse;

interface StaffResponseInterface{
   public function store($request);
   public function update($request, $id);
   public function show($id);
   public function destroy($id);
}
