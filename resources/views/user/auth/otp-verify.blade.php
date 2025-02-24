@extends('frontend.layouts.master')

@section('frontend_content')
    <!--====== Section 1 ======-->
    <div class="u-s-p-y-0">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ route('index') }}">@lang('frontend.Home')</a>
                            </li>
                            <li class="is-marked">
                                <a href="javascript:void(0)">@lang('frontend.Send Otp')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->

    <div class="u-s-p-b-60">


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 u-s-m-b-30">
                        <div class="l-f-o">
                            <div class="l-f-o__pad-box">
                                <h1 class="gl-h1">@lang('frontend.Set Otp')</h1>


                                <form class="l-f-o__form" method="POST" action="{{ route('user.otp.verify', $token) }}">
                                    @csrf
                                    <div class="u-s-m-b-30">
                                        <label class="gl-label" for="reset-email">@lang('frontend.Otp Code') *</label>
                                        <input class="input-text input-text--primary-style" type="text" id="reset-email"
                                            name="code" placeholder="@lang('frontend.Enter Otp Code')">
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <button class="btn btn--e-transparent-brand-b-2" type="submit">
                                            @lang('backend.Submit')
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
