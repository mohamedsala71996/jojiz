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
                         src="{{ asset('backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                         alt="Logo" /></a>
                 <!--====== End - Main Logo ======-->

                 <!--====== Search Form ======-->
                 <form class="main-form" method="GET" action="{{ route('product.search') }}">
                     @csrf
                     <label for="main-search"></label>

                     <input class="input-text input-text--border-radius input-text--style-1" name="product_search"
                         type="text" id="main-search" placeholder="@lang('backend.Search')" />

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
                                     <li>
                                         <a href="dashboard.html"><i class="fas fa-user-circle u-s-m-r-6"></i>
                                             <span>Account</span></a>
                                     </li>
                                     <li>
                                         <a href="{{ route('register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                                             <span>Signup</span></a>
                                     </li>
                                     <li>
                                         <a href="{{ route('login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                                             <span>Signin</span></a>
                                     </li>
                                     <li>
                                         <a href="signup.html"><i class="fas fa-lock-open u-s-m-r-6"></i>
                                             <span>Signout</span></a>
                                     </li>
                                 </ul>
                                 <!--====== End - Dropdown ======-->
                             </li>
                             <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Settings">
                                 <a><i class="fas fa-user-cog"></i></a>

                                 <!--====== Dropdown ======-->

                                 <span class="js-menu-toggle"></span>
                                 <ul style="width: 120px">
                                     <li class="has-dropdown has-dropdown--ul-right-100">
                                         <a>Language<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                         <!--====== Dropdown ======-->

                                         <span class="js-menu-toggle"></span>
                                         <ul style="width: 120px">
                                             <li>
                                                 <a class="u-c-brand">ENGLISH</a>
                                             </li>
                                             <li>
                                                 <a>BANGLA</a>
                                             </li>
                                             <li>
                                                 <a>PORTUGAL</a>
                                             </li>
                                             <li>
                                         </ul>
                                         <!--====== End - Dropdown ======-->
                                     </li>
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

     <!--====== End - Nav 2 ======-->
 </header>
 <!--====== End - Main Header ======-->
