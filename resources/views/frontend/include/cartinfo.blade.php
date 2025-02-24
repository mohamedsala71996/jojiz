{{-- <a class="mini-cart-shop-link d-flex"><i class="fas fa-shopping-bag"></i> &nbsp;
    <span class="d-lg-none d-block" style="line-height: 14px;">@lang("frontend.VIEW CART")</span>
    @if (!empty($carts->count()))
        <span class="total-item-round">{{ $carts->count() }}</span>
    @endif
</a> --}}
<div class="cart-icon">
    <i class="fa-solid fa-cart-plus"></i>
    @php
        $carts = App\Models\Cart::where('user_id', Auth::id())->latest('id')->get();
        $totalAmount = $carts->reduce(function ($carry, $item) {
            return $carry + $item->price * $item->qty; // Assuming price and quantity fields exist
        }, 0);
    @endphp
    @if (!empty($carts->count()))
        <span>{{ $carts->count() }}</span>
    @endif

</div>

<div class="cart-text has-dropdown" id="cartinfo">
    <p class="mb-0 text-muted">@lang('frontend.Cart')</p>
    @if ($currency->symbol_position == 'left')
        <a href="{{ route('user.cart.add.to.cart.page') }}"
            class="text-decoration-none ">{{ $currency->symbol }}{{ number_format($totalAmount, 2) }}</a>
    @else
        <a href="{{ route('user.cart.add.to.cart.page') }}"
            class="text-decoration-none ">{{ number_format($totalAmount, 2) }}{{ $currency->symbol }}</a>
    @endif

</div>

<span class="js-menu-toggle"></span>
<div class="mini-cart">
    <!--====== Mini Product Container ======-->
    <div class="mini-product-container gl-scroll u-s-m-b-15">
        <!--====== Card for mini cart ======-->

        @foreach ($carts as $item)
            <div class="card-mini-product">
                <div class="mini-product">
                    <div class="mini-product__image-wrapper">
                        <a class="mini-product__link" href="{{ route('product.details', $item->product->id) }}">
                            <img class="u-img-fluid" src="{{ asset($item->productvariation->image) }}"
                                alt="" /></a>
                    </div>
                    <div class="mini-product__info-wrapper">
                        <span class="mini-product__category" style="margin-top: -5px;">


                            <span class="mini-product__name">
                                <a
                                    href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->product_name }}</a></span>
                            <span class="mini-product__quantity">
                                @if (isset($item->color_id) && isset($item->color))
                                    @lang('frontend.Color'): {{ $item->color }}
                                    @endif, @if (isset($item->size_id) && isset($item->size))
                                        @lang('frontend.Size') : {{ $item->size }}
                                        @endif @if (isset($item->weight_id) && isset($item->weight))
                                            @lang('backend.Weight') : {{ $item->weight }}
                                        @endif
                            </span><br>
                            <span class="mini-product__quantity">{{ $item->qty }}x</span>

                            <span class="mini-product__price">{{ $currency->symbol }}
                                {{ intval($item->price) }}</span>
                    </div>
                </div>

                <a class="mini-product__delete-link far fa-trash-alt"
                    href="{{ route('user.cart.remove.cart.item', $item->id) }}"></a>
            </div>
        @endforeach

        <!--====== End - Card for mini cart ======-->

        <!--====== End - Card for mini cart ======-->
    </div>
    <!--====== End - Mini Product Container ======-->

    <!--====== Mini Product Statistics ======-->
    <div class="mini-product-stat">

        <div class="mini-action">
            <a class="mini-link btn--e-brand-b-2" href="{{ route('user.checkout.page') }}">@lang('frontend.PROCEED TO CHECKOUT')</a>

            <a class="mini-link btn--e-transparent-secondary-b-2"
                href="{{ route('user.cart.add.to.cart.page') }}">@lang('frontend.VIEW CART')</a>
        </div>
    </div>
    <!--====== End - Mini Product Statistics ======-->
</div>
