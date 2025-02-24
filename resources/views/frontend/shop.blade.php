@extends('frontend.layouts.master')

@section('frontend_content')
    <style>
        .minusicon {
            display: none;
        }

        @media (max-width: 575px) {
            .product-o {
                padding: 0px !important;
            }

            .shop-w-master__heading {
                display: flex !important;
                justify-content: space-between;

            }
        }
    </style>
    <div class="u-s-p-y-10">

        <div class="container">
            <div class="row">
                @include('frontend.include.nav-side')
                <div class="col-lg-9 col-md-12">
                    <h1 type="buttom" onclick="loadfilter()" class="shop-w-master__heading u-s-m-b-15 d-lg-none d-block">
                        <span>@lang('frontend.FILTERS')</span>
                        <i class="fas fa-filter u-s-m-r-0" aria-hidden="true"></i>
                    </h1>
                    <div class="shop-p">
                        <div class="shop-p__collection" id="productview">
                            @include('frontend.include.productview')
                        </div>

                        <div class="u-s-p-y-20">
                            <!--====== Pagination ======-->
                            <ul class="shop-p__pagination">
                                <div class="row text-center" style="padding:20px;">
                                    {{-- {{ $cProducts->links() }} --}}
                                    <button class="custom-btn4 btn-10 load-more-data">@lang('backend.Load More') </button>

                                </div>

                                <div class="auto-load text-center" style="display: none;">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border" role="status">

                                        </div>
                                    </div>
                                </div>


                            </ul>
                            <!--====== End - Pagination ======-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== Login and Registration Form Modal ======-->
    @include('frontend.components.modal.login-registration-form')
    <!--====== End - Quick View Form Modal ======-->
    @include('frontend.components.modal.quick-look')
    <!--====== Add to Cart Modal ======-->
    @include('frontend.components.modal.add-to-card')
    <!--====== End - Add to Cart Modal ======-->
@endsection
@push('frontend_script')
    <script>
        var ENDPOINT = "{{ route('shop') }}";
        var page = 1;

        $(".load-more-data").click(function() {
            page++;
            LoadMore(page);
        });

        function LoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "json",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    $('.auto-load').hide();

                    // Check if there is more data to load
                    if (!response.hasMore) {
                        $('.load-more-data').hide(); // Hide the Load More button if no more products
                        return;
                    }

                    $("#productview").append("<div class='row'>" + response.html + "</div>");
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occurred');
                });
        }
    </script>





    <script type="text/javascript">
        $(document).ready(function() {

        });

        function changeico(id) {
            var check = $('#changeico' + id).val();
            if (check == 'plus') {
                $('#changeico' + id).val('minus');
                $('#plusicon' + id).css('display', 'none');
                $('#minusicon' + id).css('display', 'inline-block');
            } else {
                $('#changeico' + id).val('plus');
                $('#minusicon' + id).css('display', 'none');
                $('#plusicon' + id).css('display', 'inline-block');
            }
        }

        function loadfilter() {
            document.getElementById("mySidepanel").style.width = "280px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
@endpush
