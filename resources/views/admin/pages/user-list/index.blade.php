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
                                                        @lang('backend.User List')
                                                    </h4>


                                                    <div class="table-responsive">
                                                        <table id="offerCollectionTable" class="display" style="width:100%">
                                                            <div class="table-export">
                                                                <a style="align-content:right"
                                                                    href="{{ route('admin.user.list.export') }}"
                                                                    class="btn btn-success"> Export</a>
                                                            </div>

                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>@lang('backend.Name')</th>
                                                                    <th>@lang('backend.Email')</th>
                                                                    <th>@lang('backend.Phone')</th>
                                                                    <th>@lang('backend.Gender')</th>
                                                                    <th>@lang('backend.Location')</th>
                                                                    <th>@lang('backend.Country')</th>
                                                                    <th>@lang('backend.Image')</th>
                                                                    <th>@lang('backend.Status')</th>
                                                                    <th>@lang('backend.Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @forelse ($users as $key => $data)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $data->name }}</td>
                                                                        <td>{{ $data->email }}</td>
                                                                        <td>{{ $data->phone ?? '' }}</td>
                                                                        <td>{{ $data->gender ?? '' }}</td>
                                                                        <td>{{ $data->location ?? '' }}</td>
                                                                        <td>{{ $data->country ?? '' }}</td>

                                                                        <td>
                                                                            <img width="60"
                                                                                src="{{ asset($data->image ?? '') }}"
                                                                                alt="Collection Image">
                                                                        </td>
                                                                        <td>

                                                                            {!! $data->status == 1
                                                                                ? "<span class='bg-success text-white active-user p-2'>Active</span>"
                                                                                : "<span class='bg-danger text-white p-2'>Inactive</span>" !!}</td>
                                                                        <td>
                                                                            <div class="dropdown-product-list">
                                                                                <button><i
                                                                                        class="bi bi-three-dots dropdown-product-list"></i></button>
                                                                                <div id="myDropdown"
                                                                                    class="dropdown-product-list-content">

                                                                                    <a href="{{ route('admin.user.list.edit', $data->id) }}"
                                                                                        class="label rounded"
                                                                                        href="javascript:void(0)"
                                                                                        id="editModalBtn"><span><i
                                                                                                class="fa-solid fa-pen-to-square mr-1"
                                                                                                aria-hidden="true"></i></span>@lang('backend.Edit')</a>



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
