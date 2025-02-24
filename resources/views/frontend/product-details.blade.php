@extends('frontend.layouts.master')

@section('frontend_content')
    @php
        $varient_id = Session::get('varient_id');
        $size_id = Session::get('size_id');
        $weight_id = Session::get('weight_id');
    @endphp
    <style>
        #checked {
            color: orange
        }
    </style>
    <!--====== Section 1 ======-->

    <div class="u-s-p-t-10" id="productDetailsPage" data-productId={{ $product->id }}>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <!--====== Product Breadcrumb ======-->
                    <div class="pd-breadcrumb u-s-m-b-10">
                        <ul class="pd-breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ route('index') }}">@lang('frontend.Home')</a>
                            </li>

                            <li class="is-marked">
                                <a href="javascript:void(0)">{{ $product->product_name }}</a>
                            </li>
                        </ul>
                    </div>
                    <!--====== End - Product Breadcrumb ======-->

                    <!--====== Product Detail Zoom ======-->
                    <div class="pd u-s-m-b-10">
                        <div class="slider-fouc pd-wrap">
                            <div id="pd-o-initiate">

                                @foreach ($product->productvariations as $productvariation)
                                    @foreach ($productvariation->productvariationimages as $item)
                                        <div class="pd-o-img-wrap" data-src="{{ asset($item->image_path) }}">
                                            <img class="u-img-fluid" src="{{ asset($item->image_path) }}"
                                                data-zoom-image="{{ asset($item->image_path) }}" alt="Product Image" />
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                            <span class="pd-text">@lang('frontend.Click for larger zoom')</span>
                        </div>
                        <div class="u-s-m-t-15">
                            <div class="slider-fouc">
                                <div id="pd-o-thumbnail">
                                    @foreach ($product->productvariations as $productvariation)
                                        @foreach ($productvariation->productvariationimages as $item)
                                            <div class="mini-photo">
                                                <img class="u-img-fluid " style="width:100px!important;"
                                                    src="{{ asset($item->image_path) }}" alt="" />
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--====== End - Product Detail Zoom ======-->
                </div>
                <div class="col-lg-7">
                    <!--====== Product Right Side Details ======-->
                    <div class="pd-detail">
                        <div>
                            <span class="pd-detail__name">{{ $product->product_name }}</span>
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
                        <div>
                            @php
                                $varients = App\Models\Productvariation::where('product_id', $product->id)->get();
                                $sizes = App\Models\Size::where('varient_id', $varients[0]->id)->get();
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
                                                ({{ intval(($sizes[0]->Discount / $sizes[0]->RegularPrice) * 100) }}%
                                                OFF)</span>
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
                                                ({{ intval(($weights[0]->Discount / $weights[0]->RegularPrice) * 100) }}%
                                                OFF)</span>
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
                                                </span>{{ $currency->symbol }}</del><span
                                                class="pd-detail__discount">&nbsp;
                                                ({{ intval(($sizes[0]->Discount / $sizes[0]->RegularPrice) * 100) }}%
                                                OFF)</span>
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
                                                </span>{{ $currency->symbol }}</del><span
                                                class="pd-detail__discount">&nbsp;
                                                ({{ intval(($weights[0]->Discount / $weights[0]->RegularPrice) * 100) }}%
                                                OFF)</span>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>



                        <div class="u-s-m-b-15">

                            <div class="u-s-m-b-15">
                                <span class="pd-detail__label u-s-m-b-8" id="colorText"> {{ $varients[0]->color }}</span>
                                <div class="pd-detail__color">
                                    @foreach ($varients as $key => $color)
                                        <div class="color__radio">
                                            <input type="radio" data-colorText="{{ $color->color }}"
                                                id="color{{ $color->color }}"
                                                @if ($varient_id == $color->id) checked @elseif($key == 0) checked @else @endif
                                                value="{{ $color->id }}" name="color"
                                                onclick="loadexinfo('{{ $color->id }}', this)" />

                                            <label class="color__radio-label" data-colorText="{{ $color->color }}"
                                                id="colortext{{ $color->color }}" for="color{{ $color->color }}"
                                                style="background-color: {{ $color->color_code }}"
                                                onclick="loadexinfo('{{ $color->id }}',this)"></label>
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
                                        <div class="quantity-text">
                                            <h5>@lang('backend.Quantity')</h5>
                                        </div>
                                        <div class="input-counter">
                                            <span class="input-counter__minus fas fa-minus"></span>
                                            <input class="input-counter__text input-counter--text-primary-style"
                                                type="text" id="qty" value="1" name="qty"
                                                data-min="1" data-max="1000" />

                                            <span class="input-counter__plus fa-solid fa-plus"></span>
                                        </div>
                                        <div class="pd-detail__inline">
                                            <span class="pd-detail__stock">
                                                @if (isset($sizes[0]))
                                                    <span id="stock">{{ $sizes[0]->stock }}</span>
                                                @else
                                                    <span id="stock">{{ $weights[0]->stock }}</span>
                                                @endif
                                                @lang('frontend.in stock')
                                            </span>
                                        </div>
                                    </div>
                                    <!--====== End - Input Counter ======-->
                                    {{-- total price of quantity set --}}

                                </div>

                                <input type="hidden" name="varient_id" id="varient_id" value="{{ $varients[0]->id }}">
                                @if (isset($sizes[0]))
                                    <input type="hidden" name="size_id" id="size_id" value="{{ $sizes[0]->id }}">
                                @else
                                    <input type="hidden" name="size_id" id="size_id" value="">
                                @endif
                                @if (isset($weights[0]))
                                    <input type="hidden" name="weight_id" id="weight_id"
                                        value="{{ $weights[0]->id }}">
                                @else
                                    <input type="hidden" name="weight_id" id="weight_id" value="">
                                @endif

                            </div>
                            <div class="u-s-m-b-15 buy-btn">
                                <button type="submit" class="btn bg--btn "
                                    onclick="buynowRedirectCheckout({{ $product->id }})"><span><i
                                            class="fa-solid fa-bag-shopping"></i></span> @lang('frontend.Buy Now')</button>
                                <button type="submit" class="btn  bg--btn" onclick="buynow({{ $product->id }})">
                                    <span><i class="fa-solid fa-cart-plus"></i></span> @lang('frontend.Add to Cart')
                                </button>
                                <button class="btn  bg--btn addWishlist"
                                    data-weightid="{{ $product->weights->firstWhere('weight_id')->weight_id ?? '' }}"
                                    data-sizeid="{{ $product->sizes->firstWhere('size_id')->size_id ?? '' }}"
                                    data-variationid="{{ $product->productvariations->firstWhere('id')->id ?? '' }}"
                                    data-id="{{ $product->id }}" data-tooltip="tooltip" data-placement="top"
                                    title="@lang('frontend.Add to Wishlist')"><i class="fa-regular fa-heart"></i>

                                </button>
                            </div>
                        </div>
                        <div class="hr-border"></div>
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
                    <!--====== End - Product Right Side Details ======-->
                </div>
            </div>
        </div>
    </div>

    <!--====== Product Detail Tab ======-->
    <div class="u-s-p-y-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pd-tab">
                        <div class="u-s-m-b-30">
                            <ul class="nav pd-tab__list">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#pd-desc">@lang('frontend.DESCRIPTION') </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#pd-tag">@lang('frontend.TAGS')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#pd-qna">@lang('frontend.Q&A')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="view-review" data-toggle="tab"
                                        href="#pd-rev">@lang('frontend.REVIEWS')

                                        <span>
                                            @if (isset($reviews))
                                                {{ $reviews->count() }}
                                            @endif
                                        </span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <!--====== Tab 1 ======-->
                            <div class="tab-pane fade show active" id="pd-desc">
                                <div class="pd-tab__desc">
                                    <div class="u-s-m-b-15">
                                        <p>
                                            {!! $product->product_description !!}
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <!--====== End - Tab 1 ======-->

                            <!--====== Tab 2 ======-->
                            <div class="tab-pane" id="pd-tag">
                                <div class="pd-tab__tag">
                                    @php
                                        $keywords = explode(' ', $product->meta_keywords);
                                    @endphp
                                    @foreach ($keywords as $keyword)
                                        <span class="text-danger">{{ $keyword }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!--====== End - Tab 2 ======-->
                            <div class="tab-pane" id="pd-qna">
                                <div class="pd-tab__tag">

                                    <form name="form" id="qnaform" method="GET">
                                        <label for="">@lang('frontend.Ask any question here !')</label>
                                        <div class="form-group d-flex">
                                            <input type="text" class="form-control" name="question" id="question">
                                            <input type="hidden" class="form-control" value="{{ $product->id }}"
                                                name="product_id" id="product_id_qna">
                                            @if (Auth::id())
                                                <input type="hidden" name="user_id"
                                                    value="{{ auth()->user()->id ?? null }}" id="user_id_qna">
                                            @else
                                                <input type="hidden" name="user_id" id="user_id_qna">
                                            @endif
                                            <button type="button" class="btn btn-sm btn-primary" onclick="submitna()"
                                                style="margin-left: -10px;border-radius: 0px 4px 4px 0px;font-size:15px;padding: 14px 18px;">SUBMIT</button>
                                        </div>
                                    </form>
                                    <div class="qna mt-4" id="qnainfo">
                                    </div>
                                </div>
                            </div>

                            <!--====== Tab 3 ======-->
                            <div class="tab-pane" id="pd-rev">
                                <div class="pd-tab__rev">
                                    <div class="u-s-m-b-30">
                                        <div class="pd-tab__rev-score">
                                            <div class="u-s-m-b-8">
                                                <h2>
                                                    @if (count($reviews) > 0)
                                                        {{ $reviews->count() }}
                                                        @endif @lang('frontend.Review') - @if (count($reviews) > 0)
                                                            {{ $reviews->sum('ratings') / $reviews->count() }}
                                                        @endif (Overall)
                                                </h2>
                                            </div>
                                            <div class="gl-rating-style-2 u-s-m-b-8">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star-half-alt"></i>
                                            </div>
                                            <div class="u-s-m-b-8">
                                                <h4>@lang('frontend.We want to hear from you!')</h4>
                                            </div>

                                            <span class="gl-text">@lang('frontend.Tell us what you think about this item')</span>
                                        </div>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <form class="pd-tab__rev-f1">
                                            <div class="rev-f1__group">
                                                <div class="u-s-m-b-15">
                                                    <h2>
                                                        @if (isset($reviews))
                                                            {{ $reviews->count() }}
                                                        @endif @lang('frontend.Review(s) for Man Ruched Floral Applique')
                                                        Tee
                                                    </h2>
                                                </div>
                                                <div class="u-s-m-b-15">
                                                    <label for="sort-review"></label><select
                                                        class="select-box select-box--primary-style" id="sort-review">
                                                        <option selected>@lang('frontend.Sort by: Best Rating')</option>
                                                        <option>@lang('frontend.Sort by: Worst Rating')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="rev-f1__review">
                                                @if (isset($reviews))
                                                    @foreach ($reviews as $review)
                                                        <div class="review-o u-s-m-b-15">
                                                            <div class="review-o__info u-s-m-b-8">
                                                                <span
                                                                    class="review-o__name">{{ $review->user->name }}</span>

                                                                <span
                                                                    class="review-o__date">{{ date('d M Y H:i:s', strtotime($review->created_at)) }}</span>
                                                            </div>
                                                            <div class="review-o__rating gl-rating-style u-s-m-b-8">
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
                                                            </div>
                                                            <div class="image-forge">
                                                                @if (isset($review->image))
                                                                    @foreach (json_decode($review->image) ?? [] as $img)
                                                                        <img src="../../public/images/review/{{ $img }}"
                                                                            alt="" id="previewImage"
                                                                            style="border-radius: 10px;width: 80px;padding:5px;">
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <p class="review-o__text">
                                                                {{ $review->text }}
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 3 ======-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Product Detail Tab ======-->
    <div class="u-s-p-b-20 mt-4 pt-4">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-16">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap ps-0">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">
                                @lang('backend.RELATED PRODUCTS')
                            </h1>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="slider-fouc">
                    <div class="owl-carousel product-slider" data-item="4">
                        @foreach ($product->category->products->take(10) as $product)
                            <div class="u-s-m-b-30">
                                <div class="product-o arrival-card product-o--hover-on">
                                    <div class="product-o__wrap">
                                        <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                            href="{{ route('product.details', $product->slug) }}">
                                            <img class="aspect__img"
                                                src="{{ asset($product->productvariations->firstWhere('image')->image ?? '') }}"
                                                alt="" /></a>

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
                                                data-price="{{ $product->sizes->firstWhere('SalePrice')->SalePrice ?? $product->sizes->firstWhere('RegularPrice')->RegularPrice ?? 'No Price Available' }}"
                                                class="addToCart" data-tooltip="tooltip" data-placement="top"
                                                title="@lang('frontend.Add to Cart')"><i class="fa-solid fa-cart-plus"></i></a>
                                        </span>

                                        <span class="product-o__name">
                                            <a
                                                href="{{ route('product.details', $product->slug) }}">{{ $product->product_name }}</a>
                                        </span>
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
                                            <span
                                                class="product-o__price">{{ $currency->symbol }}{{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}
                                                @if ($product->sizes == null && $product->sizes->firstWhere('Discount')->Discount > 0)
                                                    <span
                                                        class="product-o__discount">{{ $currency->symbol }}{{ intval($product->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}</span>
                                                @endif
                                            </span>
                                        @else
                                            <span
                                                class="product-o__price">{{ intval($product->sizes->firstWhere('RegularPrice')->RegularPrice ?? '') }}{{ $currency->symbol }}
                                                @if ($product->sizes == null && $product->sizes->firstWhere('Discount')->Discount > 0)
                                                    <span
                                                        class="product-o__discount">{{ intval($product->sizes->firstWhere('SalePrice')->SalePrice ?? '') }}{{ $currency->symbol }}</span>
                                                @endif
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 1 ======-->
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">


    @include('frontend.components.modal.login-registration-form')

    <!--====== Login and Registration Form Modal ======-->
    @include('frontend.components.modal.quick-look')


@endsection
@push('frontend_script')
    {{-- csrf --}}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <script>
        var token = $("input[name='_token']").val();

        $(document).ready(function() {
            var product_id_qna = $('#productDetailsPage').data('productid')
            loadqna(product_id_qna);
            var varient = "<?php echo Session::get('varient_id'); ?>";
            if (varient) {
                loadexinfo(varient);
            } else {
                var varient = $('#varient_id').val();
                loadexinfo(varient);
            }
        });

        function submitna() {
            var user = $('#user_id_qna').val();
            var question = $('#question').val();
            var product_id = $('#product_id_qna').val();
            if (user != '') {
                $.ajax({
                    type: 'GET',
                    url: '{{ url('user/ask-question') }}',
                    data: {
                        user_id: user,
                        question: question,
                        product_id: product_id,
                    },

                    success: function(response) {
                        loadqna(product_id);
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            } else {
                toastr.error('Please login before ask a question.');
            }
        }

        function submitrena(id) {
            var user = $('#user_id_re' + id).val();
            var qa = $('#qna_id' + id).val();
            var question = $('#question_re' + id).val();
            var product_id = $('#product_id_re' + id).val();
            if (user != '') {
                $.ajax({
                    type: 'GET',
                    url: '{{ url('user/replay-question') }}',
                    data: {
                        user_id: user,
                        question: question,
                        product_id: product_id,
                        qa: qa,
                    },

                    success: function(response) {
                        loadqna(product_id);
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            } else {
                toastr.error('Please login before ask a question.');
            }
        }

        function loadqna(product_id) {


            $.ajax({
                type: 'GET',
                url: '{{ url('user/load-question') }}',
                data: {
                    product_id: product_id,
                },

                success: function(response) {
                    console.log(response);
                    $('#qnainfo').empty().append(response);
                },
                error: function(error) {
                    console.log('error');
                }
            });
        }
    </script>
@endpush
