@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Checkout'])
    <style>
        #couponoption {
            display: none;
        }

        #coupontext {
            display: none;
        }

        #coupontext1 {
            display: none;
        }
    </style>
    @php
        $subtotal = $carts->sum('total');

        if ($setting->vat_status == 'ON') {
            $vatam = $subtotal * ($setting->vat / 100);
        } else {
            $vatam = 0;
        }
        if ($setting->vat_status == 'ON') {
            $taxam = $subtotal * ($setting->tax / 100);
        } else {
            $taxam = 0;
        }
        $sdm = Session::get('deliverycharge');
        if ($sdm) {
            $deliverycharge = Session::get('deliverycharge');
        } else {
            $deliverycharge = $setting->inside_dhaka_charge;
        }
        $total = $subtotal + $taxam + $vatam + $deliverycharge;
        $availablecoup = App\Models\Coupon::where('status', 'Active')->where('validity', '>=', date('Y-m-d'))->first();

        $coupon = Session::get('availablecoupon');
        $couponcode = Session::get('couponcode');
    @endphp

    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="checkout-msg-group">
                            <div class="msg">
                                <span class="msg__text">@lang('frontend.Have a coupon?')
                                    <a class="gl-link collapsed" href="#have-coupon" data-toggle="collapse"
                                        aria-expanded="false">@lang('frontend.Click Here to enter your code')</a></span>
                                <div class="collapse" id="have-coupon" data-parent="#checkout-msg-group" style="">
                                    <div class="c-f u-s-m-b-16">
                                        <span class="gl-text u-s-m-b-16">@lang('frontend.Enter your coupon code if you have one.')</span>
                                        <form class="c-f__form">
                                            <div class="u-s-m-b-16">
                                                <div class="u-s-m-b-15">
                                                    <label for="coupon"></label>

                                                    <input class="input-text input-text--primary-style" type="text"
                                                        id="couponcode" placeholder="@lang('backend.Coupon Code')"
                                                        value="{{ $couponcode }}">
                                                </div>
                                                <div class="u-s-m-b-15">
                                                    <button class="btn btn--e-transparent-brand-b-2" onclick="applycoupon()"
                                                        type="button">
                                                        @lang('frontend.APPLY')
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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
    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="checkout-f">
                    <form class="checkout-f__delivery" method="POST" action="{{ route('user.checkout.order.place') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="billing-address">
                                    <h1 class="checkout-f__h1">@lang('backend.BILLING ADDRESS')</h1>
                                    <div class="u-s-m-b-30">

                                        <!--====== First Name, Last Name ======-->
                                        <div class="billing-card gl-inline">

                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-fname">@lang('backend.Name') *</label>
                                                <input name="" value="{{ auth()->user()->name }}"
                                                    class="input-text input-text--primary-style" type="text"
                                                    id="billing-fname" data-bill="" readonly>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--====== End - First Name, Last Name ======-->

                                        @if (auth()->user()->phone)
                                            <!--====== PHONE ======-->
                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-phone">@lang('frontend.Phone') *</label>

                                                <input name="phone" value="{{ auth()->user()->phone }}"
                                                    class="input-text input-text--primary-style" type="text"
                                                    id="billing-phone" data-bill="" readonly>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!--====== End - PHONE ======-->
                                        @endif

                                    </div>
                                </div>
                                <div class="delivery-address">
                                    <h1 class="checkout-f__h1">@lang('frontend.DELIVERY INFORMATION')</h1>
                                    <div class="delivery-card  u-s-m-b-30">

                                        <!--====== First Name, Last Name ======-->
                                        <div class="gl-inline">

                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-fname">@lang('backend.Name') *</label>
                                                <input name="name" value="{{ auth()->user()->name }}"
                                                    class="input-text input-text--primary-style" type="text"
                                                    id="billing-fname" data-bill="">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                        </div>
                                        <!--====== End - First Name, Last Name ======-->


                                        <!--====== PHONE ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-phone">@lang('frontend.Phone') *</label>

                                            <input name="phone" value="{{ old('phone') }}"
                                                class="input-text input-text--primary-style" type="text"
                                                id="billing-phone" data-bill="">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--====== End - PHONE ======-->

                                        <!--======  Address ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-street">@lang('backend.Address') *</label>

                                            <input name="address" value="{{ old('address') }}"
                                                class="input-text input-text--primary-style" type="text"
                                                id="billing-street" data-bill="">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--====== End - Address ======-->
                                        @if ($basic_setting->delivery_charge_type == 'address_wise')
                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-street">@lang('backend.Delivery Charge')*</label>
                                                <select name="addressWiseShippingCharge" id="shippingCharge" requiblack
                                                    class="input-text input-text--primary-style"
                                                    aria-label=".form-select-lg example">
                                                    @if ($delivaryCharges)
                                                        @foreach ($delivaryCharges as $delivaryCharge)
                                                            <option value="{{ $delivaryCharge->amount }}">
                                                                {{ $delivaryCharge->city }}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>

                                        @endif



                                        <!--====== Town / City ======-->
                                        <div class="u-s-m-b-15">
                                            <label class="gl-label" for="billing-town-city">@lang('frontend.TOWN/CITY') </label>

                                            <input name="city" value="{{ old('city') }}"
                                                class="input-text input-text--primary-style" type="text"
                                                id="billing-town-city" data-bill="">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--====== End - Town / City ======-->

                                        <div class="u-s-m-b-10">
                                            <label class="gl-label" for="order-note">@lang('backend.Order Note')</label>
                                            <textarea name="order_note" value="{{ old('order_note') }}" class="text-area text-area--primary-style"
                                                id="order-note"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h1 class="checkout-f__h1">@lang('frontend.ORDER SUMMARY')</h1>

                                <!--====== Order Summary ======-->
                                <div class="o-summary">
                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__item-wrap gl-scroll">
                                            @foreach ($carts as $item)
                                                <div class="summary-card o-card">
                                                    <div class="o-card__flex">
                                                        <div class="o-card__img-wrap">
                                                            <img class="u-img-fluid"
                                                                src="{{ asset($item->productvariation->image) }}"
                                                                alt="Product Image">
                                                        </div>
                                                        <div class="o-card__info-wrap">
                                                            <span class="o-card__name">

                                                                <a
                                                                    href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->product_name }}</a></span>
                                                            <span class="o-card__quantity">
                                                                @if (isset($item->color_id) && isset($item->color))
                                                                    @lang('frontend.Color'): {{ $item->color }}
                                                                    @endif, @if (isset($item->size_id) && isset($item->size))
                                                                        @lang('frontend.Size'): {{ $item->size }}
                                                                        @endif @if (isset($item->weight_id) && isset($item->weight))
                                                                            @lang('backend.Weight'): {{ $item->weight }}
                                                                        @endif
                                                            </span>
                                                            @if ($currency->symbol_position == 'left')
                                                                <span class="o-card__price"> <span
                                                                        style="color: black">{{ $item->qty }}x</span>
                                                                    &nbsp;{{ $currency->symbol }}{{ intval($item->price) }}</span>
                                                            @else
                                                                <span class="o-card__price"> <span
                                                                        style="color: black">{{ $item->qty }}x</span>
                                                                    &nbsp;{{ intval($item->price) }}{{ $currency->symbol }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('user.cart.remove.cart.item', $item->id) }}"
                                                        class="o-card__del far fa-trash-alt"></a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__box">
                                            <h1 class="checkout-f__h1">@lang('backend.Delivery Option')</h1>

                                            @error('delivery_option')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                            <div class="o-summary-content">
                                                @if ($other_delivery_charge->normal_delivery_status)
                                                    <div class="o-summary-check delivery-check d-flex justify-content-between align-items-center"
                                                        onclick="setActive(this)">
                                                        <!-- Left Side: Radio Box -->
                                                        <div class="radio-box d-flex align-items-center">
                                                            <input type="radio" name="delivery_option_type"
                                                                value="normal_delivery" hidden>
                                                            <input type="radio"
                                                                value="{{ $other_delivery_charge->normal_delivery_fee }}"
                                                                id="normal_delivery" name="delivery_option" checked>
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="normal_delivery">@lang('Normal Delivery')</label>
                                                                <p>{{ $other_delivery_charge->normal_delivery_duration }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- Right Side: Delivery Fee -->
                                                        @if ($currency->symbol_position == 'left')
                                                            <div class="delivery-text">
                                                                {{ $currency->symbol }}{{ $other_delivery_charge->normal_delivery_fee }}
                                                            </div>
                                                        @else
                                                            <div class="delivery-text">
                                                                {{ $other_delivery_charge->normal_delivery_fee }}
                                                                {{ $currency->symbol }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if ($other_delivery_charge->express_delivery_status)
                                                    <div class="o-summary-check delivery-check d-flex justify-content-between align-items-center"
                                                        onclick="setActive(this)">
                                                        <!-- Left Side: Radio Box -->
                                                        <div class="radio-box d-flex align-items-center">
                                                            <input type="radio" name="delivery_option_type"
                                                                value="express_delivery" hidden>
                                                            <input type="radio"
                                                                value="{{ $other_delivery_charge->express_delivery_fee }}"
                                                                id="express_delivery" name="delivery_option">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="express_delivery">@lang('backend.Express Delivery')</label>
                                                                <p>{{ $other_delivery_charge->express_delivery_duration }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- Right Side: Delivery Fee -->
                                                        @if ($currency->symbol_position == 'left')
                                                            <div class="delivery-text">
                                                                {{ $currency->symbol }}{{ $other_delivery_charge->express_delivery_fee }}
                                                            </div>
                                                        @else
                                                            <div class="delivery-text">
                                                                {{ $other_delivery_charge->express_delivery_fee }}{{ $currency->symbol }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if ($other_delivery_charge->pick_up_our_place_status)
                                                    <div class="o-summary-check delivery-check d-flex justify-content-between align-items-center"
                                                        onclick="setActive(this)">
                                                        <!-- Left Side: Radio Box -->
                                                        <div class="radio-box d-flex align-items-center">
                                                            <input type="radio" name="delivery_option_type"
                                                                value="pick_up_our_place_duration" hidden>
                                                            <input type="radio"
                                                                value="{{ $other_delivery_charge->pick_up_our_place_fee }}"
                                                                id="pick_up_our_place" name="delivery_option">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="pick_up_our_place">@lang('backend.Pick up at Our Place')</label>
                                                                <p>{{ $other_delivery_charge->pick_up_our_place_duration }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- Right Side: Delivery Fee -->
                                                        @if ($currency->symbol_position == 'left')
                                                            <div class="delivery-text">
                                                                {{ $currency->symbol }}{{ $other_delivery_charge->pick_up_our_place_fee }}
                                                            </div>
                                                        @else
                                                            <div class="delivery-text">
                                                                {{ $other_delivery_charge->pick_up_our_place_fee }}{{ $currency->symbol }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__box">
                                            <table class="o-summary__table">
                                                <tbody>
                                                    <tr>
                                                        <td>@lang('frontend.SUBTOTAL')</td>
                                                        @if ($currency->symbol_position == 'left')
                                                            <td>{{ $currency->symbol }}<span
                                                                    id="subtotal">{{ $subtotal }}</span></td>
                                                        @else
                                                            <td><span
                                                                    id="subtotal">{{ $subtotal }}</span>{{ $currency->symbol }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('frontend.SHIPPING')</td>
                                                        @if ($currency->symbol_position == 'left')
                                                            <td>{{ $currency->symbol }}
                                                                @if ($basic_setting->delivery_charge_type == 'address_wise')
                                                                    <span id="address_wise_delivary_charge_show"></span>
                                                                @else
                                                                    <span
                                                                        id="dinamicdalivery">{{ $setting->inside_dhaka_charge }}</span>
                                                                @endif

                                                            </td>
                                                        @else
                                                            <td>
                                                                @if ($basic_setting->delivery_charge_type == 'address_wise')
                                                                    <span id="address_wise_delivary_charge_show"></span>
                                                                @else
                                                                    <span
                                                                        id="dinamicdalivery">{{ $setting->inside_dhaka_charge }}</span>
                                                                @endif
                                                                {{ $currency->symbol }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @if ($setting->tax_status == 'ON')
                                                        <tr>
                                                            <td>@lang('backend.Tax')</td>
                                                            @if ($currency->symbol_position == 'left')
                                                                <td>{{ $currency->symbol }}<span
                                                                        id="taxamount">{{ $taxam }}</span></td>
                                                            @else
                                                                <td><span
                                                                        id="taxamount">{{ $taxam }}</span>{{ $currency->symbol }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <input type="hidden" name="tax" value="{{ $taxam }}"
                                                            id="taxvalue">
                                                    @else
                                                        <input type="hidden" name="tax" value="0"
                                                            id="taxvalue">
                                                    @endif
                                                    @if ($setting->vat_status == 'ON')
                                                        <tr>
                                                            <td>@lang('backend.Vat')</td>
                                                            @if ($currency->symbol_position == 'left')
                                                                <td>{{ $currency->symbol }}<span
                                                                        id="vatamount">{{ $vatam }}</span></td>
                                                            @else
                                                                <td><span
                                                                        id="vatamount">{{ $vatam }}</span>{{ $currency->symbol }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <input type="hidden" name="vat" value="{{ $vatam }}"
                                                            id="vatvalue">
                                                    @else
                                                        <input type="hidden" name="vat" value="0"
                                                            id="vatvalue">
                                                    @endif


                                                    @if (isset($coupon))
                                                        <tr id="couponpart">
                                                            <td>@lang('backend.Coupon')</td>
                                                            @if ($currency->symbol_position == 'left')
                                                                <td>{{ $currency->symbol }}<span
                                                                        id="coupondiscount">{{ Session::get('discount') }}
                                                                    </span></td>
                                                            @else
                                                                <td><span
                                                                        id="coupondiscount">{{ Session::get('discount') }}
                                                                    </span>{{ $currency->symbol }}</td>
                                                            @endif
                                                        </tr>
                                                        <input type="hidden" name="discount"
                                                            value="{{ Session::get('discount') }}" id="cpdiscount">
                                                    @else
                                                        <tr id="couponpart" class="d-none">
                                                            <td>@lang('backend.Coupon')</td>
                                                            @if ($currency->symbol_position == 'left')
                                                                <td>{{ $currency->symbol }}<span
                                                                        id="coupondiscount">0</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        id="coupondiscount">0</span>{{ $currency->symbol }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <input type="hidden" name="discount" value="0"
                                                            id="cpdiscount">
                                                    @endif
                                                    <tr>
                                                        <td>@lang('frontend.GRAND TOTAL')</td>
                                                        @if ($currency->symbol_position == 'left')
                                                            <td>{{ $currency->symbol }}<span
                                                                    id="total">{{ $total }}</span> </td>
                                                        @else
                                                            <td><span id="total">{{ $total }}</span>
                                                                {{ $currency->symbol }}</td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if ($setting->advance_payment_status == 'ON')
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <h1 class="checkout-f__h1">@lang('backend.Advance Payment')</h1>
                                                <div class="u-s-m-b-10">
                                                    <!--====== Radio Box ======-->
                                                    <div class="check-box">
                                                        <input type="checkbox" value="advance_payment"
                                                            id="advance_payment" name="advance_payment">
                                                        <div class="check-box__state check-box__state--primary">
                                                            <label class="check-box__label"
                                                                for="advance_payment">@lang('backend.Advance Payment')</label>
                                                        </div>
                                                    </div>
                                                    <!--====== End - Radio Box ======-->
                                                    <span class="gl-text u-s-m-t-6">
                                                        @if ($setting->advance_payment_type == 'product_wise')
                                                            {{ productWiseAdvancePaymentAmount() }}
                                                        @else
                                                            {{ $setting->advance_payment }}
                                                        @endif


                                                        @if ($setting->advance_payment_type == 'fixed')
                                                            {{ $currency->symbol }}
                                                        @elseif ($setting->advance_payment_type == 'percentage')
                                                            %
                                                        @else
                                                            {{ $currency->symbol }}
                                                        @endif
                                                        {{ $setting->advance_payment_title }}
                                                    </span>

                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    <div class="o-summary__section u-s-m-b-30">
                                        <div class="o-summary__box">
                                            <h1 class="checkout-f__h1">@lang('frontend.PAYMENT INFORMATION')</h1>

                                            @error('payment')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="o-summary-content u-s-m-b-10">

                                                @if ($cash_on_delivary->status == 1)
                                                    <div class=" payment-check" onclick="paymentActive(this)">
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">
                                                            <input type="radio" value="cash_on_delivery"
                                                                id="cash-on-delivery" name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="cash-on-delivery">@lang('backend.Cash On Delivery')</label>
                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif

                                                @if ($sslcommerz->status == 1)
                                                    <div class="payment-check" onclick="paymentActive(this)">
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">
                                                            <input type="radio" value="stripe" id="pay-with-card"
                                                                name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="pay-with-card">@lang('frontend.Pay Stripe')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($stripe->status == 1)
                                                    <div class="payment-check" onclick="paymentActive(this)">
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">
                                                            <input type="radio" value="sslcommerz" id="pay-with-card"
                                                                name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="pay-with-card">@lang('frontend.Pay SSLCOMMERZ')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($bkash->status == 1)
                                                    <div class="payment-check" onclick="paymentActive(this)">
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">
                                                            <input type="radio" value="bkash" id="pay-with-card"
                                                                name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="pay-with-card">@lang('frontend.Pay bKash')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($razorpay->status == 1)
                                                    <div class="payment-check" onclick="paymentActive(this)">
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">
                                                            <input type="radio" value="razorpay" id="pay-with-card"
                                                                name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="pay-with-card">@lang('frontend.Pay Razorpay')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($paypal->status == 1)
                                                    <div class="payment-check" onclick="paymentActive(this)">
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">
                                                            <input type="radio" value="paypal" id="pay-with-card"
                                                                name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label"
                                                                    for="pay-with-card">@lang('frontend.Pay PayPal')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div>

                                                <button class="check-btn btn btn--e-brand-b-2 bg--btn" type="submit">
                                                    @lang('frontend.PLACE ORDER')
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--====== End - Order Summary ======-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>

    <script>
        $(document).ready(function() {
            //other delivery charge

            var deliverychargeType = @json($basic_setting->delivery_charge_type);
            var addressWiseDeliveryCharge = $('#shippingCharge').val();
            var normal_delivery_fee = @json($other_delivery_charge->normal_delivery_fee);
            var free_shipping_fee = @json($other_delivery_charge->free_shipping_fee);
            var free_shipping_status = @json($other_delivery_charge->free_shipping_status);
            var subprice = $('#subtotal').html();
            $('input[name="delivery_option"]').on('click', function() {

                var subprice = $('#subtotal').html();
                var delivery_option_value = $(this).val();

                if (deliverychargeType == 'address_wise') {

                    if (Number(subprice) >= Number(free_shipping_fee) && free_shipping_status == 1) {
                        var delivery_option_value = Number(0) + Number(
                            0);
                        $("#address_wise_delivary_charge_show").text(delivery_option_value);


                    } else {
                        var addressWiseDeliveryCharge = $('#shippingCharge').val();
                        var delivery_option_value = Number(delivery_option_value) + Number(
                            addressWiseDeliveryCharge);

                        var delivery_option_type = $(this).attr('id');
                        if (delivery_option_type == 'pick_up_our_place') {
                            var delivery_option_value = Number(0) + Number(0);

                        }

                        $("#address_wise_delivary_charge_show").text(delivery_option_value);
                    }

                } else {

                    if (Number(subprice) >= Number(free_shipping_fee) && free_shipping_status == 1) {
                        var deliverycharge = @json($basic_setting->delivary_charge);
                        var delivery_option_value = Number(0) + Number(0);
                    } else {

                        var deliverycharge = @json($basic_setting->delivary_charge);
                        var delivery_option_value = Number(delivery_option_value) + Number(deliverycharge);
                    }

                }


                var delivery_option_type = $(this).attr('id');
                if (delivery_option_type == 'pick_up_our_place') {
                    var delivery_option_value = Number(0) + Number(0);

                }

                $("#dinamicdalivery").text(delivery_option_value);
                var coupon = $('#cpdiscount').val();
                var subprice = $('#subtotal').html();
                var vat = $('#vatvalue').val();
                var tax = $('#taxvalue').val();
                var totalprice = Number(subprice) + Number(delivery_option_value) + Number(vat) + Number(
                        tax) -
                    Number(
                        coupon);
                $('#total').html(totalprice)
            });

            if (deliverychargeType == 'address_wise') {
                var addressWiseDeliveryCharge = $('#shippingCharge').val();


                $('#shippingCharge').on('change', function() {
                    var subprice = $('#subtotal').html();

                    if (Number(subprice) >= Number(free_shipping_fee)) {
                        var addressWiseDeliveryCharge = Number(0) + Number(
                            0);
                        $('#address_wise_delivary_charge_show').html(addressWiseDeliveryCharge);
                    } else {
                        var addressWiseDeliveryCharge = $(this).val();
                        var addressWiseDeliveryCharge = Number(normal_delivery_fee) + Number(
                            addressWiseDeliveryCharge);
                        $('#address_wise_delivary_charge_show').html(addressWiseDeliveryCharge);
                    }

                    var coupon = $('#cpdiscount').val();
                    var subprice = $('#subtotal').html();
                    var vat = $('#vatvalue').val();
                    var tax = $('#taxvalue').val();
                    var totalprice = Number(subprice) + Number(addressWiseDeliveryCharge) + Number(vat) +
                        Number(tax) -
                        Number(
                            coupon);
                    $('#total').html(totalprice)
                });

                if (Number(subprice) >= Number(free_shipping_fee) && free_shipping_status == 1) {
                    var addressWiseDeliveryCharge = Number(0) + Number(0);
                    $('#address_wise_delivary_charge_show').html(addressWiseDeliveryCharge);
                } else {
                    var addressWiseDeliveryCharge = Number(normal_delivery_fee) + Number(addressWiseDeliveryCharge);
                    $('#address_wise_delivary_charge_show').html(addressWiseDeliveryCharge);
                }

                var coupon = $('#cpdiscount').val();
                var subprice = $('#subtotal').html();
                var vat = $('#vatvalue').val();
                var tax = $('#taxvalue').val();
                var totalprice = Number(subprice) + Number(addressWiseDeliveryCharge) + Number(vat) + Number(tax) -
                    Number(
                        coupon);
                $('#total').html(totalprice)
            } else {
                calculation();
            }
        });

        function applycoupon() {
            var code = $('#couponcode').val();

            if (code == '') {
                toastr.error("Please apply a valid coupon!");
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'check-coupon',
                    data: {
                        coupon_code: code,
                    },

                    success: function(data) {
                        if (data.status == 'invalid') {
                            $('#couponpart').addClass('d-none');
                            $('#coupondiscount').text(data.discount);
                            $('#cpdiscount').val(data.discount);
                            $('#couponcode').val('');
                            calculation();
                            toastr.error('Please Input a valid Coupon.');
                        } else if (data.status == 'false') {
                            $('#couponpart').addClass('d-none');
                            $('#cpdiscount').val(data.discount);
                            $('#coupondiscount').text(data.discount);
                            $('#couponcode').val('');
                            calculation();
                            toastr.error('You have already use this coupon.');
                        } else {
                            $('#couponpart').removeClass('d-none');
                            $('#cpdiscount').val(data.discount);
                            $('#coupondiscount').text(data.discount);
                            $('#couponcode').val(code);
                            calculation();
                            toastr.success('coupon applied successfully !');
                        }
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            }
        }

        function havecoupon() {
            var v = $('#havecoupon').val();
            if (v == 'Yes') {
                $('#couponoption').css('display', 'inline-block');
                $('#havecoupon').val('No');
                $('#couponcode').val('');
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'reset-coupon',

                    success: function(data) {
                        if (data == 'valid') {
                            $('#couponoption').css('display', 'none');
                            $('#havecoupon').val('Yes');
                            $('#couponcode').val('');
                            // location.reload();
                        } else {
                            $('#couponoption').css('display', 'none');
                            $('#havecoupon').val('Yes');
                            $('#couponcode').val('');
                            window.alert('Please Input a valid Coupon.');
                        }
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });

            }
        }

        function setdeliverycharge() {

            var deliverycharge = @json($basic_setting->delivary_charge);
            $('#dinamicdalivery').html(deliverycharge);
            var coupon = $('#cpdiscount').val();
            var subprice = $('#subtotal').html();
            var vat = $('#vatvalue').val();
            var tax = $('#taxvalue').val();
            var totalprice = Number(subprice) + Number(deliverycharge) + Number(vat) + Number(tax) - Number(coupon);
            $('#total').html(totalprice)
        }

        function calculation() {
            var free_shipping_fee = @json($other_delivery_charge->free_shipping_fee);
            var free_shipping_status = @json($other_delivery_charge->free_shipping_status);
            var subprice = $('#subtotal').html();
            var normal_delivery_fee = @json($other_delivery_charge->normal_delivery_fee);


            if ((Number(subprice) >= Number(free_shipping_fee) && free_shipping_status == 1)) {
                var deliverycharge = (Number(0) + Number(0));
                $('#dinamicdalivery').html(deliverycharge);
            } else {
                var deliverycharge = @json($basic_setting->delivary_charge);
                var deliverycharge = (Number(deliverycharge) + Number(normal_delivery_fee));
                $('#dinamicdalivery').html(deliverycharge);
            }

            var coupon = $('#cpdiscount').val();
            var subprice = $('#subtotal').html();
            var vat = $('#vatvalue').val();
            var tax = $('#taxvalue').val();
            var totalprice = Number(subprice) + Number(deliverycharge) + Number(vat) + Number(tax) - Number(coupon);
            $('#total').html(totalprice)
            console.log(totalprice);
        }
    </script>

    {{-- delivery option check --}}
    <script>
        function setActive(selectedDiv) {
            $('.delivery-check').removeClass('active');
            $(selectedDiv).addClass('active');
            $(selectedDiv).find('input[type="radio"]').prop('checked', true);
        }
    </script>
    {{-- payment option check --}}
    <script>
        function paymentActive(selectedDiv) {
            $('.payment-check').removeClass('active');
            $(selectedDiv).addClass('active');
            $(selectedDiv).find('input[type="radio"]').prop('checked', true);
        }
    </script>

@endsection
