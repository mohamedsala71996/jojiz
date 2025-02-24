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
                                                        @lang('backend.Collection List')
                                                    </h4>

                                                    <div class="row product-row">
                                                        <div class="col-lg-12">
                                                            <div class="add-three category-add-text">

                                                                <div class="category-text">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ route('admin.offer.collection.create') }}">@lang('backend.Add New')</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="table-responsive">
                                                        <table id="offerCollectionTable" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.ID')</th>
                                                                    <th>@lang('backend.Title')</th>
                                                                    <th>@lang('backend.Sub Title')</th>
                                                                    <th>@lang('backend.Image')</th>
                                                                    <th>@lang('backend.Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($offerCollections as $key => $data)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $data->title }}</td>
                                                                        <td>{{ $data->sub_title }}</td>
                                                                        <td>
                                                                            <img width="60"
                                                                                src="{{ asset($data->image) }}"
                                                                                alt="Collection Image">
                                                                        </td>
                                                                        <td>

                                                                            <div class="dropdown-product-list">
                                                                                <button><i
                                                                                        class="bi bi-three-dots dropdown-product-list"></i></button>
                                                                                <div id="myDropdown"
                                                                                    class="dropdown-product-list-content">


                                                                                    <a type="button" class="label rounded "
                                                                                        href="{{ route('admin.offer.collection.show', $data->id) }}"><span><i
                                                                                                class="fa-regular fa-eye mr-1"></i></span>@lang('backend.Details')</a>
                                                                                    <a type="button"
                                                                                        class="label rounded editBtn"
                                                                                        href="{{ route('admin.offer.collection.edit', $data->id) }}"><span><i
                                                                                                class="fa-solid fa-pen-to-square mr-1"></i></span>@lang('backend.Edit')</a>

                                                                                    <a type="button"
                                                                                        class="label rounded confirmDelete"
                                                                                        data-id="{{ $data->id }}"
                                                                                        id="deleteBtn"
                                                                                        href="javascript:void(0)"><span><i
                                                                                                class="fa-regular fa-trash-can mr-1"></i></span>@lang('backend.Delete')</a>

                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td>@lang('backend.Not Found!')</td>
                                                                    </tr>
                                                                @endforelse

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

    @include('admin.components.modal.offer-collection.details')
    <!-------------========= Modal add category start ===========--------->
    @include('admin.components.modal.offer-collection.create')
    <!-------------========= Modal add Category End ===========--------->
    <!-------------========= Modal edit category start ===========--------->
    @include('admin.components.modal.offer-collection.edit')

    <!-------------========= Modal edit Category End ===========--------->
@endsection
@push('script')
    <script type="text/javascript">
        //Show Table
        new DataTable('#offerCollectionTable');


        //offer Collection Delete
        $(document).on('click', '.confirmDelete', function(e) {
            e.preventDefault();
            let offer_id = $(this).data('id');

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
                        url: "offer-collection/destroy/" + offer_id,
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
                                location.reload();
                            }
                        },
                        error: function(err) {
                            console.log('err');
                        }
                    });

                }
            });
        });

        function imagePriview(event) {
            let previewImage = document.getElementById("offer_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function editImagePriview(event) {
            let eidtPreviewImage = document.getElementById("offer_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
