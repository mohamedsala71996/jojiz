<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    var baseURL = "{{ env('APP_URL') }}";
</script>

<script type="text/javascript">
    var token = $("input[name='_token']").val();
    $(document).ready(function() {


        $(document).ready(function() {
            $(document).on('click', '.QuickLook', function() {
                let product = $(this).data('product');

                $('.product_name').text(product.product_name);

                var variationsHtml = '';
                product.productvariations.forEach(function(variation) {
                    variationsHtml =
                        '<img class="u-img-fluid" id="quickimage" style="width: 300px !important;" src="' +
                        baseURL + '/' +
                        variation.image + '" alt="Product Image" />';
                });

                var smvariationsHtml = '';
                product.productvariations.forEach(function(variation) {
                    smvariationsHtml +=
                        '<img class="u-img-fluid me-2" onclick="setimg(\'' +
                        variation.image +
                        '\')"  style="width: 100px !important;" src="' + baseURL + '/' +
                        variation.image + '" alt="" />';
                });

                // Destroy existing slick instance
                if ($('#pd-o-thumbnail').hasClass('slick-initialized')) {
                    $('#pd-o-thumbnail').slick('unslick');
                }

                // Append new HTML for the slider
                $('#quick-look').find('#pd-o-initiate').empty().append(variationsHtml);
                $('#quick-look').find('#pd-o-thumbnail').empty().append(smvariationsHtml);

                $.ajax({
                    type: 'GET',
                    url: '{{ url('load-details') }}' + '/' + product.slug,
                    success: function(response) {
                        $('#quick2nd').empty().append(response);

                        // Initialize Slick slider after appending content
                        $('#pd-o-thumbnail').slick({
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 2000,
                            infinite: true
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                $('#quick-look').modal('show');
            });
        });


    });

    function setimg(src) {

        $('#quickimage').prop('src', src);
    }

    function buynow(id) {
        var user = $('#user_id').val();
        if (user) {
            var product_id = id;
            var varient_id = $('#varient_id').val();
            var size_id = $('#size_id').val();
            var weight_id = $('#weight_id').val();
            var qty = $('#qty').val();


            $.ajax({
                type: 'POST',
                url: '{{ url('user/cart/add/to/cart') }}',
                data: {
                    _token: token,
                    product_id: product_id,
                    varient_id: varient_id,
                    size_id: size_id,
                    weight_id: weight_id,
                    qty: qty,
                },

                success: function(response) {
                    loadcart();
                    stkyloadcart();
                    toastr.success("@lang('frontend.Item Add To Cart Successfully')");

                },
                error: function(error) {
                    console.log('error');
                }
            });
        } else {
            $('#authenticate').modal('show');
        }
    }

    function buynowRedirectCheckout(id) {
        var user = $('#user_id').val();
        if (user) {
            var product_id = id;
            var varient_id = $('#varient_id').val();
            var size_id = $('#size_id').val();
            var weight_id = $('#weight_id').val();
            var qty = $('#qty').val();


            $.ajax({
                type: 'POST',
                url: '{{ url('user/cart/add/to/cart') }}',
                data: {
                    _token: token,
                    product_id: product_id,
                    varient_id: varient_id,
                    size_id: size_id,
                    weight_id: weight_id,
                    qty: qty,
                },

                success: function(response) {
                    loadcart();
                    stkyloadcart();
                    toastr.success("@lang('frontend.Item Add To Cart Successfully')");
                    window.location.href = '{{ route('user.checkout.page') }}';
                },
                error: function(error) {
                    console.log('error');
                }
            });
        } else {
            $('#authenticate').modal('show');
        }
    }


    function loadexinfo(id, element) {
        // Access the data-colorText attribute
        var colorText = $(element).data('colortext');


        // Check if colorText is correctly retrieved
        console.log('Selected color:', element);
        console.log('Selected color:', colorText);

        // Update the color text in the span
        $('#colorText').text('Color: ' + colorText === null ? "" : colorText);

        // Other AJAX logic remains the same
        var vid = id;
        $('#varient_id').val(id);
        sessionStorage.setItem('varient_id', id);

        var pid = $('#product_id').val();
        $.ajax({
            type: 'GET',
            url: '{{ url('load/varient-data') }}',
            data: {
                _token: token,
                varient_id: vid,
                product_id: pid,
            },
            success: function(response) {
                $('#varientinfo').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }
    // $(document).ready(function() {
    //     // Find the checked radio button and set the color text
    //     var colorText = $("#colortext").data('colortext') || "No color selected";
    //     $('#colorText').text('Color: ' + colorText);
    // });


    // function loadexinfo(id, element) {
    //     var colorText = $(element).data('colortext') || "No color selected";
    //     $('#colorText').text('Color: ' + colorText);

    //     var vid = id;
    //     $('#varient_id').val(id);
    //     sessionStorage.setItem('varient_id', id);

    //     var pid = $('#product_id').val();

    //     $.ajax({
    //         type: 'GET',
    //         url: '{{ url('load/varient-data') }}',
    //         data: {
    //             _token: token,
    //             varient_id: vid,
    //             product_id: pid,
    //         },
    //         success: function(response) {
    //             // Update the varient info (size, weight, etc.)
    //             $('#varientinfo').empty().append(response.varientInfo);

    //             // Update the product images based on the selected color
    //             var images = response.images;
    //             var imageHtml = '';
    //             var thumbnailHtml = '';

    //             images.forEach(function(image) {
    //                 // Main image for zoom view
    //                 imageHtml += `
    //             <div class="pd-o-img-wrap" data-src="{{ asset('') }}${image}">
    //                 <img class="u-img-fluid" src="{{ asset('') }}${image}" data-zoom-image="{{ asset('') }}${image}" alt="Product Image" />
    //             </div>`;

    //                 // Thumbnail
    //                 thumbnailHtml += `
    //             <div>
    //                 <img class="u-img-fluid" style="width:100px!important;" src="{{ asset('') }}${image}" alt="Thumbnail Image" />
    //             </div>`;
    //             });

    //             // Populate images dynamically into the respective divs
    //             $('#pd-o-initiate').empty().append(imageHtml);
    //             $('#pd-o-thumbnail').empty().append(thumbnailHtml);

    //             // Handle size and weight info here (if applicable)
    //             if (response.sizes.length > 0) {
    //                 let sizeHtml = '';
    //                 response.sizes.forEach(function(size) {
    //                     sizeHtml += `
    //                 <div class="size__radio">
    //                     <input type="hidden" name="regularpriceofsize" id="regularpriceofsize${size.size}" value="${size.RegularPrice}">
    //                     <input type="hidden" name="salepriceofsize" id="salepriceofsize${size.size}" value="${size.SalePrice}">
    //                     <input type="radio" id="size${size.size}" name="size" onclick="getsize('${size.id}', ${size.SalePrice})" value="${size.id}" ${(response.size_id == size.id) ? 'checked' : ''} />
    //                     <label class="sizetext size__radio-label" id="sizetext${size.size}" for="size${size.size}" onclick="getsize('${size.id}', ${size.SalePrice})">${size.size}</label>
    //                 </div>`;
    //                 });
    //                 $('.pd-detail__size').html(sizeHtml);
    //             }
    //         },
    //         error: function(error) {
    //             console.log('Error:', error);
    //         }
    //     });
    // }





    function getsize(id, price) {
        $('#size_id').val(id);
        $('#salePrice').text(price);
        var varient_id = $('#varient_id').val();
        var pid = $('#product_id').val();
        $.ajax({
            type: 'GET',
            url: '{{ url('put-data/session') }}',
            data: {
                _token: token,
                size_id: id,
                product_id: pid,
                price: price,
                varient_id: varient_id,
            },

            success: function(response) {
                $('#stock').html(response.stock);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }

    function getweight(id, price) {
        $('#weight_id').val(id);
        $('#salePrice').text(price);
        var varient_id = $('#varient_id').val();
        var pid = $('#product_id').val();
        $.ajax({
            type: 'GET',
            url: '{{ url('put-data/session') }}',
            data: {
                _token: token,
                weight_id: id,
                product_id: pid,
                price: price,
                varient_id: varient_id,
            },

            success: function(response) {},
            error: function(error) {
                console.log('error');
            }
        });
    }

    function loadcart() {
        $.ajax({
            type: 'GET',
            url: '{{ url('load-cart') }}',

            success: function(response) {
                $('#cartinfo').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }
    function stkyloadcart() {
        $.ajax({
            type: 'GET',
            url: '{{ url('stky-load-cart') }}',

            success: function(response) {
                $('.stky_cartinfo').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }
        });
    }

    function loadwishlist() {
        if (Number($('#wishlistcount').text()) > 0) {
            var wn = Number($('#wishlistcount').text());
            $('#wishlistcount').text(wn + 1)
        } else {
            if (Number($('#wlist').text()) > 0) {
                var wl = $('#wlist').text();
                var wn = wl + 1;
                $('#wlist').empty().append('<span class="total-item-round" style="top: 16px;" id="wishlistcount">' +
                    wn + '</span>');
            } else {
                var wn = 1;
                $('#wlist').empty().append('<span class="total-item-round" style="top: 16px;" id="wishlistcount">' +
                    wn + '</span>');
            }

        }


    }

    function minus() {
        var avqty = $('#qty').val();
        if (avqty == 1) {

        } else {
            qty = Number(avqty) - 1;
            $('#qty').val(qty);
        }
    }

    function plus() {
        var avqty = $('#qty').val();
        if (avqty == 10) {

        } else {
            qty = Number(avqty) + 1;
            $('#qty').val(qty);
        }
    }
</script>


<!--====== Vendor Js ======-->
<script src="{{ asset('public/frontend/js') }}/vendor.js"></script>

<script src="https://kit.fontawesome.com/0b2a739660.js" crossorigin="anonymous"></script>

<!--====== jQuery Shopnav plugin ======-->
<script src="{{ asset('public/frontend/js') }}/jquery.shopnav.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}

<!--====== App ======-->
<script src="{{ asset('public/frontend/js') }}/app.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //wishlist add
        $(document).on('click', '.addWishlist', function(e) {
            var authenticated = @json(Auth::user());
            if (authenticated) {
                e.preventDefault();

                let product_id = $(this).data('id');
                let productvariation_id = $(this).data('variationid');
                let size_id = $(this).data('sizeid');
                let weight_id = $(this).data('weightid');
                $.ajax({
                    method: "POST",
                    url: "{{ route('user.wishlist.add.wishlist') }}",
                    data: {
                        _token: _token,
                        product_id: product_id,
                        productvariation_id: productvariation_id,
                        size_id: size_id,
                        weight_id: weight_id
                    },
                    dataType: "JSON",
                    success: function(success) {
                        loadwishlist();
                        toastr.success(success.message)
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else {
                $('#authenticate').modal('show');
            }

        });
        //wishlist remove
        $(document).on('click', '.removeItemWishlist', function(e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            $.ajax({
                method: "POST",
                url: "{{ route('user.wishlist.remove.wishlist') }}",
                data: {
                    _token: _token,
                    product_id: product_id
                },
                dataType: "JSON",
                success: function(success) {
                    loadwishlistview();
                    toastr.success(success.message);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        //All wishlist remove
        $(document).on('click', '.allWishlistRemove', function(e) {
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "{{ route('user.wishlist.all.remove.wishlist') }}",
                data: {
                    _token: _token
                },
                dataType: "JSON",
                success: function(success) {
                    loadwishlistview();
                    toastr.success(success.message);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

    });


    function loadwishlistview() {
        $.ajax({
            type: 'GET',
            url: '{{ url('user/wishlist/load') }}',

            success: function(response) {
                $('#wishlistview').empty().append(response);
            },
            error: function(error) {
                console.log('error');
            }


        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.addToCart', function() {
            var authenticated = @json(Auth::user());

            if (authenticated != null) {
                let slug = $(this).data('slug');
                let product_id = $(this).data('id');
                let product_image = $(this).data('image');
                let product_name = $(this).data('name');
                let product_price = $(this).data('price');
                let addToCartContent = `<div class="success u-s-m-b-30">
                        <div class="success__text-wrap">
                            <i class="fas fa-check"></i>

                             <span>@lang('frontend.Item is added successfully!')</span>
                        </div>
                        <div class="success__img-wrap">
                            <img class="u-img-fluid" src="${product_image}"
                                alt="" />
                        </div>
                        <div class="success__info-wrap">
                            <span class="success__name">${product_name}</span>

                            <span class="success__quantity">@lang('backend.Quantity'): 1</span>
                              @if ($currency->symbol_position == 'left')
                              <span class="success__price">{{ $currency->symbol }} ${product_price}</span>
                              @else
                              <span class="success__price"> ${product_price}{{ $currency->symbol }}</span>

                            @endif
                        </div>
                    </div>`;
                $('.product_content').html(addToCartContent);
                $('.productDetailsLink').prop('href', 'product/details/' + slug);
                loadcart();
                stkyloadcart();
                $('#add-to-cart').modal('show');
            } else {
                $('#authenticate').modal('show');
            }

        });

        $(document).on('click', '.addToCart', function() {
            let product_id = $(this).data('id');
            let color = $(this).data('color');
            let size = $(this).data('size');
            let price = $(this).data('price');
            let varient_id = $(this).data('varientid');
            let size_id = $(this).data('sizeid');
            let weight_id = $(this).data('weightid');

            let user = $(this).data('userid');
            console.log(user);

            $.ajax({
                method: "POST",
                url: "{{ route('user.cart.add.to.cart') }}",
                data: {
                    _token: _token,
                    product_id: product_id,
                    color: color,
                    size: size,
                    price: price,
                    qty: 1,
                    varient_id: varient_id,
                    size_id: size_id,
                    weight_id: weight_id
                },
                dataType: "JSON",
                success: function(success) {
                    loadcart();
                    stkyloadcart();
                    toastr.success(success.message);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });
</script>

@stack('user_script')
