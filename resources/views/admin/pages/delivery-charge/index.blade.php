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
                                                        @lang('backend.Delivery Charge List')
                                                    </h4>
                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <button id="addModalBtn">
                                                                        @lang('backend.Add New')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table id="expense-category" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.City')</th>
                                                                    <th>@lang('backend.Amount')</th>
                                                                    <th>@lang('backend.Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($deliveryCharges as $deliveryCharge)
                                                                    <tr>
                                                                        <td>{{ $deliveryCharge->city }}</td>
                                                                        <td>{{ $deliveryCharge->amount ?? '' }}</td>

                                                                        <td>
                                                                            <div class="dropdown-product-list">
                                                                                <button><i
                                                                                        class="bi bi-three-dots dropdown-product-list"></i></button>
                                                                                <div id="myDropdown"
                                                                                    class="dropdown-product-list-content">

                                                                                    <a type="button" class="label rounded"
                                                                                        href="javascript:void(0)"
                                                                                        id="editModalBtn"
                                                                                        data-id="{{ $deliveryCharge->id }}"><span><i
                                                                                                class="fa-solid fa-pen-to-square mr-1"
                                                                                                aria-hidden="true"></i></span>@lang('backend.Edit')</a>

                                                                                    <a type="button"
                                                                                        class="label rounded confirmDelete"
                                                                                        data-id="{{ $deliveryCharge->id }}"
                                                                                        id="deleteModalBtn"
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

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-------------========= Modal add slider start ===========--------->
                            @include('admin.components.modal.delivery-charge.add')
                            <!-------------========= Modal add Slider End ===========--------->
                            <!-------------========= Modal Edit Slider start ===========--------->
                            @include('admin.components.modal.delivery-charge.edit')
                            <!-------------========= Modal Edit Slider End ===========--------->
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
            var table = new DataTable('#expense-category');
            //Add Expense Category
            $(document).on('click', '#addModalBtn', function(e) {
                $('#Modal').modal('show');
            });


            //Expense edit
            $(document).on('click', '#editModalBtn', function(e) {
                let id = $(this).data('id');
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: `delivery-charges/${id}/edit`,
                    success: function(res) {
                        console.log(res);

                        $('#editForm').find('#city').val(res.city);
                        $('#editForm').find('#amount').val(res.amount);
                        $('#editForm').find('#id').val(id);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            // //Expense Category Update
            $('#editForm').submit(function(e) {
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    type: "POST",
                    url: `delivery-charges/${id}`,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    headers: {
                        'X-HTTP-Method-Override': 'PUT' // Override method to simulate a PUT request
                    },
                    success: function(res) {
                        $('#city').val();
                        $('#amount').val();
                        // table.ajax.reload();
                        $('#editModal').modal('hide');

                        window.location.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Expense Category Delete
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
                            url: `delivery-charges/${id}`,
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
                                    // table.ajax.reload();
                                }
                                toastr.success(res.message);
                                window.location.reload();
                            },
                            error: function(err) {
                                console.log('err');
                            }
                        });

                    }
                });
            });

        });
    </script>
@endpush
