@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Wishlist'])

    <div class="u-s-p-b-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">@lang("frontend.Wishlist")</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
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
        <!--====== End - Section Content ======-->
    </div>
@endsection
@push('user_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.cartUpdat', function(e) {
                e.preventDefault();
                let cart_id = $(this).data('id');
                let qty = $(this).val();
                console.log(cart_id);
                console.log(qty);
            });
        });
    </script>
@endpush
