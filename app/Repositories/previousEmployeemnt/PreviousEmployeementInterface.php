<?php

namespace App\Repositories\previousEmployeemnt;

interface PreviousEmployeementInterface{
   public function store($request);
   public function update($request, $id);
   public function show($id);
   public function getPreviousEmployeement($id);
   public function destroy($id);
}
