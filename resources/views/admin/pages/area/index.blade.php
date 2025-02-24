@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>Area List</h3>
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
                                                        Area List
                                                    </h4>
                                                    <div class="table-responsive">
                                                        <div class="row product-row">
                                                            <div class="col-lg-12">
                                                                <div class="add-three category-add-text">

                                                                    <div class="category-text">
                                                                        <button data-bs-toggle="modal"
                                                                            data-bs-target="#addArea">
                                                                            Add Area
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table header-border" id="areainfo">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.ID')</th>
                                                                    <th>Courier Name</th>
                                                                    <th>Zone Name</th>
                                                                    <th>Area Name</th>
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
                                    <div class="modal fade" id="addArea" tabindex="-1" aria-labelledby="addArea"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="card m-0">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title card-title">
                                                            Create New Area
                                                        </h5>
                                                    </div>
                                                    <div class="card-body custom-card-body Product-body">
                                                        <form name="form" id="AddArea" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="successSMS"></div>

                                                            <div class="form-group mb-3">
                                                                <label for="menuName" class="control-label mt-2">Courier
                                                                    Name</label>
                                                                <div class="">
                                                                    <select class="form-control" name="courier_id"
                                                                        id="courier_id" onchange="zoneupdatenow()" required>
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
                                                                <label for="menuName" class="control-label mt-2">Zone
                                                                    name</label>
                                                                <div class="">
                                                                    <select class="form-control" name="zone_id"
                                                                        id="zone_id" required>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group pb-3">
                                                                <label for="websiteTitle" class="control-label">Area
                                                                    name</label>
                                                                <div class="webtitle">
                                                                    <input type="text" class="form-control"
                                                                        name="areaName" id="areaName" required>
                                                                    <span
                                                                        class="text-danger">{{ $errors->has('areaName') ? $errors->first('areaName') : '' }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group pb-3">
                                                                <label for="websiteTitle" class="control-label">Area
                                                                    ID</label>
                                                                <div class="webtitle">
                                                                    <input type="text" class="form-control"
                                                                        name="areaId" id="areaId">
                                                                    <span
                                                                        class="text-danger">{{ $errors->has('areaId') ? $errors->first('areaId') : '' }}</span>
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

    <!---------=============== Modal area details part start ====================------------>
    <div class="modal fade" id="editmainArea" tabindex="-1" aria-labelledby="editmainArea" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card m-0">
                    <div class="modal-header">
                        <h5 class="modal-title card-title">
                            Edit Area
                        </h5>
                    </div>
                    <div class="card-body custom-card-body Product-body">
                        <form name="form" id="EditArea" enctype="multipart/form-data">
                            @csrf
                            <div class="successSMS"></div>

                            <div class="form-group mb-3">
                                <label for="menuName" class="control-label mt-2">Courier Name</label>
                                <div class="">
                                    <select class="form-control" name="courier_id" id="editcourier_id"
                                        onchange="editzoneupdatenow()" required>
                                        <option value="">Select Courier</option>
                                        @forelse ($couriers as $courier)
                                            <option value="{{ $courier->id }}">{{ $courier->courierName }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="menuName" class="control-label mt-2">Zone name</label>
                                <div class="">
                                    <select class="form-control" name="zone_id" id="editzone_id" required>
                                        <option value="">Select Zone</option>
                                        @forelse ($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->zoneName }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">Area name</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="areaName" id="editareaName"
                                        required>
                                    <span
                                        class="text-danger">{{ $errors->has('areaName') ? $errors->first('areaName') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">Area ID</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="areaId" id="areaId">
                                    <span
                                        class="text-danger">{{ $errors->has('areaId') ? $errors->first('areaId') : '' }}</span>
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
        function zoneupdatenow() {
            var select = document.getElementById('courier_id').value;
            $('#zone_id').html('');

            $.ajax({
                type: 'GET',
                url: 'set-value/zone/' + select,

                success: function(data) {

                    for (var i = 0; i < data.length; i++) {
                        const option = document.createElement("option");
                        const node = document.createTextNode(data[i].zoneName);
                        option.setAttribute("value", data[i].id);
                        option.appendChild(node);
                        const element = document.getElementById("zone_id");
                        element.appendChild(option);
                    }


                },
                error: function(error) {
                    console.log('error');
                }

            });
        };

        function editzoneupdatenow() {
            var select = document.getElementById('editcourier_id').value;
            $('#editzone_id').html('');

            $.ajax({
                type: 'GET',
                url: 'set-value/zone/' + select,

                success: function(data) {

                    for (var i = 0; i < data.length; i++) {
                        const option = document.createElement("option");
                        const node = document.createTextNode(data[i].zoneName);
                        option.setAttribute("value", data[i].id);
                        option.appendChild(node);
                        const element = document.getElementById("editzone_id");
                        element.appendChild(option);
                    }


                },
                error: function(error) {
                    console.log('error');
                }

            });
        };

        $(document).ready(function() {

            var areainfotbl = $('#areainfo').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.area.data') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'couriers.courierName'
                    },
                    {
                        data: 'zones.zoneName'
                    },
                    {
                        data: 'areaName'
                    },
                    {
                        "data": null,
                        render: function(data) {

                            if (data.status === 'Active') {
                                return '<button type="button" class="btn btn-success btn-sm btn-statusarea" data-status="Inactive" id="areastatusBtn" data-id="' +
                                    data.id + '">Active</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm btn-statusarea" data-status="Active" id="areastatusBtn" data-id="' +
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


            //add area

            $('#AddArea').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    uploadUrl: '{{ route('admin.areas.store') }}',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#areaName').val('');
                        $('#courier_id').val('');
                        $('#zone_id').val('');

                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                        });
                        areainfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //edit area

            $(document).on('click', '#editAreaBtn', function() {
                let areaId = $(this).data('id');

                $('#editcourier_id').val('');
                $('#editzone_id').val('');
                $('#editareaName').val('');
                $('#EditArea').attr('data-id', '');

                $.ajax({
                    type: 'GET',
                    url: 'areas/' + areaId + '/edit',

                    success: function(data) {
                        $('#EditArea').find('#areaId').val(data.areaId);
                        $('#EditArea').find('#editcourier_id').val(data.courier_id);
                        $('#EditArea').find('#editzone_id').val(data.zone_id);
                        $('#EditArea').find('#editareaName').val(data.areaName);

                        $('#EditArea').find('#idhidden').val(data.id);

                        $('#EditArea').attr('data-id', data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

            //update area
            $('#EditArea').submit(function(e) {
                e.preventDefault();
                let areaId = $('#idhidden').val();

                $.ajax({
                    type: 'POST',
                    url: 'area/' + areaId,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#editcourier_id').val('');
                        $('#editzone_id').val('');
                        $('#editareaName').val('');

                        $("#EditArea").trigger("reset");

                        Swal.fire({
                            title: "Area update successfully !",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        areainfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //delete area

            $(document).on('click', '#deleteAreaBtn', function() {
                let areaids = $(this).data('id');
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
                            url: 'areas/' + areaids,
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
                                    areainfotbl.ajax.reload();
                                }
                            },
                            error: function(err) {
                                console.log('err');
                            }
                        });

                    }
                });

            });

            //status update area

            $(document).on('click', '#areastatusBtn', function() {
                let areaId = $(this).data('id');
                let areaStatus = $(this).data('status');

                $.ajax({
                    type: 'PUT',
                    url: 'area/status',
                    data: {
                        area_id: areaId,
                        status: areaStatus,
                    },

                    success: function(data) {
                        Swal.fire({
                            title: "@lang('backend.Status updated !')",
                            icon: "success",
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#DD6B55",
                        });
                        areainfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });











        });
    </script>
@endsection
