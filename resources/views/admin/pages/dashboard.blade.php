@extends('admin.layouts.master')

@section('admin_content')
    <style>
        #filterdrop {}
    </style>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="page-heading card-title mt-5">
                    <h3>@lang('backend.Overview')</h3>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ url('admin/product-info/All') }}" class="submenu-link">
                            <div class="card card-bg-1">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon green mb-2">
                                                <i class="fa-brands fa-product-hunt"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">
                                                @lang('backend.Total Products')</h6>
                                            <h5 class="font-extrabold mb-0" id="products">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none" href="{{ url('admin/admin_order/orderall') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3"
                                    style="background: #d0fcff; border-radius:10px;">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2">
                                                <i class="fa-solid fa-chart-line"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.All Order')</h6>
                                            <h5 class="font-extrabold mb-0" id="all">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card card-bg-4">
                            <div class="card-body  card-hover px-4 py-3">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="fa-regular fa-money-bill-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                        <h6 class="text-muted font-semibold">@lang('backend.Total Sales')</h6>
                                        @if ($currency->symbol_position == 'left')
                                            <h5 class="font-extrabold mb-0">{{ $currency->symbol }}<span class="ml-1"
                                                    id="totalsales">0</span></h5>
                                        @else
                                            <h5 class="font-extrabold mb-0"><span class="ml-1"
                                                    id="totalsales">0</span>{{ $currency->symbol }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a href="{{ route('admin.user.list.index') }}">
                            <div class="card card-bg-3">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon red mb-2">
                                                <i class="fa-solid fa-users-viewfinder"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">

                                            <h6 class="text-muted font-semibold">@lang('backend.Total Users') </h6>
                                            <h5 class="font-extrabold mb-0" id="users">0</h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="page-heading card-title mt-2">
                    <h3>@lang('backend.Order Status')</h3>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body  card-hover px-4 py-3">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="fa-solid fa-sack-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                        <h6 class="text-muted font-semibold">@lang('backend.Total Earning') </h6>
                                        @if ($currency->symbol_position == 'left')
                                            <h5 class="font-extrabold mb-0">{{ $currency->symbol }}<span
                                                    class="ml-1 ">0</span>
                                            </h5>
                                        @else
                                            <h5 class="font-extrabold mb-0"><span
                                                    class="ml-1 ">0</span>{{ $currency->symbol }}
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Pending') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2">
                                                <i class="fa-regular fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Pending')</h6>
                                            <h5 class="font-extrabold mb-0" id="pending">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Confirmed') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon green mb-2">
                                                <i class="fa-solid fa-calendar-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Confirmed')</h6>
                                            <h5 class="font-extrabold mb-0" id="confirmed">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Ongoing') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon red mb-2">
                                                <i class="fa-solid fa-truck-fast"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Ongoing')</h6>
                                            <h5 class="font-extrabold mb-0" id="ongoing">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Delivered') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon green mb-2">
                                                <i class="fa-solid fa-truck-ramp-box"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Delivered') </h6>
                                            <h5 class="font-extrabold mb-0" id="delivered">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Canceled') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon red mb-2">
                                                <i class="fa-solid fa-xmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Canceled')</h6>
                                            <h5 class="font-extrabold mb-0" id="canceled">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Returned') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class="fa-solid fa-sack-dollar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Returned') </h6>
                                            <h5 class="font-extrabold mb-0" id="returned">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <a style="text-decoration: none;" href="{{ url('admin/admin_order/Rejected') }}">
                            <div class="card">
                                <div class="card-body  card-hover px-4 py-3">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2">
                                                <i class="fa-solid fa-ban"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12  overview-text">
                                            <h6 class="text-muted font-semibold">@lang('backend.Rejected')</h6>
                                            <h5 class="font-extrabold mb-0" id="rejected">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 cal-xl-12">
                        <canvas id="barChart" data-dailyOrders={{ json_encode($dates) }}></canvas>

                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-3">
                <div class="card category-card" style="margin-top: 110px;">
                    <div class="card-header">
                        <h4>@lang('backend.Top Categories')</h4>
                    </div>
                    <div class="card-content pb-4">
                        @forelse($topcategory as $top)
                            <div class="recent-message d-flex px-4 py-1">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset($top['image']) }}" />
                                </div>
                                <div class="name ms-4 d-flex flex-row gap-1 align-items-center">
                                    <h5 class="mb-1">{{ $top['name'] }}</h5>
                                    <h6 class="text-muted mb-0">({{ $top['products'] }})</h6>
                                </div>
                            </div>
                        @empty
                        @endforelse

                        <div class="px-4">
                            <a href="{{ url('admin/category') }}"
                                class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                                @lang('backend.View All')
                            </a>
                        </div>
                    </div>

                </div>
                <div class="card category-card">
                    <div class="card-header">
                        <h4>7 @lang('backend.Days Sale Amount')</h4>
                    </div>
                    <canvas id="pieChart"
                        data-previousSavenDaysSell={{ json_encode($previousSavenDaysAmount) }}></canvas>

                </div>

            </div>


            <div class="row mt-10">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mt-2">@lang('backend.Top Selling Products')</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table top-sell-table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.Image')</th>
                                            <th>@lang('backend.Product Name')</th>
                                            <th>@lang('backend.Price')</th>
                                            <th>@lang('backend.Quantity')</th>

                                        </tr>
                                    </thead>
                                    <tbody class="top-sell">
                                        @foreach ($topSellingProducts as $topSellingProduct)
                                            <tr>
                                                <td class="col-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img
                                                                src="{{ asset($topSellingProduct->productvariations->firstWhere('image')->image) }}" />
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3 mr-right">
                                                    <p class="  mb-0">{{ $topSellingProduct->product_name }}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class="  mb-0">
                                                        ${{ $topSellingProduct->sizes->firstWhere('RegularPrice')->RegularPrice }}
                                                    </p>
                                                </td>

                                                <td class="col-3 shtok-out-tex">
                                                    <p class="  mb-0">
                                                        {{ $topSellingProduct->sizes->firstWhere('total_stock')->total_stock }}
                                                    </p>
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
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header recent-text mt-2 d-flex justify-content-between ">
                            <h4>@lang('backend.Recent Orders')</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table top-sell-table table-hover table-lg ">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.Tracking Number')</th>
                                            <th>@lang('backend.Product Image') </th>
                                            <th>@lang('backend.Product Name')</th>
                                            <th>@lang('backend.Price')</th>
                                            <th>@lang('backend.Total Amount')</th>
                                        </tr>

                                    </thead>
                                    <tbody class="top-sell">
                                        @php
                                            $orders = App\Models\Order::paginate(5);
                                        @endphp
                                        @foreach ($orders as $order)
                                            @php
                                                $order_product = App\Models\Orderproduct::where(
                                                    'order_id',
                                                    $order->id,
                                                )->first();

                                            @endphp
                                            <tr>
                                                <td class="col-auto">
                                                    <p class="  mb-0">#{{ $order->invoiceID }}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <div class="avatar avatar-md">
                                                        <img
                                                            src="{{ asset($order_product->productvariation->image ?? '') }}" />
                                                    </div>
                                                </td>
                                                <td class="col-auto mr-right">
                                                    <div class="d-flex align-items-center">

                                                        <p class="ml-2  mb-0">{{ $order_product->productName ?? '' }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    @if ($currency->symbol_position == 'left')
                                                        <p class="mb-0">
                                                            {{ $currency->symbol }}{{ $order_product->price ?? '' }}</p>
                                                    @else
                                                        <p class="mb-0">{{ $order_product->price ?? '' }}
                                                            {{ $currency->symbol }}</p>
                                                    @endif
                                                </td>

                                                <td class="col-auto">
                                                    @if ($currency->symbol_position == 'left')
                                                        <p class="mb-0">
                                                            {{ $currency->symbol }}{{ $order->total ?? '' }}
                                                        </p>
                                                    @else
                                                        <p class="mb-0">
                                                            {{ $order->total ?? '' }}{{ $currency->symbol }}
                                                        </p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="pagination">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script>
        let dailyOrderAmount = $('#pieChart').data('previoussavendayssell');

        // Extract the labels (dates) and data (amounts) from the array
        let amountLabels = dailyOrderAmount.map(order => order.date);
        let amountData = dailyOrderAmount.map(order => order.amount);


        const ctx = document.getElementById('pieChart');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: amountLabels,
                datasets: [{
                    label: 'Previous 7 days Amount',
                    data: amountData,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        let dailyOrders = $('#barChart').data('dailyorders');

        let labels = dailyOrders.map(order => order.date);
        let data = dailyOrders.map(order => order.count);

        const barChart = document.getElementById('barChart');
        new Chart(barChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Previous 7 Days Orders',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            countorder();
            $(document).on('click', '#logot', function(e) {
                e.preventDefault();
                let admin_id = $(this).data('id');

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
                            $('#users').text(data["users"]);
                            $('#totalsales').text(data["totalsales"]);
                            $('#products').text(data["products"]);
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

        });

        function topsellfilter(id) {
            $.ajax({
                type: "get",
                url: "{{ url('admin/product/topsell/') }}" + '/' + id,
                contentType: "application/json",
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#topsellProductTbl').html('');
                    if (data["status"] == "success") {
                        for (let i = 0; i < data["orders"].length; i++) {
                            $('#topsellProductTbl').append(
                                `
                                    <tr>
                                        <th>` + data["orders"][i].productCode + `</th>
                                        <td scope="row"><a href="#"><img src="{{ asset('public/image/default.png') }}" alt=""></a></td>
                                        <td><a href="#" class="text-primary fw-bold">` + data["orders"][i]
                                .productName + `</a></td>
                                        <td>TK. ` + data["orders"][i].productPrice + `</td>
                                        <td class="fw-bold">` + data["orders"][i].total_amount + `</td>
                                    </tr>
                                `);
                        }
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
    </script>
@endpush
