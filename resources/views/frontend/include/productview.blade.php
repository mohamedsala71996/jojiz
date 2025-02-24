@php
    $sc_id = App\Models\Admin\SubCategory::where('id', Session::get('sub_category_id'))->first();
    $b_id = App\Models\Admin\Brand::where('id', Session::get('brand_id'))->first();
    $minprice = Session::get('min_price');
    $maxprice = Session::get('max_price');
    $rating = Session::get('rating');
@endphp
<style>
    #buttonfil {
        border: none;
        background: #02a8ec;
        color: white;
        font-weight: bold;
        border-radius: 20px;
        padding: 2px 10px;
    }
</style>
<div class="row">
    @if ($sc_id || $b_id || $minprice || $maxprice || $rating)
        <div class="col-12">
            <div class="card card-body" style="padding: 4px 20px;border:none">
                <p>@lang('frontend.Filter Results') :
                    @if (isset($sc_id->name))
                        <button id="buttonfil" type="button"
                            onclick="resetdatasc({{ $sc_id->id }})">{{ $sc_id->name }} &nbsp; <i
                                class="fas fa-close"></i></button> &nbsp;
                    @endif
                    @if (isset($b_id->name))
                        <button id="buttonfil" type="button"
                            onclick="resetdatab({{ $b_id->id }})">{{ $b_id->name }} &nbsp; <i
                                class="fas fa-close"></i></button> &nbsp;
                    @endif
                    @if (isset($minprice))
                        <button id="buttonfil" type="button"
                            onclick="resetdatamin({{ $minprice }})">${{ $minprice }} &nbsp; <i
                                class="fas fa-close"></i></button> &nbsp;
                    @endif
                    @if (isset($maxprice))
                        <button id="buttonfil" type="button"
                            onclick="resetdatamax({{ $maxprice }})">${{ $maxprice }} &nbsp; <i
                                class="fas fa-close"></i></button> &nbsp;
                    @endif
                    @if (isset($rating))
                        <button id="buttonfil" type="button"
                            onclick="resetdatastar({{ $rating }})">{{ $rating }} Star &nbsp; <i
                                class="fas fa-close"></i></button>
                    @endif
                </p>
            </div>
        </div>
    @endif

    @forelse ($cProducts as $product)
        @if (count($product->productvariations) > 0)
            <div class="shop-product col-xl-3 col-lg-3 col-md-4 col-6 u-s-m-b-30">
                <div class="product-o product-o--hover-on product-o--radius u-h-100">
                    <div class="product-o__wrap">

                        <a class="aspect aspect--bg-grey aspect--square u-d-block"
                            href="{{ route('product.details', $product->slug) }}">
                            <img class="aspect__img"
                                src="{{ asset($product->productvariations->firstWhere('image')->image ?? '') }}"
                                alt="Product Image" /></a>

                        {{-- <div class="product-o__action-wrap">
                            <ul class="product-o__action-list">
                                <li>
                                    <a data-modal="modal" data-product="{{ json_encode($product) }}" class="QuickLook"
                                        data-tooltip="tooltip" data-placement="top" title="@lang('frontend.Quick View')"><i
                                            class="fas fa-search-plus"></i></a>
                                </li>
                                <li>
                                    <a data-modal="modal" data-id="{{ $product->id }}"
                                        data-slug="{{ $product->slug }}" data-name="{{ $product->product_name }}"
                                        data-size="{{ $product->sizes->firstWhere('size')->size ?? '' }}"
                                        data-sizeid="{{ $product->sizes->firstWhere('id')->id ?? '' }}"
                                        data-weightid="{{ $product->weights->firstWhere('id')->id ?? '' }}"
                                        data-varientid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                                        data-color="{{ $product->productvariations->firstWhere('color')->color ?? '' }}"
                                        data-image="{{ $product->productvariations->firstWhere('image')->image ?? '' }}"
                                        data-price="{{ $product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '' }}"
                                        class="addToCart" data-tooltip="tooltip" data-placement="top"
                                        title="@lang('frontend.Add to Cart')"><i class="fa-solid fa-cart-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="addWishlist" data-id="{{ $product->id }}" data-tooltip="tooltip"
                                        data-placement="top" title="@lang('frontend.Add to Wishlist')"><i class="fas fa-heart"></i></a>
                                </li>

                            </ul>
                        </div> --}}
                    </div>

                    <div class="product-text">
                        <span class="product-o__category category-dev">
                            <a
                                href="{{ route('category.product', $product->category->slug) }}">{{ $product->category->category_name }}</a>
                            <a data-modal="modal" data-id="{{ $product->id }}" data-slug="{{ $product->slug }}"
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
                            <span class="product-o__price">
                                @if ($product->sizes->firstWhere('Discount') && $product->sizes->firstWhere('Discount')->Discount > 0)
                                    {{ $currency->symbol }}{{ intval($product->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}<span
                                        class="product-o__discount">{{ $currency->symbol }}{{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}</span>
                                @else
                                    {{ $currency->symbol }}{{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                @endif
                            </span>
                        @else
                            <span class="product-o__price">
                                @if ($product->sizes->firstWhere('Discount') && $product->sizes->firstWhere('Discount')->Discount > 0)
                                   {{ intval($product->sizes->firstWhere('SalePrice')->SalePrice ?? '') }} {{ $currency->symbol }}<span
                                        class="product-o__discount">{{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}{{ $currency->symbol }}</span>
                                @else
                                   {{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }} {{ $currency->symbol }}
                                @endif
                            </span>
                        @endif

                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="col-12">
            <div class="card p-4 text-center">
                <h2>@lang('frontend.No Data Found !')</h4>
            </div>
        </div>
    @endforelse

</div>
