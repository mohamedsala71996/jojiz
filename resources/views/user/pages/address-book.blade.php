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
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                              <div class="dash__pad-2">
                                <div class="dash__address-header">
                                  <h1 class="dash__h1">Address Book</h1>
                                  <div>
                                    <span class="dash__link dash__link--black u-s-m-r-8">
                                      <a href="dash-address-make-default.html">Make default shipping address</a></span>

                                    <span class="dash__link dash__link--black">
                                      <a href="dash-address-make-default.html">Make default shipping address</a></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
                              <div class="dash__table-2-wrap gl-scroll">
                                <table class="dash__table-2">
                                  <thead>
                                    <tr>
                                      <th>Action</th>
                                      <th>Full Name</th>
                                      <th>Address</th>
                                      <th>Region</th>
                                      <th>Phone Number</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <a class="address-book-edit btn--e-transparent-platinum-b-2" href="dash-address-edit.html">Edit</a>
                                      </td>
                                      <td>John Doe</td>
                                      <td>4247 Ashford Drive Virginia VA-20006 USA</td>
                                      <td>Virginia VA-20006 USA</td>
                                      <td>(+0) 900901904</td>
                                      <td>
                                        <div class="gl-text">
                                          Default Shipping Address
                                        </div>
                                        <div class="gl-text">
                                          Default Billing Address
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <a class="address-book-edit btn--e-transparent-platinum-b-2" href="{{route('user.edit.address.book')}}">Edit</a>
                                      </td>
                                      <td>Doe John</td>
                                      <td>1484 Abner Road</td>
                                      <td>Eau Claire WI - Wisconsin</td>
                                      <td>(+0) 7154419563</td>
                                      <td></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div>
                              <a class="dash__custom-link btn--e-brand-b-2" href="{{route(''ad)}}"><i class="fas fa-plus u-s-m-r-8"></i>

                                <span>Add New Address</span></a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
