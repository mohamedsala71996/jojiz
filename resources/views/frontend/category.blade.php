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
        .shop-w-master__heading{
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
                    <h1 type="buttom" onclick="loadfilter()" class="shop-w-master__heading u-s-m-b-15 d-lg-none d-block" >
                        <span>@lang("frontend.FILTERS")</span>
                        <i class="fas fa-filter u-s-m-r-0" aria-hidden="true"></i>
                    </h1>
                    <div class="shop-p">
                        <div class="shop-p__collection" id="productview">
                            @include('frontend.include.productview')
                        </div>
                        <div class="u-s-p-y-20">
                            <!--====== Pagination ======-->
                            <ul class="shop-p__pagination">
                                <li>
                                    {{ $cProducts->links() }}
                                </li>
                            </ul>
                            <!--====== End - Pagination ======-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.components.modal.quick-look')
    @include('frontend.components.modal.login-registration-form')
    <!--====== Add to Cart Modal ======-->
    @include('frontend.components.modal.add-to-card')
    <!--====== End - Add to Cart Modal ======-->

   

@endsection
@push('frontend_script')
    <script type="text/javascript">


        function changeico(id){
            var check=$('#changeico'+id).val();
            if(check=='plus'){
                $('#changeico'+id).val('minus');
                $('#plusicon'+id).css('display','none');
                $('#minusicon'+id).css('display','inline-block');
            }else{
                $('#changeico'+id).val('plus');
                $('#minusicon'+id).css('display','none');
                $('#plusicon'+id).css('display','inline-block');
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
