@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-content">
        <!-- Contextual classes start -->
        <div class="section">
            <div class="row" id="table-contexual">

                <div class="modal fade" id="mainCoupon" tabindex="-1" data-bs-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('backend.Add New Coupon')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form name="form" id="AddCoupon" enctype="multipart/form-data">
                                    @csrf
                                    <div class="successSMS"></div>
                                    <div class="form-group mb-3">
                                        <label for="menuName" class="control-label mt-2">@lang('backend.Coupon Code') <span
                                                class="text-danger">*</span></label>
                                        <div class="">
                                            <input type="text" class="form-control" name="code" id="code"
                                                required>
                                        </div>
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="date"
                                        id="date" hidden>

                                    <div class="form-group pb-3">
                                        <label for="websiteTitle" class="control-label">@lang('backend.Type') <span
                                                class="text-danger">*</span></label>
                                        <div class="webtitle">
                                            <select class="form-control" name="type" id="type">
                                                <option value="">@lang('backend.Select One')</option>
                                                <option value="Percent">@lang('backend.Percent')</option>
                                                <option value="Amount">@lang('backend.Amount')</option>
                                            </select>
                                        </div>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="menuName" class="control-label mt-2">@lang('backend.Amount') <span
                                                class="text-danger">*</span> </label>
                                        <div class="">
                                            <input type="number" class="form-control" name="amount" id="amount"
                                                required>
                                        </div>
                                        @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group pb-3">
                                        <label for="websiteTitle" class="control-label">@lang('backend.Validity') <span
                                                class="text-danger">*</span></label>
                                        <div class="webtitle">
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                                name="validity" id="validity" required>
                                        </div>
                                        @error('validity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <!-- Coupon Type -->
                                    <div class="form-group pb-3">
                                        <label for="coupon_type" class="control-label">@lang('backend.Coupon Type') <span
                                                class="text-danger">*</span></label>

                                        <select name="coupon_type" id="coupon_type" class="form-control" required>
                                            <option value="global"> @lang('backend.Global')</option>
                                            <option value="category">@lang('backend.Category-Specific')</option>
                                        </select>
                                    </div>

                                    <!-- Categories (Visible only for Category-Specific Coupons) -->
                                    <div class="form-group" id="category-selector" style="display: none;">
                                        <label for="categories">@lang('backend.Select Categories')</label>
                                        <select name="categories[]" id="categories" class="form-control select2" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group pb-3">
                                        <label for="websiteTitle" class="control-label">@lang('backend.Status') <span
                                                class="text-danger">*</span></label>
                                        <div class="webtitle">
                                            <select class="form-control" name="status" id="status">

                                                <option value="Active">@lang('backend.Active')</option>
                                                <option value="Inactive">@lang('backend.Inactive') </option>
                                            </select>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="text-align: right">
                                        <div class="submitBtnSCourse">
                                            <button type="submit" name="btn"
                                                class="btn btn-primary AddCouponBtn btn-block">@lang('backend.Save')</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div><!-- End popup Modal-->

                <section class="section">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body custom-card-body custom-product-list-body pt-4">
                                    <div class="pagetitle row mb-2">
                                        <div class="col-12">
                                            <h4 class="card-title product-title">
                                                @lang('backend.Coupon List')
                                            </h4>
                                        </div>
                                        <div class="col-12" style="text-align: right">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#mainCoupon"><span style="font-weight: bold;">+</span>
                                                @lang('backend.Add New Coupon')</button>
                                        </div>
                                    </div>
                                    @if (\Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ \Session::get('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <!-- Table with stripped rows -->
                                    <div class="table-responsive">

                                        <table id="expense-category" class="display dataTable" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>@lang('backend.Serial No')</th>
                                                    <th>@lang('backend.Coupon')</th>
                                                    <th>@lang('backend.Coupon Type')</th>
                                                    <th>@lang('frontend.Categories')</th>
                                                    <th>@lang('backend.Amount')</th>
                                                    <th>@lang('backend.Amount Type')</th>
                                                    <th>@lang('backend.Validity')</th>
                                                    <th>@lang('backend.Status')</th>
                                                    <th>@lang('backend.Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($coupons as $key=>$data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $data->code }}</td>
                                                        <td>{{ $data->coupon_type }}</td>
                                                        <td>
                                                            @if ($data->categories->isNotEmpty())
                                                                <ul>
                                                                    @foreach ($data->categories as $category)
                                                                        <span
                                                                            class="gradient-11 p-1">{{ $category->category_name }}</span>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                @lang('backend.Not Found!')
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->amount }}</td>
                                                        <td>{{ $data->type }}</td>
                                                        <td>{{ $data->validity }}</td>
                                                        <td>{{ $data->status }}</td>

                                                        <td>
                                                            <div class="dropdown-product-list">
                                                                <button><i
                                                                        class="bi bi-three-dots dropdown-product-list"></i></button>
                                                                <div id="myDropdown"
                                                                    class="dropdown-product-list-content">
                                                                    {{-- <a href="#" type="button" id="deleteCouponBtn" data-id="{{ $data->id }}" class="confirmDelete btn btn-danger btn-sm" ><i class="bi bi-archive" ></i></a> --}}


                                                                    <a type="button" class="label rounded confirmDelete"
                                                                        data-id="{{ $data->id }}" id="deleteModalBtn"
                                                                        href="javascript:void(0)"><span><i
                                                                                class="fa-regular fa-trash-can mr-1"
                                                                                aria-hidden="true"></i></span>@lang('backend.Delete')</a>

                                                                </div>
                                                            </div>
                                                        </td>

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
                                    <!-- End Table with stripped rows -->

                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                {{-- //popup modal for edit user --}}
                <div class="modal fade" id="editmainCoupon" tabindex="-1" data-bs-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('backend.Edit Coupon')</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form name="form" id="EditCoupon" enctype="multipart/form-data">
                                    @csrf
                                    <div class="successSMS"></div>

                                    <div class="form-group mb-3">
                                        <label for="menuName" class="control-label mt-2">@lang('backend.Coupon Code')</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="code" id="code"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="websiteTitle" class="control-label">@lang('backend.Type')</label>
                                        <div class="webtitle">
                                            <select class="form-control" name="type" id="type">
                                                <option value="">@lang('backend.Select Type')</option>
                                                <option value="Percent">@lang('backend.Percent')</option>
                                                <option value="Amount">@lang('backend.Amount')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="menuName" class="control-label mt-2">@lang('backend.Amount')</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="amount" id="amount"
                                                required>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                        name="date" id="date" hidden>

                                    <div class="form-group pb-3">
                                        <label for="websiteTitle" class="control-label">@lang('backend.Validity')
                                        </label>
                                        <div class="webtitle">
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                                name="validity" id="validity" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="idhidden" id="idhidden">
                                    <div class="form-group pb-3">
                                        <label for="websiteTitle" class="control-label">@lang('backend.Status')</label>
                                        <div class="webtitle">
                                            <select class="form-control" name="status" id="status">
                                                <option value="">@lang('backend.Select One') </option>
                                                <option value="Active">@lang('backend.Action')</option>
                                                <option value="Inactive">@lang('backend.Inactive')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" style="text-align: right">
                                        <div class="submitBtnSCourse">
                                            <button type="submit" name="btn"
                                                class="btn btn-primary btn-block">@lang('backend.Save')</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div><!-- End popup Modal-->

            </div>
        </div>
        <!-- Contextual classes end -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



    <script>
        $(document).ready(function() {
            var table = new DataTable('.dataTable');
            //Coupon Type Start
            $('#coupon_type').change(function() {
                if ($(this).val() === 'category') {
                    $('#category-selector').show();
                } else {
                    $('#category-selector').hide();
                }
            });

            // Initialize Select2 for multiple category selection
            $('.select2').select2();
            //Coupon Type End
            var couponinfotbl = $('#couponinfo').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.coupon.data') !!}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'coupon_type'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'validity',
                        render: function(data) {
                            // Parse the date and format it
                            var date = new Date(data);
                            return date.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                        }
                    },
                    {
                        "data": null,
                        render: function(data) {

                            if (data.status === 'Active') {
                                return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="Inactive" id="couponstatusBtn" data-id="' +
                                    data.id + '">' + "@lang('backend.Active')" + '</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="Active" id="couponstatusBtn" data-id="' +
                                    data.id + '" >' + "@lang('backend.Inactive')" + '</button>';
                            }


                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });


            //add user

            $('#AddCoupon').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    uploadUrl: '{{ route('admin.admin.coupons.store') }}',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#couponName').val('');
                        $('#courier_id').val('');

                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            icon: "success",
                            showCancelButton: false,

                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",

                        });
                        // Reload the current page
                        location.reload();

                        $("#mainCoupon").hide();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //edit coupon

            $(document).on('click', '#editCouponBtn', function() {
                let couponId = $(this).data('id');
                $('#editcourier_id').val('');
                $('#editcouponName').val('');
                $('#EditCoupon').attr('data-id', '');
                $.ajax({
                    type: 'GET',
                    url: 'coupons/' + couponId + '/edit',

                    success: function(data) {

                        $('#EditCoupon').find('#code').val(data.code);
                        $('#EditCoupon').find('#date').val(data.date);
                        $('#EditCoupon').find('#validity').val(data.validity);
                        $('#EditCoupon').find('#type').val(data.type);
                        $('#EditCoupon').find('#amount').val(data.amount);
                        $('#EditCoupon').find('#status').val(data.status);
                        $('#EditCoupon').find('#idhidden').val(data.id);
                        $('#EditCoupon').attr('data-id', data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

            //update coupon
            $('#EditCoupon').submit(function(e) {
                e.preventDefault();
                let couponId = $('#idhidden').val();


                $.ajax({
                    type: 'POST',
                    url: 'coupon/' + couponId,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#editcourier_id').val('');
                        $('#editcouponName').val('');

                        $("#EditCoupon").trigger("reset");

                        Swal.fire({
                            title: "Coupon update successfully !",
                            icon: "success",
                            showCancelButton: false,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",

                        });
                        couponinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //deleteuser

            // $(document).on('click', '#deleteCouponBtn', function() {
            //     let couponId = $(this).data('id');
            //     swal({
            //             title: "@lang('backend.Are you sure?')",
            //             text: "Once deleted, you will not be able to recover this !",
            //             icon: "warning",
            //             buttons: true,
            //             dangerMode: true,
            //         })
            //         .then((willDelete) => {
            //             if (willDelete) {
            //                 $.ajax({
            //                     type: 'DELETE',
            //                     url: 'coupons/' + couponId,

            //                     success: function(data) {
            //                         Swal.fire("Poof! Your coupon has been deleted!", {
            //                             icon: "success",
            //                         });
            //                         couponinfotbl.ajax.reload();
            //                     },
            //                     error: function(error) {
            //                         console.log('error');
            //                     }

            //                 });


            //             } else {
            //                 swal("Your data is safe!");
            //             }
            //         });

            // });

            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                Swal.fire({
                    title: "@lang('backend.Are you sure?')",
                    text: "@lang('backend.You won\'t be able to revert this!')",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "@lang('backend.Yes, delete it!')",
                    cancelButtonText: "@lang('backend.No, cancel!')",

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: 'coupons/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                if (res.status == 'success') {
                                    Swal.fire({
                                        title: "@lang('backend.Deleted!')!",
                                        text: "@lang('backend.Your file has been deleted.')",
                                        icon: "success"
                                    });
                                    couponinfotbl.ajax.reload();
                                }
                            },
                            error: function(err) {
                                console.log('err');
                            }
                        });

                    }
                });
            });

            //status update

            $(document).on('click', '#couponstatusBtn', function() {
                let couponId = $(this).data('id');
                let couponStatus = $(this).data('status');

                $.ajax({
                    type: 'PUT',
                    url: 'coupon/status',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        coupon_id: couponId,
                        status: couponStatus,
                    },

                    success: function(data) {
                        Swal.fire({
                            title: "@lang('backend.Status updated !')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes",
                            cancelButtonText: "No",
                        });
                        couponinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });











        });
    </script>
@endsection
