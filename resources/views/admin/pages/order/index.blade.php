@extends('admin.layouts.master')

@section('admin_content')
    <?php
    // use App\Models\Admin\Admin;
    // $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    // $users = Admin::where('status', 1)->get();
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
        </div>

        <div class="row">

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('admin.orders.status', 'all') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $all_orders }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> <!-- end col-->
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'pending') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $pending }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'confirmed') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $confirmed }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'ongoing') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $ongoing }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'delivered') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $delivered }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'canceled') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $canceled }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'returned') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $returned }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a style="text-decoration: none;" href="{{ route('admin.orders.status', 'rejected') }}">
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
                                    <h5 class="font-extrabold mb-0">{{ $rejected }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body custom-card-body custom-product-list-body pt-4 pb-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><a href="">@lang('backend.Total') <span
                                                class="total">{{ $all_orders }}</span>
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

                                <table class="display dataTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.ID')</th>
                                            <th>@lang('backend.Invoice ID')</th>
                                            <th>@lang('backend.Order Date')</th>
                                            <th>@lang('backend.Customer Info')</th>
                                            <th>@lang('backend.Total Amount')</th>
                                            <th>@lang('backend.Order Status')</th>
                                            <th class="hidden-sm">@lang('backend.Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $key=> $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->invoiceID }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>
                                                    {{ $data->user->name ?? '' }} <br />
                                                    {{ $data->user->email ?? '' }}
                                                </td>
                                                <td>
                                                    @if ($currency->symbol_position == 'left')
                                                        {{ $currency->symbol }}
                                                        {{ $data->total }}
                                                    @else
                                                        {{ $data->total }}{{ $currency->symbol }}
                                                    @endif
                                                </td>
                                                <td><span class="badge--primary">{{ $data->status }}</span></td>
                                                </td>
                                                <td>
                                                    <div class="dropdown-product-list">
                                                        <button><i
                                                                class="bi bi-three-dots dropdown-product-list"></i></button>
                                                        <div id="myDropdown" class="dropdown-product-list-content">

                                                            <a type="button" class="label rounded"
                                                                href="{{ route('admin.orders.show', $data->id) }}"
                                                                data-id="{{ $data->id }}"><span><i
                                                                        class="fa-solid fa-eye mr-1"
                                                                        aria-hidden="true"></i></span>@lang('backend.Details')</a>
                                                            <a type="button" class="label rounded"
                                                                href="{{ route('admin.orders.edit', $data->id) }}"
                                                                data-id="{{ $data->id }}"><span><i
                                                                        class="fa-solid fa-pen-to-square mr-1"
                                                                        aria-hidden="true"></i></span>@lang('backend.Edit')</a>

                                                            <a type="button" class="label rounded confirmDelete"
                                                                data-id="{{ $data->id }}"
                                                                href="javascript:void(0)"><span><i
                                                                        class="fa-regular fa-trash-can mr-1"
                                                                        aria-hidden="true"></i></span>@lang('backend.Delete')</a>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td>@lang('backend.Not Found!')</td>
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

    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $('.dropdown-toggle').dropdown()
        });
        $(document).ready(function() {

            // countorder();

            // var orderstatus = $('#orderstatus').val();

            // var orderinfotbl = $('#orderinfo').DataTable({
            //     ajax: {
            //         url: "{{ url('admin/order/') }}" + '/' + orderstatus,
            //     },
            //     ordering: false,
            //     processing: true,
            //     serverSide: true,
            //     pageLength: 30,
            //     columnDefs: [{
            //         targets: 7, // Index of the notification column
            //         visible: false, // Disable the column visibility
            //     }, {
            //         targets: 0,
            //         checkboxes: {
            //             selectRow: false,
            //         },
            //     }, ],

            //     columns: [{
            //             data: 'id'
            //         },
            //         {
            //             data: 'invoice',
            //             width: "15%"
            //         },
            //         {
            //             data: 'customerInfo',
            //             width: "25%",
            //             className: "customerInfo"
            //         },
            //         {
            //             data: "products",
            //             width: "15%",
            //         },
            //         {
            //             data: "subTotal",
            //             width: "5%"
            //         },
            //         {
            //             data: "courier",
            //             width: "20%",
            //             searchable: false
            //         },
            //         {
            //             data: 'statusButton',
            //             width: "10%"
            //         },
            //         {
            //             data: 'notification',
            //             width: "15%"
            //         },
            //         {
            //             data: "user",
            //             width: "5%",
            //             searchable: false
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         },

            //     ],

            //     footerCallback: function() {
            //         var api = this.api();
            //         var numRows = api.rows().count();

            //         $('.total').empty().append(numRows);

            //         var intVal = function(i) {
            //             return typeof i === "string" ? i.replace(/[\$,]/g, "") * 1 :
            //                 typeof i === "number" ? i : 0;
            //         };
            //         pageTotal = api.column(4, {
            //             page: "current"
            //         }).data().reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);

            //         $(api.column(4).footer()).html(pageTotal + " {{ $currency->symbol }}");
            //     }

            // });

            // update status selected item

            // $(document).on('click', '.btn-change-status', function(e) {
            //     e.preventDefault();
            //     var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            //     var ids = [];
            //     $.each(rows_selected, function(index, rowId) {
            //         ids[index] = rowId;
            //     });
            //     var status = $(this).attr('data-status');
            //     $.ajax({
            //         type: "get",
            //         url: "{{ url('order/statusUpdateByCheckbox') }}",
            //         data: {
            //             'status': status,
            //             'orders_id': ids,
            //             '_token': token
            //         },
            //         success: function(response) {
            //             countorder();
            //             var data = JSON.parse(response);
            //             if (data['status'] == 'success') {
            //                 toastr.success(data["message"]);
            //                 orderinfotbl.ajax.reload();
            //             } else {
            //                 if (data['status'] == 'failed') {
            //                     toastr.error(data["message"]);
            //                 } else {
            //                     toastr.error('Something wrong ! Please try again.');
            //                 }
            //             }
            //         }
            //     });
            // });

            // $(document).on('click', '.confirmDelete', function(e) {
            //     e.preventDefault();
            //     let order_id = $(this).data('id');

            //     Swal.fire({
            //         title: "@lang('backend.Are you sure?')",
            //         text: "@lang('backend.You won\'t be able to revert this!')",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: "#3085d6",
            //         cancelButtonColor: "#d33",
            //         confirmButtonText: "@lang('backend.Yes, delete it!')",
            //         cancelButtonText: "@lang('backend.No, cancel!')",
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 type: "DELETE",
            //                 url: "order/destroy/" + order_id,
            //                 data: {
            //                     "_token": "{{ csrf_token() }}"
            //                 },
            //                 success: function(res) {
            //                     if (res.status == 'success') {
            //                         Swal.fire({
            //                             title: "@lang('backend.Deleted!')!",
            //                             text: "@lang('backend.Your file has been deleted.')",
            //                             icon: "success"
            //                         });
            //                         location.reload();
            //                     }
            //                 },
            //                 error: function(err) {
            //                     console.log('err');
            //                 }
            //             });

            //         }
            //     });
            // });


            //delete order selectes

            // $(document).on('click', '.order-print-btn', function(e) {
            //     e.preventDefault();
            //     var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            //     var ids = [];
            //     $.each(rows_selected, function(index, rowId) {
            //         ids[index] = rowId;
            //     });

            //     if (ids.length > 0) {

            //         $.ajax({
            //             type: "GET",
            //             url: "{{ url('order/store/Invoice') }}",
            //             data: {
            //                 orders_id: ids
            //             },
            //             success: function(response) {
            //                 var data = JSON.parse(response);
            //                 if (data['status'] === 'success') {
            //                     window.open(data['link'], "_blank");
            //                     swal({
            //                         title: "@lang('backend.Are you sure?')",
            //                         text: "All invoiced Printed !",
            //                         type: "warning",
            //                         buttons: true,
            //                         dangerMode: true,
            //                     }).then((t) => {
            //                         if (t) {
            //                             $.ajax({
            //                                 type: "get",
            //                                 url: "{{ url('order/statusUpdateByCheckbox') }}",
            //                                 data: {
            //                                     'status': 'Invoiced',
            //                                     'orders_id': ids,
            //                                     '_token': token
            //                                 },
            //                                 success: function(response) {
            //                                     var data = JSON.parse(
            //                                         response);
            //                                     if (data['status'] ===
            //                                         'success') {
            //                                         toastr.success(data[
            //                                             "message"]);
            //                                         orderinfotbl.ajax
            //                                             .reload();
            //                                     } else {
            //                                         if (data['status'] ===
            //                                             'failed') {
            //                                             toastr.error(data[
            //                                                 "message"
            //                                             ]);
            //                                         } else {
            //                                             toastr.error(
            //                                                 'Something wrong ! Please try again.'
            //                                             );
            //                                         }
            //                                     }
            //                                 }
            //                             });
            //                         } else {
            //                             swal("Invoice Stay Pending !");
            //                         }
            //                     });

            //                 } else {
            //                     if (data['status'] === 'failed') {
            //                         toastr.error(data["message"]);
            //                     } else {
            //                         toastr.error('Something wrong ! Please try again.');
            //                     }
            //                 }


            //             }

            //         });
            //     } else {
            //         swal("Oops...!", "Select at last one", "error");
            //     }


            // });

            // $('#orderinfo thead th').each(function() {
            //     //count orders
            //     countorder();
            //     var title = $(this).text();
            //     if (title != 'Status' &&
            //         title != '' &&
            //         title != 'Action' &&
            //         title != 'Products' &&
            //         title != 'Total') {

            //         if (title == 'Courier') {
            //             $(this).html(
            //                 ' <select type="text" class="form-control courierID" id="courierID" style="width: 70px;  placeholder="Courier" ></select>'
            //             );
            //         }
            //         if (title == 'User') {
            //             $(this).html(
            //                 ' <select type="text" style="width: 100px;" class="form-control" id="userID" placeholder="User" ></select>'
            //             );
            //         }
            //         if (title == 'Invoice ID') {
            //             $(this).html(
            //                 ' <input type="text" class="form-control cuID" placeholder="Invoice ID" />');
            //         }
            //         if (title == 'Name') {
            //             $(this).html(
            //                 ' <input type="text" class="form-control" placeholder="Customer Phone" />');
            //         }

            //     }
            // });

            // $("#userID").select2({
            //     placeholder: "Staff",
            //     allowClear: true,
            //     ajax: {
            //         url: '{{ url('admin/order/users') }}',
            //         processResults: function(data) {
            //             var data = $.parseJSON(data);
            //             return {
            //                 results: data
            //             };
            //         }
            //     }
            // });

            // $("#courierID").select2({
            //     placeholder: "Courier",
            //     allowClear: true,
            //     ajax: {
            //         url: '{{ url('admin/order/couriers') }}',
            //         processResults: function(data) {
            //             var data = $.parseJSON(data);
            //             return {
            //                 results: data
            //             };
            //         }
            //     }
            // });

            // $("#cityID").select2({
            //     placeholder: "Select a City",
            //     allowClear: true,
            //     ajax: {
            //         url: '{{ url('order/cities') }}',
            //         processResults: function(data) {
            //             var data = $.parseJSON(data);
            //             return {
            //                 results: data
            //             };
            //         }
            //     }
            // });

            // orderinfotbl.columns().every(function() {

            //     var orderinfotbl = this;
            //     $('input', this.header()).on('keyup change', function() {
            //         if (orderinfotbl.search() !== this.value) {
            //             orderinfotbl.search(this.value).draw();
            //         }
            //     });

            //     $('select', this.header()).on('change', function() {
            //         if (orderinfotbl.search() !== this.value) {
            //             orderinfotbl.search(this.value).draw();
            //         }
            //     });

            // });


            // function courierid() {
            //     var cur = $('#courierID').select2('val');
            //     var id = $('#courier_id').val(cur);

            //     if (id == '') {
            //         swal("Oops...!", "Select at last one", "error");

            //     }
            // }

            //change order status
            // var token = $("input[name='_token']").val();

            // $(document).on('click', '.btn-status', function(e) {
            //     e.preventDefault();
            //     var status = $(this).attr('data-status');
            //     var id = $(this).attr('data-id');
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ url('admin/order/status') }}",
            //         data: {
            //             'status': status,
            //             'id': id,
            //             '_token': token
            //         },
            //         success: function(response) {
            //             var data = JSON.parse(response);
            //             countorder();
            //             if (data['status'] == 'success') {
            //                 orderinfotbl.ajax.reload();
            //                 toastr.success(data["message"]);
            //             } else {
            //                 if (data['status'] == 'failed') {
            //                     toastr.error(data["message"]);
            //                 } else {
            //                     toastr.error('Something wrong ! Please try again.');
            //                 }
            //             }
            //         }
            //     });
            // });

            //order edit
            // $(document).on('click', '#orderEdit', function(e) {
            //     e.preventDefault();
            //     var id = $(this).attr('data-id');

            //     $.ajax({
            //         type: "get",
            //         url: "{{ url('admin/orders') }}/" + id + "/edit",
            //         success: function(response) {
            //             $('#editOrder .modal-body').html('');
            //             $('#editOrder .modal-body').empty().append(response);
            //             $('#editOrder').modal('toggle');
            //             $('#editOrder .modal-footer').hide();

            //             $("#courierID").select2({
            //                 placeholder: "Courier",
            //                 allowClear: true,
            //                 dropdownParent: $('#courierdatatbl'),
            //                 ajax: {
            //                     url: '{{ url('admin/order/couriers') }}',
            //                     processResults: function(data) {
            //                         var data = $.parseJSON(data);
            //                         return {
            //                             results: data
            //                         };
            //                     }
            //                 }
            //             }).trigger("change").on("select2:select", function(e) {
            //                 $("#zoneID").empty();
            //                 for (var i = 0; i < couriers.length; i++) {
            //                     if (couriers[i]['courierName'] == e.params.data.text) {
            //                         if (couriers[i]['hasCity'] == 'on') {
            //                             jQuery(".hasCity").show();
            //                         } else {
            //                             jQuery(".hasCity").hide();
            //                         }
            //                         if (couriers[i]["hasZone"] == 'on') {
            //                             jQuery(".hasZone").show();
            //                         } else {
            //                             jQuery(".hasZone").hide();
            //                             $("#zoneID").empty();
            //                         }
            //                     }

            //                     if (e.params.data.text == 'Pathao') {
            //                         $("#cityID").empty();
            //                     } else {
            //                         $("#cityID").empty();
            //                     }
            //                 }

            //             });

            //             if ($("#courierID").text()) {
            //                 var courier = $("#courierID").text().trim();
            //                 for (var i = 0; i < couriers.length; i++) {
            //                     if (couriers[i]['courierName'] == courier) {
            //                         if (couriers[i]['hasCity'] == 'on') {
            //                             jQuery(".hasCity").show();
            //                         } else {
            //                             jQuery(".hasCity").hide();
            //                         }

            //                         if (couriers[i]["hasZone"] == 'on') {
            //                             jQuery(".hasZone").show();
            //                         } else {
            //                             jQuery(".hasZone").hide();
            //                             $("#zoneID").empty();
            //                         }
            //                     }
            //                 }
            //             }

            //             $("#cityID").select2({
            //                 placeholder: "Select a City",
            //                 dropdownParent: $('#citydatatbl'),
            //                 allowClear: true,
            //                 ajax: {
            //                     data: function(params) {
            //                         var query = {
            //                             q: params.term,
            //                             courierID: $("#courierID").val()
            //                         };
            //                         return query;
            //                     },
            //                     type: 'GET',
            //                     url: '{{ url('admin/order/cities') }}',
            //                     processResults: function(data) {
            //                         var data = $.parseJSON(data);
            //                         return {
            //                             results: data
            //                         };
            //                     }
            //                 }
            //             });

            //             $("#zoneID").select2({
            //                 placeholder: "Select a Zone",
            //                 dropdownParent: $('#xonedatatbl'),
            //                 allowClear: true,
            //                 ajax: {
            //                     data: function(params) {
            //                         var query = {
            //                             q: params.term,
            //                             courierID: $("#courierID").val(),
            //                             cityID: $("#cityID").val()
            //                         };
            //                         return query;
            //                     },
            //                     type: 'GET',
            //                     url: '{{ url('admin/order/zones') }}',
            //                     processResults: function(data) {
            //                         var data = $.parseJSON(data);
            //                         return {
            //                             results: data
            //                         };
            //                         console.log(data);
            //                     }
            //                 }
            //             });

            //             $("#areaID").select2({
            //                 placeholder: "Select a Area",
            //                 dropdownParent: $('#aredatatbld'),
            //                 ajax: {
            //                     data: function(params) {
            //                         var query = {
            //                             q: params.term,
            //                             courierID: $("#courierID").val(),
            //                             zoneID: $("#zoneID").val()
            //                         };
            //                         return query;
            //                     },
            //                     type: 'GET',
            //                     url: '{{ url('admin/order/areas') }}',
            //                     processResults: function(data) {
            //                         var data = $.parseJSON(data);
            //                         return {
            //                             results: data
            //                         };
            //                         console.log(data);
            //                     }
            //                 }
            //             });

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

            // $(document).on("click", "#updateComment", function() {
            //     var note = $('#comment');
            //     var id = $('#btn-update').val();
            //     if (note.val() == '') {
            //         note.css('border', '1px solid red');
            //         return;
            //     } else if (id == '') {
            //         toastr.success('Something Wrong , Try again ! ');
            //         return;
            //     } else {
            //         $.ajax({
            //             type: "GET",
            //             url: "{{ url('admin/order-update/comment') }}",
            //             data: {
            //                 'comment': note.val(),
            //                 'id': id,
            //                 '_token': token
            //             },
            //             success: function(response) {
            //                 var data = JSON.parse(response);
            //                 if (data['status'] == 'success') {
            //                     toastr.success(data["message"]);
            //                     orderCommentTable.ajax.reload();
            //                 } else {
            //                     if (data['status'] ==
            //                         'failed') {
            //                         toastr.error(data[
            //                             "message"]);
            //                     } else {
            //                         toastr.error(
            //                             'Something wrong ! Please try again.'
            //                         );
            //                     }
            //                 }
            //             }
            //         });

            //     }
            //     return;

            // });

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

            //             // function calculation() {
            //             //     var subtotal = 0;
            //             //     var shippingCharge = +$("#shippingCharge").val();
            //             //     var vat = +$("#vat").val();
            //             //     var tax = +$("#tax").val();
            //             //     var discount = +$("#discount").val();
            //             //     var paidAmount = +$("#paidAmount").val();
            //             //     $("#productTable tbody tr").each(function(index) {
            //             //         subtotal = subtotal + +$(this).find(".price").text() * +
            //             //             $(this).find(".qty").val();
            //             //     });
            //             //     $("#subtotal").text(subtotal);
            //             //     $("#total").text(subtotal + vat + tax + shippingCharge -
            //             //         paidAmount - discount);
            //             // }
            //             function calculation() {
            //                 let subtotal = 0;
            //                 const shippingCharge = parseFloat($("#shippingCharge").val()) || 0;
            //                 const vat = parseFloat($("#vat").val()) || 0;
            //                 const tax = parseFloat($("#tax").val()) || 0;
            //                 const discount = parseFloat($("#discount").val()) || 0;
            //                 const paidAmount = parseFloat($("#paidAmount").val()) || 0;

            //                 $("#productTable tbody tr").each(function() {
            //                     const price = parseFloat($(this).find(".price")
            //                         .text()) || 0;
            //                     const qty = parseFloat($(this).find(".qty").val()) || 0;
            //                     subtotal += price * qty;
            //                 });

            //                 $("#subtotal").text(subtotal.toFixed(2));
            //                 $("#total").text((subtotal + vat + tax + shippingCharge -
            //                     paidAmount - discount).toFixed(2));
            //             }



            //             $(document).on("click", ".delete-btn", function() {
            //                 $(this).closest("tr").remove();
            //                 calculation();
            //             });


            //         }
            //     });
            // });


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

            //             // Check if DataTable is already initialized, if so, destroy it
            //             if ($.fn.DataTable.isDataTable('#orderCommentTable')) {
            //                 $('#orderCommentTable').DataTable().clear().destroy();
            //             }

            //             // Initialize DataTable
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

            //             // Update comment functionality
            // $(document).on("click", "#updateComment", function() {
            //     var note = $('#comment');
            //     var id = $('#btn-update').val();
            //     if (note.val() == '') {
            //         note.css('border', '1px solid red');
            //         return;
            //     } else if (id == '') {
            //         toastr.success('Something Wrong , Try again ! ');
            //         return;
            //     } else {
            //         $.ajax({
            //             type: "GET",
            //             url: "{{ url('admin/order-update/comment') }}",
            //             data: {
            //                 'comment': note.val(),
            //                 'id': id,
            //                 '_token': token
            //             },
            //             success: function(response) {
            //                 var data = JSON.parse(response);
            //                 if (data['status'] == 'success') {
            //                     toastr.success(data["message"]);
            //                     orderCommentTable.ajax.reload();
            //                 } else {
            //                     if (data['status'] ==
            //                         'failed') {
            //                         toastr.error(data[
            //                             "message"]);
            //                     } else {
            //                         toastr.error(
            //                             'Something wrong ! Please try again.'
            //                         );
            //                     }
            //                 }
            //             }
            //         });
            //     }
            //     return;
            // });

            //             // Additional calculations
            //             $(document).on("change", ".qty", calculation);
            //             $(document).on("input", ".price", calculation);
            //             $(document).on("input", "#paidAmount", calculation);
            //             $(document).on("input", "#shippingCharge", calculation);
            //             $(document).on("input", "#vat", calculation);
            //             $(document).on("input", "#tax", calculation);
            //             $(document).on("input", "#discount", calculation);
            //             calculation();

            //             function calculation() {
            //                 var subtotal = 0;
            //                 var shippingCharge = +$("#shippingCharge").val();
            //                 var vat = +$("#vat").val();
            //                 var tax = +$("#tax").val();
            //                 var discount = +$("#discount").val();
            //                 var paidAmount = +$("#paidAmount").val();
            //                 $("#productTable tbody tr").each(function(index) {
            //                     subtotal += +$(this).find(".price").text() * +$(this)
            //                         .find(".qty").val();
            //                 });
            //                 $("#subtotal").text(subtotal);
            //                 $("#total").text(subtotal + vat + tax + shippingCharge -
            //                     paidAmount - discount);
            //             }
            //         }
            //     });
            // });



            // $(document).on("click", "#btn-update", function() {
            //     console.log(id)
            //     var id = $(this).val();
            //     var invoiceID = $("#invoiceID");
            //     var name = $("#name");
            //     var email = $("#email");
            //     var phone = $("#phone");
            //     var country = $("#country");
            //     var state = $("#state");
            //     var city = $("#city");
            //     var address = $("#address");
            //     var zip_code = $("#zip_code");
            //     var courierID = $("#courierID");
            //     var hub_name = $("#hub_name");
            //     var cityID = $("#cityID");
            //     var zoneID = $("#zoneID");
            //     var areaID = $("#areaID");
            //     var subtotal = $("#subtotal");
            //     var orderDate = $("#orderDate");
            //     var shippingCharge = $("#shippingCharge");
            //     var vat = $("#vat");
            //     var tax = $("#tax");
            //     var discount = $("#discount");
            //     var paidAmount = $("#paidAmount");
            //     var total = $("#total");
            //     var product = [];
            //     var productCount = 0;

            //     $("#productTable tbody tr").each(function(index, value) {
            //         var currentRow = $(this);
            //         var obj = {};
            //         obj.orderproductID = currentRow.find(".orderproductID").val();
            //         obj.productID = currentRow.find(".productID").val();
            //         obj.variationID = currentRow.find(".variationID").val();
            //         obj.sizeID = currentRow.find(".sizeID").val();
            //         obj.codeID = currentRow.find(".codeID").val();
            //         obj.weightID = currentRow.find(".weightID").val();
            //         obj.code = currentRow.find("#code").text();
            //         obj.color = currentRow.find("#color").val();
            //         obj.size = currentRow.find("#size").val();
            //         obj.weight = currentRow.find("#weight").val();
            //         obj.productName = currentRow.find(".productName").text();
            //         obj.qty = currentRow.find(".qty").val();
            //         obj.price = currentRow.find(".price").text();
            //         product.push(obj);
            //         productCount++;
            //     });


            //     if (invoiceID.val() == '') {
            //         toastr.error('Invoice ID Should Not Be Empty');
            //         invoiceID.css('border', '1px solid red');
            //         return;
            //     }
            //     invoiceID.css('border', '1px solid #ced4da');

            //     if (name.val() == '') {
            //         toastr.error('Name Should Not Be Empty');
            //         name.css('border', '1px solid red');
            //         return;
            //     }
            //     name.css('border', '1px solid #ced4da');

            //     if (phone.val() == '') {
            //         toastr.error('Phone Should Not Be Empty');
            //         phone.css('border', '1px solid red');
            //         return;
            //     }
            //     phone.css('border', '1px solid #ced4da');

            //     if (address.val() == '') {
            //         toastr.error('Address Should Not Be Empty');
            //         address.css('border', '1px solid red');
            //         return;
            //     }
            //     address.css('border', '1px solid #ced4da');

            //     if (orderDate.val() == '') {
            //         toastr.error('Order Date Should Not Be Empty');
            //         orderDate.css('border', '1px solid red');
            //         return;
            //     }
            //     orderDate.css('border', '1px solid #ced4da');

            //     if (productCount == 0) {
            //         toastr.error('Product Should Not Be Empty');
            //         return;
            //     }

            //     var data = {};
            //     data["invoiceID"] = invoiceID.val();
            //     data["name"] = name.val();
            //     data["email"] = email.val();
            //     data["phone"] = phone.val();
            //     data["country"] = country.val();
            //     data["state"] = state.val();
            //     data["city"] = city.val();
            //     data["address"] = address.val();
            //     data["zip_code"] = zip_code.val();
            //     data["courierID"] = courierID.val();
            //     data["hub_name"] = hub_name.val();
            //     data["cityID"] = cityID.val();
            //     data["zoneID"] = zoneID.val();
            //     data["areaID"] = areaID.val();
            //     data["orderDate"] = orderDate.val();
            //     data["subtotal"] = subtotal.text();
            //     data["shippingCharge"] = shippingCharge.val();
            //     data["vat"] = vat.val();
            //     data["tax"] = vat.val();
            //     data["discount"] = discount.val();
            //     data["paidAmount"] = paidAmount.val();
            //     data["total"] = total.text();
            //     data["products"] = product;
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ url('admin/order-update') }}/" + id,
            //         data: {
            //             'data': data,
            //             '_token': token
            //         },
            //         success: function(response) {
            //             console.log(response);
            //             var data = JSON.parse(response);
            //             if (data["status"] === "success") {
            //                 toastr.success(data["message"]);
            //                 $('#editOrder').modal('toggle');
            //             } else {
            //                 toastr.error(data["message"]);
            //             }
            //             orderinfotbl.ajax.reload();
            //         }
            //     });


            // });


            // function countorder() {
            //     $.ajax({
            //         type: "get",
            //         url: "{{ url('admin/order/count') }}",
            //         contentType: "application/json",
            //         success: function(response) {
            //             var data = JSON.parse(response);

            //             if (data["status"] == "success") {

            //                 $('#pending').text(data["pending"]);
            //                 $('#confirmed').text(data["confirmed"]);
            //                 $('#ongoing').text(data["ongoing"]);
            //                 $('#delivered').text(data["delivered"]);
            //                 $('#canceled').text(data["canceled"]);
            //                 $('#returned').text(data["returned"]);
            //                 $('#rejected').text(data["rejected"]);
            //                 $('#all').text(data["all"]);

            //             } else {
            //                 if (data["status"] == "failed") {
            //                     swal(data["message"]);
            //                 } else {
            //                     swal("Something wrong ! Please try again.");
            //                 }
            //             }
            //         }
            //     });
            // }

            // $(".datepicker").flatpickr();

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
@endpush
