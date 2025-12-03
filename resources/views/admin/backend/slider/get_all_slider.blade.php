@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                                                        <h4 class="card-title mb-0">All Slider items
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('update.review') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $review->id }}">
                                                <div class="card-body">
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">First Name</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="name"
                                                                value="{{ $review->name }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Position</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="position"
                                                                value="{{ $review->position }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Message</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <textarea class="form-control" type="text"
                                                                name="message">{{ $review->message }}</textarea>
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



@endsection()