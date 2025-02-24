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
                                                <div class="card-body custom-card-body">
                                                    <h4 class="card-title product-title">
                                                        @lang('backend.FAQ List')
                                                    </h4>
                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <button id="faqModalButton">
                                                                        @lang('backend.Add New')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table id="faqTable" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.Title')</th>
                                                                    <th>@lang('backend.Description')</th>
                                                                    <th>@lang('backend.Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($faqs as $faq)
                                                                    <tr>
                                                                        <td>{{ $faq->title }}</td>
                                                                        <td>{!! $faq->description !!}</td>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown-product-list">
                                                                                <button><i
                                                                                        class="bi bi-three-dots dropdown-product-list"></i></button>
                                                                                <div id="myDropdown"
                                                                                    class="dropdown-product-list-content">

                                                                                    <a type="button" class="label rounded"
                                                                                        href="javascript:void(0)"
                                                                                        id="editFaqModalBtn"
                                                                                        data-id="{{ $faq->id }}"><span><i
                                                                                                class="fa-solid fa-pen-to-square mr-1"
                                                                                                aria-hidden="true"></i></span>Edit</a>

                                                                                    <a type="button"
                                                                                        class="label rounded confirmDelete"
                                                                                        data-id="{{ $faq->id }}"
                                                                                        id="deleteFaqModalBtn"
                                                                                        href="javascript:void(0)"><span><i
                                                                                                class="fa-regular fa-trash-can mr-1"
                                                                                                aria-hidden="true"></i></span>Delete</a>

                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td>@lang('backend.Not Found!')</td>
                                                                    </tr>
                                                                @endforelse

                                                                </thead>
                                                            <tbody>


                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-------------========= Modal add slider start ===========--------->
                            @include('admin.components.modal.faq.create')

                            <!-------------========= Modal add Slider End ===========--------->
                            <!-------------========= Modal Edit Slider start ===========--------->
                            @include('admin.components.modal.faq.edit')
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
        $(document).ready(function() {
            //Show Table
            var table = new DataTable('#faqTable');
            //Add Expense Category
            $(document).on('click', '#faqModalButton', function(e) {
                $('#faqCreateModal').modal('show');
            });

            $(document).ready(function() {
                $('#description').summernote({
                    placeholder: 'Write Description',
                    tabsize: 2,
                    height: 200
                });
            });
            $(document).ready(function() {
                $('#edit_description').summernote({
                    placeholder: 'Write Description',
                    tabsize: 2,
                    height: 200
                });
            });

            //FAQ edit
            $(document).on('click', '#editFaqModalBtn', function(e) {
                let id = $(this).data('id');
                $('#editFaqModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: `faqs/${id}/edit`,
                    success: function(res) {

                        // Set the content of Summernote editor
                        $('#edit_description').summernote('code', res.description);
                        $('#editFaqForm').find('#title').val(res.title);
                        $('#editFaqForm').find('#faq_id').val(id);

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //FAQ Category Update
            $('#editFaqForm').submit(function(e) {
                e.preventDefault();
                let faq_id = $('#faq_id').val();
                $.ajax({
                    type: "POST",
                    url: `faqs/${faq_id}`,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#title').val();
                        $('#edit_description').val();
                        // table.ajax.reload();
                        $('#editFaqModal').modal('hide');

                        window.location.reload();
                        toastr.success(res.message);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            //FAQ Category Delete
            $(document).on('click', '.confirmDelete', function(e) {
                e.preventDefault();
                let faq_id = $(this).data('id');

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
                            url: `faqs/${faq_id}`,
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
                                    // table.ajax.reload();
                                }
                                toastr.success(res.message);
                                window.location.reload();
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
