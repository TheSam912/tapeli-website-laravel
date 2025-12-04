@extends('admin.admin_master')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0"></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">All Features</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive table-responsive nowrap dataTable no-footer dtr-inline"
                                    aria-describedby="datatable_info" style="width: 1246px;">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable"
                                                rowspan="1" colspan="1" style="width: 192px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">SI</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable"
                                                rowspan="1" colspan="1" style="width: 192px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Title</th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable"
                                                rowspan="1" colspan="1" style="width: 192px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Description</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 340px;"
                                                aria-label="Position: activate to sort column ascending">Icon</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 140px;"
                                                aria-label="Start date: activate to sort column ascending">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->icon }}</td>
                                                <td>
                                                    <a href="{{ route('edit.feature', $item->id) }}"
                                                        class="btn btn-success btn-sm">Edit</a>
                                                    <a href="{{ route('delete.feature', $item->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection