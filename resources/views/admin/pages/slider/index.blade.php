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
                                                        @lang('backend.Slider List')
                                                    </h4>


                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <button id="slider">
                                                                        @lang('backend.Add Slider')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table header-border data-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.No') </th>
                                                                    <th>@lang('backend.Image') </th>
                                                                    <th>@lang('backend.Sub Heading') </th>
                                                                    <th>@lang('backend.Heading')</th>
                                                                    <th>@lang('backend.Starting Amount')</th>
                                                                    <th>@lang('backend.Button Text')</th>
                                                                    <th>@lang('backend.Button Link')</th>
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

                            <!-------------========= Modal add slider start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="sliderModal" tabindex="-1"
                                        aria-labelledby="sliderModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('admin.slider.store') }}" method="post"
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
                                                                        @lang('backend.Add New Slider')
                                                                    </h5>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="category-save-text">
                                                                        <button type="submit" name="action"
                                                                            value="publish"><i
                                                                                class="fa-solid fa-check mr-2"
                                                                                id="add_category"></i> @lang('backend.Add Slider')

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
                                                                                                    class="text-danger">*</span>
                                                                                            </h5>
                                                                                            <div
                                                                                                class="modal-product-image">
                                                                                                <img id="slider_image_preview"
                                                                                                    src="{{ asset('public') }}/dumy.jpg"
                                                                                                    alt="Image">
                                                                                            </div>
                                                                                        </div>
                                                                                        <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                                        <span>@lang('backend.Size'):5MB</span>
                                                                                        <span>@lang('backend.Recommend'): Width:
                                                                                            1110px and Height: 390px.</span>
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
                                                                                    <div class="sub_heading">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Sub Heading') </label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="sub_heading"
                                                                                                value="{{ old('sub_heading') }}">
                                                                                        </div>
                                                                                        @error('sub_heading')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="heading">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Heading')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="heading"
                                                                                                value="{{ old('heading') }}">
                                                                                        </div>
                                                                                        @error('heading')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="starting_amount">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Starting Amount')</label>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                name="starting_amount"
                                                                                                value="{{ old('starting_amount') }}">
                                                                                        </div>
                                                                                        @error('starting_amount')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="button_text">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Button Text')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="button_text"
                                                                                                value="{{ old('button_text') }}">
                                                                                        </div>
                                                                                        @error('button_text')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="button_link">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Button Link')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="button_link"
                                                                                                value="{{ old('button_link') }}">
                                                                                        </div>
                                                                                        @error('button_link')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="desc">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Description')</label>
                                                                                            <textarea name="desc" class="form-control" id="desc" cols="30" rows="10"></textarea>
                                                                                        </div>
                                                                                        @error('desc')
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
                            <!-------------========= Modal add Slider End ===========--------->
                            <!-------------========= Modal Edit Slider start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="editSliderModal" tabindex="-1"
                                        aria-labelledby="editslider" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="post" id="editSliderForm" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="slider_id" id="slider_id">
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
                                                                        @lang('backend.Edit Slider')
                                                                    </h5>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="category-save-text">
                                                                        <button type="submit" name="action"
                                                                            value="publish"><i
                                                                                class="fa-solid fa-check mr-2"
                                                                                id="add_category"></i> @lang('backend.Update')

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
                                                                                            <h5>@lang('backend.Uploading Image') <span
                                                                                                    class="text-danger">*</span>
                                                                                            </h5>
                                                                                            <div
                                                                                                class="modal-product-image">
                                                                                                <img src=""
                                                                                                    id="slider_edit_image_preview"
                                                                                                    alt="Category Image">
                                                                                            </div>
                                                                                            <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                                            <span>@lang('backend.Size'):5MB</span>
                                                                                            <span>@lang('backend.Recommend'): Width:
                                                                                                1110px and Height:
                                                                                                390px.</span>
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
                                                                                                                onchange="editImagePriview(event)"
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
                                                                                    <div class="sub_heading">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Sub Heading') </label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="sub_heading"
                                                                                                value="{{ old('sub_heading') }}"
                                                                                                id="sub_heading">
                                                                                        </div>
                                                                                        @error('sub_heading')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="heading">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Heading')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="heading"
                                                                                                value="{{ old('heading') }}"
                                                                                                id="heading">
                                                                                        </div>
                                                                                        @error('heading')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="starting_amount">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Starting Amount')</label>
                                                                                            <input type="number"
                                                                                                class="form-control"
                                                                                                name="starting_amount"
                                                                                                value="{{ old('starting_amount') }}"
                                                                                                id="starting_amount">
                                                                                        </div>
                                                                                        @error('starting_amount')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="button_text">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Button Text')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="button_text"
                                                                                                value="{{ old('button_text') }}"
                                                                                                id="button_text">
                                                                                        </div>
                                                                                        @error('button_text')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="button_link">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Button Link')</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="button_link"
                                                                                                value="{{ old('button_link') }}"
                                                                                                id="button_link">
                                                                                        </div>
                                                                                        @error('button_link')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="desc">
                                                                                        <div
                                                                                            class="form-group general-form mb-3">
                                                                                            <label for="name">
                                                                                                @lang('backend.Description')</label>
                                                                                            <textarea class="form-control" name="desc" id="desc" cols="30" rows="10" id="desc"></textarea>
                                                                                        </div>
                                                                                        @error('desc')
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
                            <!-------------========= Modal Edit Slider End ===========--------->
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
            let previewImage = document.getElementById("slider_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);

        }

        function editImagePriview(event) {
            var eidtPreviewImage = document.getElementById("slider_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);

        }

        $(document).ready(function() {
            //Add slider
            $(document).on('click', '#slider', function(e) {
                $('#sliderModal').modal('show');
            });
            //ajra table data show
            let table = $('.data-table').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.slider.ajra.table') }}",
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
                        data: 'sub_heading',
                        name: 'sub_heading'
                    },
                    {
                        data: 'heading',
                        name: 'heading'
                    },

                    {
                        data: 'starting_amount',
                        name: 'starting_amount'
                    },
                    {
                        data: 'button_text',
                        name: 'button_text'
                    },
                    {
                        data: 'button_link',
                        name: 'button_link'
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

            //slider edit
            $(document).on('click', '#sliderEdit', function(e) {
                $('.dropify').dropify();
                let slider_id = $(this).data('id');
                $('#editSliderModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "slider/edit/" + slider_id,
                    success: function(res) {
                        console.log(res);
                        $("#editSliderForm #image").attr("data-default-file",
                            "{{ asset('backend/images/slider/') }}/" + res.image);
                        $('.dropify').dropify();

                        $('#editSliderForm').find('#sub_heading').val(res.sub_heading);
                        $('#editSliderForm').find('#heading').val(res.heading);
                        $('#editSliderForm').find('#starting_amount').val(res.starting_amount);
                        $('#editSliderForm').find('#button_text').val(res.button_text);
                        $('#editSliderForm').find('#button_link').val(res.button_link);
                        $('#editSliderForm').find('#desc').val(res.desc);
                        $('#editSliderForm').find('#slider_id').val(slider_id);
                        $('#editSliderForm #slider_edit_image_preview').attr('src',
                            "{{ asset('') }}" + res.image);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //slider Update
            $('#editSliderForm').submit(function(e) {
                e.preventDefault();
                let slider_id = $('#slider_id').val();
                $.ajax({
                    type: "POST",
                    url: "slider/update/" + slider_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#sub_heading').val();
                        $('#heading').val();
                        $('#starting_amount').val();
                        $('#button_text').val();
                        $('#button_link').val();
                        $('#desc').val();
                        $("#editSliderModal").modal("hide");
                        table.ajax.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //Slider Delete
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let slider_id = $(this).data('id');

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
                            url: "slider/destroy/" + slider_id,
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
