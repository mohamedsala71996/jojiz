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
                            <div class="m-order__get">
                                <div class="manage-o__header u-s-m-b-30">
                                    <div class="dash-l-r">
                                        <div>
                                            <div class="manage-o__text-2 u-c-secondary">
                                                @lang('frontend.Order #'){{ $order->invoiceID }}
                                            </div>
                                            <div class="manage-o__text u-c-silver">
                                                @lang('frontend.Placed On') {{ date('d M Y H:i:s', strtotime($order->created_at)) }}
                                            </div>
                                        </div>
                                        <div>
                                            @if ($currency->symbol_position == 'left')
                                                <div class="dash__link dash__link--brand"
                                                    style="color: black;font-size:20px; font-weight:600;">
                                                    <span>@lang('frontend.Total') :
                                                        {{ $currency->symbol }}</span><span>{{ $order->total }}</span>
                                                </div>
                                            @else
                                                <div class="dash__link dash__link--brand"
                                                    style="color: black;font-size:20px; font-weight:600;">
                                                    <span>@lang('frontend.Total') :
                                                    </span><span>{{ $order->total }}</span>{{ $currency->symbol }}
                                                </div>
                                            @endif
                                            <div class="dash__link dash__link--brand"
                                                style="color:black;font-size:17px;  margin-top:5px; background: rgba(255, 178, 134, 0.856); text-align:center; border-radius: 30px; font-weight:600; text-transform:capitalize;">

                                                <span>{{ $order->subTotal <= $order->paidAmount ? __('backend.Paid') : __('frontend.Due') }}</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($order->orderproducts as $order_product)
                                    <div class="manage-o__description mb-3">

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
                                                    <span class="manage-o__text-2 u-c-silver">@lang('backend.Variation') :

                                                        <span class="manage-o__text-2 ">{{ $order_product->color }}</span>,
                                                        {{ $order_product->size }}</span>
                                                </div>
                                                <div>
                                                    <span class="manage-o__text-2 u-c-silver">@lang('backend.Quantity') :

                                                        <span
                                                            class="manage-o__text-2 u-c-secondary">{{ $order_product->qty }}</span></span>
                                                </div>
                                                @if ($currency->symbol_position == 'left')
                                                    <div>
                                                        <span class="manage-o__text-2 u-c-silver">@lang('backend.Price'):

                                                            <span
                                                                class="manage-o__text-2 u-c-secondary">{{ $currency->symbol }}{{ $order_product->price }}</span></span>
                                                    </div>
                                                @else
                                                    <div>
                                                        <span class="manage-o__text-2 u-c-silver">@lang('backend.Price'):

                                                            <span
                                                                class="manage-o__text-2 u-c-secondary">{{ $order_product->price }}</span></span>{{ $currency->symbol }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="description__info-wrap">
                                            <div class="text-center">
                                                <span
                                                    class="manage-o__badge badge--processing order-pending mb-2">{{ $order->status }}</span><br>
                                                @if ($order->status == 'Delivered')
                                                    <a style="color: black;font-weight:bold"
                                                        href="{{ url('user/give-review', Crypt::encrypt($order_product->product_id)) }}">@lang('frontend.WRITE A REVIEW')
                                                    </a>
                                                    {{-- <span
                                                        class="manage-o__badge badge--processing mb-2">{{ $order->status }}</span><br>
                                                    <a style="color: black;font-weight:bold"
                                                        href="{{ url('user/give-review', Crypt::encrypt($order_product->product_id)) }}">WRITE
                                                        A REVIEW</a> --}}
                                                @endif


                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                <div class="user-info mt-3  mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="user-part">
                                                <h4 style="font-weight: 600; color:#000;">@lang('frontend.Summary') : </h4>
                                                <div class="row">

                                                    <div class="user-summary">
                                                        <div class="col-lg-6">
                                                            <h5>@lang('backend.Sub Total'):</h5>
                                                            <h5>@lang('backend.Delivery Charge'):</h5>
                                                            <h5>@lang('backend.Discount'): </h5>
                                                            <h5>@lang('backend.Tax'): </h5>
                                                            <h5>@lang('backend.Advance Payment'):</h5>
                                                            <h5>@lang('frontend.Due'):</h5>
                                                            <h5 style="font-weight: 600;">@lang('frontend.Total'): </h5>
                                                        </div>
                                                        @if ($currency->symbol_position == 'left')
                                                            <div class="col-lg-6">
                                                                <h5><span>{{ $currency->symbol }}{{ $order->subTotal }}</span>
                                                                </h5>
                                                                <h5><span>{{ $currency->symbol }}{{ $order->shippingCharge }}</span>
                                                                </h5>
                                                                <h5><span>{{ $currency->symbol }}{{ $order->discount }}</span>
                                                                </h5>
                                                                <h5><span>{{ $currency->symbol }}{{ $order->tax }}</span>
                                                                </h5>
                                                                <h5><span>{{ $currency->symbol }}{{ intval($order->advance_payment_amount) }}</span>
                                                                </h5>
                                                                <h5><span>{{ $currency->symbol }}{{ intval($order->total - $order->paidAmount) }}</span>
                                                                </h5>
                                                                <h5 style="font-weight:600;">
                                                                    <span>{{ $currency->symbol }}{{ $order->total }}</span>
                                                                </h5>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-6">
                                                                <h5><span>{{ $order->subTotal }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                                <h5><span>{{ $order->shippingCharge }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                                <h5><span>{{ $order->discount }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                                <h5><span>{{ $order->tax }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                                <h5><span>{{ intval($order->advance_payment_amount) }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                                <h5><span>{{ intval($order->total - $order->paidAmount) }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                                <h5 style="font-weight:600;">
                                                                    <span>{{ $order->total }}{{ $currency->symbol }}</span>
                                                                </h5>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-info mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="user-part">
                                                <h4 style="font-weight: 600; color:#000;">@lang('frontend.Payment Info:') </h4>
                                                <div class="row">

                                                    <div class="user-summary">
                                                        <div class="col-lg-6">
                                                            <h5>@lang('frontend.Payment Method:')</h5>
                                                            <h5>@lang('frontend.Payment Status:') </h5>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h5>
                                                                @if ($order->payment_method == 'cash_on_delivery')
                                                                    <span>@lang('frontend.Cash on Delivery') </span>
                                                                @elseif($order->payment_method == 'sslcommerz')
                                                                    <span>@lang('backend.SSL Commerz')</span>
                                                                @elseif($order->payment_method == 'stripe')
                                                                    <span>@lang('backend.Stripe')</span>
                                                                @elseif($order->payment_method == 'razorpay')
                                                                    <span>@lang('backend.Razor Pay')</span>
                                                                @elseif($order->payment_method == 'bkash')
                                                                    <span>@lang('backend.bKash')</span>
                                                                @endif

                                                            </h5>
                                                            <h5><span>{{ $order->subTotal <= $order->paidAmount ? __('backend.Paid') : __('frontend.Due') }}</span>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="user-info mt-3  mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="user-part">
                                                <h4 style="font-weight: 600; color:#000;">@lang('frontend.Delivery Info:')</h4>
                                                <div class="row">
                                                    <div class="user-summary">
                                                        <div class="col-lg-6">
                                                            <h5>@lang('frontend.Name:')</h5>
                                                            <h5>@lang('frontend.Email:')</h5>
                                                            <h5>@lang('backend.Phone:')</h5>
                                                            <h5>@lang('frontend.Country:')</h5>
                                                            <h5>@lang('backend.State')</h5>
                                                            <h5>@lang('backend.City')</h5>
                                                            <h5>@lang('frontend.Address:')</h5>
                                                            <h5>@lang('frontend.Zip Code:')</h5>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h5><span>{{ $order->name }}</span></h5>
                                                            <h5><span>{{ $order->email }}</span></h5>
                                                            <h5><span>{{ $order->phone }}</span></h5>
                                                            <h5><span>{{ $order->country }}</span></h5>
                                                            <h5><span>{{ $order->state }}</span></h5>
                                                            <h5><span>{{ $order->city }}</span></h5>
                                                            <h5><span>{{ $order->address }}</span></h5>
                                                            <h5><span>{{ $order->zip_code }}</span></h5>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-info mt-3  mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="user-part">
                                                <h4 style="font-weight: 600; color:#000;">@lang('frontend.Courier Info:') </h4>
                                                <div class="row">
                                                    <div class="user-summary">
                                                        <div class="col-lg-6">
                                                            <h5>@lang('frontend.Courier Name:')</h5>
                                                            <h5>@lang('frontend.Hub Name:')</h5>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h5><span>{{ $order->couriers->courierName ?? '' }}</span></h5>
                                                            <h5><span>{{ $order->hub_name ?? '' }}</span></h5>
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
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
