@extends('admin.layouts.master')
@section('admin_content')
    <div class="modal-body product-details product-info-body">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    @lang('backend.Product Details')
                </h1>
            </div>
            <div class="modal-body product-info-body">
                <form>
                    <div class="modal-body ">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="modal-product-image modal-product-details-image">
                                            <img src="{{ asset($product->productvariations[0]->image) }}" class="big-image"
                                                id="zoom"
                                                xoriginal="{{ asset($product->productvariations[0]->image) }}"
                                                style="visibility: visible;">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="xzoom-thumbs">
                                            <div class="row">
                                                @foreach ($product->productvariations as $productvariation)
                                                    @foreach ($productvariation->productvariationimages as $image)
                                                        <div class="col-lg-4 col-4">
                                                            <div class="modal-product-image3">
                                                                <img class="small-images"
                                                                    src="{{ asset($image->image_path) }}"
                                                                    xpreview="{{ asset($image->image_path) }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <!--====== Product Right Side Details ======-->
                                <div class="pd-detail">
                                    <div class="product-info  p-3 mt-2">
                                        <div class="pd-text">
                                            <h6 class="pd-detail__name">@lang('backend.Product Info') :</h6>
                                        </div>
                                        <div class="pd-text">
                                            <h5 class="pd-detail__name">{{ $product->product_name }}</h5>
                                            @if ($currency->symbol_position == 'left')
                                                <h6 class="mt-3"><span
                                                        class="details-price">{{ $currency->symbol }}{{ $product->sizes[0]->RegularPrice }}</span>
                                                </h6>
                                            @else
                                                <h6 class="mt-3"><span
                                                        class="details-price">{{ $product->sizes[0]->RegularPrice }}{{ $currency->symbol }}</span>
                                                </h6>
                                            @endif
                                        </div>
                                        <div class="pd-detail__inline">
                                            <h6>@lang('backend.Product Sku'): <span
                                                    class="pd-detail__sku">{{ $product->product_sku }}</span>
                                            </h6>

                                            <h6>@lang('backend.Category') :<span
                                                    class="pd-category">{{ $product->category->category_name }}</span></h6>
                                            <h6>@lang('backend.Sub Category'): <span
                                                    class="pd-sub_category">{{ $product->subcategory?->name ?? 'No Sub Category' }}</span>
                                            </h6>
                                            <h6>@lang('backend.Brand') : <span
                                                    class="pd-brand">{{ $product->brand?->name ?? 'No Brand' }}</span></h6>
                                            <h6>@lang('backend.Shipping Type') : <span
                                                    class="pd-shipping_type">{{ $product->shipping_type ?? 'No Shipping Type' }}
                                                </span></h6>
                                        </div>
                                    </div>

                                    {{-- <div class="variation-info u-s-m-b-15  p-3 mt-2">
                                        <div class="pd-text">
                                            <h6 class="pd-detail__name">Variation Info:</h6>
                                        </div>
                                        <div class="u-s-m-b-15 variation-text">
                                            <span class="pd-detail__label u-s-m-b-8">Color:</span>
                                            <div class="pd-detail__color d-flex">
                                                <div class="color__radio">
                                                    <input type="radio" id="colorRed" checked="" value="1"
                                                        name="color" onclick="loadexinfo('1','0')">
                                                    <label class="color__radio-label" id="colortextRed" for="colorRed"
                                                        style="background-color: Red" onclick="loadexinfo('1','0')"></label>
                                                </div>
                                                <div class="color__radio">
                                                    <input type="radio" id="colorGray" value="6" name="color"
                                                        onclick="loadexinfo('6','1')">
                                                    <label class="color__radio-label" id="colortextGray" for="colorGray"
                                                        style="background-color: Gray"
                                                        onclick="loadexinfo('6','1')"></label>
                                                </div>
                                                <div class="color__radio">
                                                    <input type="radio" id="colorBlack" value="7" name="color"
                                                        onclick="loadexinfo('7','2')">
                                                    <label class="color__radio-label" id="colortextBlack" for="colorBlack"
                                                        style="background-color: Black"
                                                        onclick="loadexinfo('7','2')"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="u-s-m-b-0 variation-text" id="varientinfo">
                                            <div class="u-s-m-b-10">
                                                <span class="pd-detail__label u-s-m-b-5">Size:</span>
                                                <div class="pd-detail__size d-flex">
                                                    <div class="size__radio">
                                                        <input type="hidden" name="regularpriceofsize"
                                                            id="regularpriceofsizeXL" value="160">
                                                        <input type="hidden" name="salepriceofsize" id="salepriceofsizeXL"
                                                            value="160">
                                                        <input type="radio" id="sizeXL" name="size"
                                                            onclick="getsize('1',160)" value="1">
                                                        <label class="sizetext size__radio-label" id="sizetextXL"
                                                            for="sizeXL" onclick="getsize('1',160)">XL</label>
                                                    </div>
                                                    <div class="size__radio">
                                                        <input type="hidden" name="regularpriceofsize"
                                                            id="regularpriceofsizeL" value="150">
                                                        <input type="hidden" name="salepriceofsize"
                                                            id="salepriceofsizeL" value="150">
                                                        <input type="radio" id="sizeL" name="size"
                                                            onclick="getsize('7',150)" value="7">
                                                        <label class="sizetext size__radio-label" id="sizetextL"
                                                            for="sizeL" onclick="getsize('7',150)">L</label>
                                                    </div>
                                                    <div class="size__radio">
                                                        <input type="hidden" name="regularpriceofsize"
                                                            id="regularpriceofsizeM" value="150">
                                                        <input type="hidden" name="salepriceofsize"
                                                            id="salepriceofsizeM" value="150">
                                                        <input type="radio" id="sizeM" name="size"
                                                            onclick="getsize('8',150)" value="8">
                                                        <label class="sizetext size__radio-label" id="sizetextM"
                                                            for="sizeM" onclick="getsize('8',150)">M</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pd-detail-inline-2">
                                            <input type="hidden" name="varient_id" id="varient_id" value="1">
                                            <input type="hidden" name="size_id" id="size_id" value="1">
                                            <input type="hidden" name="weight_id" id="weight_id" value="">
                                            <input type="hidden" name="user_id" id="user_id" value="1">
                                            <input type="hidden" name="product_id" id="product_id" value="1">
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__stock">200 in stock</span>

                                                <span class="pd-detail__left">Only 2 left</span>
                                            </div>
                                        </div>
                                        <div class="u-s-m-b-15">
                                            <div class="pd-detail__rating gl-rating-style">
                                                <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                                    aria-hidden="true"></i><i class="fas fa-star"
                                                    aria-hidden="true"></i><i class="fas fa-star"
                                                    aria-hidden="true"></i><i class="fas fa-star-half-alt"
                                                    aria-hidden="true"></i>

                                                <span class="pd-detail__review u-s-m-l-4">
                                                    <a href="product-detail.html">23 Reviews</a></span>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="product-description mt-2 p-3">
                                        <div class=" u-s-m-b-15 ">
                                            <h6>@lang('frontend.Product Description') : </h6>
                                            <span class="pd-detail__preview-desc">{!! $product->product_description !!}</span>
                                        </div>

                                        {{-- <div class="u-s-m-b-15 mt-2">
                                            <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                            <ul class="pd-detail__policy-list">
                                                <li>
                                                    <i class="fas fa-check-circle u-s-m-r-8" aria-hidden="true"></i>

                                                    <span>Buyer Protection.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle u-s-m-r-8" aria-hidden="true"></i>

                                                    <span>Full Refund if you don't receive your
                                                        order.</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-check-circle u-s-m-r-8" aria-hidden="true"></i>

                                                    <span>Returns accepted if product not as
                                                        described.</span>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    </div>

                                </div>
                                <!--====== End - Product Right Side Details ======-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="variation-part create-variation-part ">
            <div class="row table-responsive">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('backend.ID')</th>
                                <th>@lang('backend.Image')</th>
                                <th>@lang('backend.Color')</th>
                                <th>@lang('backend.Size')</th>
                                {{-- <th>@lang("backend.Action")</th> --}}
                            </tr>
                        </thead>
                        <tbody id="">
                            @foreach ($product->productvariations as $productvariation)
                                <tr class="tr-bg-2">
                                    <td>
                                        <a href="javascript:void(0)">{{ $loop->index + 1 }}</a>
                                    </td>
                                    <td>
                                        <img class="img-fluid" src="{{ asset($productvariation->image) }}" alt="">
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $productvariation->color }}</span>
                                    </td>

                                    <td>
                                        @foreach ($productvariation->sizes as $size)
                                            <span class="text-muted">@lang('backend.Size'): {{ $size->size }},
                                                @lang('backend.Price'): {{ $size->SalePrice }}, @lang('backend.Stock') :
                                                {{ $size->total_stock }}</span><br>
                                        @endforeach

                                    </td>

                                    {{-- <td>
                                    <span>{{$productvariation}}</span>
                                    <button type="button" class="label gradient-10 rounded" data-id="1"
                                        data-status="Active" id="variationstatus">@lang("backend.Action")</button>

                                </td> --}}
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
