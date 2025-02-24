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
                                                        @lang('backend.Sub Category List')
                                                    </h4>


                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <button id="subCategory">
                                                                        @lang('backend.Add Sub Category')
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
                                                                    <th>@lang('backend.Image')</th>
                                                                    <th>@lang('backend.Category')</th>
                                                                    <th>@lang('backend.Sub Category')</th>
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

    <!-------------========= Modal add subcategory start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.subcategory.store') }}" method="post" enctype="multipart/form-data">
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
                                                @lang('backend.Add New Sub Category')
                                            </h5>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="category-save-text">
                                                <button type="submit" name="action" value="publish"><i
                                                        class="fa-solid fa-check mr-2"
                                                        id="add_category"></i>@lang('backend.Add Sub Category')

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
                                                                    <h5>@lang('backend.Uploading Image') <span
                                                                            class="text-danger">*</span></h5>

                                                                    <div class="modal-product-image">
                                                                        <img id="subcategory_image_preview"
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
                                                                                        class=" form-control" required />
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
                                                                <label for="floatingInput">@lang('backend.Category Name') <span
                                                                        class="text-danger">*</span></label>
                                                                <select name="category_id" required class="form-control"
                                                                    id="category_id">
                                                                    @foreach ($categoris as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->category_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('category_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="form-group general-form mb-3">
                                                                <label for="name">
                                                                    @lang('backend.Sub Category Name') <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ old('name') }}" required>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------========= Modal add Sub Category End ===========--------->
    <!-------------========= Modal Edit Sub Category start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="editSubCategory" tabindex="-1" aria-labelledby="editSubCategory"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form id="editSubCategoryForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subcat_id" id="subcat_id">
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
                                                @lang('backend.Update Sub Category')
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
                                                                    <h5>@lang('backend.Uploading Image')<span
                                                                            class="text-danger">*</span></h5>
                                                                    <div class="modal-product-image">
                                                                        <img src=""
                                                                            id="subcategory_edit_image_preview"
                                                                            alt="">
                                                                    </div>
                                                                    <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                    <span>@lang('backend.Size'):5MB</span>
                                                                </div>
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
                                                                <label for="floatingInput">Category<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="category_id" class="form-control"
                                                                    id="category_id">
                                                                    @foreach ($categoris as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->category_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('category_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">@lang('backend.Sub Category Name')
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Ex: Man"
                                                                    required="" />
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------========= Modal Edit Sub Category End ===========--------->
@endsection
@push('script')
    <script type="text/javascript">
        function imagePriview(event) {
            let previewImage = document.getElementById("subcategory_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function editImagePriview(event) {
            let eidtPreviewImage = document.getElementById("subcategory_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);
        }
        $(document).ready(function() {


            //Add subcategory
            $(document).on('click', '#subCategory', function(e) {
                $('#subcategoryModal').modal('show');
            });
            //ajra table data show
            let table = $('.data-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.subcategory.subcategory.ajra.table') }}",
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
                        data: 'category',
                        name: 'category'
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

            //SubCategory edit
            $(document).on('click', '#subCategoryEdit', function(e) {
                let subcategory_id = $(this).data('id');
                $('#editSubCategory').modal('show');
                $.ajax({
                    type: "GET",
                    url: "subcategory/edit/" + subcategory_id,
                    success: function(res) {
                        console.log(res);
                        $("#editSubCategoryForm #subcategory_edit_image_preview").attr("src",
                            "{{ asset('') }}" + res.image);
                        $('.dropify').dropify();
                        $('#editSubCategoryForm').find('#category_id').val(res.category_id);
                        $('#editSubCategoryForm').find('#name').val(res.subcategory);
                        $('#editSubCategoryForm').find('#subcat_id').val(res.subcat_id);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //SubCategory Update
            $('#editSubCategoryForm').submit(function(e) {
                e.preventDefault();
                let subcat_id = $('#subcat_id').val();
                $.ajax({
                    type: "POST",
                    url: "subcategory/update/" + subcat_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#name').val();
                        $('#category_id').val();
                        $("#editSubCategory").modal("hide");
                        table.ajax.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Sub Category Delete
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let subcategory_id = $(this).data('id');

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
                            url: "subcategory/destroy/" + subcategory_id,
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
