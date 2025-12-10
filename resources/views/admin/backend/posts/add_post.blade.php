@extends('admin.admin_master')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/user_dropdown.css') }}">
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectWrapper = document.getElementById('authorSelect');
            const dropdown = document.getElementById('authorDropdown');
            const nameInput = document.getElementById('author_name');
            const idInput = document.getElementById('author_id');

            if (!selectWrapper || !dropdown || !nameInput || !idInput) {
                return; // safety check
            }

            // Toggle dropdown when clicking on the visible input
            nameInput.addEventListener('click', function () {
                const isVisible = dropdown.style.display === 'block';
                dropdown.style.display = isVisible ? 'none' : 'block';
            });

            // Handle option click
            document.querySelectorAll('.author-option').forEach(function (item) {
                item.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    idInput.value = id;       // hidden input -> sent in form
                    nameInput.value = name;   // display name

                    dropdown.style.display = 'none';
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!selectWrapper.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
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
                                                        <h4 class="card-title mb-0">Add New Post
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('store.post') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Title</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="title">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">description</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <textarea class="form-control" type="text"
                                                                name="description"></textarea>
                                                        </div>
                                                    </div>
                                                    {{-- select author based on author_id start --}}
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Author</label>
                                                        <div class="col-lg-12 col-xl-12">

                                                            <div class="author-select" id="authorSelect">
                                                                {{-- This will be sent to the database --}}
                                                                <input type="hidden" name="author_id" id="author_id">

                                                                {{-- This is just for display --}}
                                                                <input type="text" class="form-control" id="author_name"
                                                                    placeholder="Select author...">

                                                                <ul class="author-dropdown" id="authorDropdown">
                                                                    @foreach($users as $user)
                                                                        <li class="author-option" data-id="{{ $user->id }}"
                                                                            data-name="{{ $user->name }}">
                                                                            {{ $user->name }} ({{ $user->email }})
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                            @error('author_id')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    {{-- select author based on author_id end --}}
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Read Time</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="read_time">
                                                        </div>
                                                    </div>
                                                    <div class="pt-4">
                                                        <button type="submit" class="btn btn-primary">Add</button>
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