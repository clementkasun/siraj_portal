@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Blog Post Registration</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-light">
                            <div class="card-body">
                                <form id="blog_post_form">
                                    <div class="form-group row">
                                        <label for="post_name"> Post Name * </label>
                                        <input type="text" id="post_name" name="post_name" class="form-control" placeholder="Please enter the post name" maxlength="255" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"> Description * </label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Please enter the post description" maxlength="3000" style="width: 100%;height: 150px;padding: 12px 20px;box-sizing: border-box;border: 2px solid #ccc;border-radius: 4px;" required></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label for="post_image"> Post Image * <code>(805  pixel x 520 pixel)</code></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="post_image" name="post_image" class="form-control image" accept=".jpeg, .jpg, .png" required>
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
                    <div class="col-md-9">
                        <table class="table table-stripped" id="blog_post_tbl">
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
                                <tr>
                                    <td class="text-center" colspan="7"><b>No Data</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
    var USER_ID = '{{auth()->user()->id}}';
    $(function() {
        bsCustomFileInput.init();
        load_blog_posts();

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