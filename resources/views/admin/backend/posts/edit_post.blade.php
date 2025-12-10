@extends('admin.admin_master')
@section('admin')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/post_image.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/user_dropdown.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').on('change', function (e) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $('#showImage').attr('src', event.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
    <script>
        (function () {
            const input = document.getElementById('image_url');
            const preview = document.getElementById('showImage');
            const defaultSrc = "{{ url('upload/no_image.jpg') }}";

            if (!input || !preview) return;

            input.addEventListener('input', function (e) {
                const url = e.target.value.trim();

                if (url) {
                    preview.src = url;
                } else {
                    preview.src = defaultSrc;
                }
            });
        })();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image_url');   // URL text input
            const preview = document.getElementById('showImage'); // <img>
            const defaultSrc = "{{ url('upload/no_image.jpg') }}";

            if (!input || !preview) {
                // Elements not found; avoid silent failure
                return;
            }

            function updatePreview() {
                const url = input.value.trim();

                if (url) {
                    // If image fails to load (bad URL, blocked, etc.), reset to default
                    preview.onerror = function () {
                        this.onerror = null;         // avoid loop
                        this.src = defaultSrc;
                    };
                    preview.src = url;
                } else {
                    preview.src = defaultSrc;
                }
            }

            // For typing, pasting, and when field loses focus
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        });
    </script>
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content text-muted bg-white">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="card border mb-0">

                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="card-title mb-0">Edit Post
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('update.post') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <div class="card-body">
                                                    <div class="col-lg-12 col-xl-12 mb-3">
                                                        <div class="image-preview-wrapper">
                                                            <img id="showImage" src="{{ !empty($post?->cover_image)
        ? $post->cover_image
        : url('upload/no_image.jpg')      
                                                                            }}" alt="cover image"
                                                                class="image-preview img-thumbnail">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Image Cover (URL)</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="cover_image"
                                                                id="image_url" placeholder="https://example.com/image.jpg"
                                                                value="{{ old('cover_image', $post->cover_image ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Title</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="title"
                                                                value="{{ $post->title }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Description</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="description"
                                                                value="{{ $post->description }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">read_time</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="read_time"
                                                                value="{{ $post->read_time }}">
                                                        </div>
                                                    </div>
                                                    <div class="pt-4">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>

                                                </div><!--end card-body-->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Tab panes -->
        </div>
    </div>
    </div>
    </div>
@endsection()