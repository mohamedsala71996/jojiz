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
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                              <div class="dash__pad-2">
                                <h1 class="dash__h1 u-s-m-b-14">My Payment Options</h1>

                                <span class="dash__text">No payment options</span>
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
