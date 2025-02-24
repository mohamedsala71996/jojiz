
    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
     <script>
        $(document).on('click', '.addToCart', function() {
            var authenticated = @json(Auth::user());
            var currency = @json($currency->symbol);
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

                            <span class="success__quantity">@lang("backend.Quantity") : 1</span>

                            <span class="success__price">${product_price}</span>
                        </div>
                    </div>`;
                $('.product_content').html(addToCartContent);
                $('.productDetailsLink').prop('href','product/details/'+slug);
                loadcart();
                stkyloadcart()
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
     </script>

      <!--====== Vendor Js ======-->
      <script src="{{asset('public/frontend/js')}}/vendor.js"></script>

      <script src="https://kit.fontawesome.com/0b2a739660.js" crossorigin="anonymous"></script>

      <!--====== jQuery Shopnav plugin ======-->
      <script src="{{asset('public/frontend/js')}}/jquery.shopnav.js"></script>

      <!--====== App ======-->
      <script src="{{asset('public/frontend/js')}}/app.js"></script>

      <!--====== Noscript ======-->
      <noscript>
        <div class="app-setting">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="app-setting__wrap">
                  <h1 class="app-setting__h1">
                    JavaScript is disabled in your browser.
                  </h1>
                  <span class="app-setting__text"
                    >Please enable JavaScript in your browser or upgrade to a
                    JavaScript-capable browser.</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </noscript>
