@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Profile'])

    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">

                        @include('user.include.left-sidebar')

                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">@lang("frontend.My Wishlists")</h1>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12" id="wishlistview">
                                            @include('user.pages.wishlistview')
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="route-box">
                                                <div class="route-box__g">
                                                    <a class="route-box__link" href="{{ route('shop') }}"><i
                                                            class="fas fa-long-arrow-alt-left"></i>

                                                        <span>@lang("frontend.CONTINUE SHOPPING")</span></a>
                                                </div>
                                                <div class="route-box__g">
                                                    <a class="route-box__link allWishlistRemove" type="button">
                                                        <i class="fas fa-trash"></i>

                                                        <span>@lang("frontend.CLEAR WISHLIST")</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>

@endsection
