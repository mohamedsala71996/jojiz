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
    <div class="container-fluid pt-4 px-4">


        <div class="row text-center mb-4">
            <h4>Online Orders</h4>
        </div>

        {{-- //popup modal for edit user --}}
        <div class="modal" id="editmainOrder">
            <div class="modal-dialog" style="width: 92%;max-width: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Order</h5>
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
                        <div class="card-body custom-card-body pt-4 pb-2">
                            <div class="row">
                                <div class="col-4">
                                    <h4><a href="">Total <span class="total">0</span> Orders </a></h4>
                                </div>

                                <div class="col-8" style="text-align: right">

                                    <a href="{{ url('admin/create/order') }}" class="btn btn-primary btn-sm mb-2"><span
                                            style="font-weight: bold;">+</span> Add New Order</a>

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
                                <table class="table table-centered table-borderless table-hover mb-0" id="orderinfo"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.ID')</th>
                                            <th>Invoice ID</th>
                                            <th>Name</th>
                                            <th>Products</th>
                                            <th>Total</th>
                                            <th>Courier</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th style="width: 133px;">Notes</th>
                                            <th style="width: 133px;">User</th>
                                            <th class="hidden-sm">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        {{-- //user role --}}

        @if (empty($status))
        @else
            <input type="text" id="orderstatus" value="{{ $status }}" hidden>
        @endif
    </div>


    <script>
        $(document).ready(function() {


            var orderstatus = $('#orderstatus').val();

            var orderinfotbl = $('#orderinfo').DataTable({
                ajax: {
                    url: "{{ url('admin/online/orders-data') }}",
                },
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 30,
                columnDefs: [{
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
                        data: "orderDate",
                        width: "20%"
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

            //assign user
            $(document).on('click', '.assign-user', function(e) {
                e.preventDefault();

                var rows_selected = orderinfotbl.column(0).checkboxes.selected();
                console.log(rows_selected);
                var ids = [];
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
                var user_id = $(this).attr('data-id');

                jQuery.ajax({
                    type: "get",
                    url: "{{ url('admin/order/assign_user') }}",
                    contentType: "application/json",
                    data: {
                        action: "assign",
                        ids: ids,
                        user_id: user_id
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data["status"] == "success") {
                            swal(data["message"]);
                            orderinfotbl.ajax.reload();
                        } else {
                            if (data["status"] == "failed") {
                                swal(data["message"]);
                            } else {
                                swal("Something wrong ! Please try again.");
                            }
                        }
                    }
                });

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

            $(document).on('click', '#delete_selected_order', function(e) {
                e.preventDefault();
                var rows_selected = orderinfotbl.column(0).checkboxes.selected();
                var ids = [];
                $.each(rows_selected, function(index, rowId) {
                    ids[index] = rowId;
                });
                swal({
                        title: "@lang('backend.Are you sure?')",
                        text: "Once deleted, you will not be able to recover this !",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "GET",
                                url: "{{ url('order/delete_selected_order') }}",
                                data: {
                                    orders_id: ids,
                                },
                                success: function(response) {
                                    countorder();
                                    var data = JSON.parse(response);
                                    if (data["status"] == "success") {
                                        swal(data["message"]);
                                        orderinfotbl.ajax.reload();
                                    } else {
                                        if (data["status"] == "failed") {
                                            swal(data["message"]);
                                        } else {
                                            swal("Something wrong ! Please try again.");
                                        }
                                    }
                                }
                            });


                        } else {
                            swal("Your data is safe!");
                        }
                    });

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
                    // console.log(title);
                    if (title == 'Order Date') {
                        $(this).html(
                            '<input type="text" style="width: 60px;" class="form-control datepicker" id="dateorder" placeholder="Date" />'
                        );
                    }

                    if (title == 'Courier') {
                        $(this).html(
                            ' <select type="text" class="form-control courierID" id="courierID" onchange="courierid()" style="width: 70px;  placeholder="Courier" ></select>'
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
                placeholder: "Select a User",
                allowClear: true,
                ajax: {
                    url: '{{ url('order/users') }}',
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
                    url: '{{ url('order/courier') }}',
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


            function countorder() {
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/order/count') }}",
                    contentType: "application/json",
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data["status"] == "success") {

                            $('#all').text(data["all"]);
                            $('#pending').text(data["pending"]);
                            $('#readytoship').text(data["readytoship"]);
                            $('#hold').text(data["hold"]);
                            $('#shipped').text(data["shipped"]);
                            $('#cancelled').text(data["cancelled"]);
                            $('#completed').text(data["completed"]);
                            $('#packaging').text(data["packaging"]);
                            $('#delfailed').text(data["delFailed"]);
                            $('#return').text(data["return"]);
                            $('#refund').text(data["refund"]);
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

            $(document).on('click', '.btn-editorder', function(e) {

                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "get",
                    url: "{{ url('order') }}/" + id + "/edit",
                    success: function(response) {
                        $('.modal .modal-body').html('');
                        $('.modal .modal-body').empty().append(response);
                        $('.modal').modal('toggle');
                        $('.modal-footer').hide();

                        $(".datepicker").flatpickr();

                        $("#productID").select2({
                            placeholder: "@lang('backend.Select a Product')",
                            dropdownParent: $('#productTable'),
                            allowClear: true,
                            templateResult: function(state) {
                                if (!state.id) {
                                    return state.text;
                                }
                                var $state = $(
                                    '<span><img width="60px" src="' + state
                                    .image + '" class="img-flag" /> ' + state
                                    .text + '" (Size: "' + state.size +
                                    ")</span>"
                                );
                                return $state;
                            },
                            ajax: {
                                type: 'GET',
                                url: '{{ url('admin_order/products') }}',
                                processResults: function(data) {
                                    return {
                                        results: data.data
                                    };
                                }
                            }
                        }).trigger("change").on("select2:select", function(e) {
                            $("#productTable tbody").append(
                                "<tr>" +
                                '<td style="display: none"><input type="hidden" id="prd" value="new"><input type="text" class="productID" style="width:80px;" value="' +
                                e.params.data.id + '"></td>' +
                                '<td><input type="text" name="color" id="ProductColor" value="" style="    max-width: 60px;"> </td>' +
                                '<td><input type="text" name="size" id="ProductSize" value="' +
                                e.params.data.size +
                                '" style="    max-width: 40px;"></td>' +
                                '<td><span class="productCode">' + e.params.data
                                .productCode + '</span></td>' +
                                '<td><span class="productName">' + e.params.data
                                .text +
                                '</span><br><input type="text" name="sigment" id="sigment" class="form-control" value="" style="max-width: 250px;"></td>' +
                                '<td><input type="number" class="productQuantity form-control" style="width:80px;" value="1"></td>' +
                                '<td><input type="text" name="productPrice" class="productPrice" value="' +
                                e.params.data.productPrice +
                                '" style="max-width: 60px;"></td>' +
                                '<td><button class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                                "</tr>"
                            );
                            calculation();
                            $('#productID').val(null).trigger('change');
                        });


                        $("#courierID").select2({
                            placeholder: "Courier",
                            allowClear: true,
                            dropdownParent: $('#courierdatatbl'),
                            ajax: {
                                url: '{{ url('order/couriers') }}',
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
                                    $("#cityID").empty().append(
                                        '<option value="8">Dhaka</option>');
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
                                url: '{{ url('order/cities') }}',
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
                                url: '{{ url('order/zones') }}',
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
                            ajax: "{{ url('admin_order/getComment') }}?id=" + $(
                                '#orderCommentTable').attr('data-id'),
                            ordering: false,
                            lengthChange: false,
                            bFilter: false,
                            search: false,
                            info: false,
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

                        var oldOrderTable = $("#oldOrderTable").DataTable({
                            ajax: "{{ url('order/previous_orders') }}?id=" + $(
                                '#oldOrderTable').attr('data-id'),
                            ordering: false,
                            lengthChange: false,
                            bFilter: false,
                            search: false,
                            info: false,
                            columns: [{
                                    data: "invoiceID"
                                },
                                {
                                    data: null,
                                    width: "15%",
                                    render: function(data) {
                                        return '<i class="fas fa-user mr-2 text-grey-dark"></i>' +
                                            data.customerName +
                                            '<br> <i class="fas fa-phone  mr-2 text-grey-dark"></i>' +
                                            data.customerPhone +
                                            '<br><i class="fas fa-map-marker mr-2 text-grey-dark"></i>' +
                                            data.customerAddress;
                                    }
                                },
                                {
                                    data: "products"
                                },
                                {
                                    data: "subTotal"
                                },
                                {
                                    data: "status"
                                },
                                {
                                    data: "name"
                                }
                            ]
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
                                    url: "{{ url('order/updateComment') }}",
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


                        if ($("#paymentTypeID").text()) {
                            var paymentType = $("#paymentTypeID").val();
                            if (paymentType == "") {
                                $(".paymentID").hide();
                                $(".paymentAgentNumber").hide();
                                $(".paymentAmount").hide();
                            } else {
                                $(".paymentID").show();
                                $(".paymentAgentNumber").show();
                                $(".paymentAmount").show();
                            }
                        }

                        $("#paymentTypeID").select2({
                            placeholder: "Select a payment Type",
                            dropdownParent: $('#paymntidname'),
                            allowClear: true,
                            ajax: {
                                data: function(params) {
                                    return {
                                        q: params.term
                                    };
                                    console.log(params);
                                },
                                url: '{{ url('order/paymenttype') }}',
                                processResults: function(data) {

                                    var data = $.parseJSON(data);
                                    return {
                                        results: data
                                    };
                                }
                            }
                        }).trigger("change").on("select2:select", function(e) {
                            if (e.params.data.text == "") {
                                $(".paymentID").hide();
                                $(".paymentAgentNumber").hide();
                                $(".paymentAmount").hide();
                            } else {
                                $(".paymentID").show();
                                $(".paymentAgentNumber").show();
                                $(".paymentAmount").show();
                            }
                        }).on("select2:unselect", function(e) {
                            $(".paymentID").hide();
                            $(".paymentAgentNumber").hide();
                            $(".paymentAmount").hide();
                            calculation();
                        });

                        $("#paymentID").select2({
                            placeholder: "Select a payment Number",
                            dropdownParent: $('#paymentIDname'),
                            allowClear: true,
                            ajax: {
                                data: function(params) {
                                    return {
                                        q: params.term,
                                        paymentTypeID: $("#paymentTypeID").val(),
                                    };
                                },
                                type: 'GET',
                                url: '{{ url('order/paymentnumber') }}',

                                processResults: function(data) {
                                    var data = $.parseJSON(data);
                                    return {
                                        results: data
                                    };
                                }
                            }
                        });

                        $(document).on("change", ".productQuantity", function() {
                            calculation();
                        });
                        $(document).on("input", ".productPrice", function() {
                            calculation();
                        });
                        $(document).on("input", "#paymentAmount", function() {
                            calculation();
                        });
                        $(document).on("input", "#deliveryCharge", function() {
                            calculation();
                        });
                        $(document).on("input", "#discountCharge", function() {
                            calculation();
                        });
                        calculation();

                        function calculation() {
                            var subtotal = 0;
                            var deliveryCharge = +$("#deliveryCharge").val();
                            var discountCharge = +$("#discountCharge").val();
                            var paymentAmount = +$("#paymentAmount").val();
                            $("#productTable tbody tr").each(function(index) {
                                subtotal = subtotal + +$(this).find(".productPrice")
                                    .val() * +$(this).find(".productQuantity").val();
                            });
                            $("#subtotal").text(subtotal);
                            $("#total").text(subtotal + deliveryCharge - paymentAmount -
                                discountCharge);
                        }

                        $(document).on("click", ".delete-btn", function() {
                            $(this).closest("tr").remove();
                            calculation();
                        });


                    }
                });
            });


            $(document).on("click", "#btn-update", function() {
                var id = $(this).val();
                var invoiceID = $("#invoiceID");
                var customerName = $("#customerName");
                var customerPhone = $("#customerPhone");
                var customerAddress = $("#customerAddress");
                var courier_tracking_link = $("#courier_tracking_link");
                var areaID = $("#areaID");
                var customerNote = $("#customerNote");
                var storeID = $("#storeID");
                var total = +$("#total").text();
                var deliveryCharge = +$("#deliveryCharge").val();
                var discountCharge = +$("#discountCharge").val();
                var paymentTypeID = $("#paymentTypeID").val();
                var paymentID = $("#paymentID").val();
                var paymentAmount = +$("#paymentAmount").val();
                var paymentAgentNumber = $("#paymentAgentNumber").val();
                var orderDate = $("#orderDate");
                var courierID = $("#courierID");
                var hub_name = $("#hub_name");
                var cityID = +$("#cityID").val();
                var zoneID = +$("#zoneID").val();
                var memo = $("#memo").val();
                var product = [];
                var productCount = 0;

                $("#productTable tbody tr").each(function(index, value) {
                    var currentRow = $(this);
                    var obj = {};
                    obj.productColor = currentRow.find("#ProductColor").val();
                    obj.sigment = currentRow.find("#sigment").val();
                    obj.productSize = currentRow.find("#ProductSize").val();
                    obj.productID = currentRow.find(".productID").val();
                    obj.productCode = currentRow.find(".productCode").text();
                    if (currentRow.find("#ProductSize").val() == '' && currentRow.find("#prd")
                        .val() == 'old') {
                        toastr.error('please select any size');
                        return false;
                    }
                    obj.productName = currentRow.find(".productName").text();
                    obj.productQuantity = currentRow.find(".productQuantity").val();
                    obj.productPrice = currentRow.find(".productPrice").val();
                    product.push(obj);
                    productCount++;
                });

                if (storeID.val() == '') {
                    toastr.error('Store Should Not Be Empty');
                    storeID.closest('.form-group').find('.select2-selection').css('border',
                        '1px solid red');
                    return;
                }
                storeID.closest('.form-group').find('.select2-selection').css('border',
                    '1px solid #ced4da');

                if (invoiceID.val() == '') {
                    toastr.error('Invoice ID Should Not Be Empty');
                    invoiceID.css('border', '1px solid red');
                    return;
                }
                invoiceID.css('border', '1px solid #ced4da');

                if (customerName.val() == '') {
                    toastr.error('Customer Name Should Not Be Empty');
                    customerName.css('border', '1px solid red');
                    return;
                }
                customerName.css('border', '1px solid #ced4da');

                if (customerPhone.val() == '') {
                    toastr.error('Customer Phone Should Not Be Empty');
                    customerPhone.css('border', '1px solid red');
                    return;
                }
                customerPhone.css('border', '1px solid #ced4da');

                if (customerAddress.val() == '') {
                    toastr.error('Customer Address Should Not Be Empty');
                    customerAddress.css('border', '1px solid red');
                    return;
                }
                customerAddress.css('border', '1px solid #ced4da');

                if (orderDate.val() == '') {
                    toastr.error('Order Date Should Not Be Empty');
                    orderDate.css('border', '1px solid red');
                    return;
                }
                orderDate.css('border', '1px solid #ced4da');

                if (courierID.val() == '') {
                    toastr.error('Courier Should Not Be Empty');
                    courierID.closest('.form-group').find('.select2-selection').css('border',
                        '1px solid red');
                    return;
                }
                courierID.css('border', '1px solid #ced4da');

                if (productCount == 0) {
                    toastr.error('Product Should Not Be Empty');
                    return;
                }

                var data = {};
                data["invoiceID"] = invoiceID.val();
                data["storeID"] = storeID.val();
                data["customerName"] = customerName.val();
                data["customerPhone"] = customerPhone.val();
                data["customerAddress"] = customerAddress.val();
                data["customerNote"] = customerNote.val();
                data["courier_tracking_link"] = courier_tracking_link.val();
                data["total"] = total;
                data["deliveryCharge"] = deliveryCharge;
                data["discountCharge"] = discountCharge;
                data["paymentTypeID"] = paymentTypeID;
                data["paymentID"] = paymentID;
                data["paymentAmount"] = paymentAmount;
                data["paymentAgentNumber"] = paymentAgentNumber;
                data["orderDate"] = orderDate.val();
                data["courierID"] = +courierID.val();
                data["cityID"] = cityID;
                data["zoneID"] = zoneID;
                data["areaID"] = areaID.val();
                data["hub_name"] = hub_name.val();
                data["userID"] = $('#user_id').val();
                data["products"] = product;
                data["memo"] = memo;
                $.ajax({
                    type: "PUT",
                    url: "{{ url('admin_orders') }}/" + id,
                    data: {
                        'data': data,
                        '_token': token
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data["status"] === "success") {
                            toastr.success(data["message"]);
                            $('.modal').modal('toggle');
                        } else {
                            toastr.error(data["message"]);
                        }
                        orderinfotbl.ajax.reload();
                    }
                });


            });


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
