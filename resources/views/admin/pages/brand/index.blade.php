@extends('admin.layouts.master')

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
                                                        @lang('backend.Brand List')
                                                    </h4>

                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">
                                                                <div class="product-search-right search-right-one">

                                                                </div>
                                                                <div class="category-text">
                                                                    <button type="button" id="addBrand">
                                                                        @lang('backend.Add Brand')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="table-responsive">
                                                        <table class="table header-border data-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.ID')</th>
                                                                    <th>@lang('backend.Image')</th>
                                                                    <th>@lang('backend.Name')</th>
                                                                    <th>@lang('backend.Description')</th>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>
    {{-- Details modal --}}
    <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="detailsTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>@lang('backend.Brand Details')</h5>
                </div>
                <div class="modal-body brandDetailsContent">

                </div>
            </div>
        </div>
    </div>
    <!-------------========= Modal add brand start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
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
                                                @lang('backend.Add New Brand')
                                            </h5>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="category-save-text">
                                                <button type="submit" name="action" value="publish"><i
                                                        class="fa-solid fa-check mr-2"></i>@lang('backend.Add Brand')

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
                                                    <div class="col-lg-4">
                                                        <div class="upload-product">
                                                            <div class="row ">
                                                                <div class="col-lg-12 border-round">
                                                                    <h5>@lang('backend.Uploading Image')</h5>
                                                                    <div class="modal-product-image">
                                                                        <img id="brand_image_preview"
                                                                            src="{{ asset('public') }}/dumy.jpg"
                                                                            alt="Image">
                                                                    </div>
                                                                </div>
                                                                <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                <span>@lang('backend.Size'):5MB</span>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="xzoom-thumbs">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-4">
                                                                                <div class="modal-product-image4">
                                                                                    <i class="fa fa-plus plus"></i>

                                                                                    <input type="file"
                                                                                        onchange="imagePriview(event)"
                                                                                        name="image" id="image"
                                                                                        class=" form-control" />
                                                                                </div>
                                                                                @error('image')
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
                                                    <div class="col-lg-8">
                                                        <div class="general-main">
                                                            <div class="general-text">

                                                            </div>
                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">
                                                                    @lang('backend.Name')
                                                                </label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Ex: Daraz" required="" />
                                                            </div>
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="form-group general-form mb-3">
                                                                <label for="desc">
                                                                    @lang('backend.Description')</label>
                                                                <textarea class="form-control" name="desc" placeholder="Ex:This is best brand" id="desc" rows="3"></textarea>
                                                            </div>
                                                            @error('desc')
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------========= Modal add brand End ===========--------->
    <!-------------========= Modal edit brand start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="editbrand" tabindex="-1" aria-labelledby="editbrand" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="editbrandform" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="brand_id" id="brand_id">
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
                                                @lang('backend.Update Brand')
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
                                <div class="card-body custom-card-body">
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <div class="product-input">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="upload-product">
                                                            <div class="row ">
                                                                <div class="col-lg-12 border-round">
                                                                    <h5>@lang('backend.Uploading Image')</h5>
                                                                    <div class="modal-product-image">
                                                                        <img src="" id="brand_edit_image_preview"
                                                                            alt="Brand Image">
                                                                    </div>
                                                                </div>
                                                                <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                <span>@lang('backend.Size'):5MB</span>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="xzoom-thumbs">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-4">
                                                                                <div class="modal-product-image4">
                                                                                    <i class="fa fa-plus plus"></i>

                                                                                    <input type="file"
                                                                                        onchange="editImagePriview(event)"
                                                                                        name="image" id="image"
                                                                                        class="form-control" />
                                                                                </div>
                                                                                @error('image')
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
                                                    <div class="col-lg-8">
                                                        <div class="general-main">
                                                            <div class="general-text">

                                                            </div>
                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">
                                                                    @lang('backend.Name')
                                                                </label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Ex: Daraz"
                                                                    required="" />
                                                            </div>
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="form-group general-form mb-3">
                                                                <label for="desc">
                                                                    @lang('backend.Description')</label>
                                                                <textarea class="form-control" name="desc" placeholder="Ex:This is a very useful product" id="desc"
                                                                    rows="3"></textarea>
                                                            </div>
                                                            @error('desc')
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
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-------------========= Modal edit brand End ===========--------->
@endsection
@push('script')
    <script type="text/javascript">
        function imagePriview(event) {
            let previewImage = document.getElementById("brand_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function editImagePriview(event) {
            let eidtPreviewImage = document.getElementById("brand_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        $(document).ready(function() {
            $(document).on('click', '#addBrand', function() {
                $('#addBrandModal').modal('show');
            });

            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.brand.brand.ajra.table') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            return "<img src=../" + data + " width=\"60\" alt='No Image'/>";
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'desc',
                        name: 'desc'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            //Brand Details
            $(document).on('click', '#brandDetails', function() {
                let brandDetails = $('#brandDetails').data('details');
                $('.brandDetailsContent').text(brandDetails);
                $('#brandModal').modal('show');
            });

            //Brand edit
            $(document).on('click', '#brandedit', function(e) {
                brand_id = $(this).data('id');
                $('#editbrand').modal('show');
                $.ajax({
                    type: "GET",
                    url: "brand/edit/" + brand_id,
                    success: function(res) {
                        $('#editbrandform').find('#name').val(res.name);
                        $('#editbrandform').find('#desc').val(res.desc);
                        $('#editbrandform').find('#brand_id').val(res.id);
                        $('#editbrandform #brand_edit_image_preview').attr('src',
                            "{{ asset('') }}" + res.image);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });


            });
            //Brand Update
            $('#editbrandform').submit(function(e) {
                e.preventDefault();
                let brand_id = $('#brand_id').val();
                $.ajax({
                    type: "POST",
                    url: "brand/update/" + brand_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#name').val();
                        $('#desc').val();
                        $("#editbrand").modal("hide");
                        table.ajax.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Brand Delete
            // sweet alert started
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let brand_id = $(this).data('id');

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
                            url: "brand/destroy/" + brand_id,
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
            //sweet alert end



        });
    </script>
@endpush
