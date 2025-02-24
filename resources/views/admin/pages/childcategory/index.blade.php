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
                                                        @lang('backend.Child Category List')
                                                    </h4>

                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal">
                                                                        @lang('backend.Add Child Category')
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
                                                                    <th> @lang('backend.Image')</th>
                                                                    <th>@lang('backend.Sub Category')</th>
                                                                    <th>@lang('backend.Child Category')</th>
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

                            <!-------------========= Modal add childcategory start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('admin.childcategory.store') }}" method="post"
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
                                                                        @lang('backend.Add New Child Category')
                                                                    </h5>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="category-save-text">
                                                                        <button type="submit" name="action"
                                                                            value="publish"><i
                                                                                class="fa-solid fa-check mr-2"
                                                                                id="add_category"></i>@lang('backend.Add Child Category')

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
                                                                                                    class="text-danger">*</span>
                                                                                            </h5>
                                                                                            <div
                                                                                                class="modal-product-image">
                                                                                                <img id="childcategory_image_preview"
                                                                                                    src="{{ asset('public') }}/dumy.jpg"
                                                                                                    alt="Image">
                                                                                            </div>
                                                                                            <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                                            <span>@lang('backend.Size'):5MB</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="xzoom-thumbs">
                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="col-lg-12 col-4">
                                                                                                        <div
                                                                                                            class="modal-product-image4">
                                                                                                            <i
                                                                                                                class="fa fa-plus plus"></i>

                                                                                                            <input
                                                                                                                type="file"
                                                                                                                onchange="imagePriview(event)"
                                                                                                                name="image"
                                                                                                                id="image"
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
                                                                                    <div
                                                                                        class="form-group general-form mb-3">
                                                                                        <label
                                                                                            for="floatingInput">@lang('backend.Category')</label>
                                                                                        <select name="subcategory_id"
                                                                                            class="form-control"
                                                                                            id="subcategory_id">
                                                                                            @foreach ($subcategories as $subcategory)
                                                                                                <option
                                                                                                    value="{{ $subcategory->id }}">
                                                                                                    {{ $subcategory->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    @error('subcategory_id')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                    <div
                                                                                        class="form-group general-form mb-3">
                                                                                        <label
                                                                                            for="floatingInput">@lang('backend.Child Category Name')

                                                                                        </label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name" id="name"
                                                                                            placeholder="Ex: Pant"
                                                                                            required="" />
                                                                                    </div>
                                                                                    @error('name')
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-------------========= Modal add product End ===========--------->
                            </div>
                            <!-------------========= Modal add childcategory End ===========--------->
                            <!-------------========= Modal edit childcategory start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="childcategorymodal" tabindex="-1"
                                        aria-labelledby="childcategroy" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form id="childcategoryform" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="childcat_id" id="childcat_id">
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
                                                                        @lang('backend.Update Child Category')
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
                                                                            <div class="col-lg-4">
                                                                                <div class="upload-product">
                                                                                    <div class="row ">
                                                                                        <div
                                                                                            class="col-lg-12 border-round">
                                                                                            <h5>@lang('backend.Uploading Image')</h5>
                                                                                            <div
                                                                                                class="modal-product-image">
                                                                                                <img src=""
                                                                                                    id="childcategory_edit_image_preview"
                                                                                                    alt="">
                                                                                            </div>
                                                                                        </div>
                                                                                        <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                                        <span>@lang('backend.Size'):5MB</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="xzoom-thumbs">
                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="col-lg-12 col-4">
                                                                                                        <div
                                                                                                            class="modal-product-image4">
                                                                                                            <i
                                                                                                                class="fa fa-plus plus"></i>
                                                                                                            <input
                                                                                                                type="file"
                                                                                                                onchange="editImagePriview(event)"
                                                                                                                name="image"
                                                                                                                id="image"
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
                                                                                    <div
                                                                                        class="form-group general-form mb-3">
                                                                                        <label
                                                                                            for="floatingInput">@lang('backend.Sub Category')
                                                                                        </label>
                                                                                        <select name="subcategory_id"
                                                                                            class="form-control"
                                                                                            id="subcategory_id">
                                                                                            @foreach ($subcategories as $subcategory)
                                                                                                <option
                                                                                                    value="{{ $subcategory->id }}">
                                                                                                    {{ $subcategory->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    @error('subcategory_id')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                    <div
                                                                                        class="form-group general-form mb-3">
                                                                                        <label
                                                                                            for="floatingInput">@lang('backend.Child Category Name')

                                                                                        </label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="name" id="name"
                                                                                            placeholder="Ex: Pant"
                                                                                            required="" />
                                                                                    </div>
                                                                                    @error('name')
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
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-------------========= Modal edit childcategory End ===========--------->
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
        function imagePriview(event) {
            let previewImage = document.getElementById("childcategory_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function editImagePriview(event) {
            let eidtPreviewImage = document.getElementById("childcategory_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        $(document).ready(function() {

            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.childcategory.yajra.table') }}",
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
                        data: 'subcategory',
                        name: 'subcategory'
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

            //Category edit
            $(document).on('click', '#childcategoryedit', function(e) {
                $subcategory_id = $(this).data('id');
                $('#childcategoryform').find('#name').val('');
                $('#childcategoryform').find('#childcat_id').val('');
                $('#childcategoryform').find('img').attr('src', '');

                $('#childcategorymodal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "childcategory/edit/" + $subcategory_id,
                    success: function(res) {
                        console.log(res);
                        $('#childcategoryform').find('#subcategory_id').val(res.subcategory_id);
                        $('#childcategoryform').find('#name').val(res.name);
                        $('#childcategoryform').find('#childcat_id').val(res.childcat_id);

                        $('#childcategoryform #childcategory_edit_image_preview').attr('src',
                            "../" + res.image);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });


            });
            //Category Update
            $('#childcategoryform').submit(function(e) {
                e.preventDefault();
                let childcat_id = $('#childcat_id').val();
                $.ajax({
                    type: "POST",
                    url: "childcategory/update/" + childcat_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#name').val();
                        $('#childcategory_id').val();
                        $("#childcategorymodal").modal("hide");
                        table.ajax.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Category Delete
            // sweet alert started
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let childcategory_id = $(this).data('id');

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
                            url: "childcategory/destroy/" + childcategory_id,
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
