@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Dashboard'])

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
                                    <h1 class="dash__h1 u-s-m-b-14">@lang('frontend.Manage My Account')</h1>

                                    <span class="dash__text u-s-m-b-30">@lang('frontend.From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.')</span>
                                    <div class="row">
                                        <div class="col-lg-12 u-s-m-b-30">
                                            <div class="dash__box dash__box--bg-grey dash__box--shadow-2 u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">
                                                        @lang('frontend.PERSONAL PROFILE')
                                                    </h2>
                                                    <div class="dash__link dash__link--secondary u-s-m-b-8">
                                                        <a
                                                            href="{{ route('user.profile.edit', auth()->user()->id) }}">@lang('backend.Edit')</a>
                                                    </div>

                                                    <span
                                                        class="dash__text">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>

                                                    <span class="dash__text">{{ auth()->user()->email }}</span>
                                                    <div class="dash__link dash__link--secondary u-s-m-t-8">
                                                        <a data-modal="modal"
                                                            data-modal-id="#dash-newsletter">@lang('frontend.Subscribe Newsletter')
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                                <h2 class="dash__h2 u-s-p-xy-20">@lang('backend.Recent Orders')</h2>
                                <div class="dash__table-wrap gl-scroll">
                                    <table class="dash__table">
                                        <thead>
                                            <tr>
                                                <th>@lang('frontend.Order #') </th>
                                                <th>@lang('frontend.Placed On')</th>
                                                <th>@lang('frontend.Items')</th>
                                                <th>@lang('backend.Total')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order_products)
                                                @foreach ($order_products->orderproducts as $order_product)
                                                    <tr>
                                                        <td>#{{ $order_product->order_id }}</td>
                                                        <td> {{ date('d/m/Y', strtotime($order_product->created_at)) }}</td>
                                                        <td>
                                                            <div class="dash__table-img-wrap">
                                                                <img class="u-img-fluid"
                                                                    src="{{ asset($order_product->productvariation->image ?? '') }}"
                                                                    alt="">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($currency->symbol_position == 'left')
                                                            <div class="dash__table-total">
                                                                <span>{{ $currency->symbol }}{{ $order_product->price }}</span>

                                                            </div>
                                                            @else
                                                            <div class="dash__table-total">
                                                                <span>{{ $order_product->price }}{{ $currency->symbol }}</span>

                                                            </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius">
                                <h2 class="dash__h2 u-s-p-xy-20">@lang("backend.Recent Orders")</h2>
                                <div class="dash__table-wrap gl-scroll">
                                    <table class="dash__table">
                                        <thead>
                                            <tr>
                                                <th>@lang("frontend.Order #")</th>
                                                <th>@lang("frontend.Placed On")</th>
                                                <th>@lang("frontend.Items")</th>
                                                <th>@lang("backend.Total")</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_products as $order)
                                                <tr>
                                                    <!-- Display order details -->
                                                    <td>#{{ $order->id }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                                    <td colspan="2"> <!-- Merging the cells -->
                                                        <ul>
                                                            @foreach ($order->orderproducts as $product)
                                                                <li style="margin-bottom: 10px;">
                                                                    <div style="display: flex; align-items: center;">
                                                                        <img src="{{ asset($product->productvariation->image ?? '') }}" alt="Product Image"
                                                                             style="width: 50px; height: 50px; margin-right: 10px;">
                                                                        <span>{{ $product->name ?? 'N/A' }} -
                                                                            {{ $currency->symbol }}{{ $product->price }}
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}





                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
