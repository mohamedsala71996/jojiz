<!--====== Section 3 ======-->
<div class="u-s-p-b-60 pb-0">
    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">
                            @lang('frontend.DEAL OF THE DAY')
                        </h1>

                        <span class="section__span u-c-silver">@lang('frontend.Buy deal of the day, hurry up!') </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->

    <!--====== Deal of the day section start ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12" id="offerproduct">
                    <div class="row custom-row">
                        @foreach ($todaySaleProduct as $product)
                            @if (count($product->productvariations) > 0)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6 u-s-m-b-30 custom-padding">
                                    <div class="product-o product-o--hover-on u-h-100">
                                        <div class="product-o__wrap">

                                            <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                href="{{ route('product.details', $product->slug) }}">
                                                <img class="aspect__img"
                                                    src="{{ asset($product->productvariations->firstWhere('image')->image ?? '') }}"
                                                    alt="Product Image" /></a>

                                            {{-- <div class="product-o__action-wrap">
                                                <ul class="product-o__action-list">
                                                    <li>
                                                        <a data-modal="modal" data-product="{{ json_encode($product) }}"
                                                            class="QuickLook" data-tooltip="tooltip"
                                                            data-placement="top" title="@lang('frontend.Quick View')"><i
                                                                class="fas fa-search-plus"></i></a>
                                                    </li>
                                                    <li>
                                                        <a data-modal="modal" data-id="{{ $product->id }}"
                                                            data-slug="{{ $product->slug }}"
                                                            data-name="{{ $product->product_name }}"
                                                            data-size="{{ $product->sizes->firstWhere('size')->size ?? '' }}"
                                                            data-sizeid="{{ $product->sizes->firstWhere('id')->id ?? '' }}"
                                                            data-weightid="{{ $product->weights->firstWhere('id')->id ?? '' }}"
                                                            data-varientid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                                                            data-color="{{ $product->productvariations->firstWhere('color')->color ?? '' }}"
                                                            data-image="{{ $product->productvariations->firstWhere('image')->image ?? '' }}"
                                                            data-price="{{ $product->sizes->firstWhere('SalePrice')->SalePrice ?? $product->sizes->firstWhere('RegularPrice')->RegularPrice }}"
                                                            class="addToCart" data-tooltip="tooltip"
                                                            data-placement="top" title="@lang('frontend.Add to Cart')"><i
                                                                class="fa-solid fa-cart-plus"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="addWishlist"
                                                            data-weightid="{{ $product->weights->firstWhere('weight_id')->weight_id ?? '' }}"
                                                            data-sizeid="{{ $product->sizes->firstWhere('size_id')->size_id ?? '' }}"
                                                            data-variationid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                                                            data-id="{{ $product->id }}"
                                                            href="{{ route('user.wishlist.page') }}"
                                                            data-tooltip="tooltip" data-placement="top"
                                                            title="@lang('frontend.Add to Wishlist')"><i class="fas fa-heart"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div> --}}
                                        </div>

                                        <div class="product-text">
                                            <span class="product-o__category category-dev">
                                                <a
                                                    href="{{ route('category.product', $product->category->slug) }}">{{ $product->category->category_name }}</a>
                                                <a data-modal="modal" data-id="{{ $product->id }}"
                                                    data-slug="{{ $product->slug }}"
                                                    data-name="{{ $product->product_name }}"
                                                    data-size="{{ $product->sizes->firstWhere('size')->size ?? '' }}"
                                                    data-sizeid="{{ $product->sizes->firstWhere('id')->id ?? '' }}"
                                                    data-weightid="{{ $product->weights->firstWhere('id')->id ?? '' }}"
                                                    data-varientid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                                                    data-color="{{ $product->productvariations->firstWhere('color')->color ?? '' }}"
                                                    data-image="{{ $product->productvariations->firstWhere('image')->image ?? '' }}"
                                                    data-price="{{ $product->sizes->firstWhere('SalePrice')->SalePrice ?? $product->sizes->firstWhere('RegularPrice')->RegularPrice }}"
                                                    class="addToCart" data-tooltip="tooltip" data-placement="top"
                                                    title="@lang('frontend.Add to Cart')"><i class="fa-solid fa-cart-plus"></i></a>
                                            </span>

                                            <span class="product-o__name">
                                                <a
                                                    href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a></span>

                                            <div class="product-o__rating gl-rating-style">
                                                @php
                                                    $ratings = $product->reviews->pluck('rating');
                                                    $sum_rating = $ratings->sum();
                                                    $count_rating = $ratings->count();
                                                    if ($count_rating > 0) {
                                                        $average_rating = intval($sum_rating / $count_rating);
                                                    }
                                                @endphp

                                                @if ($count_rating > 0)
                                                    @for ($i = 1; $i <= $average_rating; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor

                                                    <span class="product-o__review">({{ $count_rating }})</span>
                                                @endif
                                            </div>

                                            @if ($currency->symbol_position == 'left')
                                            <span class="product-1__price">

                                                @if ($product->sizes->firstWhere('Discount') != null)
                                                    @if ($product->sizes->firstWhere('Discount')->Discount > 0)
                                                        {{ $currency->symbol }}{{ intval($product->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}<span
                                                            class="product-l__discount">{{ $currency->symbol }}
                                                            {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}</span>
                                                    @else
                                                        {{ $currency->symbol }}
                                                        {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                    @endif
                                                @else
                                                    {{ $currency->symbol }}
                                                    {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                @endif

                                            </span>
                                        @else
                                            <span class="product-1__price">

                                                @if ($product->sizes->firstWhere('Discount') != null)
                                                    @if ($product->sizes->firstWhere('Discount')->Discount > 0)
                                                        {{ intval($product->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}{{ $currency->symbol }}<span
                                                            class="product-l__discount">
                                                            {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}{{ $currency->symbol }}</span>
                                                    @else
                                                        {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}{{ $currency->symbol }}
                                                    @endif
                                                @else
                                                    {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}{{ $currency->symbol }}
                                                @endif

                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== Deal of the day section End ======-->
