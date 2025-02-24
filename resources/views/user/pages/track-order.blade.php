@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Profile'])

    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">

                        @include('user.include.left-sidebar')

                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white pb-2">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">@lang('frontend.Track your Order')</h1>

                                    <span class="dash__text u-s-m-b-30">@lang("frontend.To track your order please enter your Order ID in the box below and press the 'Track' button.")</span>
                                    <form class="dash-track-order" action="{{ url('user/track-order') }}" method="GET">
                                        <div class="gl-inline">
                                            <div class="u-s-m-b-30">
                                                <label class="gl-label" for="order-id">@lang('frontend.Order ID *')</label>

                                                <input class="input-text input-text--primary-style"
                                                    @if (isset($order)) value="{{ $order->invoiceID }}" @endif
                                                    name="invoiceID" type="text" id="order-id"
                                                    placeholder="@lang('backend.Enter Order Invoice ID/Order ID')">
                                            </div>
                                            <div class="u-s-m-b-30 track-blank">
                                                <label class="gl-label" for="order-id"></label>
                                                <button class="btn btn--e-brand-b-2" type="submit"
                                                    style="padding: 6px 15px;margin-top: 18px;color: white;">
                                                    @lang('frontend.TRACK')
                                                </button>
                                            </div>
                                        </div>


                                    </form>
                                </div>

                                @if (isset($order))
                                    {{-- track list --}}
                                    <div class="card m-4">

                                        <div class="track-part">
                                            <h1 class="track-text">@lang('backend.Track Order Live View')</h1>
                                            @php
                                                $statusProgress = [
                                                    'Pending' => 0,
                                                    'Confirmed' => 35,
                                                    'Ongoing' => 67,
                                                    'Delivered' => 95,
                                                ];
                                                $progressWidth = $statusProgress[$order->status] ?? 0; // Default to 0 if status is not found
                                            @endphp
                                            <div class="progress-bar2" style="--progress-width: {{ $progressWidth }}%;">
                                                <style>
                                                    .progress-bar2 {
                                                        position: relative;
                                                        margin: 20px 0;
                                                    }

                                                    .progress-bar2::before {
                                                        content: '';
                                                        position: absolute;
                                                        top: 50%;
                                                        left: 0;
                                                        transform: translateY(-50%);
                                                        height: 4px;
                                                        width: 100%;
                                                        background-color: #e0e0e0;
                                                        z-index: 0;
                                                    }

                                                    .progress-bar2::after {
                                                        content: '';
                                                        position: absolute;
                                                        top: 50%;
                                                        left: 0;
                                                        transform: translateY(-50%);
                                                        height: 4px;
                                                        width: var(--progress-width);
                                                        background-color: #3498db;
                                                        z-index: 0;
                                                        transition: width 0.5s ease;
                                                    }
                                                </style>

                                                <!-- Progress Steps -->
                                                <div
                                                    class="progress-step previous_bd @if ($order->status == 'Pending') active @endif">
                                                    <div class="progress-step-img1">
                                                        <img src="{{ asset('public/frontend/images/truck-image/pending.png') }}"
                                                            alt="">
                                                        <div class="progress-step-text">@lang('backend.Pending')</div>
                                                    </div>
                                                </div>
                                                @php
                                                    $activeStatuses = ['Pending', 'Confirmed', 'Ongoing', 'Delivered'];
                                                @endphp
                                                <div
                                                    class="progress-step @if (in_array($order->status, $activeStatuses)) previous_bd @endif @if ($order->status == 'Confirmed') active @endif">
                                                    <div class="progress-step-img2">
                                                        <img src="{{ asset('public/frontend/images/truck-image/confirmed.png') }}"
                                                            alt="">
                                                        <div class="progress-step-text">@lang('backend.Confirmed')</div>
                                                    </div>
                                                </div>

                                                @php
                                                    $activeStatuses = ['Pending', 'Confirmed', 'Ongoing', 'Delivered'];
                                                @endphp
                                                <div
                                                    class="progress-step @if (in_array($order->status, $activeStatuses)) previous_bd @endif   @if ($order->status == 'Ongoing') active @endif">
                                                    <div class="progress-step-img3">
                                                        <img src="{{ asset('public/frontend/images/truck-image/ongoing.png') }}"
                                                            alt="">
                                                        <div class="progress-step-text">@lang('frontend.On Going')</div>
                                                    </div>
                                                </div>
                                                @php
                                                    $activeStatuses = ['Pending', 'Confirmed', 'Ongoing', 'Delivered'];
                                                @endphp
                                                <div
                                                    class="progress-step @if (in_array($order->status, $activeStatuses)) previous_bd @endif  @if ($order->status == 'Delivered') active @endif">
                                                    <div class="progress-step-img4">
                                                        <img src="{{ asset('public/frontend/images/truck-image/delivered.png') }}"
                                                            alt="">
                                                        <div class="progress-step-text">@lang('backend.Delivered')</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="status-info">
                                                @lang('backend.Your Order is')
                                                @if ($order->status == 'Pending')
                                                    @lang('backend.Pending')
                                                @elseif($order->status == 'Confirmed')
                                                    @lang('backend.Confirmed')
                                                @elseif($order->status == 'Ongoing')
                                                    @lang('frontend.On Going')
                                                @elseif($order->status == 'Delivered')
                                                    @lang('backend.Delivered')
                                                @else
                                                    @lang('backend.Pending')
                                                @endif
                                            </div>
                                            {{-- <div class="delivery-estimate">
                                                Estimated delivery: May 18, 2023
                                            </div>

                                            <div class="track-img active">
                                                <img src="{{ asset('public/frontend/images/product/shooe.jpg') }}"
                                                    alt="">
                                            </div> --}}
                                        </div>




                                        {{-- <div class="card-body px-0 pt-5">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="track-product">
                                                        <div class="col-lg-12">

                                                            @foreach ($order->orderproducts as $order_product)
                                                                <div class="manage-o__description mb-5">
                                                                    <div class="description__container ">
                                                                        <div class="description__img-wrap">
                                                                            <img class="u-img-fluid"
                                                                                src="{{ asset($order_product->productvariation->image) }}"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="order-text">
                                                                            <div class="order-name">
                                                                                <h5>{{ $order_product->productName }}</h5>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="manage-o__text-2 u-c-silver">@lang('backend.Variation'):

                                                                                    <span
                                                                                        class="manage-o__text-2 ">{{ $order_product->color }}</span>,
                                                                                    {{ $order_product->size }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="manage-o__text-2 u-c-silver">@lang('backend.Quantity'):

                                                                                    <span
                                                                                        class="manage-o__text-2 u-c-secondary">{{ $order_product->qty }}</span></span>
                                                                            </div>
                                                                            @if ($currency->symbol_position == 'left')
                                                                                <div>
                                                                                    <span
                                                                                        class="manage-o__text-2 u-c-silver">@lang('backend.Price'):

                                                                                        <span
                                                                                            class="manage-o__text-2 u-c-secondary">{{ $currency->symbol }}{{ $order_product->price }}</span></span>
                                                                                </div>
                                                                            @else
                                                                                <div>
                                                                                    <span
                                                                                        class="manage-o__text-2 u-c-silver">@lang('backend.Price'):

                                                                                        <span
                                                                                            class="manage-o__text-2 u-c-secondary">{{ $order_product->price }}</span></span>{{ $currency->symbol }}
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                    </div>
                                                                    <div class="description__info-wrap">
                                                                        <div>
                                                                            <span
                                                                                class="manage-o__badge badge--processing">{{ $order->status }}</span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="card m-4">
                                        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                                            <div class="float-left" style="color:#000;text-align:center">
                                                <b>@lang('frontend.Order History')</b>
                                            </div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <table class="details-table table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('backend.Order ID'):</td>
                                                                <td>{{ $order->invoiceID }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('backend.Customers'):</td>
                                                                <td>{{ $order->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('backend.Phone'):</td>
                                                                <td>{{ $order->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('frontend.Shipping address'):</td>
                                                                <td>{{ $order->address }},{{ $order->city }},{{ $order->district }},{{ $order->country }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6">
                                                    <table class="details-table table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('backend.Order Date'):</td>
                                                                <td>{{ $order->created_at->format('Y-m-d') }} ,
                                                                    {{ date('h:i A', strtotime($order->created_at)) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('frontend.Total order amount'):</td>
                                                                @if ($currency->symbol_position == 'left')
                                                                    <td>{{ $currency->symbol }}{{ $order->subTotal }} +
                                                                        <span style="color: red">(@lang('frontend.Shipping Charge')
                                                                            : {{ $order->shippingCharge }})</span>
                                                                    </td>
                                                                @else
                                                                    <td>{{ $order->subTotal }} + <span
                                                                            style="color: red">(@lang('frontend.Shipping Charge')
                                                                            :
                                                                            {{ $order->shippingCharge }})</span>{{ $currency->symbol }}
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('frontend.Shipping Company') :</td>
                                                                <td>
                                                                    @if (isset($order->courier_id))
                                                                        {{ App\Models\Courier::where('id', $order->courier_id)->first()->courierName }}
                                                                    @else
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">@lang('frontend.Payment Method:'):</td>
                                                                <td>
                                                                    @if ($order->Payment == 'C-O-D')
                                                                        @lang('backend.Cash On Delivery')
                                                                    @else
                                                                        @lang('frontend.Online Payment')
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-12">
                                                    @foreach ($order->orderproducts as $order_product)
                                                        <div class="manage-o__description mb-5">
                                                            <div class="description__container ">
                                                                <div class="description__img-wrap">
                                                                    <img class="u-img-fluid"
                                                                        src="{{ asset($order_product->productvariation->image) }}"
                                                                        alt="">
                                                                </div>
                                                                <div class="order-text">
                                                                    <div class="order-name">
                                                                        <h5>{{ $order_product->productName }}</h5>
                                                                    </div>
                                                                    <div>
                                                                        <span
                                                                            class="manage-o__text-2 u-c-silver">@lang('backend.Variation'):

                                                                            <span
                                                                                class="manage-o__text-2 ">{{ $order_product->color }}</span>,
                                                                            {{ $order_product->size }}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span
                                                                            class="manage-o__text-2 u-c-silver">@lang('backend.Quantity'):

                                                                            <span
                                                                                class="manage-o__text-2 u-c-secondary">{{ $order_product->qty }}</span></span>
                                                                    </div>
                                                                    @if ($currency->symbol_position == 'left')
                                                                        <div>
                                                                            <span
                                                                                class="manage-o__text-2 u-c-silver">@lang('backend.Price'):

                                                                                <span
                                                                                    class="manage-o__text-2 u-c-secondary">{{ $currency->symbol }}{{ $order_product->price }}</span></span>
                                                                        </div>
                                                                    @else
                                                                        <div>
                                                                            <span
                                                                                class="manage-o__text-2 u-c-silver">@lang('backend.Price'):

                                                                                <span
                                                                                    class="manage-o__text-2 u-c-secondary">{{ $order_product->price }}</span></span>{{ $currency->symbol }}
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                            <div class="description__info-wrap">
                                                                <div>
                                                                    <span
                                                                        class="manage-o__badge badge--processing">{{ $order->status }}</span>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card mt-4">
                                        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                                            <div class="float-left" style="color: red;text-align:center">
                                                @lang('frontend.No Records Found. Please call our customer care or use Live Chat')
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>


    <style>
        /* .progress-bar2::after {
                                            content: '';
                                            position: absolute;
                                            top: 50%;
                                            left: 0;
                                            transform: translateY(-50%);
                                            height: 4px;
                                            width: 0%;
                                            background-color: #3498db;
                                            transition: width 0.5s ease;
                                        } */

        .previous_bd {
            background: #3498db;
        }

        .process-steps {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .process-steps li {
            width: 25%;
            float: left;
            text-align: center;
            position: relative;
        }

        .process-steps li .icon {
            height: 30px;
            width: 30px;
            margin: auto;
            background: #fff;
            border-radius: 50%;
            line-height: 30px;
            font-size: 14px;
            font-weight: 700;
            color: #adadad;
            position: relative;
        }

        .process-steps li .title {
            font-weight: 600;
            font-size: 13px;
            color: #777;
            margin-top: 8px;
            margin-bottom: 0;
        }

        .process-steps li+li:after {
            position: absolute;
            content: "";
            height: 3px;
            width: calc(100% - 30px);
            background: #fff;
            top: 14px;
            z-index: 0;
            right: calc(50% + 15px);
        }

        .breadcrumb {
            padding: 5px 0;
            border-bottom: 1px solid #e9e9e9;
            background-color: #fafafa;
        }

        .search-area .search-button {
            border-radius: 0px 3px 3px 0px;
            display: inline-block;
            float: left;
            margin: 0px;
            padding: 5px 15px 6px;
            text-align: center;
            background-color: #e62e04;
            border: 1px solid #e62e04;
        }

        .search-area .search-button:after {
            color: #fff;
            content: "\f002";
            font-family: fontawesome;
            font-size: 16px;
            line-height: 9px;
            vertical-align: middle;
        }
    </style>


@endsection
