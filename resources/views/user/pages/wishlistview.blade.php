<!--====== Wishlist Product ======-->
@foreach ($wishlists as $wishlist)
    @php
        $product = App\Models\Admin\Product::find($wishlist->product_id);
    @endphp
    <div class="w-r u-s-m-b-30">
        <div class="w-r__container">
            <div class="w-r__wrap-1">
                <div class="w-r__img-wrap">
                    <img class="u-img-fluid"
                        src="{{ asset($product->productvariations->firstWhere('image')->image ?? '') }}" alt="">
                </div>
                <div class="w-r__info">
                    <span class="w-r__name">
                        <a href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a></span>

                    <span class="w-r__category">
                        <a
                            href="{{ route('category.product', $product->category->slug) }}">{{ $product->category->category_name }}</a></span>

                    <span class="w-r__price">${{ $product->sizes->firstWhere('RegularPrice')->RegularPrice }}

                        <span
                            class="w-r__discount">${{ $product->sizes->firstWhere('SalePrice')->SalePrice }}</span></span>
                </div>
            </div>
            <div class="w-r__wrap-2">


                <a href="{{ route('user.cart.add.to.cart.page') }}" data-id="{{ $product->id }}"
                    data-slug="{{ $product->slug }}" data-name="{{ $product->product_name }}"
                    data-size="{{ $product->sizes->firstWhere('size')->size ?? '' }}"
                    data-sizeid="{{ $product->sizes->firstWhere('id')->id ?? '' }}"
                    data-weightid="{{ $product->weights->firstWhere('id')->id ?? '' }}"
                    data-varientid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                    data-color="{{ $product->productvariations->firstWhere('color')->color ?? '' }}"
                    data-image="{{ $product->productvariations->firstWhere('image')->image ?? '' }}"
                    data-price="${{ $product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '' }}"
                    class="addToCart w-r__link btn--e-transparent-platinum-b-2" data-tooltip="tooltip" data-placement="top" title="@lang('frontend.Add to Cart')">
                    @lang('frontend.Add to Cart')</a>

                <a class="w-r__link btn--e-transparent-platinum-b-2"
                    href="{{ route('product.details', $product->slug) }}">@lang('frontend.VIEW')</a>

                <a class="w-r__link btn--e-transparent-platinum-b-2 removeItemWishlist" data-id="{{ $product->id }}"
                    type="button">@lang('frontend.REMOVE')</a>
            </div>
        </div>
    </div>
@endforeach
