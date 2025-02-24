@extends('frontend.layouts.master')
@push('frontend_style')
    <style>
      body{
    background:#f5f5f6;
    margin-top:20px;
}
/*Faq*/

.faq-search-wrap {
    padding: 50px 0 60px;
}

.faq-search-wrap .form-group .form-control,
.faq-search-wrap .form-group .dd-handle {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
}

.faq-search-wrap .form-group .input-group-append {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 10;
    pointer-events: none;
}

.faq-search-wrap .form-group .input-group-append .input-group-text {
    background: transparent;
    border: none;
}

.faq-search-wrap .form-group .input-group-append .input-group-text .feather-icon > svg {
    height: 18px;
    width: 18px;
}
.bg-teal-light-3 {
    background-color: #7fcdc1 !important;
}

.hk-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}

@media (min-width: 576px){
    .mt-sm-60 {
        margin-top: 60px !important;
    }
}
.mt-30 {
    margin-top: 30px !important;
}

.list-group-item.active {
    background-color: #00acf0;
    border-color: #00acf0;
}
.accordion .card .card-header.activestate {
    border-width: 1px;
}
.accordion .card .card-header {
    padding: 0;
    border-width: 0;
}
.card.card-lg .card-header, .card.card-lg .card-footer {
    padding: .9rem 1.5rem;
}
.accordion>.card .card-header {
    margin-bottom: -1px;
}
.card .card-header {
    background: transparent;
    border: none;
}
.accordion.accordion-type-2 .card .card-header > a.collapsed {
    color: #324148;
}
.accordion .card:first-of-type .card-header:first-child > a {
    border-top-left-radius: calc(.25rem - 1px);
    border-top-right-radius: calc(.25rem - 1px);
}
.accordion.accordion-type-2 .card .card-header > a {
    background: transparent;
    color: #00acf0;
    padding-left: 50px;
}
.accordion .card .card-header > a.collapsed {
    color: #324148;
    background: transparent;
}
.accordion .card .card-header > a {
    background: #00acf0;
    color: #fff;
    font-weight: 500;
    padding: .75rem 1.25rem;
    display: block;
    width: 100%;
    text-align: left;
    position: relative;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
a {
    text-decoration: none;
    color: #00acf0;
    -webkit-transition: color 0.2s ease;
    -moz-transition: color 0.2s ease;
    transition: color 0.2s ease;
}


.badge.badge-pill {
    border-radius: 50px;
}
.badge.badge-light {
    background: #eaecec;
    color: #324148;
}
.badge {
    font-weight: 500;
    border-radius: 4px;
    padding: 5px 7px;
    font-size: 72%;
    letter-spacing: 0.3px;
    vertical-align: middle;
    display: inline-block;
    text-align: center;
    text-transform: capitalize;
}
.ml-15 {
    margin-left: 15px !important;
}

.accordion.accordion-type-2 .card .card-header > a.collapsed:after {
    content: "\f158";
}

.accordion.accordion-type-2 .card .card-header > a::after {
    display: inline-block;
    font: normal normal normal 14px/1 'Ionicons';
    speak: none;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: auto;
    position: absolute;
    content: "\f176";
    font-size: 21px;
    top: 15px;
    left: 20px;
}

.mr-15 {
    margin-right: 15px !important;
}
    </style>
@endpush
@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'FAQ'])
    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                            <div class="card card-lg mt-4">
                                @foreach ($faqs as $faq)
                                  <div class="accordion accordion-type-2 accordion-flush" id="accordion_{{$faq->id}}">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between activestate"> <a
                                                role="button" data-toggle="collapse" href="#collapse_{{$faq->id}}"
                                                aria-expanded="true" class="">{{$faq->title}}</a></div>
                                        <div id="collapse_{{$faq->id}}" class="collapse " data-parent="#accordion_{{$faq->id}}"
                                            role="tabpanel" style="">
                                            <div class="card-body pa-15">{!! $faq->description !!}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        {{-- <div class="faq_area section_padding_130" id="faq">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <!-- Section Heading-->
                                        <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s"
                                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                            <h3><span>Frequently </span> Asked Questions</h3>

                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <!-- FAQ Area-->
                                    <div class="col-12 col-sm-10 col-lg-8 mt-3">
                                        <div class="accordion faq-accordian" id="faqAccordion">
                                            @foreach ($faqs as $faq)
                                                <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s"
                                                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                                    <div class="card-header" id="headingOne">
                                                        <h6 class="mb-0 collapsed" data-toggle="collapse"
                                                            data-target="#collapse-{{$faq->id}}" aria-expanded="true"
                                                            aria-controls="collapse-{{$faq->id}}">{{$faq->title}}<span
                                                                class="lni-chevron-up"></span></h6>
                                                    </div>
                                                    <div class="collapse" id="collapse-{{$faq->id}}" aria-labelledby="heading-{{$faq->id}}"
                                                        data-parent="#faqAccordion">
                                                        <div class="card-body">
                                                            {!! $faq->description !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                        <!-- Support Button-->
                                        <div class="support-button text-center d-flex align-items-center justify-content-center mt-4 wow fadeInUp"
                                            data-wow-delay="0.5s"
                                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                            <i class="lni-emoji-sad"></i>
                                            <p class="mb-0 px-2">Can't find your answers?</p>
                                            <a href="{{route('contact')}}"> Contact us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
