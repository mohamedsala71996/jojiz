@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Contact'])
    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="help-section">
                            <header class="help-header">
                                <h2>@lang('backend.NEED HELP?')</h2>
                            </header>

                            <div class="help-content">
                                <div class="help-text">
                                    <p>@lang('backend.Have a question or need assistance? We’re here to help!')</p>
                                    <p>@lang('backend.Feel free to reach out to us anytime via chat or WhatsApp.')</p>

                                    <div class="contact-buttons">

                                        <button class="chat-button">
                                            <a href="https://wa.me/{{ $basic_setting->phone }}" target="_blank">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                                    alt="WhatsApp">


                                            </a>
                                            <a href="https://wa.me/{{ $basic_setting->phone }}" target="_blank"> @lang('backend.WHATSAPP WITH US')</a>
                                        </button>

                                    </div>

                                    <div class="contact-details">
                                        <p>@lang('backend.You can also call us directly at') <span>{{ $basic_setting->phone }}</span>.</p>
                                        <p>@lang('backend.Your queries are important to us, and we’ll get back to you as soon as possible!')
                                        </p>
                                    </div>
                                </div>

                                <div class="help-image">
                                    <img src="{{ asset('public/frontend/images/contact-image/contact3.jpeg') }}"
                                        alt="contact-img">
                                </div>
                            </div>
                        </section>
                        <div class="g-map">
                            {{-- <div id="map" style="position: relative; overflow: hidden;">
                                <div
                                    style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                                    <div tabindex="0" aria-label="Map" aria-roledescription="map" role="region"
                                        aria-describedby="86907988-28E5-4047-93BA-75758B898BE2"
                                        style="position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;">
                                        <div id="86907988-28E5-4047-93BA-75758B898BE2" style="display: none;"></div>
                                    </div>
                                    <div class="gm-style"
                                        style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                                        <div
                                            style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;">
                                            <div
                                                style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; will-change: transform; transform: translate(0px, 0px);">
                                                <div
                                                    style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                                    <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                                        <div
                                                            style="position: absolute; z-index: 988; transform: matrix(1, 0, 0, 1, -164, -171);">
                                                            <div
                                                                style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 256px; top: -256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 256px; top: 0px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 256px; top: 256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 0px; top: 256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: -256px; top: 256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: -512px; top: 256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: -512px; top: 0px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: -512px; top: -256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 512px; top: -256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 512px; top: 0px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                            <div
                                                                style="position: absolute; left: 512px; top: 256px; width: 256px; height: 256px;">
                                                                <div style="width: 256px; height: 256px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;">
                                                </div>
                                                <div
                                                    style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;">
                                                </div>
                                                <div
                                                    style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                                    <div
                                                        style="width: 26px; height: 37px; overflow: hidden; position: absolute; left: -13px; top: -37px; z-index: 0;">
                                                        <img alt=""
                                                            src="https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi3.png"
                                                            draggable="false"
                                                            style="position: absolute; left: 0px; top: 0px; width: 26px; height: 37px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                    </div>
                                                    <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                                                        <div
                                                            style="position: absolute; z-index: 988; transform: matrix(1, 0, 0, 1, -164, -171);">
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 0px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: -256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: -256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: -256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: 0px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 256px; top: 256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -512px; top: 256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -512px; top: 0px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -512px; top: -256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: -256px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: 0px;">
                                                            </div>
                                                            <div
                                                                style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 512px; top: 256px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="position: absolute; left: 0px; top: 0px; z-index: 0;"></div>
                                                <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                                    <div
                                                        style="position: absolute; z-index: 988; transform: matrix(1, 0, 0, 1, -164, -171);">
                                                        <div
                                                            style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;">
                                                            <img draggable="false" alt="" role="presentation"
                                                                src="https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i12!2i659!3i1588!4i256!2m3!1e0!2sm!3i695441717!2m3!1e2!6m1!3e5!3m17!2sen-US!3sUS!5e18!12m4!1e68!2m2!1sset!2sRoadmap!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5zOi02MHxwLmw6LTYw!4e0!5m1!1e3&amp;key=AIzaSyB-MO9uPLS-ApTqYs0FpYdVG8cFwdq6apw&amp;token=81280"
                                                                style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;">
                                                <div
                                                    style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; will-change: transform; transform: translate(0px, 0px);">
                                                    <div
                                                        style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;">
                                                    </div>
                                                    <div
                                                        style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;">
                                                    </div>
                                                    <div
                                                        style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;">
                                                        <span id="A7111BFB-F250-4142-9D20-ABC44074EF26"
                                                            style="display: none;">To navigate, press the arrow keys.</span>
                                                        <div tabindex="-1"
                                                            style="width: 26px; height: 37px; overflow: hidden; position: absolute; left: -13px; top: -37px; z-index: 0;">
                                                            <img alt=""
                                                                src="https://maps.gstatic.com/mapfiles/transparent.png"
                                                                draggable="false" usemap="#gmimap0"
                                                                style="width: 26px; height: 37px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"><map
                                                                name="gmimap0" id="gmimap0"><area log="miw"
                                                                    coords="13,0,4,3.5,0,12,2.75,21,13,37,23.5,21,26,12,22,3.5"
                                                                    shape="poly" tabindex="-1" title=""
                                                                    style="display: inline; position: absolute; left: 0px; top: 0px; cursor: pointer; touch-action: none;"></map>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gm-style-moc"
                                                style="z-index: 4; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;">
                                                <p class="gm-style-mot"></p>
                                            </div>
                                        </div><iframe aria-hidden="true" frameborder="0" tabindex="-1"
                                            style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none; opacity: 0;"></iframe>
                                        <div
                                            style="pointer-events: none; width: 100%; height: 100%; box-sizing: border-box; position: absolute; z-index: 1000002; opacity: 0; border: 2px solid rgb(26, 115, 232);">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="background-color: white; font-weight: 500; font-family: Roboto, sans-serif; padding: 15px 25px; box-sizing: border-box; top: 5px; border: 1px solid rgba(0, 0, 0, 0.12); border-radius: 5px; left: 50%; max-width: 375px; position: absolute; transform: translateX(-50%); width: calc(100% - 10px); z-index: 1;">
                                    <div><img alt=""
                                            src="https://maps.gstatic.com/mapfiles/api-3/images/google_gray.svg"
                                            draggable="false"
                                            style="padding: 0px; margin: 0px; border: 0px; height: 17px; vertical-align: middle; width: 52px; user-select: none;">
                                    </div>
                                    <div style="line-height: 20px; margin: 15px 0px;"><span
                                            style="color: rgba(0, 0, 0, 0.87); font-size: 14px;">This page can't load
                                            Google Maps correctly.</span></div>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="line-height: 16px; vertical-align: middle;"><a
                                                    href="http://g.co/dev/maps-no-account" target="_blank" rel="noopener"
                                                    style="color: rgba(0, 0, 0, 0.54); font-size: 12px;">Do you own this
                                                    website?</a></td>
                                            <td style="text-align: right;"><button class="dismissButton">OK</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="contact-o u-h-100">
                            <div class="contact-o__wrap">
                                <div class="contact-o__icon">
                                    <i class="fas fa-phone-volume"></i>
                                </div>

                                <span class="contact-o__info-text-1">@lang("frontend.LET'S HAVE A CALL")</span>

                                <span class="contact-o__info-text-2">{{ $basic_setting->phone }}</span>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="contact-o u-h-100">
                            <div class="contact-o__wrap">
                                <div class="contact-o__icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>

                                <span class="contact-o__info-text-1"> @lang('frontend.OUR LOCATION')</span>

                                <span class="contact-o__info-text-2">{{ $basic_setting->address }}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                        <div class="contact-o u-h-100">
                            <div class="contact-o__wrap">
                                <div class="contact-o__icon">
                                    <i class="far fa-clock"></i>
                                </div>

                                <span class="contact-o__info-text-1">@lang('frontend.E-MAIL')</span>

                                <span class="contact-o__info-text-2">{{ $basic_setting->email }}</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
