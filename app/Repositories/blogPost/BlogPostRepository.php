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
        return view('blog_post.registration');
    }

    public function store($request)
    {
        if (Gate::denies('create-blog-post', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to create blog post!');
        }
        $log = [
            'route' => '/api/save_blog_post',
        ];
        try {
            $request->validate([
                'post_name' => 'required|string|max: 255',
                'description' => 'required|string|max: 3000',
                'post_image' => 'required|image|mimes:jpeg,png,jpg ',
                'user_id' => 'required'
            ]);

            $blog_post = BlogPost::create([
                'post_name' => $request->post_name,
                'description' => $request->description,
                'user_id' => $request->user_id,
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

            // $user = auth()->user();
            $log['msg'] = 'Saving blog post is successful!';
            // Notification::send($user, new SystemNotification($user, $log['msg']));
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Saving blog post is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Saving blog post was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Saving blog post was unsuccessful!');
        }
    }

    public function update($request, $id)
    {
        if (Gate::denies('update-blog-post', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to blog post!');
        }
        $log = [
            'route' => '/api/update_blog_post/id/' . $id,
        ];
        try {

            $request->validate([
                'post_name' => 'sometimes|nullable|string|max: 255',
                'description' => 'sometimes|nullable|string|max: 3000',
                'post_image' => 'sometimes|nullable',
                'user_id' => 'required',
            ]);

            $blog_post = BlogPost::find($id);
            $blog_post->post_name = $request->post_name;
            $blog_post->description = $request->description;
            $blog_post->user_id = $request->user_id;
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

            // $user = auth()->user();
            $log['msg'] = 'Updating blog post is successful!';
            // Notification::send($user, new SystemNotification($user, $log['msg']));
            Log::channel('daily')->info(json_encode($log));

            return array('status' => 1, 'msg' => 'Updating blog post is successful!');
        } catch (Exception $e) {
            $log['msg'] = 'Updating blog post was unsuccessful!';
            $log['error'] = $e->getMessage() . ' in line ' . $e->getLine() . ' of file ' . $e->getFile();
            Log::channel('daily')->error(json_encode($log));

            return array('status' => 0, 'msg' => 'Updating blog post was unsuccessful!');
        }
    }

    public function getBlogPost($id)
    {
        // if (Gate::denies('view-blog-post', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to view blog post!');
        // }
        $log = [
            'route' => '/api/get_blog_post/id/' . $id,
            'msg' => 'Successfully accessed the blog post!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return BlogPost::where('id', $id)->with(['User'])->first();
    }

    public function show()
    {
        // if (Gate::denies('view-blog-post', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to view blog post!');
        // }
        $log = [
            'route' => '/api/get_blog_posts',
            'msg' => 'Successfully accessed the blog posts!',
        ];
        Log::channel('daily')->info(json_encode($log));
        return BlogPost::with(['User'])->get();
    }

    public function getPaginatedBlogPosts($request)
    {
        // if (Gate::denies('view-blog-post', auth()->user())) {
        //     return array('status' => 4, 'msg' => 'You are not authorised to view blog post!');
        // }
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
        return $blogPostArr;
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-blog-post', auth()->user())) {
            return array('status' => 4, 'msg' => 'You are not authorised to delete blog post!');
        }
        $log = [
            'route' => '/api/delete_blog_post/id/' . $id,
            'msg' => 'Successfully deleted the blog post!',
        ];
        $blog_post = BlogPost::find($id);
        $blog_post->deleted_by = auth()->user()->id;
        $blog_post->save();
        
        $status = $blog_post->delete();
        Log::channel('daily')->info(json_encode($log));

        if ($status == true) {
            return array('status' => 1, 'msg' => 'Successfully deleted the blog post!');
        } else {
            return array('status' => 0, 'msg' => 'Blog post deletion was unsuccessful!');
        }
    }
}
