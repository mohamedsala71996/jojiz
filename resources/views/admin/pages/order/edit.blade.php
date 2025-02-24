@extends('admin.layouts.master')
@php
    $orderStatus = ['Pending', 'Confirmed', 'Ongoing', 'Delivered', 'Canceled', 'Returned', 'Rejected'];
@endphp
@section('admin_content')
    <div class="modal-body product-details product-info-body">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
                @lang('backend.Edit')
            </h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>@lang('backend.Customer Info')</strong>
                    </div>
                    <div class="card-body custom-card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="user_id">@lang('backend.User Name')</label><br>
                                    <select id="user_id" name="user_id" class="form-control">
                                        <option value="{{ $order->user_id }}">{{ $order->name }}</option>
                                    </select>
                                </div>
                            </div>
                            @if (isset($order->seller_id))
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="seller_id">@lang('backend.Seller')</label><br>
                                        <select id="seller_id" name="seller_id" class="form-control">
                                            <option value="{{ $order->seller_id }}">@lang('backend.No Seller Name')</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="invoiceID">@lang('backend.Invoice Number')</label>
                                    <input type="text" readonly class="form-control" style="cursor: not-allowed;"
                                        id="invoiceID" value="{{ $order->invoiceID }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">@lang('backend.Name')</label>
                                    <input type="text" class="form-control" id="name" value="{{ $order->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">@lang('backend.Email')</label>
                                    <input type="text" class="form-control" id="email" value="{{ $order->email }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">@lang('backend.Phone')</label>
                                    <input type="text" class="form-control" id="phone" value="{{ $order->phone }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country">@lang('backend.Country')</label>
                                    <input type="text" class="form-control" id="country" value="{{ $order->country }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="state">@lang('backend.State')</label>
                                    <input type="text" class="form-control" id="state" value="{{ $order->state }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city">@lang('backend.City')</label>
                                    <input type="text" class="form-control" id="city" value="{{ $order->city }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">@lang('backend.Address')</label>
                                    <input type="text" class="form-control" id="address"
                                        value="{{ $order->address }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="zip_code">@lang('backend.Zip Code')</label>
                                    <input type="text" class="form-control" id="zip_code"
                                        value="{{ $order->zip_code }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong>@lang('frontend.Courier Info:') </strong>
                    </div>
                    <div class="card-body custom-card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="courierdatatbl">
                                    <label for="courierID">@lang('backend.Courier Name')</label><br>
                                    <select onchange="getSelectedValue()" id="courierID" class="form-control">
                                        <option value="{{ $order->courier_id }}">{{ $order->courierName }}</option>
                                    </select>

                                    <script>
                                        var couriers = <?php echo json_encode($couriers); ?>;

                                        function getSelectedValue() {
                                            var selectElement = document.getElementById('courierID');
                                            var selectedValue = selectElement.value;

                                            var selectedCourier = couriers.find(courier => courier.id == selectedValue);

                                            // Check if selectedCourier is found to avoid errors
                                            if (selectedCourier) {
                                                // Update the span with the selected courier's charge
                                                document.getElementById('courierCharge').innerText = 'Charge: ' + selectedCourier.charge;
                                                document.getElementById('courierAvailable').innerText = 'Available: ' + selectedCourier.available;
                                            }
                                        }

                                        // Optional: Call the function on page load to display the initial selected value
                                        getSelectedValue();
                                    </script>

                                </div>
                                <span id='courierCharge'></span><br />
                                <span id='courierAvailable'></span>
                            </div>

                            <div class="col-lg-12 ">
                                <div class="form-group" id="aredatatbld">
                                    <label for="areaID">@lang('backend.Hub Name')</label><br>
                                    <input type="text" value="{{ $order->hub_name }}" name="hub_name"
                                        class="form-control" id="hub_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="orderDate">@lang('backend.Order Date')</label>
                                    <input type="text" class="form-control datepicker"
                                        value="{{ $order->orderDate }}" id="orderDate">
                                </div>
                            </div>
                            @if ($order->deliveryDate)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="deliveryDate">@lang('backend.Delivery Date')</label>
                                        <input type="text" class="form-control datepicker" id="deliveryDate"
                                            value="{{ $order->deliveryDate }}">
                                    </div>
                                </div>
                            @endif
                            @if ($order->confirmDate)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirmDate">@lang('backend.Confirm Date')</label>
                                        <input type="text" class="form-control datepicker" id="confirmDate"
                                            value="{{ $order->confirmDate }}">
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="order_note">@lang('backend.Order Note')</label>
                                    <textarea name="order_note" class="form-control" placeholder="@lang('backend.Order Note')" id="order_note" rows="2">{{ $order->order_note }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="order_note">@lang('backend.Order Status')</label>
                                    <select id="status" name="status" class="form-control">
                                        @foreach ($orderStatus as $item)
                                            <option value="{{ $item }}"
                                                @if ($item == $order->status) selected @endif>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>@lang('backend.Product Info')</strong>
                    </div>
                    <div class="card-body custom-card-body">
                        <table id="productTable" style="width: 100% !important;"
                            class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('backend.Image')</th>
                                    <th>@lang('backend.Color')</th>
                                    <th>@lang('backend.Size')</th>
                                    <th>@lang('backend.Product Name')</th>
                                    <th>@lang('backend.Quantity')</th>
                                    <th>@lang('backend.Price')</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($order->orderproducts as $product)
                                    <tr>
                                        <td style="display: none">
                                            <input type="text" class="orderproductID" value="{{ $product->id }}">
                                            <input type="text" class="productID" value="{{ $product->product_id }}">
                                            <input type="text" class="variationID"
                                                value="{{ $product->productvariation_id }}">
                                            <input type="text" class="sizeID" value="{{ $product->size_id }}">
                                            <input type="text" class="codeID" value="{{ $product->code_id }}">
                                            <input type="text" class="weightID" value="{{ $product->weight_id }}">
                                        </td>
                                        <td>
                                            @php
                                                // $image = \App\Models\Productvariation::where(
                                                //     'id',
                                                //     $product->productvariation_id,
                                                // )->first()->image;
                                            @endphp
                                            <img src="{{ asset($product->productvariation->image) }}"
                                                alt="Product Image">
                                        </td>
                                        <td>
                                            <span class="Color">
                                                <input type="text" name="color" id="color"
                                                    value="{{ $product->color }}" style="max-width: 60px;" readonly>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="Size">
                                                <input type="text" name="size" id="size"
                                                    value="{{ $product->size }}" style="max-width: 50px;" readonly>
                                            </span>
                                        </td>

                                        <td><span class="productName">{{ $product->productName }}</span></td>
                                        <td><input type="number" class="qty form-control" style="width:80px;"
                                                value="{{ $product->qty }}" readonly></td>
                                        @if ($currency->symbol_position == 'left')
                                            <td><span class="price">{{ $currency->symbol }}{{ $product->price }}</span>
                                            </td>
                                        @else
                                            <td><span class="price">{{ $product->price }}{{ $currency->symbol }}</span>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                        <br>

                        <br>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="card">

                                    <div class="card-body custom-card-body">
                                        <strong>@lang('backend.Order Note')</strong>
                                        <br>
                                        <table id="orderCommentTable" data-id="{{ $order->id }}"
                                            style="width: 100% !important;" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('backend.Created At')</th>
                                                    <th>@lang('backend.Notes')</th>
                                                    <th>@lang('backend.Staff')</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @if (isset($order->coupon))
                                    <div class="form-group row mb-2">
                                        <label for="fname"
                                            class="col-sm-4 text-right control-label col-form-label">@lang('backend.Coupon')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $order->coupon }}"
                                                id="coupon" readonly>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row mb-2">
                                    <label for="fname"
                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Sub Total')
                                    </label>
                                    <div class="col-sm-8">
                                        <span class="form-control" id="subtotal"
                                            style="cursor: not-allowed;">{{ $order->subTotal }}</span>
                                        {{-- <span class="form-control" id="subtotal"
                                        style="cursor: not-allowed;">{{ $order->subTotal }}</span> --}}
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="fname"
                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Delivery')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ $order->shippingCharge }}"
                                            id="shippingCharge">
                                    </div>
                                </div>
                                @if ($order->vat > 0)
                                    <div class="form-group row mb-2">
                                        <label for="fname"
                                            class="col-sm-4 text-right control-label col-form-label">@lang('backend.Vat')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $order->vat }}"
                                                id="vat" readonly>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" class="form-control" value="0" id="vat" readonly>
                                @endif
                                @if ($order->tax > 0)
                                    <div class="form-group row mb-2">
                                        <label for="fname"
                                            class="col-sm-4 text-right control-label col-form-label">@lang('backend.Tax')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $order->tax }}"
                                                id="tax">
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" class="form-control" value="0" id="tax" readonly>
                                @endif
                                <div class="form-group row mb-2">
                                    <label for="fname"
                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Discount')</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $order->discount }}" class="form-control"
                                            id="discount">
                                    </div>
                                </div>

                                <div class="form-group row paidAmount mb-2">
                                    <label for="fname"
                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Paid Amount')
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $order->paidAmount }}" class="form-control"
                                            id="paidAmount">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="fname"
                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Total Due')</label>
                                    <div class="col-sm-8">
                                        <span class="form-control" id="total"
                                            style="cursor: not-allowed;">{{ $order->due_amount }}</span>

                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <button type="button" id="btn-update" value="{{ $order->id }}"
                                        class="btn btn-block btn-primary"><i class="fa fa-save"></i>
                                        @lang('backend.Update Order')</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).on("click", "#btn-update", function() {
            var id = $(this).val();
            console.log()
            var invoiceID = $("#invoiceID");
            var name = $("#name");
            var email = $("#email");
            var phone = $("#phone");
            var country = $("#country");
            var state = $("#state");
            var city = $("#city");
            var address = $("#address");
            var zip_code = $("#zip_code");
            var courierID = $("#courierID");
            var hub_name = $("#hub_name");
            var cityID = $("#cityID");
            var zoneID = $("#zoneID");
            var areaID = $("#areaID");
            var subtotal = $("#subtotal");
            var orderDate = $("#orderDate");
            var shippingCharge = $("#shippingCharge");
            var vat = $("#vat");
            var tax = $("#tax");
            var discount = $("#discount");
            var paidAmount = $("#paidAmount");
            var total = $("#total");
            var status = $("#status");
            var product = [];
            var productCount = 0;

            $("#productTable tbody tr").each(function(index, value) {
                var currentRow = $(this);
                var obj = {};
                obj.orderproductID = currentRow.find(".orderproductID").val();
                obj.productID = currentRow.find(".productID").val();
                obj.variationID = currentRow.find(".variationID").val();
                obj.sizeID = currentRow.find(".sizeID").val();
                obj.codeID = currentRow.find(".codeID").val();
                obj.weightID = currentRow.find(".weightID").val();
                obj.code = currentRow.find("#code").text();
                obj.color = currentRow.find("#color").val();
                obj.size = currentRow.find("#size").val();
                obj.weight = currentRow.find("#weight").val();
                obj.productName = currentRow.find(".productName").text();
                obj.qty = currentRow.find(".qty").val();
                obj.price = currentRow.find(".price").text();
                product.push(obj);
                productCount++;
            });


            if (invoiceID.val() == '') {
                toastr.error('Invoice ID Should Not Be Empty');
                invoiceID.css('border', '1px solid red');
                return;
            }
            invoiceID.css('border', '1px solid #ced4da');

            if (name.val() == '') {
                toastr.error('Name Should Not Be Empty');
                name.css('border', '1px solid red');
                return;
            }
            name.css('border', '1px solid #ced4da');

            if (phone.val() == '') {
                toastr.error('Phone Should Not Be Empty');
                phone.css('border', '1px solid red');
                return;
            }
            phone.css('border', '1px solid #ced4da');

            if (address.val() == '') {
                toastr.error('Address Should Not Be Empty');
                address.css('border', '1px solid red');
                return;
            }
            address.css('border', '1px solid #ced4da');

            if (orderDate.val() == '') {
                toastr.error('Order Date Should Not Be Empty');
                orderDate.css('border', '1px solid red');
                return;
            }
            orderDate.css('border', '1px solid #ced4da');

            if (productCount == 0) {
                toastr.error('Product Should Not Be Empty');
                return;
            }

            var data = {};
            data["invoiceID"] = invoiceID.val();
            data["name"] = name.val();
            data["email"] = email.val();
            data["phone"] = phone.val();
            data["country"] = country.val();
            data["state"] = state.val();
            data["city"] = city.val();
            data["address"] = address.val();
            data["zip_code"] = zip_code.val();
            data["courierID"] = courierID.val();
            data["hub_name"] = hub_name.val();
            data["cityID"] = cityID.val();
            data["zoneID"] = zoneID.val();
            data["areaID"] = areaID.val();
            data["orderDate"] = orderDate.val();
            data["subtotal"] = subtotal.text();
            data["shippingCharge"] = shippingCharge.val();
            data["vat"] = vat.val();
            data["tax"] = vat.val();
            data["discount"] = discount.val();
            data["paidAmount"] = paidAmount.val();
            data["total"] = total.text();
            data["status"] = status.val();
            data["products"] = product;
            $.ajax({
                type: "POST",
                url: "{{ url('admin/order-update') }}/" + id,
                data: {
                    'data': data,
                    '_token': "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    if (data["status"] === "success") {
                        toastr.success(data["message"]);
                        $('#editOrder').modal('toggle');
                    } else {
                        toastr.error(data["message"]);
                    }
                    location.reload();
                }
            });


        });
    </script>
@endpush
