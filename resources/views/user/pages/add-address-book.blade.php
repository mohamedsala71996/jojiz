@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'My Address'])

    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">

                        @include('user.include.left-sidebar')

                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                              <div class="dash__pad-2">
                                <h1 class="dash__h1 u-s-m-b-14">Add new Address</h1>

                                <span class="dash__text u-s-m-b-30">We need an address where we could deliver
                                  products.</span>
                                <form class="dash-address-manipulation" method="POST" action="{{route('user.store.address.book')}}">
                                    @csrf
                                  <div class="gl-inline">
                                    <div class="u-s-m-b-30">
                                      <label class="gl-label" for="address-fname">FIRST NAME *</label>

                                      <input class="input-text input-text--primary-style" type="text" name="first_name" id="address-fname" placeholder="@lang('backend.First Name')">
                                    </div>
                                    <div class="u-s-m-b-30">
                                      <label class="gl-label" for="address-lname">LAST NAME *</label>

                                      <input class="input-text input-text--primary-style" name="last_name" type="text" id="address-lname" placeholder="@lang('backend.Last Name')">
                                    </div>
                                  </div>
                                  <div class="gl-inline">
                                    <div class="u-s-m-b-30">
                                      <label class="gl-label" for="address-phone">PHONE *</label>

                                      <input class="input-text input-text--primary-style" name="phone" type="text" id="address-phone">
                                    </div>
                                    <div class="u-s-m-b-30">
                                      <label class="gl-label" for="address-street">STREET ADDRESS *</label>

                                      <input class="input-text input-text--primary-style" name="street" type="text" id="address-street" placeholder="@lang('backend.House Name and Street')">
                                    </div>
                                  </div>
                                  <div class="gl-inline">
                                    <div class="u-s-m-b-30">
                                      <!--====== Select Box ======-->

                                      <label class="gl-label" for="address-country">COUNTRY *</label>
                                      <input class="input-text input-text--primary-style" name="country" type="text" id="country" placeholder="@lang('backend.Country')">
                                      <!--====== End - Select Box ======-->
                                    </div>
                                    <div class="u-s-m-b-30">
                                      <!--====== Select Box ======-->

                                      <label class="gl-label" for="address-state">STATE/PROVINCE *</label>
                                      <input class="input-text input-text--primary-style" name="state" type="text" id="state" placeholder="@lang('backend.State')">
                                      <!--====== End - Select Box ======-->
                                    </div>
                                  </div>
                                  <div class="gl-inline">
                                    <div class="u-s-m-b-30">
                                      <label class="gl-label" for="address-city">TOWN/CITY *</label>

                                      <input class="input-text input-text--primary-style" type="text" name="city" id="address-city">
                                    </div>
                                    <div class="u-s-m-b-30">
                                      <label class="gl-label" for="address-street">ZIP/POSTAL CODE *</label>

                                      <input class="input-text input-text--primary-style" name="zip_code" type="text" id="address-postal" placeholder="@lang('backend.Zip/Postal Code')">
                                    </div>
                                  </div>

                                  <button class="btn btn--e-brand-b-2" type="submit">
                                    SAVE
                                  </button>
                                </form>
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
