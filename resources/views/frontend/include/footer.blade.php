@php

    $useful_link = App\Models\UsefulLink::get();

@endphp
<footer>
    <div class="outer-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="outer-footer__content u-s-m-b-40">
                        <span class="outer-footer__content-title">@lang('frontend.Contact Us')</span>
                        <div class="outer-footer__text-wrap">
                            <i class="fas fa-home"></i>

                            <span>{{ $basic_setting->address }}</span>
                        </div>
                        <div class="outer-footer__text-wrap">
                            <i class="fas fa-phone-volume"></i>

                            <span>{{ $basic_setting->phone }}</span>
                        </div>
                        <div class="outer-footer__text-wrap">
                            <i class="far fa-envelope"></i>

                            <span>{{ $basic_setting->email }}</span>
                        </div>
                        <div class="outer-footer__social">
                            <ul>
                                <li>
                                    <a class="s-fb--color-hover" href="{{ $basic_setting->facebook }}"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a class="s-tw--color-hover" href="{{ $basic_setting->twitter }}"><i
                                            class="fab fa-whatsapp"></i></a>
                                </li>
                                <li>
                                    <a class="s-youtube--color-hover" href="{{ $basic_setting->youtube }}"><i
                                            class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a class="s-insta--color-hover" href="{{ $basic_setting->linkedin }}"><i
                                            class="fab fa-tiktok"></i></a>
                                </li>
                                <!-- <li>
                                    <a class="s-gplus--color-hover" href="{{ $basic_setting->google }}"><i
                                            class="fab fa-google-plus-g"></i></a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="outer-footer__content u-s-m-b-40">
                                <div class="outer-footer__list-wrap">
                                    <span class="outer-footer__content-title">@lang('frontend.Quick Links')</span>
                                    <ul>
                                        <li>
                                            <a href="{{ route('index') }}">@lang('frontend.Home')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shop') }}">@lang('frontend.Shop') </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.cart.add.to.cart.page') }}">@lang('frontend.Cart') </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">@lang('frontend.Contact Us')</a>
                                        </li>
                                        @if (url('link/'))
                                            @foreach ($useful_link as $item)
                                                <li><a href="{{ url('link/' . $item->slug) }}">{{ @$item->title }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                        <li>
                                            <a href="{{ route('faq') }}">@lang('frontend.FAQ') </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="outer-footer__content">
                        <span class="outer-footer__content-title">@lang('frontend.Download App')</span>
                        <div class="download-app">
                            <a target="_blank" class="router-link-active router-link-exact-active"
                                href="{{ $basic_setting->app_store }}">
                                <img class="h-8 rounded-lg w-50"
                                    src="https://demo.shopking.dev/images/required/play-store.png" alt="app"></a>
                            <a target="_blank" class="router-link-active router-link-exact-active"
                                href="{{ $basic_setting->apple_store }}">
                                <img class="h-8 rounded-lg mt-3 w-50"
                                    src="https://demo.shopking.dev/images/required/app-store.png" alt="app"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lower-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="lower-footer__content">
                        <div class="lower-footer__copyright">
                            <span>@lang('frontend.Copyright') © {{ date('Y') }}</span>

                            <a href="{{ route('index') }}">{{ $basic_setting->site_name }}</a>

                            <span>@lang('frontend.All Right Reserved')</span>
                        </div>
                        <div class="lower-footer__payment">
                            <ul>
                                <li><i class="fab fa-cc-stripe"></i></li>

                                <li><i class="fab fa-cc-mastercard"></i></li>
                                <li><i class="fas fa-credit-card"></i></li>
                                <li><i class="fab fa-cc-visa"></i></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="nav-bottom-icon lower-footer__payment">
                    <ul>
                        <li>
                            <a href="{{ route('shop') }}"><i
                                    class="fa-solid fa-store"></i><span>@lang('frontend.Shop')</span></a>
                        </li>
                        <li>
                            <a href="{{ route('user.wishlist.page') }}"><i
                                    class="fa-solid fa-heart"></i></i><span>@lang('frontend.Wishlist')</span><span
                                    class="alert-number wishlist-icon">{{ wishlistCount() }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}"><i
                                    class="fa-solid fa-house"></i><span>@lang('frontend.Home')</span></a>
                        </li>
                        <li>
                            <a href="{{ route('user.cart.add.to.cart.page') }}"><i
                                    class="fa-solid fa-bag-shopping"></i><span>@lang('frontend.Cart')</span><span
                                    class="alert-number">{{ cartCount() }}</span></a>
                        </li>
                        <li>
                            {{-- @guest
                                <a href="{{ route('login') }}"><i
                                        class="fa-solid fa-user"></i><span>@lang('backend.Profile')</span></a>
                            @endguest --}}

                            {{-- @auth
                                 <a href="{{ route('user.profile') }}"><i
                                         class="fa-solid fa-user"></i><span>@lang('backend.Profile')</span></a>
                             @endauth --}}

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
