<!-- <header class="top-nav text-white">
    <div class="container-fluid py-2"> -->

        <!-- <div class="d-flex justify-content-center align-items-center">
            <span class="badge text-special bg-light text-dark">@lang('backend.Special')</span>
            <div class="top-text"> -->

                <!-- <section class="animation">
                    @foreach ($coupons as $coupon)
                        <div class="">
                            <div><span class="discount">
                                    @if ($coupon->coupon_type == 'global')
                                        @lang('backend.All Product')
                                    @else
                                        <span>{{ $coupon->categories->pluck('category_name')->join(', ') }}</span>
                                    @endif
                                    @lang('backend.Get') {{ $coupon->amount }} @if ($coupon->type == 'Percent')
                                        % &nbsp;
                                    @else
                                        {{ $currency->code }}
                                    @endif
                                    @lang('backend.DISCOUNT for this coupon') &nbsp;
                                </span>{{ $coupon->code }}</div>
                        </div>
                    @endforeach


                </section> -->



            <!-- </div>
        </div> -->
    <!-- </div>

</header> -->

<div class="container">
    <div class="header-logo">
        <div class="logo-part d-flex align-items-center">
            <a href="{{ route('index') }}">
                <img src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                    alt="Logo" class="logo me-2" width="85"></a>

        </div>
        <!-- <div class=" d-flex align-items-center">
            <div id="number-main">
                <div class="number-part">
                    <div class="number-icon">
                        <a href="https://wa.me/{{ $basic_setting->phone }}" target="_blank"><i
                                class="fa-solid fa-phone"></i></a>
                    </div>
                    <div class="number-text">
                        <p class="mb-0 small text-muted text-uppercase">@lang('backend.Hotline 24/7')</p>
                        <a href="https://wa.me/{{ $basic_setting->phone }}"
                            class="text-decoration-none ">{{ $basic_setting->phone }}</a>
                    </div>

                </div>
            </div> -->

            <div class="account-part">

                <div class="love-icon">
                    <a href="{{ route('user.wishlist.page') }}" class=" d-flex">
                        <i class="fa-regular fa-heart"></i> &nbsp; <span class="d-lg-none d-block"
                            style="line-height: 14px;">@lang('frontend.Wishlist')</span>
                        @auth
                            @if (count(App\Models\Wishlist::where('user_id', auth()->user()->id)->get()) > 0)
                                <span class="total-item-round"
                                    id="wishlistcount">{{ count(App\Models\Wishlist::where('user_id', auth()->user()->id)->get()) }}</span>
                            @else
                                <div id="wlist"></div>
                            @endif

                        @endauth
                    </a>
                </div>


                <div class="cart-part cartHover d-lg-flex text-end has-dropdown" id="cartinfo">
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

                    <div class="cart-text">
                        <p class="mb-0 text-muted">@lang('frontend.Cart')</p>
                        @if ($currency->symbol_position == 'left')
                            <a href="{{ route('user.cart.add.to.cart.page') }}"
                                class="text-decoration-none  ">{{ $currency->symbol }}{{ number_format($totalAmount, 2) }}</a>
                        @else
                            <a href="{{ route('user.cart.add.to.cart.page') }}"
                                class="text-decoration-none">{{ number_format($totalAmount, 2) }}{{ $currency->symbol }}</a>
                        @endif
                    </div>
                    @php
                        $carts = App\Models\Cart::where('user_id', Auth::id())->latest('id')->get();
                    @endphp
                    @if (!empty($carts) && count($carts) > 0)
                        <span class="js-menu-toggle"></span>
                        <div class="mini-cart">
                            <!--====== Mini Product Container ======-->
                            <div class="mini-product-container gl-scroll u-s-m-b-15">

                                @foreach ($carts as $item)
                                    <div class="card-mini-product">
                                        <div class="mini-product">
                                            <div class="mini-product__image-wrapper">
                                                @if (isset($item->product))
                                                    <a class="mini-product__link"
                                                        href="{{ route('product.details', $item->product->slug) }}">
                                                        <img class="u-img-fluid"
                                                            src="{{ asset($item->productvariation->image) }}"
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
                                    <a class="mini-link btn--e-brand-b-2"
                                        href="{{ route('user.checkout.page') }}">@lang('frontend.PROCEED TO CHECKOUT')
                                    </a>

                                    <a class="mini-link btn--e-transparent-secondary-b-2"
                                        href="{{ route('user.cart.add.to.cart.page') }}">@lang('frontend.VIEW CART')</a>
                                </div>
                            </div>
                            <!--====== End - Mini Product Statistics ======-->
                        </div>
                    @endif

                </div>
                <div class="account-part accountHover has-dropdown">
                    <div class="account-icon">
                        @auth
                            <a href="{{ route('user.dashboard') }}"><img src="{{ asset(auth()->user()->image) }}"
                                    alt=""></a>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}"><i class="fa-regular fa-user"></i></a>
                        @endguest
                    </div>

                    <div class="account-text">
                        @guest
                            <a href="{{ route('login') }}">
                                <p class="mb-0 text-muted">@lang('backend.Welcome')</p>
                            </a>
                        @endguest
                        @auth
                            <a href="{{ route('user.dashboard') }}">
                                <p class="mb-0 text-muted">@lang('backend.My Account')</p>
                            </a>
                        @endauth
                        <div class="account-text2">
                            @auth
                                <a href="{{ route('user.dashboard') }}">

                                    <span>@lang('backend.Hi'), {{ auth()->user()->name }}</span>
                                </a>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}"><span>@lang('backend.Login')</span>/</a>
                                <a href="{{ route('register') }}"><span>@lang('backend.Register')</span></a>
                            @endguest

                        </div>
                    </div>
                    {{-- This is for hover start --}}
                    @auth
                        <ul style="width: 130px" class="accountHoverShow">

                            <li>
                                <a href="{{ route('user.dashboard') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>

                                    <span>@lang('frontend.Account')</span>
                                </a>
                            </li>

                            <li>
                                <a type="button" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                    <i class="fas fa-lock-open u-s-m-r-6"></i>
                                    <span>@lang('frontend.Signout')</span>
                                </a>
                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth


                    </ul>
                    {{-- This is for hover end --}}
                </div>



            </div>

        </div>
    </div>
</div>
<div class="header-main sticky-header" id="header">

    <nav class="navbar navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <form class="d-flex" method="GET" action="{{ route('product.search') }}">
                @csrf
                <div class="menu-init" id="navigation1">
                    <button class="btn btn--icon toggle-mega-text toggle-button " type="button">
                        <i class="fa-solid fa-list"></i>

                    </button>



                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕</span>

                        <!--====== List ======-->
                        <ul class="ah-list custom-has-nav">
                            <li class="has-dropdown">
                                <span class="mega-text d-none d-lg-block">
                                    @lang('frontend.Category')<i class="fa-solid fa-chevron-down"></i></span>
                                <!--====== Mega Menu ======-->
                                <span class="js-menu-toggle js-toggle-mark"></span>
                                <div class="mega-menu container" style="display: block;">
                                    <div class="mega-menu-wrap">
                                        <div class="mega-menu-list">
                                            <ul>
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <img class="header-category-image"
                                                            src="{{ asset($category->image) }}"
                                                            alt="Category Image" />

                                                        <a href="{{ route('category.product', $category->slug) }}">
                                                            <span>{{ $category->category_name }}</span>
                                                        </a>
                                                        <span class="js-menu-toggle"></span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!--====== Electronics ======-->
                                        @foreach ($categories as $category)
                                            <div class="mega-menu-content">
                                                <!--====== Mega Menu Row ======-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-">
                                                                <ul>
                                                                    @forelse(App\Models\Admin\SubCategory::where('category_id',$category->id)->get() as $sub)
                                                                        <li class="mega-list-title">
                                                                            <img class="header-category-image"
                                                                                src="{{ asset($sub->image) }}"
                                                                                alt="SubCategory Image" />
                                                                            <a
                                                                                href="{{ url('subcategory', $sub->slug) }}">{{ $sub->name }}</a>
                                                                        </li>
                                                                    @empty

                                                                        @lang('backend.Not Found!')
                                                                    @endforelse
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <!--====== End - Mega Menu ======-->
                            </li>
                        </ul>
                        <div class="mobile-nav-category u-s-m-b-15">
                            <div class="shop-w shop-w--style">
                                <div class="shop-w__intro-wrap">
                                    <h1 class="shop-w__h" style="padding: 14px 14px;">@lang('frontend.CATEGORY')</h1>

                                    <span class="fas fa-minus shop-w__toggle" data-target="#s-category"
                                        data-toggle="collapse" aria-hidden="true"></span>
                                </div>
                                <div class="shop-w__wrap collapse show" id="s-category">
                                    <ul class="shop-w__category-list gl-scroll">
                                        @foreach ($categories as $category)
                                            <li>
                                                <img style="border-radius: 5px" width="20px"
                                                    src="{{ asset($category->image) }}" alt="">
                                                <a href="#" class="shop collapse show" data-toggle="collapse"
                                                    onclick="changeico('10')"
                                                    data-target="#id{{ $category->id }}"><span>{{ $category->category_name }}
                                                    </span>
                                                    <span style="float: right;padding-top: 3.4px;">
                                                        <input type="hidden" id="changeico10" value="plus">
                                                        <i class="fas fa-plus" aria-hidden="true" id="plusicon10"
                                                            style="    color: gray;font-size: 12px;"></i>
                                                        <i class="fas fa-minus minusicon" aria-hidden="true"
                                                            id="minusicon10"
                                                            style="    color: gray;font-size: 12px;"></i>
                                                    </span>
                                                </a>
                                                <ul class="shop collapse" id="id{{ $category->id }}">
                                                    @foreach ($category->subcategoris as $subcategory)
                                                        <li style="padding-left: 15px; padding-top:15px;">
                                                            <img width="20px" style="border-radius: 5px"
                                                                src="{{ asset($subcategory->image) }}"
                                                                alt="">
                                                            <a
                                                                href="{{ url('subcategory', $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--====== End - List ======-->
                    </div>

                    <!--====== End - Menu ======-->
                </div>
                <div class="search-box d-flex">

                    <input class="search-input" type="search" id="main-search" name="product_search"
                        placeholder="@lang('frontend.Search')">
                    <button class=" search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

                </div>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="logo-part d-flex align-items-center" id="logo-main">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                        alt="Logo" class="logo me-2" width="85"></a>

            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">@lang('frontend.Home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">@lang('frontend.Shop')</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.track.order') }}"><i
                                    class="fa-solid fa-bag-shopping"></i>
                                @lang('backend.Track Order')</a>
                        </li>
                    @endauth

                </ul>
            </div>
            <div class="dropdown">
                <button class=" language-btn2 dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (session('locale') === 'fr')
                        <img src="{{ asset('public/frontend/images/language/france.jpeg') }}" alt="Arabic" />
                        Ar
                    @elseif (session('locale') === 'en')
                        <img src="{{ asset('public/frontend/images/language/english.png') }}" alt="english" />
                        Eng
                
                    @else
                        Language
                    @endif
                </button>

                <div class=" dropdown-menu dropdown-menu2" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item dropdown-item2" href="{{ route('locale', 'fr') }}">
                        <img src="{{ asset('public/frontend/images/language/france.jpeg') }}" alt="france" />
                        Arabic</a>
                    <a class="dropdown-item dropdown-item2" href="{{ route('locale', 'en') }}">
                        <img src="{{ asset('public/frontend/images/language/english.png') }}" alt="english" />
                        English</a>
                  
                </div>
            </div>
        </div>
    </nav>


   
    <div class="cart-container2 cartHover2 d-lg-flex text-end has-dropdown2 stky_cartinfo">
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
                                            <img class="u-img-fluid"
                                                src="{{ asset($item->productvariation->image) }}"
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
                        <a class="mini-link btn--e-brand-b-2"
                            href="{{ route('user.checkout.page') }}">@lang('frontend.PROCEED TO CHECKOUT')
                        </a>

                        <a class="mini-link btn--e-transparent-secondary-b-2"
                            href="{{ route('user.cart.add.to.cart.page') }}">@lang('frontend.VIEW CART')</a>
                    </div>
                </div>
                <!--====== End - Mini Product Statistics ======-->
            </div>
        @endif

    </div>
</div>

<script>
    // Add a single scroll event listener to the window
    window.onscroll = function() {
        const logo = document.getElementById("logo-main");
        const icon = document.querySelector(".cart-container2");

        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            if (logo) {
                logo.style.opacity = "1";
                logo.style.marginLeft = "12%";
            }
            if (icon) {
                icon.style.opacity = "1";
                icon.style.transition = "all linear .3s";
            }
        } else {
            if (logo) {
                logo.style.opacity = "0";
            }
            if (icon) {
                icon.style.opacity = "0";
            }
        }
    };
</script>
