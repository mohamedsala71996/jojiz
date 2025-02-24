@extends('admin.layouts.master')

@section('admin_content')
    <style>
        .dataTables_length select.form-select.form-select-sm {
            border: 1px solid;
        }

        .dt-buttons {
            display: none;
        }

        .dropdown-product-list {
            position: relative;
        }

        .dropdown-product-list-content {
            position: absolute;
            top: -28px ;
            right: 30px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            min-width: 150px;
        }

        .dropdown-product-list-content a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
            border-radius: 4px;
        }

        .dropdown-product-list-content a:hover {
            background: #f4f4f4;
            color: #000;
        }

        .dcustomJs {
            position: absolute;
            top: -28px ;
            right: 30px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            min-width: 150px;
        }
    </style>


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
                                        <div class="col-md-12 grid-margin stretch-card product-list-card">
                                            <div class="card">
                                                <div class="card-body product-list-body custom-product-list-body">
                                                    <div class="page-heading card-title">
                                                        <h3>@lang('backend.Product List')</h3>
                                                    </div>
                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <a href="{{ url('admin/product/create') }}">
                                                                        <button>
                                                                            @lang('backend.Add Product')
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-new product-searche">

                                                                <div class="product-search-left card-title">
                                                                    <span>@lang('backend.Show Category')</span>
                                                                    <select name="category_id" id="category_id"
                                                                        aria-controls="product" class="product-show">
                                                                        <option value="All">@lang('backend.Choose')</option>
                                                                        @forelse($categories as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->category_name }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>

                                                                </div>
                                                                {{-- <div
                                                                        class="product-search-middle card-title"
                                                                    >
                                                                        <span>Download Data</span>
                                                                        <select
                                                                        name="download"
                                                                        id="download"
                                                                        aria-controls="product"
                                                                        class="product-show"
                                                                        >
                                                                        <option value="Choose">Choose</option>
                                                                        <option value="1">PDF</option>
                                                                        <option value="2">Excel</option>
                                                                        <option value="3">Print</option>
                                                                        </select>
                                                                    </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row product-row">
                                                        <div class="col-6 col-lg-4 col-md-6">
                                                            <a href="{{ url('admin/product-info/All') }}">
                                                                <div class="card order-bg-1">
                                                                    <div
                                                                        class="card-body custom-card-body card-hover px-4 py-3">
                                                                        <div class="row">
                                                                            <div
                                                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                                                <div
                                                                                    class="stats-icon green mb-2 product-icon">
                                                                                    <i
                                                                                        class="fa-brands fa-product-hunt"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                                                                <h6 class="text-muted font-semibold">
                                                                                    @lang('backend.Total Products')</h6>
                                                                                <h5 class="font-extrabold mb-0"
                                                                                    id="totalp">{{ count( $products) }}
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-6 col-lg-4 col-md-6">
                                                            <a href="{{ url('admin/product-info/Active') }}">
                                                                <div class="card order-bg-1">
                                                                    <div
                                                                        class="card-body custom-card-body card-hover px-4 py-3">
                                                                        <div class="row">
                                                                            <div
                                                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                                                <div
                                                                                    class="stats-icon blue mb-2 product-icon">
                                                                                    <i class="fa-solid fa-chart-line"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                                                                <h6 class="text-muted font-semibold">
                                                                                    @lang('backend.Active Product')</h6>
                                                                                <h5 class="font-extrabold mb-0"
                                                                                    id="activep">
                                                                                    {{ App\Models\Admin\Product::where('status', 'Active')->get()->count() }}
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-6 col-lg-4 col-md-6">
                                                            <a href="{{ url('admin/product-info/Inactive') }}">
                                                                <div class="card order-bg-1">
                                                                    <div
                                                                        class="card-body custom-card-body card-hover px-4 py-3">
                                                                        <div class="row">
                                                                            <div
                                                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                                                                <div
                                                                                    class="stats-icon green mb-2 product-icon">
                                                                                    <i class="bi bi-bag-x bag-cross"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 overview-text">
                                                                                <h6 class="text-muted font-semibold">
                                                                                    @lang('backend.Inactive Product')</h6>
                                                                                <h5 class="font-extrabold mb-0"
                                                                                    id="inactivep">
                                                                                    {{ App\Models\Admin\Product::where('status', 'Inactive')->get()->count() }}
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <table class="table header-border" id="productinfo">
                                                        <thead>
                                                            <tr>
                                                                <th>@lang('backend.ID')</th>
                                                                <th>@lang('backend.Product Name')</th>
                                                                <th>@lang('backend.Category')</th>
                                                                <th>@lang('backend.Image')</th>
                                                                <th>@lang('backend.Regular Price')</th>
                                                                <th>@lang('backend.Selling Price')</th>
                                                                <th>@lang('backend.Buy Price')</th>
                                                                <th>@lang('backend.Status')</th>
                                                                <th>@lang('backend.Action')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
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
        <!-- Contextual classes end -->
    </div>

    <input type="hidden" name="status" id="status" value="{{ $status }}">
    @push('script')
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {


                $(document).on('click', '.dotbtn', function() {
                    $('.dropdown-product-list-content').css('display', 'none');
                    $(this).siblings('.dropdown-product-list-content').toggle();
                });





                var token = $("input[name='_token']").val();

                var productinfo = $('#productinfo').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    order: 1,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('admin/product/get-data') }}",
                        data: {
                            status: function() {
                                return $('#status').val()
                            },
                            category_id: function() {
                                return $('#category_id').val()
                            }
                        }
                    },
                    dom: '<"row"<"col-sm-6"Bl><"col-sm-6"f>>' +
                        '<"row"<"col-sm-12"<"table-responsive"tr>>>' +
                        '<"row"<"col-sm-5"i><"col-sm-7"p>>',
                    buttons: {
                        buttons: [{
                            extend: 'print',
                            text: 'Print',
                            footer: true,
                            title: function() {
                                var printTitle = 'Product List';
                                return printTitle;
                            },
                            exportOptions: {
                                stripHtml: false,
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            },
                            customize: function(win) {
                                $(win.document.body).find('h1').css('text-align', 'center');
                            }
                        }]
                    },
                    columns: [{
                            data: null, // This column displays the serial number
                            render: function(data, type, row, meta) {
                                var pageInfo = productinfo.page.info(); // Get pagination info
                                return pageInfo.start + meta.row + 1; // Calculate serial number
                            },
                            orderable: false, // Disable ordering for this column
                            searchable: false // Disable searching for this column
                        },
                        {
                            data: 'product_name',
                            render: function(data, type, row) {
                                return `<a href="../product/view-details/${row.id}" data-id="${row.id}">${data}</a>`;
                            }
                        },
                        {
                            data: 'category',
                            render: function(data, type, row) {
                                return `<a href="../product/view-details/${row.id}" data-id="${row.id}">${data}</a>`;
                            }
                        },
                        {
                            data: 'image',
                            render: function(data, type, row) {
                                return `<a href="../product/view-details/${row.id}" data-id="${row.id}">${data}</a>`;
                            }

                        },

                        {
                            data: 'price',
                            render: function(data, type, row) {
                                return `<a href="../product/view-details/${row.id}" data-id="${row.id}">${data}</a>`;
                            }
                        },
                        {
                            data: 'saleprice',
                            render: function(data, type, row) {
                                return `<a href="../product/view-details/${row.id}" data-id="${row.id}">${data}</a>`;
                            }
                        },
                        {
                            data: 'buy_price',
                            render: function(data, type, row) {
                                return `<a href="../product/view-details/${row.id}" data-id="${row.id}">${data}</a>`;
                            }
                        },
                        {
                            "data": null,
                            render: function(data) {

                                if (data.status == 'Active') {
                                    return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="Inactive" id="productstatusBtn" data-id="' +
                                        data.id + '">' + "@lang('backend.Active')" + '</button>';
                                } else {
                                    if (data.status == 'Inactive') {
                                        return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="Active" id="productstatusBtn" data-id="' +
                                            data.id + '" >' + "@lang('backend.Inactive')" + '</button>';
                                    } else {
                                        return '<button type="button" class="btn btn-info btn-sm btn-status" data-status="Active" id="productstatusBtn" data-id="' +
                                            data.id + '" >Draft</button>';
                                    }
                                }


                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },

                    ],
                    language: {
                        paginate: {
                            previous: "<i class='fas fa-chevron-left'>",
                            next: "<i class='fas fa-chevron-right'>"
                        }
                    },
                    drawCallback: function() {
                        $(".dataTables_paginate > .pagination").addClass("pagination-sm");
                        $('.dt-buttons').hide();
                    }
                });

                // delete category

                $(document).on('click', '.confirmDelete', function(e) {
                    e.preventDefault();
                    let product_id = $(this).data('id');

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
                                url: "../product/destroy/" + product_id,
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
                                        productinfo.ajax.reload();
                                    }
                                },
                                error: function(err) {
                                    console.log('err');
                                }
                            });

                        }
                    });
                });

                // status update

                $(document).on('click', '#productstatusBtn', function() {
                    let productId = $(this).data('id');
                    let productStatus = $(this).data('status');

                    $.ajax({
                        type: 'PUT',
                        url: '../product/status',
                        data: {
                            product_id: productId,
                            status: productStatus,
                            '_token': token
                        },

                        success: function(data) {
                            Swal.fire({
                                title: "@lang('backend.Status updated !')",
                                icon: "success",
                            });
                            productinfo.ajax.reload();
                        },
                        error: function(error) {
                            console.log('error');
                        }

                    });
                });

                $(document).on('change', '#category_id', function() {
                    productinfo.ajax.reload();
                });


                $(document).on('click', '#download', function() {
                    var val = $('#download').val();
                    if (val == 3) {
                        $('#download').val('Choose');
                        $(".buttons-print")[0].click();
                    } else if (val == 2) {
                        $('#download').val('Choose');
                        window.open('<?php echo env('APP_URL'); ?>' + '/admin/download-product-excel?status=' + $(
                            '#status').val() + '&category_id=' + $('#category_id').val() + '');
                    } else if (val == 1) {
                        $('#download').val('Choose');
                        window.open('<?php echo env('APP_URL'); ?>' + '/admin/download-product?status=' + $('#status')
                            .val() + '&category_id=' + $('#category_id').val() + '');
                    } else {

                    }
                });


            });
        </script>
    @endpush
@endsection
