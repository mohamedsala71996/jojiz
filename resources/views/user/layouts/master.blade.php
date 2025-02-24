<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('public/backend/images/general-setting') }}/{{ $basic_setting->site_favicon }}"
        rel="shortcut icon" />
    <title>{{ $basic_setting->site_name }} | {{ $basic_setting->site_title }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @include('frontend.include.headerlink')
    @stack('user_style')
</head>

<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">
            <img class="preloader__img" src="{{ asset('public/frontend/images') }}/preloader.png" alt="" />
        </div>
    </div>

    <!--====== Main App ======-->
    <div id="app">
        @include('frontend.include.top-header')

        <!--====== App Content ======-->
        <div class="app-content">

            @yield('frontend_content')

            @include('frontend.include.footer')
            <!--====== Modal Section ======-->

            <!--====== Quick Look Modal ======-->
            {{-- <div class="modal fade" id="quick-look">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal--shadow">
                        <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <!--====== Product Breadcrumb ======-->
                                    <div class="pd-breadcrumb u-s-m-b-30">
                                        <ul class="pd-breadcrumb__list">
                                            <li class="has-separator">
                                                <a href="index.hml">Home</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop.html">Electronics</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop.html">DSLR Cameras</a>
                                            </li>
                                            <li class="is-marked">
                                                <a href="shop.html">Nikon Cameras</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--====== End - Product Breadcrumb ======-->

                                    <!--====== Product Detail ======-->
                                    <div class="pd u-s-m-b-30">
                                        <div class="pd-wrap">
                                            <div id="js-product-detail-modal">
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone1.jpeg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone2.jpeg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone4.jpg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone1.jpeg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone2.jpeg"
                                                        alt="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="u-s-m-t-15">
                                            <div id="js-product-detail-modal-thumbnail">
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone1.jpeg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone2.jpeg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone4.jpg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone1.jpeg"
                                                        alt="" />
                                                </div>
                                                <div>
                                                    <img class="u-img-fluid"
                                                        src="{{ asset('frontend/images') }}/product/electronic/headphone2.jpeg"
                                                        alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Product Detail ======-->
                                </div>
                                <div class="col-lg-7">
                                    <!--====== Product Right Side Details ======-->
                                    <div class="pd-detail">
                                        <div>
                                            <span class="pd-detail__name">Nikon Camera 4k Lens Zoom Pro</span>
                                        </div>
                                        <div>
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__price">$6.99</span>

                                                <span class="pd-detail__discount">(76% OFF)</span><del
                                                    class="pd-detail__del">$28.97</del>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <div class="pd-detail__rating gl-rating-style">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star-half-alt"></i>

                                                <span class="pd-detail__review u-s-m-l-4">
                                                    <a href="product-detail.html">23 Reviews</a></span>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__stock">200 in stock</span>

                                                <span class="pd-detail__left">Only 2 left</span>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <span class="pd-detail__preview-desc">Lorem Ipsum is simply dummy text of
                                                the printing and
                                                typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy text ever since the 1500s,
                                                when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book.</span>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap"><i
                                                        class="far fa-heart u-s-m-r-6"></i>

                                                    <a href="signin.html">Add to Wishlist</a>

                                                    <span class="pd-detail__click-count">(222)</span></span>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap"><i
                                                        class="far fa-envelope u-s-m-r-6"></i>

                                                    <a href="signin.html">Email me When the price drops</a>

                                                    <span class="pd-detail__click-count">(20)</span></span>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <ul class="pd-social-list">
                                                <li>
                                                    <a class="s-fb--color-hover" href="#"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li>
                                                    <a class="s-tw--color-hover" href="#"><i
                                                            class="fab fa-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a class="s-insta--color-hover" href="#"><i
                                                            class="fab fa-instagram"></i></a>
                                                </li>
                                                <li>
                                                    <a class="s-wa--color-hover" href="#"><i
                                                            class="fab fa-whatsapp"></i></a>
                                                </li>
                                                <li>
                                                    <a class="s-gplus--color-hover" href="#"><i
                                                            class="fab fa-google-plus-g"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <form class="pd-detail__form">
                                                <div class="pd-detail-inline-2">
                                                    <div class="u-s-m-b-15">
                                                        <!--====== Input Counter ======-->
                                                        <div class="input-counter">
                                                            <span class="input-counter__minus fas fa-minus"></span>

                                                            <input
                                                                class="input-counter__text input-counter--text-primary-style"
                                                                type="text" value="1" data-min="1"
                                                                data-max="1000" />

                                                            <span class="input-counter__plus fa-solid fa-plus"></span>
                                                        </div>
                                                        <!--====== End - Input Counter ======-->
                                                    </div>
                                                    <div class="u-s-m-b-15 buy-btn">
                                                        <button>
                                                            <a class="btn btn--e-brand-b-2" href="checkout.html">Buy
                                                                Now</a>
                                                        </button>
                                                        <button>
                                                            <a class="btn btn--e-brand-b-2" href="cart.html">Add to
                                                                Cart</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                            <ul class="pd-detail__policy-list">
                                                <li>
                                                    <i class="fas fa-check-circle u-s-m-r-8"></i>

                                                    <span>Buyer Protection.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle u-s-m-r-8"></i>

                                                    <span>Full Refund if you don't receive your order.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle u-s-m-r-8"></i>

                                                    <span>Returns accepted if product not as described.</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--====== End - Product Right Side Details ======-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--====== End - Quick Look Modal ======-->

            <!--====== Add to Cart Modal ======-->
            {{-- <div class="modal fade" id="add-to-cart">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-radius modal-shadow">
                        <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="success u-s-m-b-30">
                                        <div class="success__text-wrap">
                                            <i class="fas fa-check"></i>

                                            <span>Item is added successfully!</span>
                                        </div>
                                        <div class="success__img-wrap">
                                            <img class="u-img-fluid"
                                                src="{{ asset('frontend/images') }}/product/electronic/headphone2.jpeg"
                                                alt="" />
                                        </div>
                                        <div class="success__info-wrap">
                                            <span class="success__name">Beats Bomb Wireless Headphone</span>

                                            <span class="success__quantity">Quantity: 1</span>

                                            <span class="success__price">$170.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="s-option">
                                        <span class="s-option__text">1 item (s) in your cart</span>
                                        <div class="s-option__link-box">
                                            <a class="s-option__link btn--e-white-brand-shadow"
                                                data-dismiss="modal">CONTINUE SHOPPING</a>
                                            <a class="s-option__link btn--e-white-brand-shadow"
                                                href="product-detail.html">PRODUCT DETAILS</a>
                                            <a class="s-option__link btn--e-white-brand-shadow" href="cart.html">VIEW
                                                CART</a>

                                            <a class="s-option__link btn--e-brand-shadow" href="checkout.html">PROCEED
                                                TO CHECKOUT</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--====== End - Add to Cart Modal ======-->

            <!--====== End - Modal Section ======-->
        </div>
        <!--====== End - Main App ======-->
        @include('frontend.include.footerlink')

</body>

</html>
