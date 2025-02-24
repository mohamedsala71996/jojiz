@extends('admin.layouts.master')
@push('style')
@endpush
@section('admin_content')
    <div class="page-content">
        <!-- Contextual classes start -->
        <div class="section">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="content-body">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body custom-card-body custom-product-list-body">
                                                    <h4 class="card-title product-title">
                                                        @lang('backend.Notification List')
                                                    </h4>

                                                    <div class="table-responsive">
                                                        <table id="expense-category" class="display dataTable"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.User Name')</th>
                                                                    <th>@lang('backend.User Phone')</th>
                                                                    <th>@lang('backend.Title')</th>
                                                                    <th>@lang('backend.Created Order')</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($notifications as $data)
                                                                    <tr>
                                                                        <td>{{ $data->user->name }}</td>
                                                                        <td>{{ $data->user->phone ?? '' }}</td>
                                                                        <td>{{ $data->title }}</td>
                                                                        <td>{{ $data->created_at->diffForHumans() }}</td>


                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td>@lang('frontend.No Data Found !') </td>
                                                                    </tr>
                                                                @endforelse

                                                                </thead>
                                                            <tbody>


                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Show Table
            var table = new DataTable('.dataTable');





        });
    </script>
@endpush
