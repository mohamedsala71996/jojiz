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
    <!--====== Add to Cart Modal ======-->
    @include('frontend.components.modal.add-to-card')
    <!--====== End - Add to Cart Modal ======-->

    <!-- side bar panel start -->
    <div id="mySidepanel" class="sidepanel">
        <div class="side-menu-header ">
            <div class="side-menu-close" onclick="closeNav()">
                <i class="fas fa-close" style="float: right;padding: 14px;padding-right: 22px;color: red;"></i>
            </div>
            <div class="side-login px-3 pb-3" style="padding-top: 12px;padding-bottom: 15px; padding-left: 10px;">
                <a href=""></a>
                <a style="font-size: 16px" href="#">FILTERS</a>
            </div>
        </div>
        <div class="shop-w-master__sidebar">
            <div class="u-s-m-b-15">
                <div class="shop-w shop-w--style">
                    <div class="shop-w__intro-wrap">
                        <h1 class="shop-w__h" style="padding: 14px 14px;">@lang("frontend.CATEGORY")</h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-category"
                            data-toggle="collapse" aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-category">
                        <ul class="shop-w__category-list gl-scroll">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#" class="shop collapse show" data-toggle="collapse" onclick="changeico('{{$category->id}}')" data-target="#id{{ $category->id }}"><span>{{ $category->category_name }} ({{App\Models\Admin\Product::where('category_id',$category->id)->get()->count()}}) </span>
                                        <span style="float: right;padding-top: 3.4px;">
                                            <input type="hidden" id="changeico{{$category->id}}" value="plus">
                                            <i class="fas fa-plus" aria-hidden="true" id="plusicon{{$category->id}}" style="    color: gray;font-size: 12px;"></i>
                                            <i class="fas fa-minus minusicon" aria-hidden="true" id="minusicon{{$category->id}}" style="    color: gray;font-size: 12px;"></i>
                                        </span>
                                    </a>
                                    <ul class="shop collapse" id="id{{ $category->id }}">
                                        @foreach ($category->subcategoris as $subcategory)
                                            <li style="padding-left: 15px">
                                                <a href="#">{{ $subcategory->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="u-s-m-b-15">
                <div class="shop-w shop-w--style">
                    <div class="shop-w__intro-wrap">
                        <h1 class="shop-w__h" style="padding: 14px 14px;">@lang("frontend.RATING")</h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-rating"
                            data-toggle="collapse" aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-rating">
                        <ul class="shop-w__list gl-scroll">
                            <li>
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>

                                <span class="shop-w__total-text">(2)</span>
                            </li>
                            <li>
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span class="shop-w__total-text">(8)</span>
                            </li>
                            <li>
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span class="shop-w__total-text">(10)</span>
                            </li>
                            <li>
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span class="shop-w__total-text">(12)</span>
                            </li>
                            <li>
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span class="shop-w__total-text">(1)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="u-s-m-b-15">
                <div class="shop-w shop-w--style">
                    <div class="shop-w__intro-wrap">
                        <h1 class="shop-w__h" style="padding: 14px 14px;">PRICE</h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-price"
                            data-toggle="collapse" aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-price">
                        <form class="shop-w__form-p">
                            <div class="shop-w__form-p-wrap">
                                <div class="mb-0">
                                    <label for="price-min"></label>

                                    <input style="height: 40px !important;" class="input-text input-text--primary-style" type="text"
                                        id="price-min" placeholder="@lang('backend.Min')">
                                </div>
                                <div class="mb-0">
                                    <label for="price-max"></label>

                                    <input style="height: 40px !important;" class="input-text input-text--primary-style" type="text"
                                        id="price-max" placeholder="@lang('backend.Max')">
                                </div>
                                <div>
                                    <button
                                        class="btn btn--icon fas fa-angle-right btn--e-transparent-platinum-b-2"
                                        type="submit" aria-hidden="true"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="u-s-m-b-15">
                <div class="shop-w shop-w--style">
                    <div class="shop-w__intro-wrap">
                        <h1 class="shop-w__h"  style="padding: 14px 14px;">@lang("frontend.BRANDS")</h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-manufacturer"
                            data-toggle="collapse" aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-manufacturer">
                        <ul class="shop-w__list-2">
                            <li>
                                <div class="list__content">
                                    <input type="checkbox" checked="">

                                    <span>Calvin Klein</span>
                                </div>

                                <span class="shop-w__total-text">(23)</span>
                            </li>
                            <li>
                                <div class="list__content">
                                    <input type="checkbox">

                                    <span>Diesel</span>
                                </div>

                                <span class="shop-w__total-text">(2)</span>
                            </li>
                            <li>
                                <div class="list__content">
                                    <input type="checkbox">

                                    <span>Polo</span>
                                </div>

                                <span class="shop-w__total-text">(2)</span>
                            </li>
                            <li>
                                <div class="list__content">
                                    <input type="checkbox">

                                    <span>Tommy Hilfiger</span>
                                </div>

                                <span class="shop-w__total-text">(9)</span>
                            </li>
                            <li>
                                <div class="list__content">
                                    <input type="checkbox">

                                    <span>Ndoge</span>
                                </div>

                                <span class="shop-w__total-text">(3)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- side bar panel end -->

@endsection
@push('frontend_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.QuickLook', function() {
                $('#quick-look').modal('show');
            });
            $(document).on('click', '.addToCart', function() {
                let product_id = $(this).data('id');
                let product_image = $(this).data('image');
                let product_name = $(this).data('name');
                let product_price = $(this).data('price');
                let addToCartContent = `<div class="success u-s-m-b-30">
                            <div class="success__text-wrap">
                                <i class="fas fa-check"></i>

                                <span>Item is added successfully!</span>
                            </div>
                            <div class="success__img-wrap">
                                <img class="u-img-fluid" src="${product_image}"
                                    alt="" />
                            </div>
                            <div class="success__info-wrap">
                                <span class="success__name">${product_name}</span>

                                <span class="success__quantity">Quantity: 1</span>

                                <span class="success__price">${product_price}</span>
                            </div>
                        </div>`;
                $('.product_content').html(addToCartContent);
                $('#add-to-cart').modal('show');
            });


            $(document).on('click', '.addToCart', function() {
                let product_id = $(this).data('id');
                let color = $(this).data('color');
                let size = $(this).data('size');

                $.ajax({
                    method: "POST",
                    url: "{{ route('user.cart.add.to.cart') }}",
                    data: {
                        _token: _token,
                        product_id: product_id,
                        color: color,
                        size: size,
                        qty: 1
                    },
                    dataType: "JSON",
                    success: function(success) {
                        console.log('success');
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });

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
