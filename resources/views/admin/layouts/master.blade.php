<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'fr' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('public/backend/images/general-setting') }}/{{ $basic_setting->site_favicon }}"
        rel="shortcut icon" />
    <title>{{ $basic_setting->site_name }} - {{ $basic_setting->site_title }}</title>
    {{-- //header link --}}


    @include('admin.include.headerlink')

    <style>
        .dataTables_filter input.form-control.form-control-sm {
            border: 1px solid;
        }

        span.select2-selection__placeholder {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #607080 !important;

        }

        [dir="rtl"] .sidebar-menu {
            text-align: right;
        }

        [dir="rtl"] .sidebar-item.has-sub .sidebar-link::after {
            transform: rotate(180deg);
            left: 1rem;
            right: auto;
        }

        [dir="rtl"] .submenu {
            padding-right: 2rem;
            padding-left: 0;
        }

        [dir="rtl"] .sidebar-title {
            text-align: right;
        }

        .ltr-sidebar {
            left: 0;
            right: auto;
        }

        /* RTL layout */
        .rtl-sidebar {
            right: 0;
            left: auto;
        }

        /* Ensure the main content adjusts based on sidebar position */
        #app {
            position: relative;
        }

        #main {
            margin-left: 250px;
            /* Adjust based on your sidebar width */
        }

        [dir="rtl"] #main {
            margin-left: 0;
            margin-right: 300px;
        }

        [dir="ltr"] #main {
            margin-right: 0;
            margin-left: 300px;
        }

        .rtl-sidebar-collapsed {
            right: -250px;
        }

        .rtl-main-expanded {
            margin-right: 0;
        }

        /* Collapsed sidebar in LTR */
        .ltr-sidebar-collapsed {
            left: -250px;
        }

        .ltr-main-expanded {
            margin-left: 0;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        #main {
            transition: margin 0.3s ease;
        }
    </style>
</head>

<body class="{{ app()->getLocale() === 'fr' ? 'rtl' : '' }}">

    <div id="app">
        @include('admin.include.sidebar')
        <div id="main">
            @include('admin.include.nav-top')
            @yield('admin_content')

            {{-- @include('admin.include.footer') --}}
        </div>
    </div>

    @include('admin.include.footerlink')

</body>

</html>
<script>
    $(document).ready(function() {
        $('.sidebar-toggler').click(function() {
            if ($('html').attr('dir') === 'rtl') {
                $('#sidebar').toggleClass('rtl-sidebar-collapsed');
                $('#main').toggleClass('rtl-main-expanded');
            } else {
                $('#sidebar').toggleClass('ltr-sidebar-collapsed');
                $('#main').toggleClass('ltr-main-expanded');
            }
        });
    });
</script>
