@extends('admin.layouts.master')

@section('admin_content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            {{-- <i class="bi bi-justify fs-3"></i> --}}
        </a>
    </header>

    <div class="page-heading card-title">
        <h3>@lang('backend.Add Order')</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>@lang('backend.Product Info')</strong>
                        </div>
                        <div class="card-body custom-card-body">
                            <div class="table-responsive">
                                <table id="productTable" style="width: 100% !important;" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.Image')</th>
                                            <th>@lang('backend.Color')</th>
                                            <th>@lang('backend.Size')</th>
                                            <th>@lang('backend.Stock')</th>
                                            <th>@lang('backend.Product Name')</th>
                                            <th>@lang('backend.Quantity')</th>
                                            <th>@lang('backend.Price')</th>
                                            <th>@lang('backend.Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="12">
                                                <select id="productID" style="width: 100%;">
                                                    <option value="">@lang('backend.Select Product')</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-form">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="fname"
                                                        class="col-sm-3 text-left control-label col-form-label">Sub
                                                        Total</label>
                                                    <div class="col-sm-10">
                                                        <span class="form-control" id="subtotal"
                                                            style="cursor: not-allowed;"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-2">
                                                    <label for="fname"
                                                        class="col-sm-3 text-left control-label col-form-label">Delivery</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="5"
                                                            id="deliveryCharge">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group row">
                                                    <label for="fname"
                                                        class="col-sm-3 text-left control-label col-form-label">Discount</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="0" class="form-control"
                                                            id="discountCharge">
                                                    </div>
                                                </div>

                                                <div class="form-group row paymentAmount">
                                                    <label for="fname"
                                                        class="col-sm-4 text-left control-label col-form-label">Payment</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="0" class="form-control"
                                                            id="paymentAmount">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="fname"
                                                        class="col-sm-4 text-left control-label col-form-label">Total</label>
                                                    <div class="col-sm-10">
                                                        <span class="form-control" id="total"
                                                            style="cursor: not-allowed;">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header justify-content-between"
                        style="display: flex; flex-direction:column; margin-bottom:15px; padding-top:20px;  margin-left:10px">
                        <h3 style="color:#607080">@lang('backend.Customer Info')</h3>
                        <strong>INV: {{ $uniqueId }}</strong>
                    </div>
                    <div class="card-body custom-card-body general-form">
                        <div class="row">
                            <input type="hidden" readonly class="form-control" style="cursor: not-allowed;" id="invoiceID"
                                value="{{ $uniqueId }}">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">@lang('backend.Name')</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">@lang('backend.Email')</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">@lang('backend.Phone')</label>
                                    <input type="text" class="form-control" id="phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">@lang('backend.Address')</label>
                                    <textarea name="address" class="form-control" placeholder="@lang('backend.Address')" id="address" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country">@lang('backend.Country')</label>
                                    <input type="text" class="form-control" id="country">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city">@lang('backend.City')</label>
                                    <input type="text" class="form-control" id="city">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="state">@lang('backend.State')</label>
                                    <input type="text" class="form-control" id="state">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="zip_code">@lang('backend.Zip Code')</label>
                                    <input type="text" class="form-control" id="zip_code">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="courierID">@lang('backend.Courier Name')</label>
                                    <select onchange="getSelectedValue()" id="courierID" style="border:none;"
                                        class="form-control">
                                        <option value="">@lang('backend.Courier Name')</option>
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
                                                document.getElementById('createCourierCharge').innerText = 'Charge: ' + selectedCourier.charge;
                                                document.getElementById('createCourierAvailable').innerText = 'Available: ' + selectedCourier.available;
                                            }
                                        }

                                        // Optional: Call the function on page load to display the initial selected value
                                        getSelectedValue();
                                    </script>

                                </div>
                                <span id='createCourierCharge'></span><br />
                                <span id='createCourierAvailable'></span>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hub_name">@lang('backend.Hub Name')</label>
                                    <input type="text" class="form-control" name="hub_name" id="hub_name" required>
                                </div>
                            </div>


                        </div>
                        <span id='createCourierCharge'></span><br />
                        <span id='createCourierAvailable'></span>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="orderDate">@lang('backend.Order Date')</label>
                                    <input type="text" class="form-control datepicker" value="{{ date('Y-m-d') }}"
                                        id="orderDate">
                                </div>
                            </div>
                        </div>
                        <div class="order-btn">
                            <button type="button" id="submit" class="btn btn-primary btn-block"
                                data-style="expand-left">@lang('backend.Add Order')</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $(".paymentID").hide();
            $(".paymentAgentNumber").hide();
            $(".paymentAmount").hide();

            $(document).on("click", "#submit", function() {

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
                var shippingCharge = $("#deliveryCharge");
                var discount = $("#discountCharge");
                var paidAmount = $("#paymentAmount");
                var total = $("#total");
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
                data["discount"] = discount.val();
                data["paidAmount"] = paidAmount.val();
                data["total"] = total.text();
                data["products"] = product;
                $.ajax({
                    type: "POST",
                    url: '{{ url('admin/order/store') }}',
                    data: {
                        'data': data,
                        '_token': token
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data["status"] === "success") {
                            toastr.success(data["message"]);
                            window.location.href = "{{ url('admin/admin_order/Pending') }}";

                        } else {
                            toastr.error(data["message"])
                        }
                    }
                });



            });

            $("#productID").select2({
                placeholder: "@lang('backend.Select a Product')",
                dropdownParent: $('#productTable'),
                allowClear: true,
                templateResult: function(state) {
                    if (!state.id) {
                        return state.product_name;
                    }
                    if (state.weight == '') {
                        var $state = $(
                            '<span><img width="60px" src="' + state.image +
                            '" class="img-flag" /> ' + state.product_name + " (Color: " + state
                            .color + ")" + '" (Size: "' + state.size + ")</span>"
                        );
                    } else {
                        var $state = $(
                            '<span><img width="60px" src="' + state.image +
                            '" class="img-flag" /> ' + state.product_name + " (Color: " + state
                            .color + '" (Weight: "' + state.weight + ")</span>"
                        );
                    }
                    return $state;
                },
                ajax: {
                    type: 'GET',
                    url: '{{ url('admin/order/products') }}',
                    processResults: function(data) {
                        return {
                            results: data.data
                        };
                    }
                }
            }).trigger("change").on("select2:select", function(e) {
                $("#productTable tbody").append(
                    "<tr>" +
                    '<td style="display: none">' +
                    '<input type="hidden" class="orderproductID" value="">' +
                    '<input type="hidden" class="productID" value="' + e.params.data.product_id + '">' +
                    '<input type="hidden" class="variationID" value="' + e.params.data.varient_id +
                    '">' +
                    '<input type="hidden" class="sizeID" value="' + e.params.data.size_id + '">' +
                    '<input type="hidden" class="codeID" value="' + e.params.data.code_id + '">' +
                    '<input type="hidden" class="weightID" value="' + e.params.data.weight_id + '">' +
                    '</td>' +
                    '<td><span class="code" id="image">' + '<img width="60px" src="' + e.params.data
                    .image + '"/>' + '</span></td>' +
                    '<td>' +
                    '<span class="Color">' +
                    '<input type="text" name="color" id="color" value="' + e.params.data.color +
                    '" style="max-width: 60px;">' +
                    '</span>' +
                    '</td>' +
                    '<td>' +
                    '<span class="Size">' +
                    '<input type="text" name="size" id="size" value="' + e.params.data.size +
                    '" style="max-width: 60px;">' +
                    '</span>' +
                    '</td>' +
                    '<td>' +
                    '<span class="Size">' +
                    '<input type="text" name="weight" id="weight" value="' + e.params.data.stock +
                    '" style="max-width: 40px;">' +
                    '</span>' +
                    '</td>' +
                    '<td><span class="productName">' + e.params.data.product_name + '</span></td>' +
                    '<td><input type="number" class="qty form-control" style="width:80px;" value="1"></td>' +
                    '<td><span class="price">' + e.params.data.SalePrice + '</span></td>' +
                    '<td><button class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>' +
                    "</tr>"
                );
                calculation();
                $('#productID').val(null).trigger('change');
            });


            //courier
            $("#courierID").select2({
                placeholder: "Courier",
                ajax: {
                    url: '{{ url('admin/order/couriers') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            }).trigger("change").on("select2:select", function(e) {
                $("#zoneID").empty();
                for (var i = 0; i < couriers.length; i++) {
                    if (couriers[i]['courierName'] == e.params.data.text) {
                        if (couriers[i]['hasCity'] == 'on') {
                            jQuery(".hasCity").show();
                        } else {
                            jQuery(".hasCity").hide();
                        }
                        if (couriers[i]["hasZone"] == 'on') {
                            jQuery(".hasZone").show();
                        } else {
                            jQuery(".hasZone").hide();
                            $("#zoneID").empty();
                        }
                        if (couriers[i]["hasArea"] == 'on') {
                            jQuery(".hasArea").show();
                        } else {
                            jQuery(".hasArea").hide();
                            $("#areaID").empty();
                        }
                    }

                    $("#cityID").empty();
                }

            });

            if ($("#courierID").text()) {
                var courier = $("#courierID").text().trim();
                for (var i = 0; i < couriers.length; i++) {
                    if (couriers[i]['courierName'] == courier) {
                        if (couriers[i]['hasCity'] == 'on') {
                            jQuery(".hasCity").show();
                        } else {
                            jQuery(".hasCity").hide();
                        }

                        if (couriers[i]["hasZone"] == 'on') {
                            jQuery(".hasZone").show();
                        } else {
                            jQuery(".hasZone").hide();
                            $("#zoneID").empty();
                        }
                        if (couriers[i]["hasArea"] == 'on') {
                            jQuery(".hasArea").show();
                        } else {
                            jQuery(".hasArea").hide();
                            $("#areaID").empty();
                        }
                    }
                }
            }

            $("#cityID").select2({
                placeholder: "Select a City",
                ajax: {
                    data: function(params) {
                        var query = {
                            q: params.term,
                            courierID: $("#courierID").val()
                        };
                        return query;
                    },
                    type: 'GET',
                    url: '{{ url('admin/order/cities') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });

            $("#zoneID").select2({
                placeholder: "Select a Zone",
                ajax: {
                    data: function(params) {
                        var query = {
                            q: params.term,
                            courierID: $("#courierID").val(),
                            cityID: $("#cityID").val()
                        };
                        return query;
                    },
                    type: 'GET',
                    url: '{{ url('admin/order/zones') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                        console.log(data);
                    }
                }
            });

            $("#areaID").select2({
                placeholder: "Select a Area",
                ajax: {
                    data: function(params) {
                        var query = {
                            q: params.term,
                            courierID: $("#courierID").val(),
                            zoneID: $("#zoneID").val()
                        };
                        return query;
                    },
                    type: 'GET',
                    url: '{{ url('admin/order/areas') }}',
                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                        console.log(data);
                    }
                }
            });

            $("#paymentTypeID").select2({
                placeholder: "Select a payment Type",
                allowClear: true,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term
                        };
                        console.log(params);
                    },
                    url: '{{ url('admin/order/paymenttype') }}',
                    processResults: function(data) {

                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            }).trigger("change").on("select2:select", function(e) {
                if (e.params.data.text == "") {
                    $(".paymentID").hide();
                    $(".paymentAgentNumber").hide();
                    $(".paymentAmount").hide();
                } else {
                    $(".paymentID").show();
                    $(".paymentAgentNumber").show();
                    $(".paymentAmount").show();
                }
            }).on("select2:unselect", function(e) {
                $(".paymentID").hide();
                $(".paymentAgentNumber").hide();
                $(".paymentAmount").hide();
                calculation();
            });

            $("#paymentID").select2({
                placeholder: "Select a payment Number",
                allowClear: true,
                ajax: {
                    data: function(params) {
                        return {
                            q: params.term,
                            paymentTypeID: $("#paymentTypeID").val(),
                        };
                    },
                    type: 'GET',
                    url: '{{ url('admin/order/paymentnumber') }}',

                    processResults: function(data) {
                        var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            });

            $(document).on("change", ".productQuantity", function() {
                calculation();
            });
            $(document).on("change", ".qty", function() {
                calculation();
            });
            $(document).on("input", "#paymentAmount", function() {
                calculation();
            });
            $(document).on("input", "#deliveryCharge", function() {
                calculation();
            });
            $(document).on("input", "#discountCharge", function() {
                calculation();
            });
            calculation();
            //calculation part
            function calculation() {
                var subtotal = 0;
                var deliveryCharge = +$("#deliveryCharge").val();
                var discountCharge = +$("#discountCharge").val();
                var paymentAmount = +$("#paymentAmount").val();
                $("#productTable tbody tr").each(function(index) {
                    subtotal = subtotal + +$(this).find(".price").text() * +$(this).find(".qty").val();
                });
                $("#subtotal").text(subtotal);
                $("#total").text(subtotal + deliveryCharge - paymentAmount - discountCharge);
            }
            //delete select order
            $(document).on("click", ".delete-btn", function() {
                $(this).closest("tr").remove();
                calculation();
            });




            //change order status
            var token = $("input[name='_token']").val();



            $(".datepicker").flatpickr();




        });
    </script>



    <style>
        .card-box {
            background-color: #fff;
            padding: 1.5rem;
            -webkit-box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
            box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
            margin-bottom: 24px;
            border-radius: 0.25rem;
        }

        a {
            text-decoration: none;
        }
    </style>
@endsection
