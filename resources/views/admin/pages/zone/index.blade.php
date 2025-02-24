@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>Zone List</h3>
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
                                                        Zone List
                                                    </h4>
                                                    <div class="table-responsive">
                                                        <div class="row product-row">
                                                            <div class="col-lg-12">
                                                                <div class="add-three category-add-text">

                                                                    <div class="category-text">
                                                                        <button data-bs-toggle="modal"
                                                                            data-bs-target="#addZone">
                                                                            Add Zone
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table header-border" id="zoneinfo">
                                                            <thead>
                                                                <tr>
                                                                    <th> ID</th>
                                                                    <th>Courier Name</th>
                                                                    <th>City Name</th>
                                                                    <th>Zone Name</th>
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
                                    <div class="modal fade" id="addZone" tabindex="-1" aria-labelledby="addZone"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="card m-0">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title card-title">
                                                            Create New Zone
                                                        </h5>
                                                    </div>
                                                    <div class="card-body custom-card-body Product-body">
                                                        <form name="form" id="AddZone" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="successSMS"></div>

                                                            <div class="form-group mb-3">
                                                                <label for="menuName" class="control-label mt-2">Courier
                                                                    Name</label>
                                                                <div class="">
                                                                    <select class="form-control" name="courier_id"
                                                                        id="courier_id" onchange="cityupdatenow()" required>
                                                                        <option value="">Select Courier</option>
                                                                        @forelse ($couriers as $courier)
                                                                            <option value="{{ $courier->id }}">
                                                                                {{ $courier->courierName }}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="menuName" class="control-label mt-2">City
                                                                    name</label>
                                                                <div class="">
                                                                    <select class="form-control" name="city_id"
                                                                        id="city_id" required>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label for="websiteTitle" class="control-label">Zone
                                                                    name</label>
                                                                <div class="webtitle">
                                                                    <input type="text" class="form-control"
                                                                        name="zoneName" id="zoneName" required>
                                                                    <span
                                                                        class="text-danger">{{ $errors->has('zoneName') ? $errors->first('zoneName') : '' }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group pb-3">
                                                                <label for="websiteTitle" class="control-label">Zone
                                                                    ID</label>
                                                                <div class="webtitle">
                                                                    <input type="text" class="form-control"
                                                                        name="zoneId" id="zoneId">
                                                                    <span
                                                                        class="text-danger">{{ $errors->has('zoneId') ? $errors->first('zoneId') : '' }}</span>
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

    <!---------=============== Modal zone details part start ====================------------>
    <div class="modal fade" id="editmainZone" tabindex="-1" aria-labelledby="editmainZone" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card m-0">
                    <div class="modal-header">
                        <h5 class="modal-title card-title">
                            Edit Zone
                        </h5>
                    </div>
                    <div class="card-body custom-card-body Product-body">
                        <form name="form" id="EditZone" enctype="multipart/form-data">
                            @csrf
                            <div class="successSMS"></div>

                            <div class="form-group mb-3">
                                <label for="menuName" class="control-label mt-2">Courier Name</label>
                                <div class="">
                                    <select class="form-control" name="courier_id" id="editcourier_id"
                                        onchange="editcityupdatenow()" required>
                                        <option value="">Select Courier</option>
                                        @forelse ($couriers as $courier)
                                            <option value="{{ $courier->id }}">{{ $courier->courierName }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="menuName" class="control-label mt-2">City name</label>
                                <div class="">
                                    <select class="form-control" name="city_id" id="editcity_id" required>
                                        <option value="">Select City</option>
                                        @forelse ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->cityName }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">Zone name</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="zoneName" id="editzoneName"
                                        required>
                                    <span
                                        class="text-danger">{{ $errors->has('zoneName') ? $errors->first('zoneName') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">Zone ID</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="zoneId" id="zoneId">
                                    <span
                                        class="text-danger">{{ $errors->has('zoneId') ? $errors->first('zoneId') : '' }}</span>
                                </div>
                            </div>

                            <input type="text" name="id" id="idhidden" hidden>

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
        function cityupdatenow() {
            var select = document.getElementById('courier_id').value;
            $('#city_id').html('');

            $.ajax({
                type: 'GET',
                url: 'set-value/city/' + select,

                success: function(data) {

                    for (var i = 0; i < data.length; i++) {
                        const option = document.createElement("option");
                        const node = document.createTextNode(data[i].cityName);
                        option.setAttribute("value", data[i].id);
                        option.appendChild(node);
                        const element = document.getElementById("city_id");
                        element.appendChild(option);
                    }


                },
                error: function(error) {
                    console.log('error');
                }

            });
        };

        function editcityupdatenow() {
            var select = document.getElementById('editcourier_id').value;
            $('#editcity_id').html('');

            $.ajax({
                type: 'GET',
                url: 'set-value/city/' + select,

                success: function(data) {

                    for (var i = 0; i < data.length; i++) {
                        const option = document.createElement("option");
                        const node = document.createTextNode(data[i].cityName);
                        option.setAttribute("value", data[i].id);
                        option.appendChild(node);
                        const element = document.getElementById("editcity_id");
                        element.appendChild(option);
                    }


                },
                error: function(error) {
                    console.log('error');
                }

            });
        };

        $(document).ready(function() {

            var zoneinfotbl = $('#zoneinfo').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.zone.data') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'couriers.courierName'
                    },
                    {
                        data: 'cities.cityName'
                    },
                    {
                        data: 'zoneName'
                    },
                    {
                        "data": null,
                        render: function(data) {

                            if (data.status === 'Active') {
                                return '<button type="button" class="btn btn-success btn-sm btn-statuszone" data-status="Inactive" id="zonestatusBtn" data-id="' +
                                    data.id + '">Active</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm btn-statuszone" data-status="Active" id="zonestatusBtn" data-id="' +
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


            //add zone

            $('#AddZone').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    uploadUrl: '{{ route('admin.zones.store') }}',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#zoneName').val('');
                        $('#courier_id').val('');
                        $('#city_id').val('');

                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                        });
                        zoneinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //edit zone

            $(document).on('click', '#editZoneBtn', function() {
                let zoneId = $(this).data('id');

                $('#editcourier_id').val('');
                $('#editcity_id').val('');
                $('#editzoneName').val('');
                $('#EditZone').attr('data-id', '');

                $.ajax({
                    type: 'GET',
                    url: 'zones/' + zoneId + '/edit',

                    success: function(data) {
                        $('#EditZone').find('#zoneId').val(data.zoneId);
                        $('#EditZone').find('#editcourier_id').val(data.courier_id);
                        $('#EditZone').find('#editcity_id').val(data.city_id);
                        $('#EditZone').find('#editzoneName').val(data.zoneName);

                        $('#EditZone').find('#idhidden').val(data.id);

                        $('#EditZone').attr('data-id', data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

            //update zone
            $('#EditZone').submit(function(e) {
                e.preventDefault();
                let zoneId = $('#idhidden').val();

                $.ajax({
                    type: 'POST',
                    url: 'zone/' + zoneId,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#editcourier_id').val('');
                        $('#editcity_id').val('');
                        $('#editzoneName').val('');

                        $("#EditZone").trigger("reset");

                        Swal.fire({
                            title: "Courier update successfully !",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        zoneinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //delete zone

            $(document).on('click', '#deleteZoneBtn', function() {
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
                            url: 'zones/' + zoneId,
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
                                    zoneinfotbl.ajax.reload();
                                }
                            },
                            error: function(err) {
                                console.log('err');
                            }
                        });

                    }
                });

            });

            //status update zone

            $(document).on('click', '#zonestatusBtn', function() {
                let zoneId = $(this).data('id');
                let zoneStatus = $(this).data('status');

                $.ajax({
                    type: 'PUT',
                    url: 'zone/status',
                    data: {
                        zone_id: zoneId,
                        status: zoneStatus,
                    },

                    success: function(data) {
                        Swal.fire({
                            title: "@lang('backend.Status updated !')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        zoneinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });











        });
    </script>
@endsection
