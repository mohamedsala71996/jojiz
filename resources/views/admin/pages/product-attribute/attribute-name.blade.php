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
                                                        @lang('backend.Product Attribute Name List')
                                                    </h4>

                                                    <div class="table-responsive">

                                                        <div class="table-responsive">
                                                            <table class="table header-border data-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>@lang('backend.No')</th>
                                                                        <th>@lang('backend.Name')</th>
                                                                        <th> @lang('backend.Action')</th>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>

    <!-------------========= Modal Edit Product Attribute Name start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="productAttributeNameModal" tabindex="-1"
                aria-labelledby="productAttributeNameModal" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="productAttributeNameFrom" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_attribute_name_id" id="product_attribute_name_id">
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
                                                @lang('backend.Product Attribute Name')
                                            </h5>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="category-save-text">
                                                <button type="submit" name="action" value="publish"><i
                                                        class="fa-solid fa-check mr-2"
                                                        id="update_category"></i>@lang('backend.Update')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body custom-card-body ">
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <div class="product-input">
                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <div class="general-main">
                                                            <div class="general-text">

                                                            </div>

                                                            <div>
                                                                <div class="form-group general-form mb-3">
                                                                    <label for="name">
                                                                        @lang('backend.Name')</label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" value="" id="name">
                                                                </div>
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
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
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {

            //ajra table data show
            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.productattribute.attribute.name.yjra.table') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
            $(document).on('click', '#productAttributeEditButtonName', function(e) {
                let productattributeName = $(this).data('id');

                $('#productAttributeNameModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "attribute-name-edit/" + productattributeName,
                    success: function(res) {
                        $('#productAttributeNameFrom').find('#name').val(res.name);
                        $('#productAttributeNameFrom').find('#product_attribute_name_id').val(
                            productattributeName);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //Product Attribute Update
            $('#productAttributeNameFrom').submit(function(e) {
                e.preventDefault();
                let product_attribute_name_id = $('#product_attribute_name_id').val();

                $.ajax({
                    type: "POST",
                    url: "attribute-name-update/" + product_attribute_name_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#name').val();
                        $('#value').val();
                        $('#product_attribute_id').val();
                        $("#productAttributeModal").modal("hide");
                        table.ajax.reload();
                        toastr.success(res.message);
                        $('#productAttributeNameModal').modal('hide');
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });



        });
    </script>
@endpush
