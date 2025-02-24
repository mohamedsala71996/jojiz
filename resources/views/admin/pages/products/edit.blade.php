@extends('admin.layouts.master');

@section('admin_content')
    <style>
        .size-input .extra-large {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-size {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-color {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-weight {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-code {
            padding: 15px;
            margin-right: 4px;
        }

        .note-editable p {
            text-align: left !important;
        }
    </style>
    <div class="page-content">
        <div class="row">
            <div class="content-body">
                <div class=" mt-3">
                    <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                        <div class="modal-content rounded h-100">
                            <div class="modal-body modal-part">
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="card">
                                                <div class="add-top-header">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="add-header-content">
                                                                        <h4>@lang('backend.Overview')</h4>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-header">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <h5 class="modal-title card-title">
                                                                @lang('backend.Edit product')
                                                            </h5>
                                                        </div>

                                                        <div class="col-lg-4">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-part-main">
                                                                    @include('admin.components.product.edit.tab')
                                                                    @include('admin.components.product.edit.tab-content')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editvariation" aria-labelledby="editvariation" aria-hidden="true">
        <div class="modal-dialog">
            <form action=" " id="editvariationForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content" id="editvariationmodel">

                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="viewvariation" aria-labelledby="viewvariation" aria-hidden="true">
        <div class="modal-dialog">
            <form action=" " id="viewvariationForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content" id="viewvariationmodel">

                </div>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#product_description').summernote({
                    placeholder: 'Write Product Description',
                    tabsize: 2,
                    height: 100
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                loadvariation($('#product_id').val());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#choosecolor').select2();
                $('#choosecode').select2();
                $(document).on("click", "#submit", function() {
                    var product_id = $("#product_id");
                    var product_sku = $("#product_sku");
                    var product_name = $("#product_name");
                    var category_id = $("#category_id");
                    var status = $("#status");
                    var type = $("#type");
                    var sub_category_id = $("#sub_category_id");
                    var child_category_id = $("#child_category_id");
                    var brand_id = $("#brand_id");
                    var product_description = $("#product_description");
                    var gander = $('input[name="gander"]:checked').val();
                    var shipping_type = $('input[name="shipping_type"]:checked').val();
                    var shippig_cost = $("#shippig_cost");
                    var shipping_rtn_policy = $("#shipping_rtn_policy");
                    var offer_start = $("#offer_start");
                    var offer_end = $("#offer_end");
                    var discount_percent = $("#discount_percent");
                    var multiple_qty = $('input[name="multiple_qty"]:checked').val();
                    var meta_name = $("#meta_name");
                    var meta_title = $("#meta_title");
                    var meta_keywords = $("#meta_keywords");
                    var meta_description = $("#meta_description");
                    var youtube_embadecode = $("#youtube_embadecode");
                    var supplier_id = $("#supplier_id");
                    var advance_payment_amount = $("#advance_payment_amount");

                    if (product_name.val() == '') {
                        toastr.error("@lang('backend.Product Name Should Not Be Empty')");
                        product_name.css('border', '1px solid red');
                        return;
                    }
                    product_name.css('border', '1px solid #ced4da');

                    // if (product_sku.val() == '') {
                    //     toastr.error('Product Sku Should Not Be Empty');
                    //     product_sku.css('border', '1px solid red');
                    //     return;
                    // }
                    product_sku.css('border', '1px solid #ced4da');

                    if (category_id.val() == '') {
                        toastr.error("@lang('backend.Category Should Not Be Empty')");
                        category_id.closest('.form-group').css('border', '1px solid red');
                        return;
                    }
                    category_id.closest('.form-group').css('border', '1px solid #ced4da');

                    if (sub_category_id.val() == '') {
                        toastr.error("@lang('backend.Category Should Not Be Empty')");
                        sub_category_id.closest('.form-group').css('border', '1px solid red');
                        return;
                    }
                    sub_category_id.closest('.form-group').css('border', '1px solid #ced4da');

                    if (product_description.val() == '') {
                        toastr.error("@lang('backend.Product Description Should Not Be Empty')");
                        product_description.css('border', '1px solid red');
                        return;
                    }
                    product_description.css('border', '1px solid #ced4da');

                    var formData = new FormData();

                    formData.append('product_id', product_id.val());
                    formData.append('product_sku', product_sku.val());
                    formData.append('product_name', product_name.val());
                    formData.append('category_id', category_id.val());
                    formData.append('status', status.val());
                    formData.append('type', type.val());
                    formData.append('sub_category_id', sub_category_id.val());
                    formData.append('child_category_id', child_category_id.val());
                    formData.append('brand_id', brand_id.val());
                    formData.append('product_description', product_description.val());
                    formData.append('gander', gander);
                    formData.append('shipping_type', shipping_type);
                    formData.append('shippig_cost', shippig_cost.val());
                    formData.append('shipping_rtn_policy', shipping_rtn_policy.val());
                    formData.append('offer_start', offer_start.val());
                    formData.append('offer_end', offer_end.val());
                    formData.append('discount_percent', discount_percent.val());
                    formData.append('multiple_qty', multiple_qty);
                    formData.append('meta_name', meta_name.val());
                    formData.append('meta_title', meta_title.val());
                    formData.append('meta_keywords', meta_keywords.val());
                    formData.append('meta_description', meta_description.val());
                    formData.append('youtube_embadecode', youtube_embadecode.val());
                    formData.append('supplier_id', supplier_id.val());
                    formData.append('advance_payment_amount', advance_payment_amount.val());
                    formData.append('meta_image', $('#meta_image')[0].files[0]);


                    $.ajax({
                        type: "POST",
                        url: '{{ url('admin/product/store') }}',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            $('#product_id').val(data.id);
                            toastr.success("@lang('backend.Product Update successfully')");
                        }
                    });
                });


                $(document).on("click", "#addvarition", function() {
                    var product_id = $("#product_id");
                    var color_id = $("#color_id");
                    var code_id = $("#code_id");

                    var size = [];
                    var sizeCount = 0;
                    var sizeValidationFailed = false;
                    $("#sizeTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};

                        var sizeID = currentRow.find("#sizeID").val();
                        var sizeValue = currentRow.find("#size").val();
                        var regularPrice = currentRow.find("#RegularPrice").val();
                        var discount = currentRow.find("#Discount").val();
                        var stock = currentRow.find("#Stock").val();
                        var buy_price = currentRow.find("#buy_price").val();
                        console.log(regularPrice, discount, stock, buy_price);
                        // Check each field for specific validation
                        if (!sizeID) {
                            toastr.error("@lang('backend.Size ID cannot be empty.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!sizeValue) {
                            toastr.error("@lang('backend.Size cannot be empty.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!regularPrice || regularPrice == 0) {
                            toastr.error("@lang('backend.Regular Price cannot be empty or zero.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(regularPrice)) {
                            toastr.error("@lang('backend.Regular Price should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!discount) {
                            toastr.error("@lang('backend.Discount cannot be empty.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(discount)) {
                            toastr.error("@lang('backend.Discount should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!stock || stock == 0) {
                            toastr.error("@lang('backend.Stock cannot be empty or zero.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(stock)) {
                            toastr.error("@lang('backend.Stock should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(buy_price)) {
                            toastr.error("@lang('backend.Buy price should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }

                        obj.sizeID = sizeID;
                        obj.size = sizeValue;
                        obj.RegularPrice = regularPrice;
                        obj.Discount = discount;
                        obj.Stock = stock;
                        obj.buy_price = buy_price;

                        size.push(obj);
                        sizeCount++;
                    });

                    if (sizeValidationFailed) return; // Prevent form s
                    // $("#sizeTable tbody tr").each(function(index, value) {
                    //     var currentRow = $(this);
                    //     var obj = {};
                    //     obj.sizeID = currentRow.find("#sizeID").val();
                    //     obj.size = currentRow.find("#size").val();
                    //     obj.RegularPrice = currentRow.find("#RegularPrice").val();
                    //     obj.Discount = currentRow.find("#Discount").val();
                    //     obj.Stock = currentRow.find("#Stock").val();
                    //     size.push(obj);
                    //     sizeCount++;
                    // });

                    var weight = [];
                    var weightCount = 0;
                    $("#weightTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};
                        obj.weightID = currentRow.find("#weightID").val();
                        obj.weight = currentRow.find("#weight").val();
                        obj.RegularPrice = currentRow.find("#RegularPrice").val();
                        obj.Discount = currentRow.find("#Discount").val();
                        obj.Stock = currentRow.find("#Stock").val();
                        weight.push(obj);
                        weightCount++;
                    });

                    if (product_id.val() == '') {
                        toastr.error("@lang('backend.Product ID Should Not Be Empty')");
                        return;
                    }

                    if ($('#photo').val() == '') {
                        toastr.error("@lang('')");
                        return;
                    }
                    if ($('#color_id').val() == '') {
                        toastr.error("@lang('backend.Photo Should Not Be Empty')");
                        return;
                    }
                    if (sizeCount == 0) {
                        toastr.error("@lang('backend.At least one size should be added.')");
                        return;
                    }


                    if (sizeCount == 0) {
                        toastr.error("@lang('backend.Variation Should Not Be Empty')");
                        return;
                    }
                    var formData = new FormData();

                    formData.append('product_id', product_id.val());
                    formData.append('color_id', color_id.val());
                    formData.append('code_id', code_id.val());
                    formData.append('photo', $('#photo')[0].files[0]);
                    // console.log(formData, $('#photo')[0].files[0], $('#photo')[0], $('#photo'));
                    var photos = $('#photo')[0].files;
                    for (var i = 0; i < photos.length; i++) {
                        formData.append('photos[]', photos[i]); // Using 'photos[]' to handle multiple files
                    }

                    size.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`size[${index}][${key}]`, value);
                        });
                    });
                    weight.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`weight[${index}][${key}]`, value);
                        });
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{ url('admin/product/variation') }}',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(response) {
                            if (response == 'exist') {
                                toastr.error("@lang('backend.Opps! Already have a colour variation in our lists')");
                            } else {
                                $('#sizeTableData').find("tr").remove();
                                $('#weightTableData').find("tr").remove();
                                $('#photo').val('');
                                $('#productImage').attr('src', '../../../public/dumy.jpg');
                                $('.big-image').attr('src', '../../../public/dumy.jpg');

                                // Clear other form inputs for color and code
                                $('#color_id').val('');
                                $('#code_id').val('');
                                // Update the select2 display text for the color selection
                                var updatedColorText =
                                    "Select Color From The Box"; // Replace with your dynamic color name if available
                                $('#select2-choosecolor-container').text(updatedColorText);
                                $('#select2-choosecolor-container').attr('title', updatedColorText);


                                toastr.success("@lang('backend.Variation added successfully')");

                                loadvariation(product_id.val());
                            }
                        }
                    });
                });

                // $(document).on("click", "#updatevariation", function() {
                //     var product_id = $("#product_id");
                //     var variation_id = $("#variation_id");
                //     var color_id = $("#editcolor_id");
                //     var code_id = $("#editcode_id");

                //     var size = [];
                //     var sizeCount = 0;
                //     $("#editsizeTable tbody tr").each(function(index, value) {
                //         var currentRow = $(this);
                //         var obj = {};
                //         obj.sID = currentRow.find("#sID").val();
                //         obj.sizeID = currentRow.find("#sizeID").val();
                //         obj.size = currentRow.find("#size").val();
                //         obj.RegularPrice = currentRow.find("#RegularPrice").val();
                //         obj.Discount = currentRow.find("#Discount").val();
                //         obj.Stock = currentRow.find("#Stock").val();
                //         obj.buy_price = currentRow.find("#buy_price").val();
                //         size.push(obj);
                //         sizeCount++;
                //     });

                //     var weight = [];
                //     var weightCount = 0;
                //     $("#editweightTable tbody tr").each(function(index, value) {
                //         var currentRow = $(this);
                //         var obj = {};
                //         obj.wID = currentRow.find("#wID").val();
                //         obj.weightID = currentRow.find("#weightID").val();
                //         obj.weight = currentRow.find("#weight").val();
                //         obj.RegularPrice = currentRow.find("#RegularPrice").val();
                //         obj.Discount = currentRow.find("#Discount").val();
                //         obj.Stock = currentRow.find("#Stock").val();
                //         weight.push(obj);
                //         weightCount++;
                //     });

                //     if (variation_id.val() == '') {
                //          toastr.error("@lang('backend.Product ID Should Not Be Empty')");
                //         return;
                //     }

                //     var formData = new FormData();

                //     formData.append('product_id', product_id.val());
                //     formData.append('variation_id', variation_id.val());
                //     formData.append('color_id', color_id.val());
                //     formData.append('code_id', code_id.val());

                //     size.forEach((item, index) => {
                //         Object.entries(item).forEach(([key, value]) => {
                //             formData.append(`size[${index}][${key}]`, value);
                //         });
                //     });
                //     weight.forEach((item, index) => {
                //         Object.entries(item).forEach(([key, value]) => {
                //             formData.append(`weight[${index}][${key}]`, value);
                //         });
                //     });
                //     // formData.append('photo', $('#editphoto')[0].files[0]);
                //     // Handle multiple image upload for update
                //     var photos = $('#editphoto')[0].files;
                //     for (var i = 0; i < photos.length; i++) {
                //         formData.append('photos[]', photos[i]); // Using 'photos[]' to handle multiple files
                //     }


                //     $.ajax({
                //         type: "POST",
                //         url: '{{ url('admin/product/variation-update') }}',
                //         data: formData,
                //         contentType: false,
                //         processData: false,

                //         success: function(data) {
                //             $('#editsizeTableData').find("tr").remove();
                //             $('#editweightTableData').find("tr").remove();
                //             $('#photo').val('');
                //             $('#productImageEdit').attr('src', '../../../public/dumy.jpg');
                //             toastr.success('Variation updated successfully');
                //             loadvariation(product_id.val());
                //         }
                //     });
                // });

                $(document).on("click", "#updatevariation", function() {
                    var product_id = $("#product_id");
                    var variation_id = $("#variation_id");
                    var color_id = $("#editcolor_id");
                    var code_id = $("#editcode_id");

                    var size = [];
                    var sizeCount = 0;
                    $("#editsizeTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};
                        obj.sID = currentRow.find("#sID").val();
                        obj.sizeID = currentRow.find("#sizeID").val();
                        obj.size = currentRow.find("#size").val();
                        obj.RegularPrice = currentRow.find("#RegularPrice").val();
                        obj.Discount = currentRow.find("#Discount").val();
                        obj.Stock = currentRow.find("#Stock").val();
                        obj.buy_price = currentRow.find("#buy_price").val();
                        size.push(obj);
                        sizeCount++;
                    });

                    var weight = [];
                    var weightCount = 0;
                    $("#editweightTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};
                        obj.wID = currentRow.find("#wID").val();
                        obj.weightID = currentRow.find("#weightID").val();
                        obj.weight = currentRow.find("#weight").val();
                        obj.RegularPrice = currentRow.find("#RegularPrice").val();
                        obj.Discount = currentRow.find("#Discount").val();
                        obj.Stock = currentRow.find("#Stock").val();
                        weight.push(obj);
                        weightCount++;
                    });

                    if (variation_id.val() == '') {
                        toastr.error("@lang('backend.Product ID Should Not Be Empty')");
                        return;
                    }

                    var formData = new FormData();
                    formData.append('variation_id', variation_id.val());
                    formData.append('color_id', color_id.val());
                    formData.append('code_id', code_id.val());
                    formData.append('product_id', product_id.val());

                    // Add size data
                    size.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`size[${index}][${key}]`, value);
                        });
                    });

                    // Add weight data
                    weight.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`weight[${index}][${key}]`, value);
                        });
                    });

                    // Handle previously uploaded images
                    var existingImages = [];
                    $("#editImagePreviewContainer img").each(function() {
                        var existingImagePath = $(this).data(
                            'image-path'); // Assuming you store the image path in a data attribute
                        if (existingImagePath) {
                            existingImages.push(existingImagePath);
                        }
                    });
                    formData.append('existingImages', JSON.stringify(
                        existingImages)); // Pass the array of existing image paths

                    // Handle multiple new image uploads
                    var photos = $('#editphoto')[0].files;
                    for (var i = 0; i < photos.length; i++) {
                        formData.append('photos[]', photos[i]); // Using 'photos[]' to handle multiple files
                    }

                    $.ajax({
                        type: "POST",
                        url: '{{ url('admin/product/variation-update') }}',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            $('#editsizeTableData').find("tr").remove();
                            $('#editweightTableData').find("tr").remove();
                            $('#photo').val('');
                            $('#productImageEdit').attr('src', '../../dumy.jpg');
                            toastr.success("@lang('backend.Variation updated successfully')");
                            loadvariation(product_id.val());
                        }
                    });
                });


                //variation Details
                $(document).on('click', '#variationDetails', function() {
                    $variation_id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        url: "../variation/view/" + $variation_id,
                        success: function(res) {
                            $('#viewvariation').modal('show');
                            $('#viewvariationmodel').empty().append(res);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });

                });

                //variation edit
                $(document).on('click', '#variationEdit', function(e) {
                    $variation_id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        url: "../variation/edit/" + $variation_id,
                        success: function(res) {
                            $('#editvariation').modal('show');
                            $('#editvariationmodel').empty().append(res);

                            $('#editchoosecolor').select2({
                                dropdownParent: $("#editcolorpart")
                            });
                            $('#editchoosecode').select2({
                                dropdownParent: $("#editcodepart")
                            });

                            $("#editsizevariantID").select2({
                                dropdownParent: $("#editsizeTable"),
                                placeholder: "@lang('backend.Select a Product Size')",
                                templateResult: function(state) {
                                    if (!state.id) {
                                        return state.text;
                                    }
                                    var $state = $(
                                        '<span>' +
                                        state.text +
                                        "</span>"
                                    );
                                    return $state;
                                },
                                ajax: {
                                    type: 'GET',
                                    url: '{{ url('admin/get/sizes') }}',
                                    processResults: function(data) {
                                        $exe = 0;
                                        $("#editsizeTable tbody tr").each(function(
                                            index, value) {
                                            var currentRow = $(this);
                                            if (currentRow.find("#sizeID")
                                                .val() == 2) {
                                                $exe = 1;
                                            } else {
                                                $exe = 2;
                                            }
                                        });

                                        if ($exe == 1) {
                                            return;
                                        } else {
                                            var data = $.parseJSON(data);
                                            return {
                                                results: data.data
                                            };
                                        }
                                    }
                                }
                            }).trigger("change").on("select2:select", function(e) {
                                if ($exe == 2 && e.params.data.id == 2) {
                                    toastr.error("@lang('backend.You can not select No size right now')");
                                } else {
                                    $("#editsizeTable tbody").append(
                                        "<tr>" +
                                        '<td><input type="text" id="sizeID" style="width:15px;border: none;color: black;" value="' +
                                        e.params.data.id + '" disabled></td>' +
                                        '<td><input type="text" name="size" id="size" style="width:45px;border: none;color: black;" value="' +
                                        e.params.data.text + '" disabled> </td>' +
                                        '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                                        '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;" value="0"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                                        '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;" value="0"> </td>' +
                                        '<td><input type="text" name="buy_price" id="buy_price" class="form-control" style="width:80px;float:left;" value="0"><span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span> </td>' +
                                        '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                                        "</tr>"
                                    );
                                }
                            });

                            $("#editweightvariantID").select2({
                                dropdownParent: $("#editweightTable"),
                                placeholder: "@lang('backend.Select a Product Weight')",
                                templateResult: function(state) {
                                    if (!state.id) {
                                        return state.text;
                                    }
                                    var $state = $(
                                        '<span>' +
                                        state.text +
                                        "</span>"
                                    );
                                    return $state;
                                },
                                ajax: {
                                    type: 'GET',
                                    url: '{{ url('admin/get/weights') }}',
                                    processResults: function(data) {
                                        $exe = 0;
                                        $("#editweightTable tbody tr").each(function(
                                            index, value) {
                                            var currentRow = $(this);
                                            if (currentRow.find("#weightID")
                                                .val() == 3) {
                                                $exe = 1;
                                            } else {
                                                $exe = 2;
                                            }
                                        });

                                        if ($exe == 1) {
                                            return;
                                        } else {
                                            var data = $.parseJSON(data);
                                            return {
                                                results: data.data
                                            };
                                        }
                                    }
                                }
                            }).trigger("change").on("select2:select", function(e) {
                                if ($exe == 2 && e.params.data.id == 3) {
                                    toastr.error('You can not select No weight right now');
                                } else {
                                    $("#editweightTable tbody").append(
                                        "<tr>" +
                                        '<td><input type="text" id="weightID" style="width:80px;border: none;color: black;" value="' +
                                        e
                                        .params.data.id + '" disabled></td>' +
                                        '<td><input type="text" name="weight" id="weight" style="width:80px;border: none;color: black;" value="' +
                                        e.params.data.text + '" disabled> </td>' +
                                        '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                                        '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;" value="0"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                                        '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;" value="0"> </td>' +
                                        '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                                        "</tr>"
                                    );
                                }
                            });
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });


                });


                $(document).on('click', '.confirmDelete', function(e) {
                    e.preventDefault();
                    let variation_id = $(this).data('id');

                    Swal.fire({
                        title: "@lang('backend.Are you sure?')",
                        text: "@lang('backend.You won\'t be able to revert this!')",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "@lang('backend.Yes, delete it!')",
                        cancelButtonText: "@lang('backend.No, cancel!')",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "../veriation-destroy/" + variation_id,
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    if (res.status == 'success') {
                                        Swal.fire({
                                            title: "@lang('backend.Deleted!')!",
                                            text: "@lang('backend.Your file has been deleted.')",
                                            icon: "success"
                                        });
                                        var product_id = $("#product_id");
                                        loadvariation(product_id.val());
                                    }
                                },
                                error: function(err) {
                                    console.log('err');
                                }
                            });

                        }
                    });
                });

                $(document).on('click', '.delete-btnsize', function(e) {
                    e.preventDefault();
                    let weight_id = $(this).data('id');
                    $(this).closest("tr").remove();

                    Swal.fire({
                        title: "@lang('backend.Are you sure?')",
                        text: "@lang('backend.You won\'t be able to revert this!')",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "@lang('backend.Yes, delete it!')",
                        cancelButtonText: "@lang('backend.No, cancel!')",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "../size-destroy/" + weight_id,
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    if (res.status == 'success') {
                                        Swal.fire({
                                            title: "@lang('backend.Deleted!')!",
                                            text: "@lang('backend.Your file has been deleted.')",
                                            icon: "success"
                                        });

                                    }

                                },
                                error: function(err) {
                                    console.log('err');
                                }
                            });

                        }
                    });
                });


                $(document).on('click', '#variationstatus', function() {
                    let variationID = $(this).data('id');
                    let cstatus = $(this).data('status');

                    if (cstatus == 'Active') {
                        var status = 'Inactive';
                    } else {
                        var status = 'Active';
                    }
                    $.ajax({
                        type: 'PUT',
                        url: '../product-variation/status',
                        data: {
                            variation_id: variationID,
                            status: status,
                            '_token': "{{ csrf_token() }}"
                        },

                        success: function(data) {
                            Swal.fire({
                                title: "@lang('backend.Status updated !')",
                                icon: "success",
                            });
                            loadvariation($('#product_id').val());
                        },
                        error: function(error) {
                            console.log('error');
                        }

                    });
                });

                $(document).on('click', '.delete-btnweight', function(e) {
                    e.preventDefault();
                    let weight_id = $(this).data('id');
                    $(this).closest("tr").remove();

                    Swal.fire({
                        title: "@lang('backend.Are you sure?')",
                        text: "@lang('backend.You won\'t be able to revert this!')",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "@lang('backend.Yes, delete it!')",
                        cancelButtonText: "@lang('backend.No, cancel!')",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "../weight-destroy/" + weight_id,
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    if (res.status == 'success') {
                                        Swal.fire({
                                            title: "@lang('backend.Deleted!')!",
                                            text: "@lang('backend.Your file has been deleted.')",
                                            icon: "success"
                                        });

                                    }
                                },
                                error: function(err) {
                                    console.log('err');
                                }
                            });

                        }
                    });
                });

                $("#sizevariantID").select2({
                    placeholder: "@lang('backend.Select a Product Size')",
                    templateResult: function(state) {
                        if (!state.id) {
                            return state.text;
                        }
                        var $state = $(
                            '<span>' +
                            state.text +
                            "</span>"
                        );
                        return $state;
                    },
                    ajax: {
                        type: 'GET',
                        url: '{{ url('admin/get/sizes') }}',
                        processResults: function(data) {
                            $ex = 0;
                            $("#sizeTable tbody tr").each(function(index, value) {
                                var currentRow = $(this);
                                if (currentRow.find("#sizeID").val() == 2) {
                                    $ex = 1;
                                } else {
                                    $ex = 2;
                                }
                            });

                            if ($ex == 1) {
                                return;
                            } else {
                                var data = $.parseJSON(data);
                                return {
                                    results: data.data
                                };
                            }
                        }
                    }
                }).trigger("change").on("select2:select", function(e) {
                    if ($ex == 2 && e.params.data.id == 2) {
                        toastr.error("@lang('backend.You can not select No size right now')");
                    } else {
                        $("#sizeTable tbody").append(
                            "<tr>" +
                            '<td><input type="text" id="sizeID" style="width:15px;border: none;color: black;" value="' +
                            e.params.data.id + '" disabled></td>' +
                            '<td><input type="text" name="size" id="size" style="width:45px;border: none;color: black;" value="' +
                            e.params.data.text + '" disabled> </td>' +
                            '<td><div style="display:flex;"><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></div></td>' +
                            '<td><div style="display:flex;"><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;" value="0"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></div></td>' +
                            '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;" value="0"> </td>' +
                            '<td><div style="display:flex;"><input type="text" name="buy_price" id="buy_price" class="form-control" style="width:80px;float:left;" value="0"><span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span> </div></td>' +
                            '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                            "</tr>"
                        );
                    }
                });

                $("#weightvariantID").select2({
                    placeholder: "@lang('backend.Select a Product Weight')",
                    templateResult: function(state) {
                        if (!state.id) {
                            return state.text;
                        }
                        var $state = $(
                            '<span>' +
                            state.text +
                            "</span>"
                        );
                        return $state;
                    },
                    ajax: {
                        type: 'GET',
                        url: '{{ url('admin/get/weights') }}',
                        processResults: function(data) {
                            $ex = 0;
                            $("#weightTable tbody tr").each(function(index, value) {
                                var currentRow = $(this);
                                if (currentRow.find("#weightID").val() == 3) {
                                    $ex = 1;
                                } else {
                                    $ex = 2;
                                }
                            });

                            if ($ex == 1) {
                                return;
                            } else {
                                var data = $.parseJSON(data);
                                return {
                                    results: data.data
                                };
                            }
                        }
                    }
                }).trigger("change").on("select2:select", function(e) {
                    if ($ex == 2 && e.params.data.id == 3) {
                        toastr.error('You can not select No weight right now');
                    } else {
                        $("#weightTable tbody").append(
                            "<tr>" +
                            '<td><input type="text" id="weightID" style="width:80px;border: none;color: black;" value="' +
                            e
                            .params.data.id + '" disabled></td>' +
                            '<td><input type="text" name="weight" id="weight" style="width:80px;border: none;color: black;" value="' +
                            e.params.data.text + '" disabled> </td>' +
                            '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                            '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;" value="0"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                            '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;" value="0"> </td>' +
                            '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                            "</tr>"
                        );
                    }
                });

                $(document).on("click", ".delete-btn", function() {
                    $(this).closest("tr").remove();
                });


            });

            function loadvariation(id) {
                $.ajax({
                    type: 'GET',
                    url: '../../../admin/product/load-variation',
                    data: {
                        product_id: id,
                    },

                    success: function(response) {
                        $('#variationpart').empty().append(response)
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            }

            function setsubcategory() {
                var sub_id = $('#category_id').val();
                $.ajax({
                    type: 'GET',
                    url: '../../get/subcategory/' + sub_id,

                    success: function(data) {
                        $('#sub_category_id').html('');

                        for (var i = 0; i < data.length; i++) {
                            $('#sub_category_id').append(`
                            <option value="` + data[i].id + `" >` + data[i].name + `</option>
                        `)
                        }
                        setchildcategory();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            }

            function setchildcategory() {
                var sub_category_id = $('#sub_category_id').val();
                $.ajax({
                    type: 'GET',
                    url: '../../get/childcategory/' + sub_category_id,

                    success: function(data) {
                        $('#child_category_id').html('');

                        for (var i = 0; i < data.length; i++) {
                            $('#child_category_id').append(`
                            <option value="` + data[i].id + `" >` + data[i].name + `</option>
                        `)
                        }
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            }


            // var loadFile = function(event) {
            //     var output = document.getElementById('productImage');
            //     console.log(output, event);
            //     output.src = URL.createObjectURL(event.target.files[0]);
            //     output.onload = function() {
            //         URL.revokeObjectURL(output.src) // free memory
            //     }
            // };
            var loadFile = function(event) {
                var files = event.target.files;
                var imagePreviewContainer = document.getElementById('imagePreviewContainer');

                // Clear previous image and previews
                imagePreviewContainer.innerHTML = '';

                // Loop through selected files and display each image
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let img = document.createElement('img');
                    img.classList.add('big-image'); // Add class for styling
                    img.style.width = '100px'; // Adjust size as needed
                    img.style.margin = '5px';
                    img.src = URL.createObjectURL(file);

                    img.onload = function() {
                        URL.revokeObjectURL(img.src); // Free memory
                    };

                    imagePreviewContainer.appendChild(img);
                }
            };

            // var loadFileEdit = function(event) {
            //     console.log(event);
            //     var files = event.target.files;
            //     var imagePreviewContainerEdit = document.getElementById(
            //         'editImagePreviewContainer'); // Assuming a container for edit previews

            //     // Clear previous image previews
            //     imagePreviewContainerEdit.innerHTML = '';

            //     // Loop through selected files and display each image
            //     for (let i = 0; i < files.length; i++) {
            //         let file = files[i];
            //         let img = document.createElement('img');
            //         img.classList.add('big-image'); // Add class for styling
            //         img.style.width = '100px'; // Adjust size as needed
            //         img.style.margin = '5px';
            //         img.src = URL.createObjectURL(file);

            //         img.onload = function() {
            //             URL.revokeObjectURL(img.src); // Free memory
            //         };

            //         // Append each image to the container
            //         imagePreviewContainerEdit.appendChild(img);
            //     }
            // };

            var loadFileEdit = function(event) {
                var files = event.target.files;
                var imagePreviewContainerEdit = document.getElementById('editImagePreviewContainer');

                // Loop through selected files and display each image
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let img = document.createElement('img');
                    img.classList.add('big-image'); // Add class for styling
                    img.style.width = '100px'; // Adjust size as needed
                    img.style.margin = '5px';
                    img.src = URL.createObjectURL(file);

                    img.onload = function() {
                        URL.revokeObjectURL(img.src); // Free memory
                    };

                    // Append each image to the container
                    imagePreviewContainerEdit.appendChild(img);
                }
            };


            function variationImageRemove(imageId, buttonElement) {
                // Find the parent div container (wrapper of image and cross button)
                var imageContainer = document.getElementById('image-' + imageId);

                // Optionally, you can send an AJAX request here to remove the image from the server if necessary
                // Example (using jQuery for simplicity):
                $.ajax({
                    url: "{{ route('admin.product.variation.delete-image') }}", // Your route for image deletion
                    type: 'POST',
                    data: {
                        id: imageId,
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        // If the request is successful, remove the image element from the DOM
                        imageContainer.remove(); // Remove the entire container (image + button)

                        toastr.success(response.success);
                    },
                    error: function(error) {
                        console.error("Error removing image:", error);
                    }
                });

                // For now, let's just remove the image element from the DOM
                imageContainer.remove(); // Remove the entire container (image + button)
            }

            // var loadFileEdit = function(event) {
            //     var files = event.target.files;
            //     var imagePreviewContainerEdit = document.getElementById('editImagePreviewContainer');

            //     // Clear previous image previews
            //     imagePreviewContainerEdit.innerHTML = '';

            //     // Loop through selected files and display each image with a delete button
            //     for (let i = 0; i < files.length; i++) {
            //         let file = files[i];
            //         let imgDiv = document.createElement('div'); // Create a div to hold the image and delete button
            //         imgDiv.style.display = 'inline-block';
            //         imgDiv.style.position = 'relative'; // Make the div a positioning context for the button
            //         imgDiv.style.margin = '5px'; // Space between each image preview

            //         let img = document.createElement('img');
            //         img.classList.add('big-image');
            //         img.style.width = '100px'; // Adjust image size
            //         img.src = URL.createObjectURL(file);

            //         img.onload = function() {
            //             URL.revokeObjectURL(img.src); // Free memory
            //         };

            //         // Create delete button (cross)
            //         let deleteButton = document.createElement('button');
            //         deleteButton.innerHTML = '&times;'; // "×" symbol
            //         deleteButton.classList.add('delete-button');
            //         deleteButton.style.position = 'absolute';
            //         deleteButton.style.top = '5px'; // Position slightly within the image
            //         deleteButton.style.right = '5px';
            //         deleteButton.style.backgroundColor = 'red';
            //         deleteButton.style.color = 'white';
            //         deleteButton.style.border = 'none';
            //         deleteButton.style.borderRadius = '50%'; // Make it round
            //         deleteButton.style.width = '20px';
            //         deleteButton.style.height = '20px';
            //         deleteButton.style.cursor = 'pointer';
            //         deleteButton.style.fontSize = '16px';
            //         deleteButton.style.display = 'flex';
            //         deleteButton.style.justifyContent = 'center';
            //         deleteButton.style.alignItems = 'center';

            //         // Event listener for delete button
            //         deleteButton.onclick = function() {
            //             imagePreviewContainerEdit.removeChild(imgDiv); // Remove the entire div (image + button)
            //         };

            //         // Append image and delete button to the div
            //         imgDiv.appendChild(img);
            //         imgDiv.appendChild(deleteButton);

            //         // Append the div to the container
            //         imagePreviewContainerEdit.appendChild(imgDiv);
            //     }
            // };





            var loadMeta = function(event) {
                var output = document.getElementById('metaimage');
                console.log(output, event);
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };

            function setcode(id) {
                $('.extra-large').css('background', '#EEEEEE');
                var id = $('#choosecode').val();
                $('#var' + id).css('background', '#9bbeff');
                $('#code_id').val(id);
            }

            function setcolor() {
                $('.extra-color').css('background', '#EEEEEE');
                var id = $('#choosecolor').val();
                $('#var' + id).css('background', '#9bbeff');
                $('#color_id').val(id);
            }

            function editsetcode(id) {
                var id = $('#editchoosecode').val();
                $('#editcode_id').val(id);
                console.log(id);
            }

            function editsetcolor() {
                var id = $('#editchoosecolor').val();
                $('#editcolor_id').val(id);
                console.log(id);
            }
        </script>
    @endpush
@endsection
