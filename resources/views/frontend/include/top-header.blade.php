 <div class="nav-top-main primary-nav-wrapper--border">
     <div class="nav-top container">
         <div class="nav-place outer-footer__text-wrap">
             <i class="fa-solid fa-location-dot" aria-hidden="true"></i>

             <span>Gulshan-1, Dhaka</span>
         </div>
         <div class="nav-phone outer-footer__text-wrap">
             <i class="fas fa-phone-volume" aria-hidden="true"></i>

             <span>01512345678</span>
         </div>
         <div class="nav-email outer-footer__text-wrap">
             <i class="far fa-envelope" aria-hidden="true"></i>

             <span>contact@arcadexit.com</span>
         </div>
         <div class="nav-account outer-footer__social">
             <button>Sign In</button>
             <button class="nav-profile">My Account</button>
             <ul>
                 <li>
                     <a class="s-fb--color-hover" href="https://facebook.com"><i class="fab fa-facebook-f"
                             aria-hidden="true"></i></a>
                 </li>
                 <li>
                     <a class="s-tw--color-hover" href="https://www.twitter.com"><i class="fab fa-twitter"
                             aria-hidden="true"></i></a>
                 </li>
                 <li>
                     <a class="s-youtube--color-hover" href="https://www.youtube.com"><i class="fab fa-youtube"
                             aria-hidden="true"></i></a>
                 </li>
                 <li>
                     <a class="s-insta--color-hover" href="https://www.linkedin.com"><i class="fab fa-linkedin-in"
                             aria-hidden="true"></i></a>
                 </li>
                 <li>
                     <a class="s-gplus--color-hover" href="https://www.google.com"><i class="fab fa-google-plus-g"
                             aria-hidden="true"></i></a>
                 </li>
             </ul>
         </div>
         <ul style="width: 120px">
             @auth
                 <li>
                     <a href="{{ route('user.dashboard') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>

                         <span>@lang('frontend.Account')</span>
                     </a>
                 </li>
             @endauth
             @guest
                 <li>
                     <a href="{{ route('register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                         <span>@lang('frontend.Signup')</span></a>
                 </li>
                 <li>
                     <a href="{{ route('login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                         <span>@lang('frontend.Signin')</span></a>
                 </li>
             @endguest

             @auth
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
     </div>
 </div>

 <!--====== Dropdown Main plugin ======-->
 <div class="menu-init" id="navigation">
     <button onclick="showinfo()" class="btn btn--icon fas fa-bars" type="button" style="font-size: 18px;"></button>
     <!--====== Menu ======-->
     <div class="ah-lg-mode">
         <span class="ah-close">✕ Close</span>

         <!--====== List ======-->
         <ul class="ah-list ah-list--design1  ah-list--link-color-secondary">
             <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">
                 <a><i class="far fa-user-circle"></i></a>

                 <!--====== Dropdown ======-->

                 <span class="js-menu-toggle"></span>
                 <ul style="width: 120px">
                     @auth
                         <li>
                             <a href="{{ route('user.dashboard') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>

                                 <span>@lang('frontend.Account')</span>
                             </a>
                         </li>
                     @endauth
                     @guest
                         <li>
                             <a href="{{ route('register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                                 <span>@lang('frontend.Signup')</span></a>
                         </li>
                         <li>
                             <a href="{{ route('login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                                 <span>@lang('frontend.Signin')</span></a>
                         </li>
                     @endguest

                     @auth
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
                 <!--====== End - Dropdown ======-->
             </li>

             <li data-tooltip="tooltip" data-placement="left" title="Contact">
                 <a href="tel:+88{{ $basic_setting->phone }}"><i class="fas fa-phone-volume"></i></a>
             </li>
             <li data-tooltip="tooltip" data-placement="left" title="Mail">
                 <a href="mailto:{{ $basic_setting->email }}"><i class="far fa-envelope"></i></a>
             </li>
         </ul>
         <!--====== End - List ======-->
     </div>
     <!--====== End - Menu ======-->
 </div>
 <!--====== End - Dropdown Main plugin ======-->


 <!--====== Main Header ======-->
 <header class="header--style-1">
     <!--====== Nav 1 ======-->
     <nav class=" primary-nav-wrapper--border d-none d-lg-block">
         <div class="container">
             <!--====== Primary Nav ======-->
             <div class="primary-nav">
                 <!--====== Main Logo ======-->

                 <a class="main-logo d-none d-lg-block logo-container" href="{{ route('index') }}">
                     <img style=""
                         src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                         alt="Logo" /></a>
                 <!--====== End - Main Logo ======-->

                 <!--====== Search Form ======-->
                 <form class="main-form" method="GET" action="{{ route('product.search') }}">
                     @csrf
                     <input class="input-text input-text--border-radius input-text--style-1" type="text"
                         id="main-search" name="product_search" placeholder="@lang('frontend.Search')" />

                     <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                 </form>
                 <!--====== End - Search Form ======-->
                 <div class="dropdown">
                     <button class="btn btn-secondary language-btn dropdown-toggle" type="button"
                         id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         @if (session('locale') === 'fr')
                             <img src="{{ asset('public/frontend/images/language/france.png') }}" alt="france" />
                             France
                         @elseif (session('locale') === 'en')
                             <img src="{{ asset('public/frontend/images/language/english.png') }}" alt="english" />
                             English
                         @elseif (session('locale') === 'bn')
                             <img src="{{ asset('public/frontend/images/language/bangla.png') }}" alt="bangla" />
                             Bangla
                         @else
                             Language
                         @endif
                     </button>

                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                         <a class="dropdown-item" href="{{ route('locale', 'fr') }}">
                             <img src="{{ asset('public/frontend/images/language/france.png') }}" alt="france" />
                             France</a>
                         <a class="dropdown-item" href="{{ route('locale', 'en') }}">
                             <img src="{{ asset('public/frontend/images/language/english.png') }}" alt="english" />
                             English</a>
                         <a class="dropdown-item" href="{{ route('locale', 'bn') }}">
                             <img src="{{ asset('public/frontend/images/language/bangla.png') }}" alt="bangla" />
                             Bangla</a>
                     </div>
                 </div>

             </div>
             <!--====== End - Primary Nav ======-->
         </div>
     </nav>
     <!--====== End - Nav 1 ======-->

     <!--====== Nav 2 ======-->
     <nav class="secondary-nav-wrapper">
         <div class="container">
             <!--====== Secondary Nav ======-->
             <div class="secondary-nav">
                 <!--====== Category Menu ======-->
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
                                 <span class="mega-text d-none d-lg-block"><i class="fa-solid fa-list"></i>
                                     @lang('frontend.Category')</span>

                                 <p class="" style="font-weight: bold;color: black;padding-left: 20px;">
                                     @lang('frontend.Categories') </p>
                                 <!--====== Mega Menu ======-->
                                 <span class="js-menu-toggle js-toggle-mark"></span>
                                 <div class="mega-menu" style="display: block;">
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

                                                                         Nothing found
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
                                                         <li style="padding-left: 15px">
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
                 <!--====== End - Category Menu ======-->


                 <!--====== Main Manu ======-->
                 <div class="menu-init" id="navigation2">
                     <a class="main-logo d-lg-none d-block" href="{{ route('index') }}">
                         <img src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                             alt="Logo" /></a>

                     <!--====== Menu ======-->
                     <div class="ah-lg-mode">
                         <span class="ah-close">✕</span>

                         <!--====== List ======-->
                         <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                             <li>
                                 <a href="{{ route('index') }}">@lang('frontend.HOME')</a>
                             </li>
                             <li>
                                 <a href="{{ route('shop') }}">@lang('frontend.SHOP')</a>
                             </li>

                         </ul>
                         <!--====== End - List ======-->
                     </div>
                     <!--====== End - Menu ======-->
                 </div>
                 <!--====== End - Main Menu ======-->

                 <!--====== Shopping Menu ======-->
                 <div class="menu-init" id="navigation3">
                     <button id="cartsm"
                         class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop"
                         type="button">
                     </button>

                     <span class="total-item-round">2</span>

                     <!--====== Menu ======-->
                     <div class="ah-lg-mode">
                         <span class="ah-close">✕</span>

                         <!--====== List ======-->
                         <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                             <li>
                                 <a href="{{ route('index') }}" class=" d-flex"><i
                                         class="fas fa-home u-c-brand"></i> &nbsp; <span class="d-lg-none d-block"
                                         style="line-height: 14px;">@lang('frontend.Home')</span> </a>
                             </li>
                             <li>
                                 <a href="{{ route('user.wishlist.page') }}" class=" d-flex">
                                     <i class="far fa-heart"></i> &nbsp; <span class="d-lg-none d-block"
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
                             </li>
                             @php
                                 $carts = App\Models\Cart::where('user_id', Auth::id())->latest('id')->get();
                             @endphp

                             <li class="has-dropdown" id="cartinfo">
                                 <a class="mini-cart-shop-link d-flex"><i class="fas fa-shopping-bag"></i> &nbsp;
                                     <span class="d-lg-none d-block" style="line-height: 14px;">View Cart</span>
                                     @php
                                         $carts = App\Models\Cart::where('user_id', Auth::id())->latest('id')->get();
                                     @endphp
                                     @if (!empty($carts->count()))
                                         <span class="total-item-round">{{ $carts->count() }}</span>
                                     @endif
                                 </a>
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
                                                             <span class="mini-product__category"
                                                                 style="margin-top: -5px;">


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
                                                                 <span
                                                                     class="mini-product__quantity">{{ $item->qty }}x</span>

                                                                 <span
                                                                     class="mini-product__price">{{ $currency->symbol }}{{ intval($item->price) }}</span>
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
                                 <!--====== End - Dropdown ======-->
                             </li>

                         </ul>
                         <!--====== End - List ======-->
                     </div>
                     <!--====== End - Menu ======-->
                 </div>
                 <!--====== End - Shopping Menu ======-->
             </div>
             <!--====== End - Secondary Nav ======-->
         </div>
     </nav>
     <!--====== End - Nav 2 ======-->
     <nav class="primary-nav primary-nav-wrapper--border d-lg-none d-block">
         <div class="container">
             <!--====== Primary Nav ======-->
             <div class="primary-nav">
                 <form class="main-form" method="GET" action="{{ route('product.search') }}">
                     @csrf

                     <input class="input-text input-text--border-radius input-text--style-1" name="product_search"
                         type="text" id="main-search" placeholder="@lang('backend.Search')" />

                     <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                 </form>
                 <div class="dropdown">
                     <button class="btn btn-secondary language-btn dropdown-toggle" type="button"
                         id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         @if (session('locale') === 'fr')
                             <img src="{{ asset('public/frontend/images/language/france.png') }}" alt="france" />
                             France
                         @elseif (session('locale') === 'en')
                             <img src="{{ asset('public/frontend/images/language/english.png') }}" alt="english" />
                             English
                         @elseif (session('locale') === 'bn')
                             <img src="{{ asset('public/frontend/images/language/bangla.png') }}" alt="bangla" />
                             Bangla
                         @else
                             Language
                         @endif
                     </button>

                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                         <a class="dropdown-item" href="{{ route('locale', 'fr') }}">
                             <img src="{{ asset('public/frontend/images/language/france.png') }}" alt="france" />
                             France</a>
                         <a class="dropdown-item" href="{{ route('locale', 'en') }}">
                             <img src="{{ asset('public/frontend/images/language/english.png') }}" alt="english" />
                             English</a>
                         <a class="dropdown-item" href="{{ route('locale', 'bn') }}">
                             <img src="{{ asset('public/frontend/images/language/bangla.png') }}" alt="bangla" />
                             Bangla</a>
                     </div>
                 </div>
                 <div class="menu-init home-bar d-lg-none d-block" id="navigation2" style="margin-top: -4px;">
                     <button style="font-size: 18px;" onclick="showinfo()"
                         class="btn btn--icon toggle-button toggle-button--secondary fas fa-solid fa-bars"
                         type="button"></button>
                 </div>
                 <!--====== End - Dropdown Main plugin ======-->
             </div>
             <!--====== End - Primary Nav ======-->
         </div>
     </nav>
 </header>
 <!--====== End - Main Header ======-->

 <!-- side bar panel start -->
 <div id="mySidepanelinfo" class="sidepanelinfo">
     <div class="side-menu-header ">
         <div class="side-menu-close" onclick="closeinfo()">
             <i class="fas fa-close" style="float: right;padding: 14px;padding-right: 22px;color: red;"></i>
         </div>
         <div class="side-login px-3 pb-3" style="padding-top: 12px;padding-bottom: 15px; padding-left: 10px;">
             <a href=""></a>
             <a href="#">@lang('frontend.INFORMATION')</a>
         </div>
     </div>
     <div class="shop-w-master__sidebar">
         <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
             <li>
                 <a href="{{ route('index') }}">@lang('frontend.HOME')</a>
             </li>
             <li>
                 <a href="{{ route('shop') }}">@lang('frontend.SHOP')</a>
             </li>


         </ul>
     </div>
 </div>
 <!-- side bar panel end -->

 <script>
     function showinfo() {
         document.getElementById("mySidepanelinfo").style.width = "280px";
     }

     function closeinfo() {
         document.getElementById("mySidepanelinfo").style.width = "0";
     }
     $(document).ready(function() {
         $(".mega-menu-content:last-child").addClass("mega-menu-content js-active");
     });
 </script>
