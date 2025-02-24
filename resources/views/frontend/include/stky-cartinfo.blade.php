    <div class="cart-icon2">
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
    @php
        $carts = App\Models\Cart::where('user_id', Auth::id())->latest('id')->get();
    @endphp
    @if (!empty($carts) && count($carts) > 0)
        <div class="mini-cart2">
            <!--====== Mini Product Container ======-->
            <div class="mini-product-container gl-scroll u-s-m-b-15">

                @foreach ($carts as $item)
                    <div class="card-mini-product">
                        <div class="mini-product">
                            <div class="mini-product__image-wrapper">
                                @if (isset($item->product))
                                    <a class="mini-product__link"
                                        href="{{ route('product.details', $item->product->slug) }}">
                                        <img class="u-img-fluid" src="{{ asset($item->productvariation->image) }}"
                                            alt="" /></a>
                                @endif
                            </div>
                            <div class="mini-product__info-wrapper">
                                <span class="mini-product__category" style="margin-top: -5px;">


                                    <span class="mini-product__name">
                                        @if (isset($item->product))
                                            <a
                                                href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->product_name }}</a>
                                        @endif
                                    </span>
                                    <span class="mini-product__quantity">
                                        @if (isset($item->color_id) && isset($item->color))
                                            @lang('frontend.Color'): {{ $item->color }}
                                            @endif, @if (isset($item->size_id) && isset($item->size))
                                                @lang('frontend.Size'): {{ $item->size }}
                                                @endif @if (isset($item->weight_id) && isset($item->weight))
                                                    Weight: {{ $item->weight }}
                                                @endif
                                    </span><br>
                                    <span class="mini-product__quantity">{{ $item->qty }}x</span>
                                    @if ($currency->symbol_position == 'left')
                                        <span
                                            class="mini-product__price">{{ $currency->symbol }}{{ intval($item->price) }}</span>
                                    @else
                                        <span
                                            class="mini-product__price">{{ intval($item->price) }}{{ $currency->symbol }}</span>
                                    @endif
                            </div>
                        </div>

                        <a class="mini-product__delete-link far fa-trash-alt"
                            href="{{ route('user.cart.remove.cart.item', $item->id) }}"></a>
                    </div>
                @endforeach

            </div>
            <!--====== End - Mini Product Container ======-->

            <!--====== Mini Product Statistics ======-->
            <div class="mini-product-stat">

                <div class="mini-action">
                    <a class="mini-link btn--e-brand-b-2" href="{{ route('user.checkout.page') }}">@lang('frontend.PROCEED TO CHECKOUT')
                    </a>

                    <a class="mini-link btn--e-transparent-secondary-b-2"
                        href="{{ route('user.cart.add.to.cart.page') }}">@lang('frontend.VIEW CART')</a>
                </div>
            </div>
            <!--====== End - Mini Product Statistics ======-->
        </div>
    @endif
