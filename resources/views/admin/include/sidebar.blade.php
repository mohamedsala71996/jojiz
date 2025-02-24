<div  id="sidebar" >
    <div class="sidebar-wrapper active" >
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('admin.dashboard') }}"><img
                            src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                            alt="Logo" /></a>
                </div>

                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">@lang('backend.Menu')</li>

                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span>{{ __('backend.Dashboard') }} </span>
                    </a>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.product.*') ? 'active' : '' }} || {{ request()->routeIs('admin.category.*') ? 'active' : '' }} || {{ request()->routeIs('admin.productattribute.*') ? 'active' : '' }} || {{ request()->routeIs('admin.brand.*') ? 'active' : '' }} || {{ request()->routeIs('admin.subcategory.*') ? 'active' : '' }} || {{ request()->is('admin/product-info/All') ? 'active' : '' }} || {{ request()->routeIs('admin.childcategory.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-brands fa-product-hunt"></i>
                        <span>@lang('backend.Products')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->is('admin/product-info/All') ? 'active' : '' }}">
                            <a href="{{ url('admin/product-info/All') }}" class="submenu-link">@lang('backend.Product List')</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.index') }}" class="submenu-link">@lang('frontend.Category')</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin.subcategory.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.subcategory.index') }}" class="submenu-link">@lang('backend.Sub Category')
                            </a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin.childcategory.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.childcategory.index') }}"
                                class="submenu-link">@lang('backend.Child Category')</a>
                        </li>

                        <li
                            class="submenu-item {{ request()->routeIs('admin.productattribute.attribute.name') ? 'active' : '' }}">
                            <a href="{{ route('admin.productattribute.attribute.name') }}"
                                class="submenu-link">@lang('backend.Attribute Name')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.productattribute.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.productattribute.index') }}"
                                class="submenu-link">@lang('backend.Attribute Value') </a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin.brand.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.brand.index') }}" class="submenu-link">@lang('backend.Brand')</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.orders.status', 'all') ? 'active' : '' }} ">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                        <span>@lang('backend.Orders')</span>
                    </a>
                    <ul class="submenu">

                        <li
                            class="submenu-item {{ request()->routeIs('admin.orders.status', 'all') ? 'active' : '' }}">
                            <a href="{{ route('admin.orders.status', 'all') }}" class="submenu-link">@lang('backend.All Order')
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.payment.credentials.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa fa-credit-card"></i>
                        <span>@lang('backend.Payment Gateway')</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item {{ request()->routeIs('admin.payment.credentials.sslcommerz.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.payment.credentials.sslcommerz.index') }}"
                                class="submenu-link">@lang('backend.SSL Commerz')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.payment.credentials.stripe.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.payment.credentials.stripe.index') }}"
                                class="submenu-link">@lang('backend.Stripe')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.payment.credentials.paypal.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.payment.credentials.paypal.index') }}"
                                class="submenu-link">@lang('backend.PayPal')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.payment.credentials.bkash.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.payment.credentials.bkash.index') }}"
                                class="submenu-link">@lang('backend.bKash')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.payment.credentials.razorpay.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.payment.credentials.razorpay.index') }}"
                                class="submenu-link">@lang('backend.Razor Pay')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.payment.credentials.cacheOnDelivery.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.payment.credentials.cacheOnDelivery.index') }}"
                                class="submenu-link">@lang('backend.Cash On Delivery')</a>
                        </li>

                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.currency.edit', ['currency' => $currency->id]) ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span>@lang('backend.Currency')</span>
                    </a>
                    <ul class="submenu">

                        <li
                            class="submenu-item {{ request()->routeIs('admin.currency.edit', ['currency' => $currency->id]) ? 'active' : '' }}">
                            <a href="{{ route('admin.currency.edit', ['currency' => $currency->id]) }}"
                                class="submenu-link">
                                @lang('backend.Edit')
                            </a>
                        </li>

                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.advance-payment.edit') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-money-bill"></i>
                        <span>@lang('backend.Advance Payment')</span>
                    </a>
                    <ul class="submenu">

                        <li
                            class="submenu-item {{ request()->routeIs('admin.advance-payment.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.advance-payment.edit') }}" class="submenu-link">
                                @lang('backend.Edit')
                            </a>
                        </li>

                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.offer.collection.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-list"></i>
                        <span>@lang('backend.Collection')</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item {{ request()->routeIs('admin.offer.collection.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.offer.collection.index') }}"
                                class="submenu-link">@lang('backend.List')</a>
                        </li>
                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.delivery-charges.index') ? 'active' : '' }} || {{ request()->routeIs('admin.other.delivery.charge.edit') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-truck"></i>
                        <span>@lang('backend.Delivery Charge')</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item {{ request()->routeIs('admin.delivery-charges.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.delivery-charges.index') }}"
                                class="submenu-link">@lang('backend.Regional Fees') </a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.other.delivery.charge.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.other.delivery.charge.edit') }}"
                                class="submenu-link">@lang('backend.Delivery Setting')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('admin.slider.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-scroll-torah"></i>
                        <span>@lang('backend.Slider') </span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.slider.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.slider.index') }}" class="submenu-link">@lang('backend.List')</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.admin.coupons.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-money-bill"></i>
                        <span>@lang('backend.Coupon')</span>
                    </a>
                    <ul class="submenu">
                        <li
                            class="submenu-item {{ request()->routeIs('admin.admin.coupons.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.admin.coupons.index') }}"
                                class="submenu-link">@lang('backend.List')</a>
                        </li>
                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('qna') ? 'active' : '' }} || {{ request()->is('admin/q-&-a') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-question"></i>
                        <span>@lang('backend.Q & A')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->is('admin/q-&-a') ? 'active' : '' }}">
                            <a href="{{ url('admin/q-&-a') }}" class="submenu-link">@lang('backend.Q & A')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('admin.user.list.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>@lang('backend.Customer List')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.user.list.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.list.index') }}"
                                class="submenu-link">@lang('backend.Customers')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('admin.alert.app.edit') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>@lang('backend.App Alert')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.alert.app.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.alert.app.edit', $alertApp->id) }}">@lang('backend.Edit')</a>

                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ request()->routeIs('admin.suppliers.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-cubes"></i>
                        <span>@lang('backend.Supplier List')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.suppliers.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.suppliers.index') }}" class="submenu-link">@lang('backend.Suppliers')
                            </a>
                        </li>
                    </ul>
                </li>



                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.couriers.*') || request()->routeIs('admin.cities.*') || request()->routeIs('admin.zones.*') || request()->routeIs('admin.areas.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-shipping-fast"></i>
                        <span>@lang('backend.Courier')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.couriers.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.couriers.index') }}" class="submenu-link">@lang('backend.Courier')</a>
                        </li>

                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.general.setting.basic.setting') ||
                    request()->routeIs('admin.general.setting.image.asset') ||
                    request()->routeIs('admin.general.setting.mail.config.page') ||
                    request()->is('admin/web-settings')
                        ? 'active'
                        : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-gear"></i>
                        <span>@lang('backend.General Settings')</span>
                    </a>

                    <ul class="submenu">

                        <li class="submenu-item {{ request()->is('admin/web-settings') ? 'active' : '' }}">
                            <a href="{{ url('admin/web-settings') }}" class="submenu-link">@lang('backend.Web Settings')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.general.setting.basic.setting') ? 'active' : '' }}">
                            <a href="{{ route('admin.general.setting.basic.setting') }}"
                                class="submenu-link">@lang('backend.Site Info')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.general.setting.image.asset') ? 'active' : '' }}">
                            <a href="{{ route('admin.general.setting.image.asset') }}"
                                class="submenu-link">@lang('backend.Logo Setup')</a>
                        </li>
                        <li
                            class="submenu-item {{ request()->routeIs('admin.general.setting.mail.config.page') ? 'active' : '' }}">
                            <a href="{{ route('admin.general.setting.mail.config.page') }}"
                                class="submenu-link">@lang('backend.Mail Config')</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.notification.index') ? 'active' : '' }} || {{ request()->routeIs('admin.notification.list') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-bell"></i>
                        <span>@lang('backend.Notification')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.notification.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.notification.index') }}" class="submenu-link">@lang('backend.Customer Notification')
                            </a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin.notification.list') ? 'active' : '' }}">
                            <a href="{{ route('admin.notification.list') }}" class="submenu-link">@lang('backend.List')
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="sidebar-item has-sub {{ request()->routeIs('admin.usefullink.index') ? 'active' : '' }} || {{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-link"></i>
                        <span>@lang('backend.Useful Link')</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin.usefullink.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.usefullink.index') }}">@lang('backend.List') </a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.faqs.index') }}">@lang('backend.FAQ')</a>

                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.cache.clear') ? 'active' : '' }}">
                    <a href="{{ route('admin.cache.clear') }}" class="sidebar-link">
                        <i class="fa-solid fa-broom"></i>
                        <span>@lang('backend.Cache Clear')</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
