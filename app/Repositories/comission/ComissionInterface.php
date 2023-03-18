<?php

namespace App\Repositories\comission;

interface ComissionInterface{
   public function store($request);
   public function update($request, $id);
   public function show($id);
   public function destroy($id);
}
