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
                                    <h1 class="dash__h1 u-s-m-b-14">@lang('frontend.My Profile') </h1>

                                    <span class="dash__text u-s-m-b-30">@lang('frontend.Look all your info, you could customize your profile.')</span>
                                    <div class="row">
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.Full Name')</h2>

                                            <span class="dash__text">{{ auth()->user()->name }}</span>
                                        </div>
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.E-mail')</h2>

                                            <span class="dash__text">{{ auth()->user()->email }}</span>
                                        </div>
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.Phone')</h2>

                                            <span class="dash__text">{{ auth()->user()->phone }}</span>
                                        </div>
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.Birthday')</h2>

                                            <span
                                                class="dash__text">{{ date('Y-m-d', strtotime(auth()->user()->birthday)) }}</span>
                                        </div>
                                        <div class="col-lg-4 u-s-m-b-30">
                                            <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.Gender')</h2>

                                            <span class="dash__text">{{ ucfirst(auth()->user()->gender) }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="u-s-m-b-16">
                                                <a class="dash__custom-link btn--e-transparent-brand-b-2"
                                                    href="{{ route('user.profile.edit', auth()->user()->id) }}">@lang('frontend.Edit Profile')
                                                </a>
                                            </div>
                                            <div>
                                                <a class="dash__custom-link btn--e-brand-b-2"
                                                    href="{{ route('user.password.edit', auth()->user()->id) }}">@lang('frontend.Change Password')
                                                </a>
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
