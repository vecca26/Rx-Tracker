@extends('layouts.app')
@section('content')
<div class="container ffmanage-page mt-4">
    <div class="row pl-3 pr-3">
        <div class="col-md-9">
            <form class="form-inline">
                <a class="brand-title">Manage Field Force</a>
                <div class="input-group">
                    <select class="form-select mr-1" id="region_id" name="region_id">
                        <option value="">Choose Region</option>
                        @foreach ($region as $key => $value)
                        <option value="{{$value->id}}">{{$value->region}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select mr-1" id="hq_id" name="hq_id">
                        <option value="">Choose Area</option>
                        @foreach ($hq as $key => $value)
                        <option value="{{$value->id}}">{{$value->hq}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select mr-1" id="team_id" name="team_id">
                        <option value="">Choose Team</option>
                        @foreach ($teams as $key => $value)
                        <option value="{{$value->id}}">{{$value->team}}</option>
                        @endforeach
                    </select>
                </div>
               <!--  <div class="input-group">
                    <select class="form-select mr-1" id="brand_id" name="brand_id">
                        <option value="">Choose Brand</option>
                        @foreach ($brands as $key => $value)
                        <option value="{{$value->id}}">{{$value->brand_name}}</option>
                        @endforeach
                    </select>
                </div> -->
                <!-- <button type="button" class="btn btn-dark"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 13L10.1667 10.1617M11.7368 6.36842C11.7368 7.79221 11.1712 9.15769 10.1645 10.1645C9.15769 11.1712 7.79221 11.7368 6.36842 11.7368C4.94463 11.7368 3.57915 11.1712 2.57237 10.1645C1.5656 9.15769 1 7.79221 1 6.36842C1 4.94463 1.5656 3.57915 2.57237 2.57237C3.57915 1.5656 4.94463 1 6.36842 1C7.79221 1 9.15769 1.5656 10.1645 2.57237C11.1712 3.57915 11.7368 4.94463 11.7368 6.36842Z" stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button> -->
            </form>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2 top-section">
            <div class="btn-group">
                <a class="btn btn-warning" href="{{ Route('ff.create') }}">ADD NEW
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="brand-list-content">
        <div class="card mt-3">
            <div class="brandlist-table table-responsive">
                @if( Session::has("success") )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get("success") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if( Session::has("error") )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ Session::get("error") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div id="list_table">
                    @include('admin.ff.ff_list_table')
                </div>
            </div>

        </div>
      <!--   <div class="row dataTables_info justify-content-between" id="showingBrandEntries">
            <div class="col-md-3">
                <div class="listed-pages">
                    <p>Showing 1 - 10 out of 50</p>
                </div>
            </div>
            <div class="col-md-3 pagintion">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> -->
    </div>
</div>

<div class="modal fade" id="ffModal" tabindex="-1" role="dialog" aria-labelledby="ffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-target="#ffModal">ADD NEW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='POST' action="{{Route('ff.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="">Employee id</label>
                        <input type="text" class="form-control" name="employe_id" id="employe_id" placeholder="Enter EmployeeId">
                    </div>

                    <div class="form-group">
                        <label for="teamSelect">Select Team</label>
                        <select id="team_select" name="team_select" required="required" class="form-select">
                            <option selected value=0>Choose Team</option>
                            @foreach ($teams as $key => $value)
                            <option value="{{$value->id}}">{{$value->team}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teamSelect">Select Region</label>
                        <select id="region_select" name="region_select" required="required" class="form-select">
                            <option selected value=0>Choose Region</option>
                            @foreach ($region as $key => $value)
                            <option value="{{$value->id}}">{{$value->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teamSelect">Select HQ</label>
                        <select id="hq_select" name="hq_select" required="required" class="form-select">
                            <option selected value=0>Choose HQ</option>
                            @foreach ($hq as $key => $value)
                            <option value="{{$value->id}}">{{$value->hq}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <div class="add-rx-btn">
                            <button type="submit" class="btn btn-add">ADD</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="ffModalEdit" tabindex="-1" role="dialog" aria-labelledby="ffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-target="#ffModal">ADD NEW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='POST' action="{{Route('doctor.update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter FirstName</label>
                        <input type="text" class="form-control" name="edit_first_name" id="edit_first_name" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Enter LastName</label>
                        <input type="text" class="form-control" name="edit_last_name" id="edit_last_name" placeholder="Enter Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Enter Email" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="edit_password" id="edit_password" placeholder="Enter Password">
                    </div> -->
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="phone" class="form-control" name="edit_phone" id="edit_phone" placeholder="Enter Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="">Employee id</label>
                        <input type="text" class="form-control" name="edit_employe_id" id="edit_employe_id" placeholder="Enter EmployeeId">
                    </div>

                    <div class="form-group">
                        <label for="teamSelect">Select Team</label>
                        <select id="edit_team_select" name="edit_team_select" required="required" class="form-select">
                            <option selected value=0>Choose...</option>
                            @foreach ($teams as $key => $value)
                            <option value="{{$value->id}}">{{$value->team}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teamSelect">Select Region</label>
                        <select id="edit_region_select" name="edit_region_select" required="required" class="form-select">
                            <option selected value=0>Choose...</option>
                            @foreach ($region as $key => $value)
                            <option value="{{$value->id}}">{{$value->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teamSelect">Select HQ</label>
                        <select id="edit_hq_select" name="edit_hq_select" required="required" class="form-select">
                            <option selected value=0>Choose...</option>
                            @foreach ($hq as $key => $value)
                            <option value="{{$value->id}}">{{$value->hq}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <div class="add-rx-btn">
                            <button type="submit" class="btn btn-add">ADD</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
    let token = "{{ csrf_token() }}";
    function deleteFf(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                useRejections: true,
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    (function($) {
                        $.ajax({
                            type: "DELETE",
                            url: '/ff/destroy',
                            async: true,
                            data: {
                                '_token': token,
                                'id': id
                            },
                            success: function(response) {
                                if (response) {
                                    if (response == "Success") {
                                        swal("Success!", "FF Deleted successfully.", "success", {
                                            button: "Ok",
                                        }).then(function() {
                                            window.location.reload();
                                        });
                                    }
                                    if (response == "Error") {
                                        swal("Error!", "Error deleting FF Details!.", "error", {
                                            button: "Ok",
                                        })
                                    }
                                } else {
                                    console.log("Error");
                                }
                            }
                        });
                    })(jQuery);
                } else {
                    swal("Cancelled!", "You cancelled the operation.", "error", {
                        button: "Ok",
                    })
                }
            });
    }

        $('#brand_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/filter_ff_details',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val(),
                    hq_id: $('#hq_id').val(),
                    team_id: $('#team_id').val(),
                    region_id: $('#region_id').val(),
                },
                success: function(response) {
                    console.log(response);
                    $('#list_table').html(response);
                },
                error: function(error_message) {
                    console.log(error_message);
                }
            });
        });

        $('#hq_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/filter_ff_details',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val(),
                    hq_id: $('#hq_id').val(),
                    team_id: $('#team_id').val(),
                    region_id: $('#region_id').val(),
                },
                success: function(response) {
                    console.log(response);
                    $('#list_table').html(response);
                },
                error: function(error_message) {
                    console.log(error_message);
                }
            });
        });

        $('#team_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/filter_ff_details',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val(),
                    hq_id: $('#hq_id').val(),
                    team_id: $('#team_id').val(),
                    region_id: $('#region_id').val(),
                },
                success: function(response) {
                    console.log(response);
                    $('#list_table').html(response);
                },
                error: function(error_message) {
                    console.log(error_message);
                }
            });
        });

        $('#region_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/filter_ff_details',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val(),
                    hq_id: $('#hq_id').val(),
                    team_id: $('#team_id').val(),
                    region_id: $('#region_id').val(),
                },
                success: function(response) {
                    console.log(response);
                    $('#list_table').html(response);
                },
                error: function(error_message) {
                    console.log(error_message);
                }
            });
        });

    function edit_ff_details(id) {
        let token = "{{csrf_token()}}";
        $.ajax({
            type: "get",
            url: '/fetch_ff_data',
            async: true,
            data: {
                _token: token,
                ff_id: id
            },
            success: function(response) {
                if (response.success == '1') {
                    var data = response.data;
                    console.log(data);
                    $("#doctor").val(data.doctor_list[0].doctor_name);
                    // $("#city_selects").val(data.doctor_list[0].city);
                    var option1 = "<option selected value=" + data.doctor_list[0].city_id + ">" + data.doctor_list[0].city + "</option>";
                    $.each(data.city_list, function(index, value) {
                        option1 = option1 + "<option value=" + value['id'] + ">" + value['city'] + "</option>";
                    });
                    $("#city_selects").html(option1);
                    var option2 = "<option selected value=" + data.doctor_list[0].speciality_id + ">" + data.doctor_list[0].speciality + "</option>";
                    $.each(data.speciality, function(index, value) {
                        option2 = option2 + "<option value=" + value['id'] + ">" + value['speciality'] + "</option>";
                    });
                    $("#speciality_selects").html(option2);
                    var option3 = "<option selected value=" + data.doctor_list[0].institute_id + ">" + data.doctor_list[0].institute_name + "</option>";
                    $.each(data.institute_list, function(index, value) {
                        option3 = option3 + "<option value=" + value['id'] + ">" + value['institute_name'] + "</option>";
                    });
                    $("#institute_selects").html(option3);
                    $("#doc_id").val(id);
                } else {
                    $("#doctor").val("");
                    $("#city_selects").html("");
                    $("#speciality_selects").html("");
                    $("#institute_selects").html("");
                }

            }
        });
    }
</script>
@endpush