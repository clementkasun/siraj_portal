<?php

namespace App\Repositories\blogPost;

interface BlogPostInterface{
   public function index();
   public function store($request);
   public function getBlogPost($id);
   public function update($request, $id);
   public function show();
   public function destroy($id);
}
