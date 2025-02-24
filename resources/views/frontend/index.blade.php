@extends('frontend.layouts.master')
@push('frontend_style')
    <style>
        .customHight {
            /* height: 708px !important; */
        }
    </style>
@endpush
@section('frontend_content')
    @include('frontend.include.slider')
    @include('frontend.include.category')
    @include('frontend.include.trending-product')
    @include('frontend.include.offer')

    <!--====== Section Intro start ======-->
    @include('frontend.include.new-arrival')
    <!--====== New Arrivals Products section End ======-->

    <!--====== Feature products part start ======-->
    @include('frontend.include.feature-product')
    <!--====== feature product part End ======-->


    <!--====== special product part start ======-->
    <div class="u-s-p-b-60 pb-0">
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 custom-padding">
                        <div class="column-product">
                            <span class="column-product__title u-c-secondary u-s-m-b-25">@lang('frontend.SPECIAL PRODUCTS')</span>
                            <ul class="column-product__list">
                                @foreach ($special_products as $sp)
                                    <li class="column-product__item">
                                        <div class="product-l">
                                            <div class="product-l__img-wrap">

                                                <a class="aspect aspect--bg-grey aspect--square u-d-block product-l__link"
                                                    href="{{ route('product.details', $sp->slug) }}">
                                                    <img class="aspect__img"
                                                        src="{{ asset($sp->productvariations->firstWhere('image')->image ?? '') }}"
                                                        alt="" />
                                                </a>

                                            </div>
                                            <div class="product-l__info-wrap">
                                                <span class="product-l__category">
                                                    <a
                                                        href="{{ route('category.product', $sp->category->slug) }}">{{ $sp->category->category_name }}</a></span>

                                                <span class="product-l__name">
                                                    <a
                                                        href="{{ route('product.details', $sp->slug) }}">{{ $sp->product_name }}</a></span>
                                                @if ($currency->symbol_position == 'left')
                                                    <span class="product-l__price">
                                                        @if ($sp->sizes->firstWhere('Discount') != null && $sp->sizes->firstWhere('Discount')->Discount > 0)
                                                            {{ $currency->symbol }}{{ intval($sp->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}
                                                        @else
                                                            {{ $currency->symbol }}{{ intval($sp->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="product-l__price">
                                                        @if ($sp->sizes->firstWhere('Discount') != null && $sp->sizes->firstWhere('Discount')->Discount > 0)
                                                            {{ intval($sp->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}{{ $currency->symbol }}
                                                        @else
                                                            {{ intval($sp->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                            {{ $currency->symbol }}
                                                        @endif
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 ">
                        <div class="column-product">
                            <span class="column-product__title u-c-secondary u-s-m-b-25">@lang('frontend.WEEKLY PRODUCTS') </span>
                            <ul class="column-product__list">
                                @foreach ($weeklySaleProduct as $wp)
                                    <li class="column-product__item">
                                        <div class="product-l">
                                            <div class="product-l__img-wrap">

                                                <a class="aspect aspect--bg-grey aspect--square u-d-block product-l__link"
                                                    href="{{ route('product.details', $wp->slug) }}">
                                                    <img class="aspect__img"
                                                        src="{{ asset($wp->productvariations->firstWhere('image')->image ?? '') }}"
                                                        alt="" />
                                                </a>

                                            </div>
                                            <div class="product-l__info-wrap">
                                                <span class="product-l__category">
                                                    <a
                                                        href="{{ route('category.product', $wp->category->slug) }}">{{ $wp->category->category_name }}</a></span>

                                                <span class="product-l__name">
                                                    <a
                                                        href="{{ route('product.details', $wp->slug) }}">{{ $wp->product_name }}</a></span>


                                                @if ($currency->symbol_position == 'left')
                                                    <span class="product-l__price">
                                                        @if ($wp->sizes->firstWhere('Discount') != null && $wp->sizes->firstWhere('Discount')->Discount > 0)
                                                            {{ $currency->symbol }}{{ intval($wp->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}
                                                        @else
                                                            {{ $currency->symbol }}{{ intval($wp->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="product-l__price">
                                                        @if ($wp->sizes->firstWhere('Discount') != null && $wp->sizes->firstWhere('Discount')->Discount > 0)
                                                            {{ intval($wp->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}{{ $currency->symbol }}
                                                        @else
                                                            {{ intval($wp->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                            {{ $currency->symbol }}
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 ">
                        <div class="column-product">
                            <span class="column-product__title u-c-secondary u-s-m-b-25">@lang('frontend.FLASH PRODUCTS') </span>
                            <ul class="column-product__list">
                                @foreach ($flash_products as $fp)
                                    <li class="column-product__item">
                                        <div class="product-l">
                                            <div class="product-l__img-wrap">

                                                <a class="aspect aspect--bg-grey aspect--square u-d-block product-l__link"
                                                    href="{{ route('product.details', $fp->slug) }}">
                                                    <img class="aspect__img"
                                                        src="{{ asset($fp->productvariations->firstWhere('image')->image ?? '') }}"
                                                        alt="" />
                                                </a>

                                            </div>
                                            <div class="product-l__info-wrap">
                                                <div class="product-l__rating gl-rating-style">
                                                    @php
                                                        $ratings = $fp->reviews->pluck('rating');
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

                                                <span class="product-l__category">
                                                    <a
                                                        href="{{ route('category.product', $fp->category->slug) }}">{{ $fp->category->category_name }}</a></span>

                                                <span class="product-l__name">
                                                    <a
                                                        href="{{ route('product.details', $fp->slug) }}">{{ $fp->product_name }}</a></span>

                                                @if ($currency->symbol_position == 'left')
                                                    <span class="product-l__price">
                                                        @if ($fp->sizes->firstWhere('Discount') != null && $fp->sizes->firstWhere('Discount')->Discount > 0)
                                                            {{ $currency->symbol }}{{ intval($fp->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}
                                                        @else
                                                            {{ $currency->symbol }}{{ intval($fp->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="product-l__price">
                                                        @if ($fp->sizes->firstWhere('Discount') != null && $fp->sizes->firstWhere('Discount')->Discount > 0)
                                                            {{ intval($fp->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}{{ $currency->symbol }}
                                                        @else
                                                            {{ intval($fp->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                            {{ $currency->symbol }}
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== special product part End ======-->

        <!--====== Free shipping Start ======-->
        <div class="u-s-p-b-20 pb-0">
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon">
                                    <i class="fas fa-solid fa-headset"></i>
                                </div>
                                <div class="service__info-wrap">
                                    <span class="service__info-text-1">@lang('frontend.Customer Support')</span>

                                    <span class="service__info-text-2">@lang('frontend.Contact us for fast and friendly customer support anytime.')</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon"><i class="fa-solid fa-parachute-box"></i></div>
                                <div class="service__info-wrap">
                                    <span class="service__info-text-1">@lang('frontend.Quick Delivery')</span>

                                    <span class="service__info-text-2">@lang('frontend.Quickly and reliable shipping for your convenience.') </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon"><i class=" fa-solid fa-truck"></i></div>
                                <div class="service__info-wrap">
                                    <span class="service__info-text-1">@lang('frontend.Order Tracking and Updates') </span>

                                    <span class="service__info-text-2">@lang('frontend.Stay informed with real-time order progress.') </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon">
                                    <i class=" fa-solid fa-screwdriver-wrench"></i>
                                </div>
                                <div class="service__info-wrap">
                                    <span class="service__info-text-1">@lang('frontend.Technical Support')</span>

                                    <span class="service__info-text-2">@lang('frontend.Expert assistance for troubleshooting and inquiries.')
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== free shipping End ======-->
        <!--====== Collection Start ======-->
        <div class="u-s-p-b-60">
            <div class="section__intro u-s-m-b-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">
                                    @lang('frontend.PRODUCTS COLLECTION')
                                </h1>

                                <span class="section__span u-c-silver">@lang('frontend.Find your existing product') </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        @foreach ($collections as $item)
                            <div class="col-lg-3 col-md-3 col-sm-5 u-s-m-b-30 get-part">
                                <a class="promotion" href="{{ route('product.collection', $item->id) }}">
                                    <div class="aspect aspect--bg-grey aspect--square">
                                        <img class="aspect__img promotion__img" src="{{ asset($item->image) }}"
                                            alt="">
                                    </div>
                                    <div class="promotion__content">
                                        <div class="promotion__text-wrap">
                                            <div class="promotion__text-1">
                                                <span class="u-c-secondary">{{ $item->sub_title ?? '' }}</span>
                                            </div>
                                            <div class="promotion__text-2">
                                                <span class="u-c-secondary">{{ $item->title ?? '' }}</span>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        {{-- <div class="col-lg-4 col-md-4 col-sm-6 u-s-m-b-30">
                <a class="promotion" href="shop.html">
                  <div class="aspect aspect--bg-grey aspect--square">
                    <img class="aspect__img promotion__img" src="images/promo/promo2.jpg" alt="">
                  </div>
                  <div class="promotion__content">
                    <div class="promotion__text-wrap">
                      <div class="promotion__text-1">
                        <span class="u-c-secondary">SMARTPHONE</span>

                        <span class="u-c-brand">2019</span>
                      </div>
                      <div class="promotion__text-2">
                        <span class="u-c-secondary">NEW ARRIVALS</span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-6 u-s-m-b-30">
                <a class="promotion" href="shop.html">
                  <div class="aspect aspect--bg-grey aspect--square">
                    <img class="aspect__img promotion__img" src="images/promo/promo3.jpg" alt="">
                  </div>
                  <div class="promotion__content">
                    <div class="promotion__text-wrap">
                      <div class="promotion__text-1">
                        <span class="u-c-secondary">DSLR FOR NEW GENERATION</span>
                      </div>
                      <div class="promotion__text-2">
                        <span class="u-c-brand">GET UP TO 10% OFF</span>
                      </div>
                    </div>
                  </div>
                </a>
              </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--====== Collection End ======-->


        <!--====== popular brand start ======-->
        <div class="u-s-p-b-60 pb-0">
            <div class="section__intro u-s-m-b-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">
                                    @lang('frontend.Popular Brands')
                                </h1>

                                <span class="section__span u-c-silver">@lang('frontend.We are associated with this popular brands') </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== popular brand End ======-->

            <!--====== Section 12 ======-->
            <div class="u-s-p-b-60 pb-4">
                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <!--====== Brand Slider ======-->
                        <div class="slider-fouc">
                            <div class="owl-carousel" id="brand-slider" data-item="5">
                                @foreach ($brands as $brand)
                                    <div class="brand-slide">
                                        <a href="{{ route('brand.product', $brand->slug) }}">
                                            <img src="{{ asset($brand->image) }}" alt=""
                                                style="border-radius:6px;height:100px;" /></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--====== End - Brand Slider ======-->
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 12 ======-->
        </div>
        <!--====== End - App Content ======-->

        @include('frontend.components.modal.quick-look')
        @include('frontend.components.modal.login-registration-form')
        <!--====== Add to Cart Modal ======-->
        @include('frontend.components.modal.add-to-card')
        <!--====== End - Add to Cart Modal ======-->
    @endsection
    @push('frontend_script')

    @endpush
