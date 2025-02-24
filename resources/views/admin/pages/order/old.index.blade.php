@extends('admin.layouts.master')

@section('admin_content')
    <?php
    use App\Models\Admin\Admin;
    $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    $users = Admin::where('status', 1)->get();
    ?>

    <style>
        .card-box {
            background-color: #ffffff !important;
            padding: 1.5rem;
            -webkit-box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
            box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
            margin-bottom: 24px;
            border-radius: 0.25rem;
        }
    </style>
    <div class="container-fluid pt-4">

        <div class="pagetitle row">
            <div class="col-12 text-center mb-4">
                <h4><a href="{{ url('/admin/dashboard') }}">@lang('backend.Order Lists')</a></h4>
            </div>
        </div><!-- End Page Title -->

        <div class="row">

            <div class="col-md-6 col-xl-3">
                <a href="{{ url('admin/admin_order/orderall') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.All Order')</h6>
                                    <h5 class="font-extrabold mb-0" id="all">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Pending') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fa-regular fa-hourglass-half"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Pending')</h6>
                                    <h5 class="font-extrabold mb-0" id="pending">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Confirmed') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="fa-solid fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Confirmed')</h6>
                                    <h5 class="font-extrabold mb-0" id="confirmed">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Ongoing') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Ongoing')</h6>
                                    <h5 class="font-extrabold mb-0" id="ongoing">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Delivered') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="fa-solid fa-truck-ramp-box"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Delivered')</h6>
                                    <h5 class="font-extrabold mb-0" id="delivered">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Canceled') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Canceled')</h6>
                                    <h5 class="font-extrabold mb-0" id="canceled">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Returned') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Returned')</h6>
                                    <h5 class="font-extrabold mb-0" id="returned">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ url('admin/admin_order/Rejected') }}">
                    <div class="card">
                        <div class="card-body custom-card-body card-hover px-4 py-3">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fa-solid fa-ban"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                    <h6 class="text-muted font-semibold">@lang('backend.Rejected')</h6>
                                    <h5 class="font-extrabold mb-0" id="rejected">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- //popup modal for edit user --}}
        <div class="modal" id="editOrder">
            <div class="modal-dialog" style="width: 1200px;max-width: none;">
                <div class="modal-content" style="width: 1200px;margin-left: -180px;">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('backend.Edit Order')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">



                    </div>

                </div>
            </div>
        </div><!-- End popup Modal-->

        <div class="modal" id="viewOrder">
            <div class="modal-dialog" style="width: 1200px;max-width: none;">
                <div class="modal-content" style="width: 1200px;margin-left: -180px;">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('backend.View Order Details')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">



                    </div>

                </div>
            </div>
        </div><!-- End popup Modal-->

        {{-- //table section for category --}}

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body custom-card-body custom-product-list-body pt-4 pb-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="">@lang('backend.Total') <span class="total">0</span>
                                            @lang('backend.Orders') </a></h4>
                                </div>

                                <div class="col-lg-12 mt-2 order-new">

                                    <a href="{{ url('admin/create/order') }}"
                                        class="btn btn-primary rounded-pill mb-2">@lang('backend.Add New Order')</a>

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


                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-hover mb-0" id="orderinfo"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.ID')</th>
                                            <th>@lang('backend.Invoice ID')</th>
                                            <th>@lang('backend.Name')</th>
                                            <th>@lang('backend.Products')</th>
                                            <th>@lang('backend.Total')</th>
                                            <th>@lang('backend.Courier')</th>
                                            <th>@lang('backend.Status')</th>
                                            <th style="width: 133px;">@lang('backend.Notes')</th>
                                            <th style="width: 133px;">@lang('backend.User')</th>
                                            <th class="hidden-sm">@lang('backend.Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>

                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


        @if (empty($status))
        @else
            <input type="text" id="orderstatus" value="{{ $status }}" hidden>
        @endif
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.dropdown-toggle').dropdown()
        });
        $(document).ready(function() {

            countorder();

            var orderstatus = $('#orderstatus').val();

            var orderinfotbl = $('#orderinfo').DataTable({
                ajax: {
                    url: "{{ url('admin/order/') }}" + '/' + orderstatus,
                },
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 30,
                columnDefs: [{
                    targets: 7, // Index of the notification column
                    visible: false, // Disable the column visibility
                }, {
                    targets: 0,
                    checkboxes: {
                        selectRow: false,
                    },
                }, ],

                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'invoice',
                        width: "15%"
                    },
                    {
                        data: 'customerInfo',
                        width: "25%",
                        className: "customerInfo"
                    },
                    {
                        data: "products",
                        width: "15%",
                    },
                    {
                        data: "subTotal",
                        width: "5%"
                    },
                    {
                        data: "courier",
                        width: "20%",
                        searchable: false
                    },
                    {
                        data: 'statusButton',
                        width: "10%"
                    },
                    {
                        data: 'notification',
                        width: "15%"
                    },
                    {
                        data: "user",
                        width: "5%",
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],

                footerCallback: function() {
                    var api = this.api();
                    var numRows = api.rows().count();

                    $('.total').empty().append(numRows);

                    var intVal = function(i) {
                        return typeof i === "string" ? i.replace(/[\$,]/g, "") * 1 :
                            typeof i === "number" ? i : 0;
                    };
                    pageTotal = api.column(4, {
                        page: "current"
                    }).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    $(api.column(4).footer()).html(pageTotal + " {{ $currency->symbol }}");
                }

            });

            // update status selected item

            $(document).on('click', '.btn-change-status', function(e) {
                e.preventDefault();
                var rows_selected = orderinfotbl.column(0).checkboxes.selected();
                var ids = [];
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
                var status = $(this).attr('data-status');
                $.ajax({
                    type: "get",
                    url: "{{ url('order/statusUpdateByCheckbox') }}",
                    data: {
                        'status': status,
                        'orders_id': ids,
                        '_token': token
                    },
                    success: function(response) {
                        countorder();
                        var data = JSON.parse(response);
                        if (data['status'] == 'success') {
                            toastr.success(data["message"]);
                            orderinfotbl.ajax.reload();
                        } else {
                            if (data['status'] == 'failed') {
                                toastr.error(data["message"]);
                            } else {
                                toastr.error('Something wrong ! Please try again.');
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let order_id = $(this).data('id');

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
                            url: "../order/destroy/" + order_id,
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
                                    orderinfotbl.ajax.reload();
                                }
                            },
                            error: function(err) {
                                console.log('err');
                            }
                        });

                    }
                });
            });


            //delete order selectes

            $(document).on('click', '.order-print-btn', function(e) {
                e.preventDefault();
                var rows_selected = orderinfotbl.column(0).checkboxes.selected();
                var ids = [];
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });

                if (ids.length > 0) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('order/store/Invoice') }}",
                        data: {
                            orders_id: ids
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            if (data['status'] === 'success') {
                                window.open(data['link'], "_blank");
                                swal({
                                    title: "@lang('backend.Are you sure?')",
                                    text: "All invoiced Printed !",
                                    type: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                }).then((t) => {
                                    if (t) {
                                        $.ajax({
                                            type: "get",
                                            url: "{{ url('order/statusUpdateByCheckbox') }}",
                                            data: {
                                                'status': 'Invoiced',
                                                'orders_id': ids,
                                                '_token': token
                                            },
                                            success: function(response) {
                                                var data = JSON.parse(
                                                    response);
                                                if (data['status'] ===
                                                    'success') {
                                                    toastr.success(data[
                                                        "message"]);
                                                    orderinfotbl.ajax
                                                        .reload();
                                                } else {
                                                    if (data['status'] ===
                                                        'failed') {
                                                        toastr.error(data[
                                                            "message"
                                                        ]);
                                                    } else {
                                                        toastr.error(
                                                            'Something wrong ! Please try again.'
                                                        );
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        swal("Invoice Stay Pending !");
                                    }
                                });

                            } else {
                                if (data['status'] === 'failed') {
                                    toastr.error(data["message"]);
                                } else {
                                    toastr.error('Something wrong ! Please try again.');
                                }
                            }


                        }

                    });
                } else {
                    swal("Oops...!", "Select at last one", "error");
                }


            });

            $('#orderinfo thead th').each(function() {
                //count orders
                countorder();
                var title = $(this).text();
                if (title != 'Status' &&
                    title != '' &&
                    title != 'Action' &&
                    title != 'Products' &&
                    title != 'Total') {

                    if (title == 'Courier') {
                        $(this).html(
                            ' <select type="text" class="form-control courierID" id="courierID" style="width: 70px;  placeholder="Courier" ></select>'
                        );
                    }
                    if (title == 'User') {
                        $(this).html(
                            ' <select type="text" style="width: 100px;" class="form-control" id="userID" placeholder="User" ></select>'
                        );
                    }
                    if (title == 'Invoice ID') {
                        $(this).html(
                            ' <input type="text" class="form-control cuID" placeholder="Invoice ID" />');
                    }
                    if (title == 'Name') {
                        $(this).html(
                            ' <input type="text" class="form-control" placeholder="Customer Phone" />');
                    }

                }
            });

            $("#userID").select2({
                placeholder: "Staff",
                allowClear: true,
                ajax: {
                    url: '{{ url('admin/order/users') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });

            $("#courierID").select2({
                placeholder: "Courier",
                allowClear: true,
                ajax: {
                    url: '{{ url('admin/order/couriers') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });

            $("#cityID").select2({
                placeholder: "Select a City",
                allowClear: true,
                ajax: {
                    url: '{{ url('order/cities') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });

            orderinfotbl.columns().every(function() {

                var orderinfotbl = this;
                $('input', this.header()).on('keyup change', function() {
                    if (orderinfotbl.search() !== this.value) {
                        orderinfotbl.search(this.value).draw();
                    }
                });

                $('select', this.header()).on('change', function() {
                    if (orderinfotbl.search() !== this.value) {
                        orderinfotbl.search(this.value).draw();
                    }
                });

            });


            function courierid() {
                var cur = $('#courierID').select2('val');
                var id = $('#courier_id').val(cur);

                if (id == '') {
                    swal("Oops...!", "Select at last one", "error");

                }
            }

            //change order status
            var token = $("input[name='_token']").val();

            $(document).on('click', '.btn-status', function(e) {
                e.preventDefault();
                var status = $(this).attr('data-status');
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/order/status') }}",
                    data: {
                        'status': status,
                        'id': id,
                        '_token': token
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        countorder();
                        if (data['status'] == 'success') {
                            orderinfotbl.ajax.reload();
                            toastr.success(data["message"]);
                        } else {
                            if (data['status'] == 'failed') {
                                toastr.error(data["message"]);
                            } else {
                                toastr.error('Something wrong ! Please try again.');
                            }
                        }
                    }
                });
            });

            //order edit
            $(document).on('click', '#orderEdit', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    type: "get",
                    url: "{{ url('admin/orders') }}/" + id + "/edit",
                    success: function(response) {
                        $('#editOrder .modal-body').html('');
                        $('#editOrder .modal-body').empty().append(response);
                        $('#editOrder').modal('toggle');
                        $('#editOrder .modal-footer').hide();


                        // $("#productID").select2({
                        //     placeholder: "@lang('backend.Select a Product')",
                        //     dropdownParent: $('#productTable'),
                        //     allowClear: true,
                        //     templateResult: function(state) {
                        //         if (!state.id) {
                        //             return state.product_name;
                        //         }
                        //         if (state.weight == '') {
                        //             var $state = $(
                        //                 '<span><img width="60px" src="' + state
                        //                 .image + '" class="img-flag" /> ' +
                        //                 state.product_name + '" (Size: "' +
                        //                 state.size + ")</span>"
                        //             );
                        //         } else {
                        //             var $state = $(
                        //                 '<span><img width="60px" src="' + state
                        //                 .image + '" class="img-flag" /> ' +
                        //                 state.product_name + '" (Weight: "' +
                        //                 state.weight + ")</span>"
                        //             );
                        //         }
                        //         return $state;
                        //     },
                        //     ajax: {
                        //         type: 'GET',
                        //         url: '{{ url('admin/order/products') }}',
                        //         processResults: function(data) {
                        //             return {
                        //                 results: data.data
                        //             };
                        //         }
                        //     }
                        // }).trigger("change").on("select2:select", function(e) {
                        //     $("#productTable tbody").append(
                        //         "<tr>" +
                        //         '<td style="display: none">' +
                        //         '<input type="hidden" class="orderproductID" value="">' +
                        //         '<input type="hidden" class="productID" value="' + e
                        //         .params.data.product_id + '">' +
                        //         '<input type="hidden" class="variationID" value="' +
                        //         e.params.data.varient_id + '">' +
                        //         '<input type="hidden" class="sizeID" value="' + e
                        //         .params.data.size_id + '">' +
                        //         '<input type="hidden" class="codeID" value="' + e
                        //         .params.data.code_id + '">' +
                        //         '<input type="hidden" class="weightID" value="' + e
                        //         .params.data.weight_id + '">' +
                        //         '</td>' +
                        //         '<td><span class="code" id="code">' + e.params.data
                        //         .code + '</span></td>' +
                        //         '<td>' +
                        //         '<span class="Color">' +
                        //         '<input type="text" name="color" id="color" value="' +
                        //         e.params.data.color +
                        //         '" style="max-width: 60px;">' +
                        //         '</span>' +
                        //         '</td>' +
                        //         '<td>' +
                        //         '<span class="Size">' +
                        //         '<input type="text" name="size" id="size" value="' +
                        //         e.params.data.size + '" style="max-width: 60px;">' +
                        //         '</span>' +
                        //         '</td>' +
                        //         '<td>' +
                        //         '<span class="Size">' +
                        //         '<input type="text" name="weight" id="weight" value="' +
                        //         e.params.data.weight +
                        //         '" style="max-width: 40px;">' +
                        //         '</span>' +
                        //         '</td>' +
                        //         '<td><span class="productName">' + e.params.data
                        //         .product_name + '</span></td>' +
                        //         '<td><input type="number" class="qty form-control" style="width:80px;" value="1"></td>' +
                        //         '<td><span class="price">' + e.params.data
                        //         .SalePrice + '</span></td>' +
                        //         '<td><button class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>' +
                        //         "</tr>"
                        //     );
                        //     calculation();
                        //     $('#productID').val(null).trigger('change');
                        // });

                        $("#courierID").select2({
                            placeholder: "Courier",
                            allowClear: true,
                            dropdownParent: $('#courierdatatbl'),
                            ajax: {
                                url: '{{ url('admin/order/couriers') }}',
                                processResults: function(data) {
                                    var data = $.parseJSON(data);
                                    return {
                                        results: data
                                    };
                                }
                            }
                        }).trigger("change").on("select2:select", function(e) {
                            $("#zoneID").empty();
                            for (var i = 0; i < couriers.length; i++) {
                                if (couriers[i]['courierName'] == e.params.data.text) {
                                    if (couriers[i]['hasCity'] == 'on') {
                                        jQuery(".hasCity").show();
                                    } else {
                                        jQuery(".hasCity").hide();
                                    }
                                    if (couriers[i]["hasZone"] == 'on') {
                                        jQuery(".hasZone").show();
                                    } else {
                                        jQuery(".hasZone").hide();
                                        $("#zoneID").empty();
                                    }
                                }

                                if (e.params.data.text == 'Pathao') {
                                    $("#cityID").empty();
                                } else {
                                    $("#cityID").empty();
                                }
                            }

                        });

                        if ($("#courierID").text()) {
                            var courier = $("#courierID").text().trim();
                            for (var i = 0; i < couriers.length; i++) {
                                if (couriers[i]['courierName'] == courier) {
                                    if (couriers[i]['hasCity'] == 'on') {
                                        jQuery(".hasCity").show();
                                    } else {
                                        jQuery(".hasCity").hide();
                                    }

                                    if (couriers[i]["hasZone"] == 'on') {
                                        jQuery(".hasZone").show();
                                    } else {
                                        jQuery(".hasZone").hide();
                                        $("#zoneID").empty();
                                    }
                                }
                            }
                        }

                        $("#cityID").select2({
                            placeholder: "Select a City",
                            dropdownParent: $('#citydatatbl'),
                            allowClear: true,
                            ajax: {
                                data: function(params) {
                                    var query = {
                                        q: params.term,
                                        courierID: $("#courierID").val()
                                    };
                                    return query;
                                },
                                type: 'GET',
                                url: '{{ url('admin/order/cities') }}',
                                processResults: function(data) {
                                    var data = $.parseJSON(data);
                                    return {
                                        results: data
                                    };
                                }
                            }
                        });

                        $("#zoneID").select2({
                            placeholder: "Select a Zone",
                            dropdownParent: $('#xonedatatbl'),
                            allowClear: true,
                            ajax: {
                                data: function(params) {
                                    var query = {
                                        q: params.term,
                                        courierID: $("#courierID").val(),
                                        cityID: $("#cityID").val()
                                    };
                                    return query;
                                },
                                type: 'GET',
                                url: '{{ url('admin/order/zones') }}',
                                processResults: function(data) {
                                    var data = $.parseJSON(data);
                                    return {
                                        results: data
                                    };
                                    console.log(data);
                                }
                            }
                        });

                        $("#areaID").select2({
                            placeholder: "Select a Area",
                            dropdownParent: $('#aredatatbld'),
                            ajax: {
                                data: function(params) {
                                    var query = {
                                        q: params.term,
                                        courierID: $("#courierID").val(),
                                        zoneID: $("#zoneID").val()
                                    };
                                    return query;
                                },
                                type: 'GET',
                                url: '{{ url('admin/order/areas') }}',
                                processResults: function(data) {
                                    var data = $.parseJSON(data);
                                    return {
                                        results: data
                                    };
                                    console.log(data);
                                }
                            }
                        });

                        var orderCommentTable = $("#orderCommentTable").DataTable({
                            ajax: "{{ url('admin/order/getComment') }}?id=" + $(
                                '#orderCommentTable').attr('data-id'),
                            ordering: false,
                            lengthChange: false,
                            bFilter: false,
                            search: false,
                            info: false,
                            paging: false,

                            columns: [{
                                    data: "date"
                                },
                                {
                                    data: "comment"
                                },
                                {
                                    data: "name"
                                }
                            ],
                        });

                        $(document).on("click", "#updateComment", function() {
                            var note = $('#comment');
                            var id = $('#btn-update').val();
                            if (note.val() == '') {
                                note.css('border', '1px solid red');
                                return;
                            } else if (id == '') {
                                toastr.success('Something Wrong , Try again ! ');
                                return;
                            } else {
                                $.ajax({
                                    type: "GET",
                                    url: "{{ url('admin/order-update/comment') }}",
                                    data: {
                                        'comment': note.val(),
                                        'id': id,
                                        '_token': token
                                    },
                                    success: function(response) {
                                        var data = JSON.parse(response);
                                        if (data['status'] == 'success') {
                                            toastr.success(data["message"]);
                                            orderCommentTable.ajax.reload();
                                        } else {
                                            if (data['status'] ==
                                                'failed') {
                                                toastr.error(data[
                                                    "message"]);
                                            } else {
                                                toastr.error(
                                                    'Something wrong ! Please try again.'
                                                );
                                            }
                                        }
                                    }
                                });

                            }
                            return;

                        });

                        $(document).on("change", ".qty", function() {
                            calculation();
                        });
                        $(document).on("input", ".price", function() {
                            calculation();
                        });
                        $(document).on("input", "#paidAmount", function() {
                            calculation();
                        });
                        $(document).on("input", "#shippingCharge", function() {
                            calculation();
                        });
                        $(document).on("input", "#vat", function() {
                            calculation();
                        });
                        $(document).on("input", "#tax", function() {
                            calculation();
                        });
                        $(document).on("input", "#discount", function() {
                            calculation();
                        });
                        calculation();

                        // function calculation() {
                        //     var subtotal = 0;
                        //     var shippingCharge = +$("#shippingCharge").val();
                        //     var vat = +$("#vat").val();
                        //     var tax = +$("#tax").val();
                        //     var discount = +$("#discount").val();
                        //     var paidAmount = +$("#paidAmount").val();
                        //     $("#productTable tbody tr").each(function(index) {
                        //         subtotal = subtotal + +$(this).find(".price").text() * +
                        //             $(this).find(".qty").val();
                        //     });
                        //     $("#subtotal").text(subtotal);
                        //     $("#total").text(subtotal + vat + tax + shippingCharge -
                        //         paidAmount - discount);
                        // }
                        function calculation() {
                            let subtotal = 0;
                            const shippingCharge = parseFloat($("#shippingCharge").val()) || 0;
                            const vat = parseFloat($("#vat").val()) || 0;
                            const tax = parseFloat($("#tax").val()) || 0;
                            const discount = parseFloat($("#discount").val()) || 0;
                            const paidAmount = parseFloat($("#paidAmount").val()) || 0;

                            $("#productTable tbody tr").each(function() {
                                const price = parseFloat($(this).find(".price")
                                    .text()) || 0;
                                const qty = parseFloat($(this).find(".qty").val()) || 0;
                                subtotal += price * qty;
                            });

                            $("#subtotal").text(subtotal.toFixed(2));
                            $("#total").text((subtotal + vat + tax + shippingCharge -
                                paidAmount - discount).toFixed(2));
                        }



                        $(document).on("click", ".delete-btn", function() {
                            $(this).closest("tr").remove();
                            calculation();
                        });


                    }
                });
            });

            // $(document).on('click', '#orderDetails', function(e) {
            //     e.preventDefault();
            //     var id = $(this).attr('data-id');

            //     $.ajax({
            //         type: "get",
            //         url: "{{ url('admin/order-details') }}/" + id,
            //         success: function(response) {

            //             $('#viewOrder .modal-body').html('');
            //             $('#viewOrder .modal-body').empty().append(response);
            //             $('#viewOrder').modal('toggle');
            //             $('#viewOrder .modal-footer').hide();

            //             var orderCommentTable = $("#orderCommentTable").DataTable({
            //                 ajax: "{{ url('admin/order/getComment') }}?id=" + $(
            //                     '#orderCommentTable').attr('data-id'),
            //                 ordering: false,
            //                 lengthChange: false,
            //                 bFilter: false,
            //                 search: false,
            //                 info: false,
            //                 paging: false,
            //                 columns: [{
            //                         data: "date"
            //                     },
            //                     {
            //                         data: "comment"
            //                     },
            //                     {
            //                         data: "name"
            //                     }
            //                 ],
            //             });

            //             $(document).on("click", "#updateComment", function() {
            //                 var note = $('#comment');
            //                 var id = $('#btn-update').val();
            //                 if (note.val() == '') {
            //                     note.css('border', '1px solid red');
            //                     return;
            //                 } else if (id == '') {
            //                     toastr.success('Something Wrong , Try again ! ');
            //                     return;
            //                 } else {
            //                     $.ajax({
            //                         type: "GET",
            //                         url: "{{ url('admin/order-update/comment') }}",
            //                         data: {
            //                             'comment': note.val(),
            //                             'id': id,
            //                             '_token': token
            //                         },
            //                         success: function(response) {
            //                             var data = JSON.parse(response);
            //                             if (data['status'] == 'success') {
            //                                 toastr.success(data["message"]);
            //                                 orderCommentTable.ajax.reload();
            //                             } else {
            //                                 if (data['status'] ==
            //                                     'failed') {
            //                                     toastr.error(data[
            //                                         "message"]);
            //                                 } else {
            //                                     toastr.error(
            //                                         'Something wrong ! Please try again.'
            //                                     );
            //                                 }
            //                             }
            //                         }
            //                     });

            //                 }
            //                 return;

            //             });

            //             $(document).on("change", ".qty", function() {
            //                 calculation();
            //             });
            //             $(document).on("input", ".price", function() {
            //                 calculation();
            //             });
            //             $(document).on("input", "#paidAmount", function() {
            //                 calculation();
            //             });
            //             $(document).on("input", "#shippingCharge", function() {
            //                 calculation();
            //             });
            //             $(document).on("input", "#vat", function() {
            //                 calculation();
            //             });
            //             $(document).on("input", "#tax", function() {
            //                 calculation();
            //             });
            //             $(document).on("input", "#discount", function() {
            //                 calculation();
            //             });
            //             calculation();

            //             function calculation() {
            //                 var subtotal = 0;
            //                 var shippingCharge = +$("#shippingCharge").val();
            //                 var vat = +$("#vat").val();
            //                 var tax = +$("#tax").val();
            //                 var discount = +$("#discount").val();
            //                 var paidAmount = +$("#paidAmount").val();
            //                 $("#productTable tbody tr").each(function(index) {
            //                     subtotal = subtotal + +$(this).find(".price").text() * +
            //                         $(this).find(".qty").val();
            //                 });
            //                 $("#subtotal").text(subtotal);
            //                 $("#total").text(subtotal + vat + tax + shippingCharge -
            //                     paidAmount - discount);
            //             }


            //         }
            //     });
            // });
            $(document).on('click', '#orderDetails', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    type: "get",
                    url: "{{ url('admin/order-details') }}/" + id,
                    success: function(response) {

                        $('#viewOrder .modal-body').html('');
                        $('#viewOrder .modal-body').empty().append(response);
                        $('#viewOrder').modal('toggle');
                        $('#viewOrder .modal-footer').hide();

                        // Check if DataTable is already initialized, if so, destroy it
                        if ($.fn.DataTable.isDataTable('#orderCommentTable')) {
                            $('#orderCommentTable').DataTable().clear().destroy();
                        }

                        // Initialize DataTable
                        var orderCommentTable = $("#orderCommentTable").DataTable({
                            ajax: "{{ url('admin/order/getComment') }}?id=" + $(
                                '#orderCommentTable').attr('data-id'),
                            ordering: false,
                            lengthChange: false,
                            bFilter: false,
                            search: false,
                            info: false,
                            paging: false,
                            columns: [{
                                    data: "date"
                                },
                                {
                                    data: "comment"
                                },
                                {
                                    data: "name"
                                }
                            ],
                        });

                        // Update comment functionality
                        $(document).on("click", "#updateComment", function() {
                            var note = $('#comment');
                            var id = $('#btn-update').val();
                            if (note.val() == '') {
                                note.css('border', '1px solid red');
                                return;
                            } else if (id == '') {
                                toastr.success('Something Wrong , Try again ! ');
                                return;
                            } else {
                                $.ajax({
                                    type: "GET",
                                    url: "{{ url('admin/order-update/comment') }}",
                                    data: {
                                        'comment': note.val(),
                                        'id': id,
                                        '_token': token
                                    },
                                    success: function(response) {
                                        var data = JSON.parse(response);
                                        if (data['status'] == 'success') {
                                            toastr.success(data["message"]);
                                            orderCommentTable.ajax.reload();
                                        } else {
                                            if (data['status'] ==
                                                'failed') {
                                                toastr.error(data[
                                                    "message"]);
                                            } else {
                                                toastr.error(
                                                    'Something wrong ! Please try again.'
                                                );
                                            }
                                        }
                                    }
                                });
                            }
                            return;
                        });

                        // Additional calculations
                        $(document).on("change", ".qty", calculation);
                        $(document).on("input", ".price", calculation);
                        $(document).on("input", "#paidAmount", calculation);
                        $(document).on("input", "#shippingCharge", calculation);
                        $(document).on("input", "#vat", calculation);
                        $(document).on("input", "#tax", calculation);
                        $(document).on("input", "#discount", calculation);
                        calculation();

                        function calculation() {
                            var subtotal = 0;
                            var shippingCharge = +$("#shippingCharge").val();
                            var vat = +$("#vat").val();
                            var tax = +$("#tax").val();
                            var discount = +$("#discount").val();
                            var paidAmount = +$("#paidAmount").val();
                            $("#productTable tbody tr").each(function(index) {
                                subtotal += +$(this).find(".price").text() * +$(this)
                                    .find(".qty").val();
                            });
                            $("#subtotal").text(subtotal);
                            $("#total").text(subtotal + vat + tax + shippingCharge -
                                paidAmount - discount);
                        }
                    }
                });
            });



            $(document).on("click", "#btn-update", function() {
                var id = $(this).val();
                var invoiceID = $("#invoiceID");
                var name = $("#name");
                var email = $("#email");
                var phone = $("#phone");
                var country = $("#country");
                var state = $("#state");
                var city = $("#city");
                var address = $("#address");
                var zip_code = $("#zip_code");
                var courierID = $("#courierID");
                var hub_name = $("#hub_name");
                var cityID = $("#cityID");
                var zoneID = $("#zoneID");
                var areaID = $("#areaID");
                var subtotal = $("#subtotal");
                var orderDate = $("#orderDate");
                var shippingCharge = $("#shippingCharge");
                var vat = $("#vat");
                var tax = $("#tax");
                var discount = $("#discount");
                var paidAmount = $("#paidAmount");
                var total = $("#total");
                var product = [];
                var productCount = 0;

                $("#productTable tbody tr").each(function(index, value) {
                    var currentRow = $(this);
                    var obj = {};
                    obj.orderproductID = currentRow.find(".orderproductID").val();
                    obj.productID = currentRow.find(".productID").val();
                    obj.variationID = currentRow.find(".variationID").val();
                    obj.sizeID = currentRow.find(".sizeID").val();
                    obj.codeID = currentRow.find(".codeID").val();
                    obj.weightID = currentRow.find(".weightID").val();
                    obj.code = currentRow.find("#code").text();
                    obj.color = currentRow.find("#color").val();
                    obj.size = currentRow.find("#size").val();
                    obj.weight = currentRow.find("#weight").val();
                    obj.productName = currentRow.find(".productName").text();
                    obj.qty = currentRow.find(".qty").val();
                    obj.price = currentRow.find(".price").text();
                    product.push(obj);
                    productCount++;
                });


                if (invoiceID.val() == '') {
                    toastr.error('Invoice ID Should Not Be Empty');
                    invoiceID.css('border', '1px solid red');
                    return;
                }
                invoiceID.css('border', '1px solid #ced4da');

                if (name.val() == '') {
                    toastr.error('Name Should Not Be Empty');
                    name.css('border', '1px solid red');
                    return;
                }
                name.css('border', '1px solid #ced4da');

                if (phone.val() == '') {
                    toastr.error('Phone Should Not Be Empty');
                    phone.css('border', '1px solid red');
                    return;
                }
                phone.css('border', '1px solid #ced4da');

                if (address.val() == '') {
                    toastr.error('Address Should Not Be Empty');
                    address.css('border', '1px solid red');
                    return;
                }
                address.css('border', '1px solid #ced4da');

                if (orderDate.val() == '') {
                    toastr.error('Order Date Should Not Be Empty');
                    orderDate.css('border', '1px solid red');
                    return;
                }
                orderDate.css('border', '1px solid #ced4da');

                if (productCount == 0) {
                    toastr.error('Product Should Not Be Empty');
                    return;
                }

                var data = {};
                data["invoiceID"] = invoiceID.val();
                data["name"] = name.val();
                data["email"] = email.val();
                data["phone"] = phone.val();
                data["country"] = country.val();
                data["state"] = state.val();
                data["city"] = city.val();
                data["address"] = address.val();
                data["zip_code"] = zip_code.val();
                data["courierID"] = courierID.val();
                data["hub_name"] = hub_name.val();
                data["cityID"] = cityID.val();
                data["zoneID"] = zoneID.val();
                data["areaID"] = areaID.val();
                data["orderDate"] = orderDate.val();
                data["subtotal"] = subtotal.text();
                data["shippingCharge"] = shippingCharge.val();
                data["vat"] = vat.val();
                data["tax"] = vat.val();
                data["discount"] = discount.val();
                data["paidAmount"] = paidAmount.val();
                data["total"] = total.text();
                data["products"] = product;
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/order-update') }}/" + id,
                    data: {
                        'data': data,
                        '_token': token
                    },
                    success: function(response) {
                        console.log(response);
                        var data = JSON.parse(response);
                        if (data["status"] === "success") {
                            toastr.success(data["message"]);
                            $('#editOrder').modal('toggle');
                        } else {
                            toastr.error(data["message"]);
                        }
                        orderinfotbl.ajax.reload();
                    }
                });


            });


            function countorder() {
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/order/count') }}",
                    contentType: "application/json",
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data["status"] == "success") {

                            $('#pending').text(data["pending"]);
                            $('#confirmed').text(data["confirmed"]);
                            $('#ongoing').text(data["ongoing"]);
                            $('#delivered').text(data["delivered"]);
                            $('#canceled').text(data["canceled"]);
                            $('#returned').text(data["returned"]);
                            $('#rejected').text(data["rejected"]);
                            $('#all').text(data["all"]);

                        } else {
                            if (data["status"] == "failed") {
                                swal(data["message"]);
                            } else {
                                swal("Something wrong ! Please try again.");
                            }
                        }
                    }
                });
            }

            $(".datepicker").flatpickr();

        });
    </script>


    <style>
        .card-box {
            background-color: #17b1ff;
            padding: 1.5rem;
            -webkit-box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
            box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
            margin-bottom: 24px;
            border-radius: 0.25rem;
        }

        a {
            text-decoration: none;
        }
    </style>
@endsection
