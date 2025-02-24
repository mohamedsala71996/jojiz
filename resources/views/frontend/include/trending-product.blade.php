<!--====== Section 2 ======-->
<div class="top-trending">
    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-16">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">
                            @lang('frontend.TOP TRENDING')
                        </h1>

                        <span class="section__span u-c-silver">@lang('frontend.Choose Category')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->

    <!--======Top Trending  Section two ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-category-container">
                        <div class="filter__category-wrapper">
                            <button class="filter__btn filter__btn--style-1 js-checked" type="button" data-filter="*">
                                @lang('frontend.ALL')
                            </button>
                        </div>
                        @foreach ($categories as $category)
                            @if ( $category->products_count > 0)
                                <div class="filter__category-wrapper">
                                    <button class=" filter__btn filter__btn--style-1 nobreak" type="button"
                                        data-filter=".{{ $category->slug }}">
                                        {{ $category->category_name }}
                                    </button>
                                </div>
                            @endif
                        @endforeach


                    </div>
                </div>
                <div class="col-lg-12 p-0">
                    <div class="filter__grid-wrapper u-s-m-t-30 customHight">
                        <div class="row custom-row">
                            @forelse ($products as $product )
                                @if (count($product->productvariations) > 0)
                                    <div
                                        class="col-xl-2 col-lg-3 col-md-4 col-6 u-s-m-b-30 custom-padding filter__item {{ $product->category->slug }}">

                                        <div class="product-o product-o--hover-on product-o--radius">
                                            <div class="product-o__wrap">

                                                <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                    href="{{ route('product.details', $product->slug) }}">
                                                    <img class="aspect__img"
                                                        src="{{ asset($product->productvariations->firstWhere('image')->image ?? 'public/dumy.jpg') }}"
                                                        alt="Product Image" />
                                                </a>


                                            </div>

                                            <div class="product-text">
                                                <span class="product-o__category category-dev">
                                                    <a
                                                        href="{{ route('category.product', $product->category->slug) }}">{{ $product->category->category_name }}</a>
                                                    <div class="product-icon">
                                                        {{-- <a class="addWishlist"
                                                            data-weightid="{{ $product->weights->firstWhere('weight_id')->weight_id ?? '' }}"
                                                            data-sizeid="{{ $product->sizes->firstWhere('size_id')->size_id ?? '' }}"
                                                            data-variationid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                                                            data-id="{{ $product->id }}" data-tooltip="tooltip"
                                                            data-placement="top" title="@lang('frontend.Add to Wishlist')"><i
                                                                class="fa-regular fa-heart"></i>
                                                        </a> --}}
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
                                                                class="fa-solid fa-cart-plus"></i></a>
                                                    </div>
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

                            @empty
                                <div>@lang('frontend.No Data Found !')</div>
                            @endforelse

                        </div>
                    </div>
                </div>
                <div id="no-products-message" class="text-center" style="display: none;">
                    @lang('frontend.No Data Found !')
                </div>

                <div class="col-lg-12" id="more-product">
                    <div class="load-more">
                        <a class="custom-btn3 btn-7" href="{{ route('shop') }}">
                            <span>@lang('frontend.More')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== Top trending Section end ======-->
</div>
<!--====== End - Section 2 ======-->
