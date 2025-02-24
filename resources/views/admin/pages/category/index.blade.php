@extends('admin.layouts.master')
@push('style')
    <!-- jQuery UI CSS (optional for styling) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
                                                        @lang('backend.Category List')
                                                    </h4>

                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal">
                                                                        @lang('backend.Add Category')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="table-responsive">
                                                        <table class="table header-border dataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.Drag')</th>
                                                                    <th>@lang('backend.SN')</th>
                                                                    <th>@lang('backend.Image')</th>
                                                                    <th>@lang('backend.Category Name')</th>
                                                                    <th>@lang('backend.Category Description')</th>
                                                                    <th>@lang('backend.Type')</th>
                                                                    <th>@lang('backend.Action')</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody id="tableBodyContents">
                                                                @foreach ($categories as $data)
                                                                    <tr class="tableRow" data-id="{{ $data->id }}">
                                                                        <td class="pl-3">
                                                                            <i class="fa-solid fa-arrows-up-down"></i>
                                                                        </td>

                                                                        <td>{{ $data->order }}</td>
                                                                        <td> <img src="{{ asset($data->image) }}"
                                                                                alt="Category Image"></td>
                                                                        <td>{{ $data->category_name }}</td>
                                                                        <td>{{ $data->category_desc ?? '' }}</td>
                                                                        <td>
                                                                            @if ($data->type == 'special')
                                                                                <button type="button"
                                                                                    class="btn btn-success btn-sm btn-type"
                                                                                    data-type="not_special"
                                                                                    id="categoryTypeBtn"
                                                                                    data-id="{{ $data->id }}">@lang('backend.Special')</button>
                                                                            @else
                                                                                <button type="button"
                                                                                    class="btn btn-warning btn-sm btn-type"
                                                                                    data-type="special" id="categoryTypeBtn"
                                                                                    data-id="{{ $data->id }}">@lang('backend.Not Special')</button>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown-product-list">
                                                                                <button><i
                                                                                        class="bi bi-three-dots dropdown-product-list"></i></button>
                                                                                <div id="myDropdown"
                                                                                    class="dropdown-product-list-content">

                                                                                    {{-- <a type="button"
                                                                                        class="label rounded categoryDetails"
                                                                                        href="javascript:void(0)"
                                                                                        data-id="{{ $data->id }}"
                                                                                        id="categoryDetails"><span><i
                                                                                                class="fa-regular fa-regular fa-eye mr-1"
                                                                                                aria-hidden="true"></i></span>@lang('backend.Details')</a> --}}
                                                                                    <a type="button" class="label rounded"
                                                                                        href="javascript:void(0)"
                                                                                        id="categoryEdit"
                                                                                        data-id="{{ $data->id }}"><span><i
                                                                                                class="fa-solid fa-pen-to-square mr-1"
                                                                                                aria-hidden="true"></i></span>@lang('backend.Edit')</a>

                                                                                    <a type="button"
                                                                                        class="label rounded confirmDelete"
                                                                                        data-id="{{ $data->id }}"
                                                                                        id="deleteModalBtn"
                                                                                        href="javascript:void(0)"><span><i
                                                                                                class="fa-regular fa-trash-can mr-1"
                                                                                                aria-hidden="true"></i></span>@lang('backend.Delete')</a>

                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
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
    <div class="modal fade" id="CategoryDetails" tabindex="-1" role="dialog" aria-labelledby="detailsTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>@lang('backend.Category Details')</h5>
                </div>
                <div class="modal-body" id="cvd">
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
                                                            <img src="" id="category_view_image_preview"
                                                                alt="Category Image">
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
                                                                        <img src="" alt="" width="85">
                                                                        <input type="file"
                                                                            onchange="editImagePriview(event)"
                                                                            name="image" id="image"
                                                                            class="form-control" />
                                                                    </div>
                                                                    @error('image')
                                                                        <span class="text-danger">{{ $message }}</span>
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

                                                <div class="form-group general-form mb-3">
                                                    <label for="floatingInput">@lang('backend.Category Name')

                                                    </label>
                                                    <input type="text" class="form-control" name="category_name"
                                                        id="category_name" placeholder="Ex: Man" required="" />
                                                </div>
                                                @error('category_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <div class="form-group general-form mb-3">
                                                    <label for="category_desc">
                                                        @lang('backend.Description')</label>
                                                    <textarea class="form-control" name="category_desc" placeholder="Ex:This is a very useful product"
                                                        id="category_desc" rows="3"></textarea>
                                                </div>
                                                @error('category_desc')
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
    </div>
    <!-------------========= Modal add category start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                                @lang('backend.Add New Category')
                                            </h5>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="category-save-text">
                                                <button type="submit" name="action" value="publish"><i
                                                        class="fa-solid fa-check mr-2"
                                                        id="add_category"></i>@lang('backend.Add Category')

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
                                                                        <img id="category_image_preview"
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

                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">@lang('backend.Category Name')
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="category_name" id="category_name"
                                                                    placeholder="Ex: Man" required="" />
                                                            </div>
                                                            @error('category_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="form-group general-form mb-3">
                                                                <label for="category_desc">
                                                                    @lang('backend.Description')</label>
                                                                <textarea class="form-control" name="category_desc" placeholder="Ex:This is a very useful product"
                                                                    id="category_desc" rows="3"></textarea>
                                                            </div>
                                                            @error('category_desc')
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
        <!-------------========= Modal add product End ===========--------->
    </div>
    <!-------------========= Modal add Category End ===========--------->
    <!-------------========= Modal edit category start ===========--------->
    <div class="row">
        <div class="col-lg-12">
            <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategory" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.category.store') }}" id="editCategoryForm" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id">
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
                                                @lang('backend.Update Category')
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
                                                                    <h5>@lang('backend.Uploading Image') <span
                                                                            class="text-danger">*</span></h5>
                                                                    <div class="modal-product-image">
                                                                        <img src=""
                                                                            id="category_edit_image_preview"
                                                                            alt="Category Image">
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
                                                                                    <img src="" alt=""
                                                                                        width="85">
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

                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">@lang('backend.Category Name')
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="category_name" id="category_name"
                                                                    placeholder="Ex: Man" required="" />
                                                            </div>
                                                            @error('category_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="form-group general-form mb-3">
                                                                <label for="category_desc">
                                                                    @lang('backend.Description')</label>
                                                                <textarea class="form-control" name="category_desc" placeholder="Ex:This is a very useful product"
                                                                    id="category_desc" rows="3"></textarea>
                                                            </div>
                                                            @error('category_desc')
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
    <!-------------========= Modal edit Category End ===========--------->
@endsection

@push('script')
    <!-- jQuery UI CDN Link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


    <script type="text/javascript">
        function imagePriview(event) {
            let previewImage = document.getElementById("category_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);

        }

        function editImagePriview(event) {
            var eidtPreviewImage = document.getElementById("category_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);

        }
        $(document).ready(function() {
            // let table = $('.data-table').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: "{{ route('admin.category.ajra.table') }}",
            //     columns: [{
            //             data: 'id',
            //             name: 'id'
            //         },
            //         {
            //             data: 'image',
            //             name: 'image',
            //             render: function(data, type, full, meta) {
            //                 return "<img src=../" + data + " width=\"60\" alt='No Image'/>";
            //             }
            //         },
            //         {
            //             data: 'category_name',
            //             name: 'category_name'
            //         },
            //         {
            //             data: 'category_desc',
            //             name: 'category_desc'
            //         },
            //         {
            //             "data": null,
            //             render: function(data) {

            //                 if (data.type == 'special') {
            //                     return '<button type="button" class="btn btn-success btn-sm btn-type" data-type="not_special" id="categoryTypeBtn" data-id="' +
            //                         data.id + '">' + "@lang('backend.Special')" + '</button>';
            //                 } else {
            //                     return '<button type="button" class="btn btn-warning btn-sm btn-type" data-type="special" id="categoryTypeBtn" data-id="' +
            //                         data.id + '" >' + "@lang('backend.Not Special')" + '</button>';
            //                 }
            //             }
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         },
            //     ]
            // });

            //Type Update
            $(document).on('click', '#categoryTypeBtn', function(e) {
                let category_id = $(this).data('id');
                let category_type = $(this).data('type');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.category.type.update') }}",
                    data: {
                        category_id: category_id,
                        category_type: category_type,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(success) {
                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            text: success.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        });
                        table.ajax.reload();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Category Details
            $(document).on('click', '.categoryDetails', function() {
                $category_id = $(this).data('id');
                $('#cvd').find('#category_name').val('');
                $('#cvd').find('#category_desc').val('');
                $('#cvd').find('img').attr('src', '');

                $('#CategoryDetails').modal('show');
                $.ajax({
                    type: "GET",
                    url: "category/edit/" + $category_id,
                    success: function(res) {
                        $('#cvd').find('#category_name').val(res.category_name);
                        $('#cvd').find('#category_desc').val(res.category_desc);
                        $('#cvd #category_view_image_preview').attr('src',
                            "{{ asset('') }}" + res.image);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Category edit
            $(document).on('click', '#categoryEdit', function(e) {
                $category_id = $(this).data('id');
                $('#editCategoryForm').find('#category_name').val('');
                $('#editCategoryForm').find('#category_desc').val('');
                $('#editCategoryForm').find('#cat_id').val('');
                $('#editCategoryForm').find('img').attr('src', '');

                $('#editCategory').modal('show');
                $.ajax({
                    type: "GET",
                    url: "category/edit/" + $category_id,
                    success: function(res) {
                        $('#editCategoryForm').find('#category_name').val(res.category_name);
                        $('#editCategoryForm').find('#category_desc').val(res.category_desc);
                        $('#editCategoryForm').find('#cat_id').val(res.id);
                        $('#editCategoryForm #category_edit_image_preview').attr('src',
                            "{{ asset('') }}" + res.image);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });


            });
            //Category Update
            $('#editCategoryForm').submit(function(e) {
                e.preventDefault();
                let cat_id = $('#cat_id').val();
                $.ajax({
                    type: "POST",
                    url: "category/update/" + cat_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#category_name').val();
                        $('#category_desc').val();
                        $("#editCategory").modal("hide");
                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            text: "@lang('backend.Your file has been updated.')",
                            icon: "success"
                        });
                        table.ajax.reload();

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Category Delete
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let category_id = $(this).data('id');

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
                            url: "category/destroy/" + category_id,
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

                                if (res.status == 'info') {
                                    Swal.fire({
                                        title: "@lang('backend.Info!')!",
                                        text: "@lang('backend.This category cannot be deleted because it contains products. Please delete all products within this category first.')",
                                        icon: "info"
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dataTable").DataTable();

            $("#tableBodyContents").sortable({
                items: "tr",
                cursor: 'move',

                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.tableRow').each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({

                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.category.reorder') }}",
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        });
    </script>
@endpush
