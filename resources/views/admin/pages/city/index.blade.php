@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>City List</h3>
    </div>
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
                                                        City List
                                                    </h4>
                                                    <div class="table-responsive">
                                                        <div class="row product-row">
                                                            <div class="col-lg-12">
                                                                <div class="add-three category-add-text">

                                                                    <div class="category-text">
                                                                        <button data-bs-toggle="modal"
                                                                            data-bs-target="#addCity">
                                                                            Add City
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table header-border" id="cityinfo">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.ID')</th>
                                                                    <th>Courier Name</th>
                                                                    <th>City Name</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
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
                            <!-------------========= Modal add Category start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="addCity" tabindex="-1" aria-labelledby="addCity"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="card m-0">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title card-title">
                                                            Create New City
                                                        </h5>
                                                    </div>
                                                    <div class="card-body custom-card-body Product-body">
                                                        <form name="form" id="AddCity" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="successSMS"></div>
                                                            <div class="form-group mb-3">
                                                                <label for="menuName" class="control-label mt-2">Courier
                                                                    Name</label>
                                                                <div class="">
                                                                    <select class="form-control" name="courier_id"
                                                                        id="courier_id" required>
                                                                        <option value="">Select Courier</option>
                                                                        @forelse ($couriers as $courier)
                                                                            <option value="{{ $courier->id }}">
                                                                                {{ $courier->courierName }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group pb-3">
                                                                <label for="websiteTitle" class="control-label">City
                                                                    name</label>
                                                                <div class="webtitle">
                                                                    <input type="text" class="form-control"
                                                                        name="cityName" id="cityName" required>
                                                                    <span
                                                                        class="text-danger">{{ $errors->has('cityName') ? $errors->first('cityName') : '' }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group pb-3">
                                                                <label for="websiteTitle"
                                                                    class="control-label">Division</label>
                                                                <div class="webtitle">
                                                                    <select class="form-control" name="division"
                                                                        id="division">
                                                                        <option value="">Select Division</option>
                                                                        <option value="Dhaka">Dhaka</option>
                                                                        <option value="Barishal">Barishal</option>
                                                                        <option value="Chattogram">Chattogram</option>
                                                                        <option value="Khulna">Khulna</option>
                                                                        <option value="Mymenshing">Mymenshing</option>
                                                                        <option value="Rajshahi">Rajshahi</option>
                                                                        <option value="Rangpur">Rangpur</option>
                                                                        <option value="Sylhet">Sylhet</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3"
                                                                style=" width: 60%; float: left; padding-top: 50px; ">
                                                                <div class="info-button">
                                                                    <button type="submit">Submit</button>
                                                                    <button class="gradient-button ml-2"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-------------========= Modal add Category End ===========--------->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>

    <!---------=============== Modal city details part start ====================------------>
    <div class="modal fade" id="editmainCity" tabindex="-1" aria-labelledby="editmainCity" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card m-0">
                    <div class="modal-header">
                        <h5 class="modal-title card-title">
                            Edit City
                        </h5>
                    </div>
                    <div class="card-body custom-card-body Product-body">
                        <form name="form" id="EditCity" enctype="multipart/form-data">
                            @csrf
                            <div class="successSMS"></div>

                            <div class="form-group mb-3">
                                <label for="menuName" class="control-label mt-2">Courier Name</label>
                                <div class="">
                                    <select class="form-control" name="courier_id" id="editcourier_id" required>
                                        <option value="">Select Courier</option>
                                        @forelse ($couriers as $courier)
                                            <option value="{{ $courier->id }}">{{ $courier->courierName }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <input type="text" name="id" id="idhidden" hidden>
                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">City name</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="cityName" id="editcityName"
                                        required>
                                    <span
                                        class="text-danger">{{ $errors->has('cityName') ? $errors->first('cityName') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">Division</label>
                                <div class="webtitle">
                                    <select class="form-control" name="division" id="division">
                                        <option value="">Select Division</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Barishal">Barishal</option>
                                        <option value="Chattogram">Chattogram</option>
                                        <option value="Khulna">Khulna</option>
                                        <option value="Mymenshing">Mymenshing</option>
                                        <option value="Rajshahi">Rajshahi</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Sylhet">Sylhet</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3" style=" width: 60%; float: left; padding-top: 50px; ">
                                <div class="info-button">
                                    <button type="submit">Update</button>
                                    <button class="gradient-button ml-2" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {

            var cityinfotbl = $('#cityinfo').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.city.data') !!}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'couriers.courierName'
                    },
                    {
                        data: 'cityName'
                    },
                    {
                        "data": null,
                        render: function(data) {

                            if (data.status === 'Active') {
                                return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="Inactive" id="citystatusBtn" data-id="' +
                                    data.id + '">Active</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="Active" id="citystatusBtn" data-id="' +
                                    data.id + '" >Inactive</button>';
                            }


                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });


            //add user

            $('#AddCity').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    uploadUrl: '{{ route('admin.cities.store') }}',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#cityName').val('');
                        $('#courier_id').val('');

                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                        });
                        cityinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //edit city

            $(document).on('click', '#editCityBtn', function() {
                let cityId = $(this).data('id');
                $('#editcourier_id').val('');
                $('#editcityName').val('');
                $('#EditCity').attr('data-id', '');
                $.ajax({
                    type: 'GET',
                    url: 'cities/' + cityId + '/edit',

                    success: function(data) {
                        $('#EditCity').find('#division').val(data.division);
                        $('#EditCity').find('#editcourier_id').val(data.courier_id);
                        $('#EditCity').find('#editcityName').val(data.cityName);
                        $('#EditCity').find('#idhidden').val(data.id);
                        $('#EditCity').attr('data-id', data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

            //update city
            $('#EditCity').submit(function(e) {
                e.preventDefault();
                let cityId = $('#idhidden').val();

                $.ajax({
                    type: 'POST',
                    url: 'city/' + cityId,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#editcourier_id').val('');
                        $('#editcityName').val('');

                        $("#EditCity").trigger("reset");

                        Swal.fire({
                            title: "Courier update successfully !",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        cityinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //deleteuser

            $(document).on('click', '#deleteCityBtn', function() {
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
                            url: 'cities/' + courierId,
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
                                    cityinfotbl.ajax.reload();
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

            $(document).on('click', '#citystatusBtn', function() {
                let cityId = $(this).data('id');
                let cityStatus = $(this).data('status');

                $.ajax({
                    type: 'PUT',
                    url: 'city/status',
                    data: {
                        city_id: cityId,
                        status: cityStatus,
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
                        cityinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });











        });
    </script>
@endsection
