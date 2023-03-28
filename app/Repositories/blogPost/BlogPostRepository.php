<?php

namespace App\Repositories\blogPost;

use Exception;
use App\Models\BlogPost;
use App\Repositories\blogPost\BlogPostInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SystemNotification;

class BlogPostRepository implements BlogPostInterface
{
    public function index()
    {
        try {
            return view('blog_post.registration', ['blog_posts' => BlogPost::with(['AddedBy'])->get()]);
        } catch (Exception $ex) {
            $log['msg'] = 'Accessing blog post was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function store($request)
    {
        try {
            if (Gate::denies('create-blog-post', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to create blog post!');
            }
            $request->validate([
                'post_name' => 'required|string|max: 255',
                'description' => 'required|string|max: 3000',
                'post_image' => 'required|image|mimes:jpeg,png,jpg ',
            ]);

            $blog_post = BlogPost::create([
                'post_name' => $request->post_name,
                'description' => $request->description,
                'added_by' => auth()->user()->id
            ]);

            if ($request->hasFile('post_image')) {
                $path = public_path('/storage/blog/posts/' . $blog_post->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($blog_post->id);

                $blog_post_img     = $request->file('post_image');
                $blog_post_img_ext    = $blog_post_img->extension();

                // I am saying to create the dir if it's not there.
                $blog_post_img = \Image::make($blog_post_img->getRealPath())->resize(500, 500);
                $blog_post_img->save($path . $random_name . '.' . $blog_post_img_ext);
                $blog_post_img_path = '/storage/blog/posts/' . $blog_post->id . '/' . $random_name . '.' . $blog_post_img_ext;
                $blog_post->post_image = $blog_post_img_path;
                $blog_post->save();
            }

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];

            $log['msg'] = 'Saving blog post is successful!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return array('status' => 1, 'msg' => 'Saving blog post is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Saving blog post was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));

            return array('status' => 0, 'msg' => 'Saving blog post was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        try {
            if (Gate::denies('update-blog-post', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to blog post!');
            }

            $request->validate([
                'post_name' => 'sometimes|nullable|string|max: 255',
                'description' => 'sometimes|nullable|string|max: 3000',
                'post_image' => 'sometimes|nullable',
            ]);

            $blog_post = BlogPost::find($id);
            $blog_post->post_name = $request->post_name;
            $blog_post->description = $request->description;
            $blog_post->updated_by = auth()->user()->id;

            if ($request->hasFile('post_image')) {
                $path = public_path('/storage/blog/posts/' . $blog_post->id . '/');
                \File::exists($path) or \File::makeDirectory($path);
                $random_name = uniqid($blog_post->id);

                $blog_post_img     = $request->file('post_image');
                $blog_post_img_ext    = $blog_post_img->extension();

                // I am saying to create the dir if it's not there.
                $blog_post_img = \Image::make($blog_post_img->getRealPath())->resize(500, 500);
                $blog_post_img->save($path . $random_name . '.' . $blog_post_img_ext);
                $blog_post_img_path = '/storage/blog/posts/' . $blog_post->id . '/' . $random_name . '.' . $blog_post_img_ext;
                $blog_post->post_image = $blog_post_img_path;
            }
            $blog_post->save();

            $logged_user = auth()->user();
            $log = [
                'URI' => $request->getUri(),
                'METHOD' => $request->getMethod(),
                'REQUEST_BODY' => $request->all(),
                'RESPONSE' => $request->getContent()
            ];
            
            $log['msg'] = 'Updating blog post is successful!';
            Log::channel('daily')->info(json_encode($log));
            
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return array('status' => 1, 'msg' => 'Updating blog post is successful!');
        } catch (Exception $ex) {
            $logged_user = auth()->user();
            $log['msg'] = 'Updating blog post was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'Updating blog post was unsuccessful!');
        }
    }

    public function getBlogPost($id)
    {
        try{
            $log = [
                'URI' => '/api/get_blog_post/id/'.$id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
    
            $log['msg'] = 'Accessing blog post is successful!';
            Log::channel('daily')->info(json_encode($log));
    
            return BlogPost::where('id', $id)->with(['AddedBy'])->first();
        }catch(Exception $ex){
            $log['msg'] = 'Accessing blog post was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function show()
    {
        try{
            $log = [
                'URI' => '/api/get_blog_posts',
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
    
            $log['msg'] = 'Accessing blog posts is successful!';
            Log::channel('daily')->info(json_encode($log));
            return BlogPost::with(['AddedBy'])->get();
        }catch(Exception $ex){
            $log['msg'] = 'Accessing blog posts was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function getPaginatedBlogPosts($request)
    {
        try{
            $page = $request->page;
            $limit = 6;
            $offset = ($page - 1) * $limit;
            $blogPostArr = array();
    
            $blog_post = BlogPost::where('deleted_at', null);
    
            $itemCount = $blog_post->count();
            $pages = ceil($itemCount / $limit);
    
            $blog_posts = $blog_post->offset($offset)->limit($limit)->get();
    
            $blogPostArr["body"] = $blog_posts;
            $blogPostArr["itemCount"] = $itemCount;
            $blogPostArr["pages"] = $pages;
            $blogPostArr["current_page"] =  $page;
            
            $log['msg'] = 'Accessing paginated blog posts is successful!';
            Log::channel('daily')->info(json_encode($log));

            return $blogPostArr;
        }catch(Exception $ex){
            $log['msg'] = 'Accessing paginated blog posts was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
        }
    }

    public function destroy($id)
    {
        try{
            if (Gate::denies('delete-blog-post', auth()->user())) {
                return array('status' => 4, 'msg' => 'You are not authorised to delete blog post!');
            }
            $log = [
                'URI' => '/api/delete_blog_post/id/' . $id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => []
            ];
            $blog_post = BlogPost::find($id);
            $blog_post->deleted_by = auth()->user()->id;
            $blog_post->save();
            $blog_post->delete();
            
            $logged_user = auth()->user();
            $log = [
                'URI' => '/api/delete_blog_post/id/'.$id,
                'METHOD' => 'GET',
                'REQUEST_BODY' => [],
                'RESPONSE' => ['status' => 1, 'msg' => 'Successfully deleted the blog post!']
            ];
            $log['msg'] = 'Successfully deleted the blog post!';
            Log::channel('daily')->info(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            
            return array('status' => 1, 'msg' => 'Successfully deleted the blog post!');
        }catch(Exception $ex){
            $logged_user = auth()->user();

            $log['msg'] = 'Deleting blog post was unsuccessful!';
            $log['error'] = $ex->getMessage() . ' in line ' . $ex->getLine() . ' of file ' . $ex->getFile();
            Log::channel('daily')->error(json_encode($log));
            Notification::send($logged_user, new SystemNotification($logged_user, $log['msg']));
            return array('status' => 0, 'msg' => 'Blog post deletion was unsuccessful!');
        }
    }
}
