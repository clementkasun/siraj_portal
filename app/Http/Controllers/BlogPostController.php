<?php

namespace App\Http\Controllers;

use App\Repositories\blogPost\BlogPostRepository;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    private $blogPostRepository;

    function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->blogPostRepository->index();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->blogPostRepository->store($request);
    }
    
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->blogPostRepository->show();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginatedBlogPosts(Request $request)
    {
        return $this->blogPostRepository->getPaginatedBlogPosts($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlogPost($id)
    {
        return $this->blogPostRepository->getBlogPost($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->blogPostRepository->update($request, $id);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->blogPostRepository->destroy($id);
    }
}
