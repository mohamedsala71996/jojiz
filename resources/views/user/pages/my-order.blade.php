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
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">@lang('frontend.My Orders')</h1>
                                    <span class="dash__text u-s-m-b-30">@lang('frontend.Here you can see all products that have been delivered.')</span>
                                    {{-- <form class="m-order u-s-m-b-30">
                                        <div class="m-order__select-wrapper">
                                            <label class="u-s-m-r-8" for="my-order-sort">Show:</label><select
                                                class="select-box select-box--primary-style" id="my-order-sort">
                                                <option selected="">Last 5 orders</option>
                                                <option>Last 15 days</option>
                                                <option>Last 30 days</option>
                                                <option>Last 6 months</option>
                                                <option>Orders placed in 2018</option>
                                                <option>All Orders</option>
                                            </select>
                                        </div>
                                    </form> --}}
                                    <div class="m-order__list">
                                        @foreach ($orders as $order)
                                            <div class="m-order__get">
                                                <div class="manage-o__header u-s-m-b-30">
                                                    <div class="dash-l-r">
                                                        <div>
                                                            <div class="manage-o__text-2 u-c-secondary">
                                                                @lang('frontend.Order #'){{ $order->invoiceID }}
                                                            </div>
                                                            <div class="manage-o__text u-c-silver">
                                                                @lang('frontend.Placed On')
                                                                {{ date('d M Y H:i:s', strtotime($order->created_at)) }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            @if ($currency->symbol_position == 'left')
                                                            <div class="manage-o__text-2 u-c-secondary">
                                                                @lang('frontend.Total:') {{ $currency->symbol }}{{ $order->total }}
                                                            </div>
                                                            @else
                                                            <div class="manage-o__text-2 u-c-secondary">
                                                                @lang('frontend.Total:') {{ $order->total }}{{ $currency->symbol }}
                                                            </div>
                                                            @endif
                                                            <div class="dash__link dash__link--brand">
                                                                <a
                                                                    href="{{ url('user/order', $order->invoiceID) }}">@lang('frontend.View Details')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        @endforeach

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
