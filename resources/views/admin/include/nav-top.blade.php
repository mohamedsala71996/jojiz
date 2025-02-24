@php
    $admin = Auth::guard('admin')->user();
@endphp
<div class="top-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-content">
                        <h4>@lang('backend.Welcome Back') , {{ $admin->display_name }}</h4>
                        <p><?php echo date('l, d F, Y'); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-one">
                                <div class="card-body custom-card-body-one py-4 px-4">
                                    <div class="d-flex align-items-center card-icon-main ">

                                        <div class="dropdown lang-dropdown">
                                            <button class=" language-btn2 dropdown-toggle" type="button"
                                                id="dropdownMenuButton">
                                                @if (session('locale') === 'fr')
                                                    <img src="{{ asset('public/frontend/images/language/france.jpeg') }}"
                                                        alt="Egypt" />
                                                    Ar
                                                @elseif (session('locale') === 'en')
                                                    <img src="{{ asset('public/frontend/images/language/english.png') }}"
                                                        alt="english" />
                                                    Eng
                                               
                                                @else
                                                    Language
                                                @endif
                                            </button>

                                            <div class="dropdown-content dropdown-menu dropdown-menu2 "
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item dropdown-item2"
                                                    href="{{ route('locale', 'fr') }}">
                                                    <img src="{{ asset('public/frontend/images/language/france.jpeg') }}"
                                                        alt="france" />
                                                    Arabic</a>
                                                <a class="dropdown-item dropdown-item2"
                                                    href="{{ route('locale', 'en') }}">
                                                    <img src="{{ asset('public/frontend/images/language/english.png') }}"
                                                        alt="english" />
                                                    English</a>
                                               
                                            </div>
                                        </div>


                                        <div class="name avatar-text avatar-notification">
                                            <div class="dropdown notification">

                                                <button class="notification-btn">
                                                    <i class="fa-regular fa-bell dropbtn"></i>
                                                    <span>{{ count($notifications) }}</span>

                                                </button>
                                                <div id="notificationDropdown"
                                                    class="dropdown-content notification-content">
                                                    <div class="notification-header">
                                                        <div class="clear-text">
                                                            <h5> <a href="{{ route('admin.notification.list') }}">
                                                                    @lang('backend.All Notification')</a></h5>
                                                        </div>

                                                    </div>
                                                    <div class="notification-view">

                                                        @foreach ($notifications as $notification)
                                                            <a href="{{ route('admin.notification.list') }}">
                                                                <h4
                                                                    style="text-align: left; color:#444; font-size:14px;">
                                                                    <div class="notification-main d-flex">
                                                                        <img src="{{ asset($admin->image) }}"
                                                                            alt="">
                                                                        <div class="notification-text">
                                                                            <h3>{{ $notification->user->name }}</h3>
                                                                            <p>{{ $notification->title }}</p>
                                                                            <p style="color:rgb(55, 148, 253);">
                                                                                {{ $notification->created_at->diffForHumans() }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </h4>
                                                            </a>
                                                        @endforeach

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="avatar-main ">
                                            {{-- profile dropdown --}}
                                            <div class="name avatar-text">
                                                <div class="dropdown">
                                                    <button>
                                                        <div class="avatar">
                                                            <img src="{{ asset($admin->image) }}" alt="Admin Image">
                                                        </div>
                                                    </button>
                                                    <button class="avatar-btn">
                                                        <h5 class="font-bold dropbtn">
                                                            {{ $admin->display_name }}
                                                        </h5><i class="fa-solid fa-chevron-down dropbtn"></i>
                                                    </button>
                                                    <div id="myDropdown" class="dropdown-content">
                                                        <img src="{{ asset($admin->image) }}" alt="Admin Image">
                                                        <h4 class="pt-1">{{ $admin->display_name }}</h4>
                                                        <p class="mb-0">{{ $admin->email }}</p>
                                                        <p>{{ $admin->phone }}</p>

                                                        <a
                                                            href="{{ route('admin.profile.edit', $admin->id) }}">@lang('backend.Profile')</a>
                                                        <a
                                                            href="{{ route('admin.profile.password.edit', $admin->id) }}">@lang('backend.Change Password')
                                                        </a>
                                                        <a type="button" href="{{ route('admin.logout') }}"
                                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">@lang('backend.LogOut')</a>
                                                        <form id="logout-form" action="{{ route('admin.logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
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
        </div>
    </div>
</div>
<header class="mb-3 mt-2">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
