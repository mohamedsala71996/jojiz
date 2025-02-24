@extends('admin.layouts.master')
@push('style')
@endpush
@section('admin_content')
    <div class="page-content">
        <!-- Contextual classes start -->
        <div class="section">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="content-body">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body custom-card-body custom-product-list-body">
                                                    <h4 class="card-title product-title">
                                                        @lang('backend.Product Attribute Value List')
                                                    </h4>

                                                    <div class="">
                                                        <div class="row product-row">
                                                            <div class="col-lg-12">
                                                                <div class="add-three category-add-text">

                                                                    <div class="category-text">
                                                                        <button id="productattributebtn">
                                                                            @lang('backend.Add New')
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table header-border data-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>@lang('backend.No')</th>
                                                                        <th>@lang('backend.Name')</th>
                                                                        <th>@lang('backend.Value')</th>
                                                                        <th>@lang('backend.Color Code') </th>
                                                                        <th>@lang('backend.Action')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-------------========= Modal add productattribute start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="productattributeModal" tabindex="-1"
                                        aria-labelledby="productattributeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('admin.productattribute.store') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="card">
                                                        <div class="add-top-header">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
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
                                                                <div class="col-lg-6">
                                                                    <h5 class="modal-title card-title">
                                                                        @lang('backend.Product Attribute Value')
                                                                    </h5>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="category-save-text">
                                                                        <button type="submit" name="action"
                                                                            value="publish"><i
                                                                                class="fa-solid fa-check mr-2"
                                                                                id="add_category"></i>@lang('backend.Submit')
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body custom-card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 ">
                                                                    <div class="product-input">
                                                                        <div class="row">

                                                                            <div class="col-lg-12">
                                                                                <div class="general-main">
                                                                                    <div class="general-text">

                                                                                    </div>

                                                                                    <div>
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Name')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ old('name') }}">
                                                                                        </div>
                                                                                        @error('name')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group colorField">
                                                                                        <label
                                                                                            for="colorPicker">@lang('backend.Choose a Color'):</label>
                                                                                        <input type="color"
                                                                                            style="width: 30%;"
                                                                                            class="form-control"
                                                                                            value="#e0ffee"
                                                                                            id="colorPicker">
                                                                                        <input type="hidden"
                                                                                            name="color_code"
                                                                                            id="color_code"
                                                                                            class="form-group">
                                                                                        <b>@lang('backend.Current Color Code'): <code
                                                                                                id="colorCode"></code></b>
                                                                                    </div>

                                                                                    <div>
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label
                                                                                                for="floatingInput">@lang('backend.Value')</label>
                                                                                            <select name="value"
                                                                                                class="form-control"
                                                                                                id="attribut_value">
                                                                                                @foreach ($attributenames as $attributename)
                                                                                                    <option
                                                                                                        value="{{ $attributename->id }}">
                                                                                                        {{ $attributename->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        @error('value')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-------------========= Modal add Product Attribute End ===========--------->
                            <!-------------========= Modal Edit Product Attribute start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="productAttributeModal" tabindex="-1"
                                        aria-labelledby="productAttributeModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form id="productAttributeFrom" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="product_attribute_id" id="product_attribute_id">
                                                <div class="modal-content">
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
                                                                <div class="col-lg-6">
                                                                    <h5 class="modal-title card-title">

                                                                        @lang('backend.Product Attribute Value')
                                                                    </h5>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="category-save-text">
                                                                        <button type="submit" name="action"
                                                                            value="publish"><i
                                                                                class="fa-solid fa-check mr-2"
                                                                                id="update_category"></i>@lang('backend.Update')

                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body custom-card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 ">
                                                                    <div class="product-input">
                                                                        <div class="row">

                                                                            <div class="col-lg-12">
                                                                                <div class="general-main">
                                                                                    <div class="general-text">

                                                                                    </div>

                                                                                    <div>
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Name')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ old('name') }}"
                                                                                                id="name">
                                                                                        </div>
                                                                                        @error('name')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group colorField">

                                                                                        <label
                                                                                            for="colorPicker">@lang('backend.Choose a Color')</label>
                                                                                        <input type="color"
                                                                                            style="width: 30%;"
                                                                                            class="form-control"
                                                                                            value="#e0ffee"
                                                                                            id="editcolorPicker">
                                                                                        <input type="hidden"
                                                                                            name="color_code"
                                                                                            id="editcolor_code"
                                                                                            class="form-group">
                                                                                        <b>@lang('backend.Current Color Code'): <code
                                                                                                id="editcolorCode"></code></b>
                                                                                    </div>
                                                                                    <div>
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label
                                                                                                for="floatingInput">@lang('backend.Value')</label>
                                                                                            <select name="value"
                                                                                                class="form-control"
                                                                                                id="value">
                                                                                                @foreach ($attributenames as $attributename)
                                                                                                    <option
                                                                                                        value="{{ $attributename->id }}">
                                                                                                        {{ $attributename->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        @error('value')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(".colorField").css("display", "none");

        $("#attribut_value").on('change', function() {
            if (this.value == 1) {
                $(".colorField").css("display", "block");
            } else {
                $(".colorField").css("display", "none");
            }
        });

        const input = document.getElementById("colorPicker");
        const colorCode = document.getElementById("colorCode");

        setColor();
        input.addEventListener("input", setColor);

        function setColor() {
            colorCode.innerHTML = input.value;
            $('#color_code').val(input.value);
        }

        const editinput = document.getElementById("editcolorPicker");
        const editcolorCode = document.getElementById("editcolorCode");

        editsetColor();
        editinput.addEventListener("input", editsetColor);

        function editsetColor() {
            editcolorCode.innerHTML = editinput.value;
            $('#editcolor_code').val(editinput.value);
        }

        $(document).ready(function() {
            //Add product attribute
            $(document).on('click', '#productattributebtn', function(e) {
                $('#productattributeModal').modal('show');
            });
            //ajra table data show
            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.productattribute.productattribute.ajra.table') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'attributeName',
                        name: 'attributeName'
                    },
                    {
                        data: 'color_code',
                        name: 'color_code'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            //Product Attribute edit
            $(document).on('click', '#productAttributeEditButton', function(e) {
                let productattribute = $(this).data('id');

                $('#productAttributeModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "productattribute/edit/" + productattribute,
                    success: function(res) {
                        if (res.value == 1) {
                            $(".colorField").css("display", "block");
                        } else {
                            $(".colorField").css("display", "none");
                        }

                        $('#productAttributeFrom').find('#name').val(res.name);
                        $('#productAttributeFrom').find('#value').val(res.value);
                        $('#productAttributeFrom').find('#editcolorCode').text(res.color_code);
                        $('#productAttributeFrom').find('#editcolorPicker').val(res.color_code);
                        $('#productAttributeFrom').find('#editcolor_code').val(res.color_code);
                        $('#productAttributeFrom').find('#product_attribute_id').val(
                            productattribute);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //Product Attribute Update
            $('#productAttributeFrom').submit(function(e) {
                e.preventDefault();
                let product_attribute_id = $('#product_attribute_id').val();

                $.ajax({
                    type: "POST",
                    url: "productattribute/update/" + product_attribute_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#name').val();
                        $('#value').val();
                        $('#color_code').val();
                        $('#product_attribute_id').val();
                        $("#productAttributeModal").modal("hide");
                        table.ajax.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //Product Attribute Delete
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let product_attribute_id = $(this).data('id');

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
                            url: "productattribute/destroy/" + product_attribute_id,
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
                                    table.ajax.reload();
                                }
                            },
                            error: function(err) {
                                console.log('err');
                            }
                        });

                    }
                });
            });

        });
    </script>
@endpush
