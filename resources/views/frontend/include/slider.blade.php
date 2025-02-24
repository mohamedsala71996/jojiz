<!--====== Primary Slider ======-->
<div class="container">
    <div class="s-skeleton  s-skeleton--bg-grey">
        <div class="owl-carousel primary-style-1" id="hero-slider">
            @foreach ($sliders as $slider)
                <div class="hero-slide hero-slide--1" style='background-image: url("{{ asset($slider->image) }}");'>




                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content slider-content--animation">
                                @if ($slider->sub_heading)
                                    <span class="content-span-1 u-c-secondary">{{ $slider->sub_heading }}</span>
                                @endif

                                @if ($slider->heading)
                                    <span class="content-span-2 u-c-secondary">{{ $slider->heading }}</span>
                                @endif
                                @if ($slider->desc)
                                    <span class="content-span-3 u-c-secondary">{{ $slider->desc }}</span>
                                @endif
                                @if ($slider->starting_amount)
                                    @if ($currency->symbol_position == 'left')
                                        <span class="content-span-4 u-c-secondary">@lang('frontend.Starting At')

                                            <span
                                                class="u-c-brand">{{ $currency->symbol }}{{ $slider->starting_amount }}</span></span>
                                    @else
                                        <span class="content-span-4 u-c-secondary">@lang('frontend.Starting At')

                                            <span
                                                class="u-c-brand">{{ $slider->starting_amount }}{{ $currency->symbol }}</span></span>
                                    @endif
                                @endif


                                @if ($slider->button_text)
                                    <a class="shop-now-link btn--e-brand "
                                        href="{{ $slider->button_link }}">{{ $slider->button_text }}</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!--====== End - Primary Slider ======-->
