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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    @include('frontend.include.headerlink')
    @stack('frontend_style')

</head>

<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">
            <img class="preloader__img" src="{{ asset('public/frontend/images') }}/preloader.png" alt="" />
        </div>
    </div>

    <!--====== Main App ======-->
    <div id="app">
        @include('frontend.include.nav-header')
        {{-- @include('frontend.include.top-header') --}}
        <!--====== App Content ======-->
        <div class="app-content">

            @yield('frontend_content')

            @include('frontend.include.footer')
            <!--====== Modal Section ======-->



            <!--====== End - Modal Section ======-->
        </div>

        <div class="modal" id="processing">
            <div class="modal-dialog">
                <div class="modal-content" style="text-align: center;background: none;">
                    <i class="spinner fa fa-spinner fa-spin" style="color: #000; font-size: 70px;  padding: 22px;"></i>
                </div>
            </div>
        </div>
        <!--====== End - Main App ======-->
        <script>
            let _token = "{{ csrf_token() }}";
        </script>
        @include('frontend.include.footerlink')
        @stack('frontend_script')

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            if (!window.matchMedia("(max-width: 576px)").matches) {
                var Tawk_API = Tawk_API || {},
                    Tawk_LoadStart = new Date();
                (function() {
                    var s1 = document.createElement("script"),
                        s0 = document.getElementsByTagName("script")[0];
                    s1.async = true;
                    s1.src = 'https://embed.tawk.to/676aacfcaf5bfec1dbe11907/1ifsb7fan';
                    s1.charset = 'UTF-8';
                    s1.setAttribute('crossorigin', '*');
                    s0.parentNode.insertBefore(s1, s0);
                })();
            }
        </script>
        <!--End of Tawk.to Script-->

</body>

</html>
