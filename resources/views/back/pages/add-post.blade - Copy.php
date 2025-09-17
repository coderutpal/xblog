@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Add Post</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add post
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="{{ route('admin.posts') }}" class="btn btn-primary">View all posts</a>
        </div>
    </div>
</div>
<form action="{{ route('admin.create_post') }}" method="POST" enctype="multipart/form-data" autocomplete="off"
    id="addPostForm">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Title</b>:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter post title">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for=""><b>Content</b>:</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control"
                            placeholder="Enter post content here"></textarea>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                </div>
            </div>
            <div class="card card-box mb-2">
                <div class="card-header weight-500">SEO</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post meta keywords</b>: <small>(Separated by comma)</small></label>
                        <input type="text" class="form-control" name="meta_keywords"
                            placeholder="Enter post meta keywords">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Post meta description</b></label>
                        <textarea name="meta_description" id="" cols="30" rows="10" class="form-control"
                            placeholder="Post meta description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box mb-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for=""><b>Post Category</b>:</label>
                        <select name="category" id="" class="custom-select form-control">
                            <option value="">Select a category</option>
                            {!! $categories_html !!}
                        </select>
                        <span class="error-text text-danger category_error"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Post Featured Image</b>:</label>
                        <input type="file" name="featured_image" id="featured_image" class="form-control-file">
                        <span class="text-danger error-text featured_image_error"></span>
                    </div>
                    <div class="d-block mb-3" style="max-width: 250px">
                        <img id="featured_image_preview" src="" alt="Preview" class="img-thumbnail"
                            style="width:100%; display:none;">
                    </div>

                    <div class="form-group">
                        <label for=""><b>Tags</b>:</label>
                        <input type="text" name="tags" class="form-control" data-role="tagsinput">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for=""><b>Visibility</b>:</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio1" class="custom-control-input"
                                value="1" checked>
                            <label for="customRadio1" class="custom-control-label">Public</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" name="visibility" id="customRadio2" class="custom-control-input"
                                value="0">
                            <label for="customRadio2" class="custom-control-label">Private</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Create post</button>
    </div>
</form>
@endsection
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('back/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('back/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
@endpush
@push('scripts')
<!-- Preview featured image, file type and ractangle size validation js  -->
<script>
    document.getElementById('featured_image').addEventListener('change', function(event) {
        let file = event.target.files[0];
        const errorText = document.querySelector('.featured_image_error');
        errorText.textContent = '';
        const preview = document.getElementById('featured_image_preview');

        if (file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                errorText.textContent = 'Invalid file type. Only JPG, JPEG, PNG, GIF, WEBP allowed.';
                preview.style.display = 'none';
                return;
            }

            let reader = new FileReader();
            reader.onload = function(e) {
                let img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    if (img.width <= img.height) {
                        errorText.textContent =
                            'Image must be a rectangle.';
                        preview.style.display = 'none';
                    } else {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<!-- Submit form using ajax and Show Error using SweetAlert2-->
<script>
    $(document).ready(function() {
        $("#addPostForm").on("submit", function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(form).find("span.error-text").text("");
                },
                success: function(response) {
                    if (response.status === 1) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.msg,
                            timer: 2000
                        });
                        form.reset();
                        $("#featured_image_preview").hide();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.msg
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            $(form).find("span." + key + "_error").text(val[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush