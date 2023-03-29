@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<?php

use Illuminate\Support\Carbon; ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Blog Post Registration</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('create-blog-post')
                    <div class="{{ (Gate::denies('view-blog-post')) ? 'col-12' : 'col-12 col-md-4' }}">
                        <div class="card card-light">
                            <div class="card-body">
                                <form id="blog_post_form">
                                    <div class="form-group row">
                                        <label for="post_name"> Post Name * </label>
                                        <input type="text" id="post_name" name="post_name" class="form-control" placeholder="Please enter the post name" maxlength="255" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"> Description * </label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Please enter the post description" maxlength="3000" style="width: 100%;height: 150px;padding: 12px 20px;box-sizing: border-box;border-radius: 4px;" required></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label for="post_image"> Post Image * <code>(805 pixel x 520 pixel)</code></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="post_image" name="post_image" class="form-control image custom-file" accept=".jpeg, .jpg, .png" required>
                                                <label class="custom-file-label" for="post_image">Post Image</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <button type="button" class="btn btn-success btn-md m-1" id="save_blog_post">Save blog post</button>
                                        <button type="button" class="btn btn-warning btn-md m-1 d-none" id="update_blog_post">Update blog post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endcan
                    @can('view-blog-post')
                    <div class="{{ (Gate::denies('create-blog-post')) ? 'col-12' : 'col-12 col-md-8' }}">
                        <table class="table table-striped" id="blog_post_tbl">
                            <thead>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Added By</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                                @forelse($blog_posts as $key => $blog_post)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><img src='{{ $blog_post->post_image }} ' class="img-responsive" alt="blog post image" width="100px" height="100px" /></td>
                                    <td>{{ $blog_post->post_name }}</td>
                                    <td style="word-wrap: break-word; max-width: 300px">{{ $blog_post->description }}</td>
                                    <td>{{ ((isset($blog_post->AddedBy->preffered_name))) ? $blog_post->AddedBy->preffered_name : '-' }}</td>
                                    <td>{{ Carbon::parse($blog_post->created_at) }}</td>
                                    <td>
                                        @can('update-blog-post')
                                        <button type="button" class="btn btn-primary btn-sm edit m-1" data-id="{{ $blog_post->id }}"> Edit </button>
                                        @endcan
                                        @can('delete-blog-post')
                                        <button type="button" class="btn btn-danger btn-sm del m-1" data-id="{{ $blog_post->id }}"> Delete </button>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="7"><b>No Data</b></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('pageScripts')
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/blog_post.js')}}"></script>
<script src="{{ asset('plugins/checkImageSize/jquery.checkImageSize.min.js') }}"></script>
<script>
    $(function() {
        bsCustomFileInput.init();

        $('#blog_post_tbl').DataTable({
            "pageLength": 10,
            "destroy": true,
            "retrieve": true
        });

        $("#post_image").checkImageSize({
            minWidth: 805,
            minHeight: 520,
            maxWidth: 805,
            maxHeight: 520,
            showError: true,
            ignoreError: false
        });
    });
</script>
@endsection