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
                                                <div class="card-body custom-card-body">
                                                    <h4 class="card-title product-title">
                                                        @lang('backend.Courier List')
                                                    </h4>
                                                    <div class="table-responsive">
                                                        <div class="row product-row">
                                                            <div class="col-lg-12">
                                                                <div class="add-three category-add-text">

                                                                    <div class="category-text">
                                                                        <button data-bs-toggle="modal"
                                                                            data-bs-target="#addCourier">
                                                                            @lang('backend.Add Courier')
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table header-border" id="courierinfo">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>@lang('backend.Courier Name')</th>
                                                                    <th>@lang('backend.Charge')</th>
                                                                    <th>@lang('backend.Available')</th>
                                                                    <th>@lang('backend.Image')</th>
                                                                    <th>@lang('backend.Status')</th>
                                                                    <th>@lang('backend.Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @forelse ($couriers as $key => $data)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $data->courierName }}</td>
                                                                        <td>
                                                                            @if ($currency->symbol_position == 'left')
                                                                                {{ $currency->symbol }} {{ $data->charge }}
                                                                            @else
                                                                                {{ $data->charge }} {{ $currency->symbol }}
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $data->available }}</td>

                                                                        <td>
                                                                            <img width="60"
                                                                                src="{{ asset($data->image ?? '') }}"
                                                                                alt="Collection Image">
                                                                        </td>
                                                                        <td>

                                                                            @if ($data->status === 'Active')
                                                                                <button type="button"
                                                                                    class="btn btn-success btn-sm btn-status"
                                                                                    data-status="Inactive"
                                                                                    id="courierstatusBtn"
                                                                                    data-id="{{ $data->id }}">@lang('backend.Action')</button>
                                                                            @else
                                                                                <button type="button"
                                                                                    class="btn btn-warning btn-sm btn-status"
                                                                                    data-status="Active"
                                                                                    id="courierstatusBtn"
                                                                                    data-id="{{ $data->id }}">@lang('backend.Inactive')</button>
                                                                            @endif

                                                                        </td>
                                                                        <td>

                                                                            <span type="button"
                                                                                class="label gradient-11 rounded"
                                                                                id="editCourierBtn"
                                                                                data-id="{{ $data->id }}"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#editmainCourier"> <i
                                                                                    class="fa-solid fa-pen-to-square"></i></span>
                                                                            <span type="button"
                                                                                class="label gradient-12 rounded confirmDelete"
                                                                                data-id="{{ $data->id }}"> <i
                                                                                    class="fa-regular fa-trash-can"></i></span>
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


    @include('admin.components.modal.courier.create')

    <!---------=============== Modal courier Edit start ====================------------>
    @include('admin.components.modal.courier.edit')
@endsection

@push('script')
    <script type="text/javascript">
        function imagePriview(event) {
            let previewImage = document.getElementById("courier_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);

        }

        function editImagePriview(event) {
            var eidtPreviewImage = document.getElementById("courier_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);

        }

        $(document).ready(function() {

            $(document).on('click', '#editCourierBtn', function() {
                let courierId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: 'couriers/' + courierId + '/edit',

                    success: function(data) {

                        $('#EditCourier').find('#courierName').val(data.courierName);
                        $('#EditCourier').find('#charge').val(data
                            .charge);
                        $('#EditCourier').find('#available').val(data
                            .available);
                        $('#EditCourier #courier_edit_image_preview').attr('src',
                            "{{ asset('') }}" + data.image);
                        $('#EditCourier').find('#courier_id').val(data.id);
                        $('#EditCourier').attr('data-id', data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

            //update
            $('#EditCourier').submit(function(e) {
                e.preventDefault();
                let courierId = $('#courier_id').val();

                $.ajax({
                    type: 'POST',
                    url: 'courier/' + courierId,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {


                        $('#EditCourier').find('#courierName').val('');
                        $('#EditCourier').find('#charge').val('');
                        $('#EditCourier').find('#available').val('');

                        Swal.fire({
                            title: "@lang('backend.Courier update successfully !')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        location.reload();
                        courierinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //deleteuser

            $(document).on('click', '.confirmDelete', function() {
                let courierId = $(this).data('id');
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
                            url: 'couriers/' + courierId,
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

            //status update

            $(document).on('click', '#courierstatusBtn', function() {
                let courierId = $(this).data('id');
                let courierStatus = $(this).data('status');

                $.ajax({
                    type: 'PUT',
                    url: 'courier/status',
                    data: {
                        courier_id: courierId,
                        status: courierStatus,
                        "_token": "{{ csrf_token() }}"
                    },

                    success: function(data) {
                        Swal.fire({
                            title: "@lang('backend.Status updated !')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        location.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

        });
    </script>
@endpush
