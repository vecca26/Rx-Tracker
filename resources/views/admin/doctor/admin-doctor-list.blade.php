@extends('layouts.app')
@section('content')
<div class="container brandlist-page">

    <div class="row pl-3 pr-3">
        <div class="col-md-9">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <form class="form-inline" method='post' action="{{route('doctor.search')}}">
                @csrf
                <a class="brand-title">Manage Doctors </a>
                <div class="input-group">

                    <input class="form-control" type="search" placeholder="Search Doctors" aria-label="Search" name="keyword" id="keyword">
                    <button type="submit" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2 top-section">
            <div class="btn-group">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#brandModal">ADD NEW DOCTOR
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </button>


                <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="brandModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="brandModalLabel">ADD NEW</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method='post' action="{{route('doctor.add')}}" id="add-admin-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Enter Doctor Name</label>
                                        <input type="text" class="form-control" id="doctor_name" name="doctor_name" placeholder="Enter doctor name" required minlength="2" maxlength="50">
                                        @error('doc_name')
                                        <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="teamSelect">Enter City</label>
                                        <input type="text" class="form-control" id="city_select" name="city_select" placeholder="Enter city" required minlength="2" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="teamSelect">Select Speciality</label>
                                        <select id="speciality_select" name="speciality_select" required="required" class="form-select">
                                            <option selected value="">Choose...</option>
                                            @foreach ($speciality as $key => $speciality)
                                            <option value="{{$speciality->id}}">{{$speciality->speciality}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Institute</label>
                                        <select id="institute_select" name="institute_select" required="required" class="form-select">
                                            <option selected value="">Choose...</option>
                                            @foreach ($institute_list as $key => $institute_list)
                                            <option value="{{$institute_list->id}}">{{$institute_list->institute_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select FF</label>
                                        <select id="ff_selects" name="ff_selects" required="required" class="form-select">
                                            <option selected value="">Choose...</option>
                                            @foreach ($ff_list as $key => $ff_list)
                                            <option value="{{$ff_list->id}}">{{$ff_list->first_name}} {{$ff_list->last_name}}</option>
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
                <div class="modal fade" id="doctorEdit" tabindex="-1" role="dialog" aria-labelledby="giftAddCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="brandModalLabel">Edit Doctor Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method='post' action="{{route('doctor.update')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Enter Doctor Name</label>
                                        <input type="text" class="form-control" id="doctor" name="doctor" placeholder="Enter doctor name" value="" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="teamSelect">Enter City</label>

                                        <input type="text" class="form-control" id="city_selects" name="city_selects" placeholder="Enter city" value="" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="teamSelect">Select Speciality</label>
                                        <select id="speciality_selects" name="speciality_selects" required="required" class="form-select">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Institute</label>
                                        <select id="institute_selects" name="institute_selects" required="required" class="form-select">
                                        </select>
                                    </div>
                                    <input type="hidden" name="doc_id" id="doc_id" value="">
                                    <div class="modal-footer">
                                        <div class="add-rx-btn">
                                            <button type="submit" class="btn btn-add">UPDATE</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-list-content">
        <div class="card mt-3">
            <div class="doctorlist-table table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="col-md-2 text-center">SL.NO</th>
                            <th scope="col" class="col-md-2">Doctors Name</th>
                            <th scope="col" class="col-md-2">Institute</th>
                            <th scope="col" class="col-md-2">Speciality</th>
                            <th scope="col" class="col-md-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctor_list as $key => $doctor_lists)
                        <tr>
                            <td class="text-center">{{$key+1}}</td>
                            <td><img class="doctor-pic" src="images/doctor-pic.png"> {{$doctor_lists->doctor_name}}</td>
                            <td>{{$doctor_lists->institute_name}}</td>
                            <td>{{$doctor_lists->speciality}}</td>
                            <td class="actions text-center">
                                <button type="button" class="doctor_edit" id="{{$doctor_lists->id}}" data-toggle="modal" data-target="#doctorEdit">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.325 4.11766L15.8876 0.680256C15.439 0.258855 14.8511 0.017061 14.2358 0.000869084C13.6205 -0.0153228 13.0207 0.195217 12.5505 0.592439L1.2598 11.8832C0.854294 12.2921 0.601806 12.8281 0.544719 13.4012L0.00527272 18.6325C-0.0116271 18.8163 0.0122157 19.0015 0.0751012 19.175C0.137987 19.3485 0.238367 19.5059 0.369086 19.6362C0.486309 19.7524 0.625331 19.8444 0.778179 19.9069C0.931028 19.9693 1.0947 20.0009 1.2598 20H1.37271L6.60409 19.5233C7.17715 19.4662 7.71313 19.2137 8.12207 18.8082L19.4128 7.51743C19.851 7.05447 20.0879 6.43667 20.0714 5.7994C20.055 5.16213 19.7865 4.55738 19.325 4.11766ZM6.37827 17.0142L2.61469 17.3655L2.95341 13.6019L10.0415 6.60163L13.4287 9.98885L6.37827 17.0142ZM15.0596 8.30778L11.6975 4.94565L14.1438 2.43659L17.5687 5.86145L15.0596 8.30778Z" fill="#818181" />
                                    </svg>
                                </button>
                                <form class="dropdown-menu  dropdown-menu-right p-3" action="{{ route('doctor.delete', $doctor_lists->id) }}" method="post" id="deleteform">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="button" class="delete" id="{{$doctor_lists->id}}"><img src="images/icons/delete.svg"></button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class='col-12'>{{ $doctor_list->links() }}</div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#ff_select').multiselect({
            includeSelectAllOption: true,
        });
        $("#add-admin-form").validate({
            rules: {
                doctor_name: {
                    required: true,
                    maxlength: 50
                }
            }
        });
    });
    @if(count($errors) > 0)
    $('#brandModal').modal('show');
    @endif
    $(".delete").click(function() {
        var deleteConfirm = confirm('Are you sure to delete doctor');

        if (deleteConfirm) {
            let token = "{{csrf_token()}}";
            var id = this.id;
            $.ajax({
                type: "delete",
                url: '/delete_doctor_data',
                async: true,
                data: {
                    _token: token,
                    doctor_id: id
                },
                success: function(response) {
                    if (response.success == '1') {
                        alert("deleted");
                        location.reload();
                    }
                }
            });
        }

    });
    //edit
    $(".doctor_edit").click(function() {
        let token = "{{csrf_token()}}";
        var id = this.id;
        $.ajax({
            type: "get",
            url: '/fetch_doctor_data',
            async: true,
            data: {
                _token: token,
                doctor_id: id
            },
            success: function(response) { 
                console.log(response);
                if (response.success == '1') {
                    var data = response.data;
                    console.log(data);
                    $("#doctor").val(data.doctor_list[0].doctor_name);
                    $("#city_selects").val(data.doctor_list[0].city);
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
    });
</script>
@endpush