@php

    $varient_id = Session::get('varient_id');
    $size_id = Session::get('size_id');
    $weight_id = Session::get('weight_id');

@endphp

<!--====== Product Right Side Details ======-->
<div class="pd-detail">
    <div>
        <span class="pd-detail__name">{{ $product->product_name }}</span>
    </div>
    <div>
        @php
            $varients = App\Models\Productvariation::where('product_id', $product->id)->get();
            $sizes = App\Models\Size::where('varient_id', $varients[0]->id)->get();
            $reviews = App\Models\Review::with('user')
                ->where('product_id', $product->id)
                ->get();
            $weights = App\Models\Weight::where('varient_id', $varients[0]->id)->get();
            $stock = $sizes->sum('stock') + $weights->sum('stock');
        @endphp

        @if ($currency->symbol_position == 'left')
            <div class="pd-detail__inline">
                @if (isset($sizes[0]))
                    <span class="pd-detail__price">{{ $currency->symbol }}<span id="salePrice">
                            @if (Session::get('price'))
                                {{ intval(Session::get('price')) }}
                            @else
                                {{ intval($sizes[0]->SalePrice) }}
                            @endif
                        </span></span>
                    @if ($sizes[0]->Discount > 0)
                        <del class="pd-detail__del">{{ $currency->symbol }}<span id="regPrice">
                                @if (Session::get('price'))
                                    {{ intval(Session::get('price')) }}
                                @else
                                    {{ intval($sizes[0]->RegularPrice) }}
                                @endif
                            </span></del><span class="pd-detail__discount">&nbsp;
                            ({{ intval(($sizes[0]->Discount / $sizes[0]->RegularPrice) * 100) }}% OFF)</span>
                    @endif
                @else
                    <span class="pd-detail__price">{{ $currency->symbol }}<span id="salePrice">
                            @if (Session::get('price'))
                                {{ intval(Session::get('price')) }}
                            @else
                                {{ intval($weights[0]->SalePrice) }}
                            @endif
                        </span></span>
                    @if ($weights[0]->Discount > 0)
                        <del class="pd-detail__del">{{ $currency->symbol }}<span id="regPrice">
                                @if (Session::get('price'))
                                    {{ intval(Session::get('price')) }}
                                @else
                                    {{ intval($weights[0]->RegularPrice) }}
                                @endif
                            </span></del><span class="pd-detail__discount">&nbsp;
                            ({{ intval(($weight->Discount / $weight->RegularPrice) * 100) }}% OFF)</span>
                    @endif
                @endif
            </div>
        @else
            <div class="pd-detail__inline">
                @if (isset($sizes[0]))
                    <span class="pd-detail__price"><span id="salePrice">
                            @if (Session::get('price'))
                                {{ intval(Session::get('price')) }}
                            @else
                                {{ intval($sizes[0]->SalePrice) }}
                            @endif
                        </span>{{ $currency->symbol }}</span>
                    @if ($sizes[0]->Discount > 0)
                        <del class="pd-detail__del"><span id="regPrice">
                                @if (Session::get('price'))
                                    {{ intval(Session::get('price')) }}
                                @else
                                    {{ intval($sizes[0]->RegularPrice) }}
                                @endif
                            </span>{{ $currency->symbol }}</del><span class="pd-detail__discount">&nbsp;
                            ({{ intval(($sizes[0]->Discount / $sizes[0]->RegularPrice) * 100) }}% OFF)</span>
                    @endif
                @else
                    <span class="pd-detail__price"><span id="salePrice">
                            @if (Session::get('price'))
                                {{ intval(Session::get('price')) }}
                            @else
                                {{ intval($weights[0]->SalePrice) }}
                            @endif
                        </span>{{ $currency->symbol }}</span>
                    @if ($weights[0]->Discount > 0)
                        <del class="pd-detail__del"><span id="regPrice">
                                @if (Session::get('price'))
                                    {{ intval(Session::get('price')) }}
                                @else
                                    {{ intval($weights[0]->RegularPrice) }}
                                @endif
                            </span>{{ $currency->symbol }}</del><span class="pd-detail__discount">&nbsp;
                            ({{ intval(($weight->Discount / $weight->RegularPrice) * 100) }}% OFF)</span>
                    @endif
                @endif
            </div>
        @endif
    </div>
    <div class="u-s-m-b-5 d-flex justify-content-between">

        <div class="pd-detail__rating gl-rating-style" style="padding-top: 5px;">
            @if (isset($reviews))
                @if (intval($reviews->sum('rating')) == 1)
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star"></span>
                    <span class="fas fa-star"></span>
                    <span class="fas fa-star"></span>
                    <span class="fas fa-star"></span>
                @elseif(intval($reviews->sum('rating')) == 2)
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star"></span>
                    <span class="fas fa-star"></span>
                    <span class="fas fa-star"></span>
                @elseif(intval($reviews->sum('rating')) == 3)
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star"></span>
                    <span class="fas fa-star"></span>
                @elseif(intval($reviews->sum('rating')) == 4)
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star"></span>
                @elseif(intval($reviews->sum('rating')) == 5)
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                @else
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                    <span class="fas fa-star" id="checked"></span>
                @endif
            @else
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                    class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            @endif

            <span class="pd-detail__review u-s-m-l-4">
                <a data-click-scroll="#view-review">
                    @if (isset($reviews))
                        {{ $reviews->count() }}
                    @endif @lang('frontend.Review')
                </a></span>
        </div>


    </div>

    <div class="u-s-m-b-15">

        <div class="u-s-m-b-15">
            <span class="pd-detail__label u-s-m-b-8">@lang('frontend.Color'):</span>
            <div class="pd-detail__color">
                @foreach ($varients as $key => $color)
                    <div class="color__radio">
                        <input type="radio" id="color{{ $color->color }}"
                            @if ($varient_id == $color->id) checked @elseif($key == 0) checked @else @endif
                            value="{{ $color->id }}" name="color"
                            onclick="loadexinfo('{{ $color->id }}','{{ $key }}')" />
                        <label class="color__radio-label" id="colortext{{ $color->color }}"
                            for="color{{ $color->color }}" style="background-color: {{ $color->color }}"
                            onclick="loadexinfo('{{ $color->id }}','{{ $key }}')"></label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="u-s-m-b-0" id="varientinfo">
            @include('frontend.include.varientinfo')
        </div>

        <div class="pd-detail-inline-2">
            <div class="u-s-m-b-15">
                <!--====== Input Counter ======-->
                <div class="quantity-part d-flex">
                    <div class="input-counter">
                        <span class="input-counter__minus fas fa-minus" id="buttonminus" onclick="minus()"></span>
                        <input class="input-counter__text input-counter--text-primary-style" type="text"
                            id="qty" value="1" name="qty" data-min="1" data-max="10" />

                        <span class="input-counter__plus fa-solid fa-plus" id="buttonplus" onclick="plus()"></span>
                    </div>
                    <!--====== End - Input Counter ======-->
                    {{-- stock part start --}}
                    <div class="pd-detail__inline mt-2">
                        <span class="pd-detail__stock">
                            @if (isset($sizes[0]))
                                <span id="stock">{{ $sizes[0]->stock }}</span>
                            @else
                                <span id="stock">{{ $weights[0]->stock }}</span>
                            @endif
                            @lang('frontend.in stock')
                        </span>
                    </div>
                    {{-- stock part end --}}
                </div>
                {{-- total price of quantity set --}}


            </div>

            <input type="hidden" name="varient_id" id="varient_id" value="{{ $varients[0]->id }}">
            @if (isset($sizes[0]))
                <input type="hidden" name="size_id" id="size_id" value="{{ $sizes[0]->id }}">
            @else
                <input type="hidden" name="size_id" id="size_id" value="">
            @endif
            @if (isset($weights[0]))
                <input type="hidden" name="weight_id" id="weight_id" value="{{ $weights[0]->id }}">
            @else
                <input type="hidden" name="weight_id" id="weight_id" value="">
            @endif
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
        </div>
        <div class="u-s-m-b-15 buy-btn">
            <button type="submit" class="btn bg--btn btn--e-brand-b-2"
                onclick="buynowRedirectCheckout({{ $product->id }})"><span><i
                        class="fa-solid fa-bag-shopping"></i></span>@lang('frontend.Buy Now')</button>
            <button type="submit" class="btn btn--e-brand-b-2 bg--btn ml-5" onclick="buynow({{ $product->id }})">
                <span><i class="fa-solid fa-cart-plus"></i></span> @lang('frontend.Add to Cart')
            </button>
        </div>
    </div>
    <div class="u-s-m-b-15">
        <span class="pd-detail__label u-s-m-b-8">@lang('frontend.Product Policy:')</span>
        <ul class="pd-detail__policy-list">
            <li>
                <i class="fas fa-check-circle u-s-m-r-8"></i>

                <span>@lang('frontend.Buyer Protection.')</span>
            </li>
            <li>
                <i class="fas fa-check-circle u-s-m-r-8"></i>

                <span>@lang("frontend.Full Refund if you don't receive your order.")</span>
            </li>
            <li>
                <i class="fas fa-check-circle u-s-m-r-8"></i>

                <span>@lang('frontend.Returns accepted if product not as described.')</span>
            </li>
        </ul>
    </div>
</div>
