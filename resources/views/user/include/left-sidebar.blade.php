<div class="col-lg-3 col-md-12">
    <!--====== Dashboard Features ======-->
    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
        <div class="dash__pad-1">
            <img src="{{ asset(auth()->user()->image) }}" alt=""
                style="    width: 80px; height:80px; border-radius: 50%;margin-bottom: 20px;">
            <span
                class="dash__text u-s-m-b-16">Hello,{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
            <ul class="dash__f-list">
                <li>
                    <a class="dash-active" href="{{ route('user.dashboard') }}">@lang('frontend.Manage My Account')</a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">@lang('frontend.My Profile')</a>
                </li>
                <li>
                    <a href="{{ route('user.my.order') }}">@lang('frontend.My Orders')</a>
                </li>
                <li>
                    <a href="{{ route('user.track.order') }}">@lang('frontend.Track Order')</a>
                </li>

                <li>
                    <a type="button" href="http://localhost/shopaholic_seller_web/admin/logout"
                        onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                        <span>Signout</span>
                    </a>
                    <form id="logout-form" action="http://localhost/shopaholic_seller_web/user/logout" method="POST"
                        class="d-none">
                        <input type="hidden" name="_token" value="sMSZEampu53QekxymHL8l4lMYCBqk1T7hO6YY7iG"
                            autocomplete="off">
                    </form>
                </li>

            </ul>
        </div>
    </div>
    <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
        <div class="dash__pad-1">
            <ul class="dash__w-list">
                <li>
                    <a href="{{ url('user/my-order') }}">
                        <div class="dash__w-wrap">
                            <span class="dash__w-icon dash__w-icon-style-1"><i
                                    class="fas fa-cart-arrow-down"></i></span>

                            <span
                                class="dash__w-text">{{ App\Models\Order::where('user_id', Auth::id())->get()->count() }}</span>

                            <span class="dash__w-name">@lang('frontend.Orders Placed')</span>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dash__w-wrap">
                        <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-times"></i></span>

                        <span
                            class="dash__w-text">{{ App\Models\Order::where('user_id', Auth::id())->where('status', 'Canceled')->get()->count() }}</span>

                        <span class="dash__w-name">@lang('frontend.Cancel Orders')</span>
                    </div>
                </li>
                <li>
                    <a href="{{ url('user/my-wishlist') }}">
                        <div class="dash__w-wrap">
                            <span class="dash__w-icon dash__w-icon-style-3"><i class="far fa-heart"></i></span>

                            <span
                                class="dash__w-text">{{ count(App\Models\Wishlist::where('user_id', auth()->user()->id)->get()) }}</span>

                            <span class="dash__w-name">@lang('frontend.Wishlist')</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--====== End - Dashboard Features ======-->
</div>
