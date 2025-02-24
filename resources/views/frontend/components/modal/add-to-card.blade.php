<!--====== Add to Cart Modal ======-->
<div class="modal fade" id="add-to-cart">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-radius modal-shadow">
            <div class="modal-body">
                <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
                <div class="row">
                    <div class="col-lg-6 col-md-12 product_content">

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="s-option">
                            <span class="s-option__text">@lang("frontend.1 item (s) in your cart")</span>
                            <div class="s-option__link-box">
                                <a class="s-option__link btn--e-white-brand-shadow" href="{{route('shop')}}">@lang("frontend.CONTINUE SHOPPING")</a>
                                <a class="s-option__link btn--e-white-brand-shadow productDetailsLink" href="">@lang("frontend.PRODUCT DETAILS")</a>
                                <a class="s-option__link btn--e-white-brand-shadow"
                                    href="{{ route('user.cart.add.to.cart.page') }}">@lang("frontend.VIEW CART")</a>

                                <a class="s-option__link btn--e-white-brand-shadow" href="{{route('user.checkout.page')}}">@lang("frontend.PROCEED TO CHECKOUT") </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Add to Cart Modal ======-->
