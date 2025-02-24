<div class="col-lg-3 col-md-12 d-none d-lg-block">
    <div class="shop-w-master shop-sidebar">
        <h1 class="shop-w-master__heading u-s-m-b-15">
            <i class="fas fa-filter u-s-m-r-8" aria-hidden="true"></i>

            <span>@lang('frontend.FILTERS')</span>
        </h1>
        <div class="shop-w-master__sidebar">
            <div class="u-s-m-b-15">
                <div class="shop-w shop-w--style">
                    <div class="shop-w__intro-wrap">
                        <h1 class="shop-w__h">@lang('frontend.CATEGORY') </h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-category" data-toggle="collapse"
                            aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-category">
                        <ul class="shop-w__category-list gl-scroll">
                            @foreach ($categories as $category)
                                <li>
                                    <img style="border-radius: 5px" width="20px" src="{{ asset($category->image) }}"
                                        alt="">
                                    <a href="#" class="shop collapse show" data-toggle="collapse"
                                        onclick="changeico('{{ $category->id }}')"
                                        data-target="#id{{ $category->id }}"><span>{{ $category->category_name }}
                                            ({{ App\Models\Admin\Product::where('category_id', $category->id)->get()->count() }})
                                        </span>
                                        <span style="float: right;padding-top: 3.4px;">
                                            <input type="hidden" id="changeico{{ $category->id }}" value="plus">
                                            <i class="fas fa-plus" aria-hidden="true" id="plusicon{{ $category->id }}"
                                                style="    color: gray;font-size: 12px;"></i>
                                            <i class="fas fa-minus minusicon" aria-hidden="true"
                                                id="minusicon{{ $category->id }}"
                                                style="    color: gray;font-size: 12px;"></i>
                                        </span>
                                    </a>
                                    <ul class="shop collapse" id="id{{ $category->id }}">
                                        @foreach ($category->subcategoris as $subcategory)
                                            <li style="padding-left: 15px; padding-top:20px; padding-bottom:10px">
                                                <img width="20px" style="border-radius: 5px"
                                                    src="{{ asset($subcategory->image) }}" alt="">
                                                <a
                                                    href="{{ url('subcategory', $subcategory->slug) }}">{{ $subcategory->name }}</a>
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
                        <h1 class="shop-w__h">@lang('frontend.RATING')</h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-rating" data-toggle="collapse"
                            aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-rating">
                        <ul class="shop-w__list gl-scroll">
                            <li onclick="loadreviewproduct(5)">
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i
                                            class="fas fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <span
                                    class="shop-w__total-text">({{ \App\Models\Review::where('rating', 5)->count() }})</span>
                            </li>
                            <li onclick="loadreviewproduct(4)">
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i
                                            class="fas fa-star" aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span
                                    class="shop-w__total-text">({{ \App\Models\Review::where('rating', 4)->count() }})</span>
                            </li>
                            <li onclick="loadreviewproduct(3)">
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i
                                            class="far fa-star" aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span
                                    class="shop-w__total-text">({{ \App\Models\Review::where('rating', 3)->count() }})</span>
                            </li>
                            <li onclick="loadreviewproduct(2)">
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star"
                                            aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i
                                            class="far fa-star" aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span
                                    class="shop-w__total-text">({{ \App\Models\Review::where('rating', 2)->count() }})</span>
                            </li>
                            <li onclick="loadreviewproduct(1)">
                                <div class="rating__check">
                                    <input type="checkbox">
                                    <div class="rating__check-star-wrap">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i
                                            class="far fa-star" aria-hidden="true"></i><i class="far fa-star"
                                            aria-hidden="true"></i>

                                        <span>&amp; Up</span>
                                    </div>
                                </div>

                                <span
                                    class="shop-w__total-text">({{ \App\Models\Review::where('rating', 1)->count() }})</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="u-s-m-b-15">
                <div class="shop-w shop-w--style">
                    <div class="shop-w__intro-wrap">
                        <h1 class="shop-w__h">@lang('frontend.BRANDS') </h1>

                        <span class="fas fa-minus shop-w__toggle" data-target="#s-manufacturer"
                            data-toggle="collapse" aria-hidden="true"></span>
                    </div>
                    <div class="shop-w__wrap collapse show" id="s-manufacturer">
                        <ul class="shop-w__list-2">
                            @foreach ($brands as $brand)
                                <li onclick="loadbproduct({{ $brand->id }})">
                                    <div class="list__content">
                                        <input type="checkbox">

                                        <span style="background: none;">{{ $brand->name }}</span>
                                    </div>

                                    @if (isset($id))
                                        <span
                                            class="shop-w__total-text">({{ App\Models\Admin\Product::where('category_id', $id)->where('brand_id', $brand->id)->get()->count() }})</span>
                                        <span
                                            class="shop-w__total-text">({{ App\Models\Admin\Product::where('brand_id', $brand->id)->get()->count() }})</span>
                                    @else
                                        <span
                                            class="shop-w__total-text">({{ App\Models\Admin\Product::where('brand_id', $brand->id)->get()->count() }})</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- csrf --}}
<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<script>
    var token = $("input[name='_token']").val();

    function loadreviewproduct(rating) {
        $('#processing').modal('show');

        $.ajax({
            type: 'GET',
            url: '{{ url('get/products/by-rating') }}',
            data: {
                _token: token,
                rating: rating,
            },

            success: function(response) {
                $('#processing').modal('hide');
                $('#productview').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }

    function loadscproduct(subcategory_id) {
        $('#processing').modal('show');

        $.ajax({
            type: 'GET',
            url: '{{ url('get/products/by-subcategory') }}',
            data: {
                _token: token,
                subcategory_id: subcategory_id,
            },

            success: function(response) {
                $('#processing').modal('hide');
                $('#productview').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }

    function loadbproduct(brand_id) {
        $('#processing').modal('show');


        $.ajax({
            type: 'GET',
            url: '{{ url('get/products/by-brand') }}',
            data: {
                _token: token,
                brand_id: brand_id,
            },

            success: function(response) {
                console.log(response);
                $('#processing').modal('hide');
                $('#productview').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }

    function resetdatasc(data) {
        $.ajax({
            type: 'GET',
            url: '{{ url('reset/data/sc') }}',
            data: {
                _token: token,
                data: data,
            },

            success: function(response) {
                loadscproduct();
            },
            error: function(error) {
                console.log('error');
            }
        });
    }

    function resetdatab(data) {
        $.ajax({
            type: 'GET',
            url: '{{ url('reset/data/b') }}',
            data: {
                _token: token,
                data: data,
            },

            success: function(response) {
                loadscproduct();
            },
            error: function(error) {
                console.log('error');
            }
        });
    }


    function resetdatastar(data) {
        $.ajax({
            type: 'GET',
            url: '{{ url('reset/data/star') }}',
            data: {
                _token: token,
                data: data,
            },

            success: function(response) {
                loadscproduct();
            },
            error: function(error) {
                console.log('error');
            }
        });
    }
</script>
