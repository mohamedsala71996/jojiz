@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Cart'])
    <div class="u-s-p-b-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">
                                @lang('frontend.SHOPPING CART')
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                        <div class="table-responsive">
                            <table class="table-p">
                                <tbody>

                                    <!--====== Row ======-->
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>
                                                <div class="table-p__box">
                                                    <div class="table-p__img-wrap">

                                                        <img class="u-img-fluid"
                                                            src="{{ asset($cart->productvariation->image) }}"
                                                            alt="">
                                                    </div>

                                                    <div class="table-p__info">
                                                        <span class="table-p__name">
                                                            
                                                            <a
                                                                href="{{ route('product.details', $cart->product->slug) }}">{{ $cart->product->product_name }}</a></span>

                                                        <span class="table-p__category">
                                                            <a
                                                                href="{{ route('category.product', $cart->product->category->id) }}">{{ $cart->product->category->category_name }}</a></span>
                                                        <ul class="table-p__variant-list">
                                                            <li>
                                                                <span>@lang('backend.Size'): {{ $cart->size }}</span>
                                                            </li>
                                                            <li>
                                                                <span>@lang('frontend.Color'): {{ $cart->color }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>


                                            </td>
                                            <td>
                                                @if ($currency->symbol_position == 'left')
                                                    <span
                                                        class="table-p__price">{{ $currency->symbol }}{{ $cart->price }}</span>
                                                @else
                                                    <span
                                                        class="table-p__price">{{ $cart->price }}{{ $currency->symbol }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-p__input-counter-wrap">
                                                    <!--====== Input Counter ======-->
                                                    <div class="input-counter" data-id="{{ $cart->id }}"
                                                        data-productid="{{ $cart->product->id }}">
                                                        <span class="input-counter__minus fas fa-minus minus"></span>

                                                        <input class="input-counter__text input-counter--text-primary-style"
                                                            type="text" name="qty" id="qty"
                                                            value="{{ $cart->qty }}" data-min="1" data-max="1000">

                                                        <span class="input-counter__plus fas fa-plus plus"></span>
                                                    </div>
                                                    <!--====== End - Input Counter ======-->
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-p__del-wrap">
                                                    <a class="far fa-trash-alt table-p__delete-link"
                                                        href="{{ route('user.cart.remove.cart.item', $cart->id) }}"></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!--====== End - Row ======-->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 u-s-m-b-30">
                                <div class="f-cart__pad-box">
                                    <div class="u-s-m-b-30">
                                        <table class="f-cart__table">
                                            <tbody>


                                                <tr>
                                                    <td>@lang('frontend.SUBTOTAL')</td>
                                                    @if ($currency->symbol_position == 'left')
                                                    <td class="sub-total">{{ $currency->symbol }} {{ cartSubTotal() }}
                                                    </td>
                                                    @else
                                                    <td class="sub-total"> {{ cartSubTotal() }}{{ $currency->symbol }}
                                                    </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>@lang('frontend.GRAND TOTAL')</td>
                                                    @if ($currency->symbol_position == 'left')
                                                    <td class="total">{{ $currency->symbol }} {{ cartTotal() }}</td>
                                                    @else
                                                    <td class="total">{{ cartTotal() }}{{ $currency->symbol }} </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a class="check-btn btn btn--e-brand-b-2 bg--btn"
                                            href="{{ route('user.checkout.page') }}">
                                            @lang('frontend.PROCEED TO CHECKOUT')
                                        </a>
                                    </div>
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
@push('user_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.input-counter', function(e) {
                e.preventDefault();
                let qty = $(this).find("input[name='qty']").val();
                let cart_id = $(this).data('id');
                let product_id = $(this).data('productid');
                $.ajax({
                    method: "POST",
                    url: "{{ route('user.cart.update.cart.item') }}",
                    data: {
                        _token: _token,
                        cart_id: cart_id,
                        product_id: product_id,
                        qty: qty
                    },
                    dataType: "JSON",
                    success: function(success) {
                        toastr.success(success.message);
                        console.log(success);
                        console.log($('.total'));
                        $('.total').text(success.total);
                        $('.sub-total').text(success.total);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

            });
        });
    </script>
@endpush
