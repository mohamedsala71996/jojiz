 <!--====== Main Header ======-->
 <header class="header--style-1">
     <!--====== Nav 1 ======-->
     <nav class="primary-nav primary-nav-wrapper--border">
         <div class="container">
             <!--====== Primary Nav ======-->
             <div class="primary-nav">
                 <!--====== Main Logo ======-->

                 <a class="main-logo" href="{{ route('index') }}">
                     <img width="150"
                         src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                         alt="Logo" /></a>
                 <!--====== End - Main Logo ======-->

                 <!--====== Search Form ======-->
                 <form class="main-form" method="GET" action="{{ route('product.search') }}">
                     @csrf
                     <label for="main-search"></label>

                     <input class="input-text input-text--border-radius input-text--style-1" type="text"
                         id="main-search" placeholder="@lang('backend.Search')" name="product_search" />

                     <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                 </form>
                 <!--====== End - Search Form ======-->

                 <!--====== Dropdown Main plugin ======-->
                 <div class="menu-init" id="navigation">
                     <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cogs"
                         type="button"></button>

                     <!--====== Menu ======-->
                     <div class="ah-lg-mode">
                         <span class="ah-close">✕ Close</span>

                         <!--====== List ======-->
                         <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                             <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">
                                 <a><i class="far fa-user-circle"></i></a>

                                 <!--====== Dropdown ======-->

                                 <span class="js-menu-toggle"></span>
                                 <ul style="width: 120px">
                                     @auth
                                         <li>
                                             <a href="{{ route('user.dashboard') }}"><i
                                                     class="fas fa-user-circle u-s-m-r-6"></i>
                                                 <span>Account</span></a>
                                         </li>
                                     @endauth
                                     @guest
                                         <li>
                                             <a href="{{ route('register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                                                 <span>Signup</span></a>
                                         </li>
                                         <li>
                                             <a href="{{ route('login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                                                 <span>Signin</span></a>
                                         </li>
                                     @endguest

                                     @auth
                                         <li>
                                             <a type="button" href="{{ route('admin.logout') }}"
                                                 onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                                 <i class="fas fa-lock-open u-s-m-r-6"></i>
                                                 <span>Signout</span>
                                             </a>
                                             <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                                 class="d-none">
                                                 @csrf
                                             </form>
                                         </li>
                                     @endauth

                                 </ul>
                                 <!--====== End - Dropdown ======-->
                             </li>

                             <li data-tooltip="tooltip" data-placement="left" title="Contact">
                                 <a href="tel:+0900901904"><i class="fas fa-phone-volume"></i></a>
                             </li>
                             <li data-tooltip="tooltip" data-placement="left" title="Mail">
                                 <a href="mailto:contact@domain.com"><i class="far fa-envelope"></i></a>
                             </li>
                         </ul>
                         <!--====== End - List ======-->
                     </div>
                     <!--====== End - Menu ======-->
                 </div>
                 <!--====== End - Dropdown Main plugin ======-->
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
                     <button class="btn btn--icon toggle-mega-text toggle-button" type="button"> sss<svg
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                             <path
                                 d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z">
                             </path>
                         </svg>
                     </button>

                     <!--====== Menu ======-->
                     <div class="ah-lg-mode">
                         <span class="ah-close">✕ Close</span>

                         <!--====== List ======-->
                         <ul class="ah-list">
                             <li class="has-dropdown">
                                 <span class="mega-text"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                         <path
                                             d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                                     </svg></span>

                                 <!--====== Mega Menu ======-->
                                 <span class="js-menu-toggle"></span>
                                 <div class="mega-menu">
                                     <div class="mega-menu-wrap">
                                         <div class="mega-menu-list">
                                             <ul>
                                                 @foreach ($categories as $category)
                                                     <li>
                                                         <a href="{{ route('category.product', $category->id) }}">
                                                             <span>{{ $category->category_name }}</span>
                                                         </a>
                                                         <span class="js-menu-toggle"></span>
                                                     </li>
                                                 @endforeach
                                             </ul>
                                         </div>

                                         <!--====== Electronics ======-->


                                         <div class="mega-menu-content js-active">
                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">3D PRINTER & SUPPLIES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">3d Printer</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">3d Printing Pen</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">3d Printing Accessories</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">3d Printer Module Board</a>
                                                         </li>
                                                     </ul>
                                                 </div>

                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />



                                             <!--====== End - Electronics ======-->

                                             {{-- <!--====== Women ======-->
                                         <div class="mega-menu-content">
                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-6 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-1.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-6 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-2.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />

                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">HOT CATEGORIES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Dresses</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Blouses & Shirts</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">T-shirts</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Rompers</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">INTIMATES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Bras</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Brief Sets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Bustiers & Corsets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Panties</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">WEDDING & EVENTS</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Wedding Dresses</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Evening Dresses</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Prom Dresses</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Flower Dresses</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">BOTTOMS</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Skirts</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Shorts</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Leggings</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Jeans</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />

                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">OUTWEAR</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Blazers</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Basics Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Trench</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Leather & Suede</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">JACKETS</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Denim Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Trucker Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Windbreaker Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Leather Jackets</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">ACCESSORIES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Tech Accessories</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Headwear</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Baseball Caps</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Belts</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">OTHER ACCESSORIES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Bags</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Wallets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Watches</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Sunglasses</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />

                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-9 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-3.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-3 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-4.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                         </div>
                                         <!--====== End - Women ======-->

                                         <!--====== Men ======-->
                                         <div class="mega-menu-content">
                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-4 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-5.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-4 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-6.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-4 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-7.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />

                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">HOT SALE</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">T-Shirts</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Baby Toys</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Polo</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Shirts</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">OUTWEAR</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Hoodies</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Trench</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Parkas</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Sweaters</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">BOTTOMS</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Casual Pants</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Cargo Pants</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Jeans</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Shorts</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">UNDERWEAR</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Boxers</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Briefs</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Robes</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Socks</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />

                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">JACKETS</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Denim Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Trucker Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Windbreaker Jackets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Leather Jackets</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">SUNGLASSES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Pilot</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Wayfarer</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Square</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Round</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">ACCESSORIES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Eyewear Frames</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Scarves</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Hats</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Belts</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-lg-3">
                                                     <ul>
                                                         <li class="mega-list-title">
                                                             <a href="shop.html">OTHER ACCESSORIES</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Bags</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Wallets</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Watches</a>
                                                         </li>
                                                         <li>
                                                             <a href="shop.html">Tech Accessories</a>
                                                         </li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                             <br />

                                             <!--====== Mega Menu Row ======-->
                                             <div class="row">
                                                 <div class="col-lg-6 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-8.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-6 mega-image">
                                                     <div class="mega-banner">
                                                         <a class="u-d-block" href="shop.html">
                                                             <img class="u-img-fluid u-d-block"
                                                                 src="{{ asset('frontend/images') }}/banners/banner-mega-9.jpg"
                                                                 alt="" /></a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!--====== End - Mega Menu Row ======-->
                                         </div>
                                         <!--====== End - Men ======-->

                                         <!--====== No Sub Categories ======-->
                                         <div class="mega-menu-content">
                                             <h5>No Categories</h5>
                                         </div>
                                         <!--====== End - No Sub Categories ======--> --}}

                                         </div>
                                     </div>
                                     <!--====== End - Mega Menu ======-->
                             </li>
                         </ul>
                         <!--====== End - List ======-->
                     </div>
                     <!--====== End - Menu ======-->
                 </div>
                 <!--====== End - Category Menu ======-->

                 <!--====== Main Manu ======-->
                 <div class="menu-init" id="navigation2">
                     <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-solid fa-bars"
                         type="button"></button>

                     <!--====== Menu ======-->
                     <div class="ah-lg-mode">
                         <span class="ah-close">✕ Close</span>

                         <!--====== List ======-->
                         <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                             <li>
                                 <a href="{{ route('index') }}">HOME</a>
                             </li>
                             <li>
                                 <a href="{{ route('shop') }}">SHOP</a>
                             </li>
                             <li>
                                 <a href="offers.html">OFFERS</a>
                             </li>
                             <li>
                                 <a href="{{ route('contact') }}">CONTACT</a>
                             </li>

                         </ul>
                         <!--====== End - List ======-->
                     </div>
                     <!--====== End - Menu ======-->
                 </div>
                 <!--====== End - Main Menu ======-->

                 <!--====== Shopping Menu ======-->
                 <div class="menu-init" id="navigation3">
                     <button
                         class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop"
                         type="button">
                     </button>

                     <span class="total-item-round">2</span>

                     <!--====== Menu ======-->
                     <div class="ah-lg-mode">
                         <span class="ah-close">✕ Close</span>

                         <!--====== List ======-->
                         <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                             <li>
                                 <a href="{{ route('index') }}"><i class="fas fa-home u-c-brand"></i></a>
                             </li>
                             <li>
                                 <a href="{{ route('user.wishlist.page') }}">
                                     <i class="far fa-heart"></i>
                                     @auth
                                         @if (Wishlist::count(auth()->user()->id) > 0)
                                             <span
                                                 class="total-item-round">{{ Wishlist::count(auth()->user()->id) }}</span>
                                         @endif
                                     @endauth

                                 </a>
                             </li>
                             <li class="has-dropdown">
                                 <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>
                                     @php
                                         $carts = App\Models\Cart::where('user_id', Auth::id())->get();
                                     @endphp
                                     @if (!empty($carts->count()))
                                         <span class="total-item-round">{{ $carts->count() }}</span>
                                     @endif
                                 </a>

                                 <!--====== Dropdown ======-->

                                 <span class="js-menu-toggle"></span>
                                 <div class="mini-cart">
                                     <!--====== Mini Product Container ======-->
                                     <div class="mini-product-container gl-scroll u-s-m-b-15">
                                         <!--====== Card for mini cart ======-->

                                         @foreach ($carts as $item)
                                             <div class="card-mini-product">
                                                 <div class="mini-product">
                                                     <div class="mini-product__image-wrapper">
                                                         <a class="mini-product__link"
                                                             href="{{ route('product.details', $item->product->id) }}">
                                                             <img class="u-img-fluid"
                                                                 src="{{ asset($item->productvariation->image) }}"
                                                                 alt="" /></a>
                                                     </div>
                                                     <div class="mini-product__info-wrapper">
                                                         <span class="mini-product__category">


                                                             <span class="mini-product__name">
                                                                 <a
                                                                     href="{{ route('product.details', $item->product->id) }}">{{ $item->product->product_name }}</a></span>

                                                             <span
                                                                 class="mini-product__quantity">{{ $item->quantity }}x</span>

                                                             <span
                                                                 class="mini-product__price">${{ $item->productvariation->price }}</span>
                                                     </div>
                                                 </div>

                                                 <a class="mini-product__delete-link far fa-trash-alt"
                                                     href="{{ route('user.cart.remove.cart.item', $item->id) }}"></a>
                                             </div>
                                         @endforeach

                                         <!--====== End - Card for mini cart ======-->

                                         <!--====== End - Card for mini cart ======-->
                                     </div>
                                     <!--====== End - Mini Product Container ======-->

                                     <!--====== Mini Product Statistics ======-->
                                     <div class="mini-product-stat">

                                         <div class="mini-action">
                                             <a class="mini-link btn--e-brand-b-2"
                                                 href="{{ route('user.checkout.page') }}">PROCEED TO
                                                 CHECKOUT</a>

                                             <a class="mini-link btn--e-transparent-secondary-b-2"
                                                 href="{{ route('user.cart.add.to.cart.page') }}">VIEW CART</a>
                                         </div>
                                     </div>
                                     <!--====== End - Mini Product Statistics ======-->
                                 </div>
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
 </header>
 <!--====== End - Main Header ======-->
