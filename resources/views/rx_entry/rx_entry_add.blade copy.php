@extends('layouts.app')
@section('content')
<div class="container client-data-form mt-4">
    <h3>Add New RX</h3>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ Route('rx_entries.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="brand_id">Brand Name</label>
                        <select id="brand_id" name="brand_id" class="form-select" value="{{ old('brand_id') }}">
                            <option value="">Choose Brands</option>
                            @foreach($brands as $key=> $value)
                            <option value="{{$value->brands->id}}" {{ old('brand_id') == $value->brands->id ? 'selected' : '' }}>{{$value->brands->brand_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('brand_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="doctor_id">Doctor Name</label>
                        <select id="doctor_id" name="doctor_id" class="form-select">
                            <option selected>Choose Doctor</option>
                            @foreach($doctors as $key=> $value)
                            <option value="{{$value->doctors->id}}" {{ old('doctor_id') == $value->doctors->id ? 'selected' : '' }}>{{$value->doctors->doctor_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('doctor_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div>{{doctors}}</div>

                    <div class="form-group col-md-4">
                        <label for="speciality">Speciality</label>
                        <select id="speciality_id" name="speciality_id" class="form-select">
                            <option selected>Choose Speciality</option>
                            @foreach($doctors as $key=> $value)
                            <option value="{{$value->doctors->id}}" {{ old('doctor_id') == $value->doctors->id ? 'selected' : '' }}>{{$value->doctors->speciality}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('doctor_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city_id" value="{{ old('city_id') }}" name="city_id" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="institute">Institute</label>
                        <input type="text" class="form-control" id="institute_id" value="{{ old('institute_id') }}" name="institute_id" readonly>
                        <!-- <select id="institute" class="form-select">
                            <option selected></option>
                            <option>...</option>
                        </select> -->
                    </div>
                    <div class="form-group col-md-4">
                        <label for="institute_type">Institute Type</label>
                        <input type="text" class="form-control" id="institute_type" value="{{ old('institute_type') }}" name="institute_type" readonly>
                        <!-- <select id="instituteType" class="form-select">
                            <option selected></option>
                            <option>...</option>
                        </select> -->
                    </div>

                </div>
                <div class="form-row" style="display: none;">
                    <div class="form-group col-md-4">
                        <label for="priscriber">Priscriber</label>
                        <select id="priscriber" class="form-select">
                            <option selected></option>
                            <option value="1">Existing</option>
                            <option value="0">New</option>
                        </select>
                    </div>
                </div>


                <div class="patient-details mt-5">
                    <h4>Patient Details</h4>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="patientName">Patient Name</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ old('patient_name') }}">
                            @if ($errors->has('patient_name'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('patient_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contactNumber">Contact Number</label>
                            <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" name="phone">
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="patient_type">Patient Type</label>
                            <select id="patient_type_id" name="patient_type_id" class="form-select">
                                <option selected>Choose Patient Type</option>
                                @foreach($patient_type as $key=> $value)
                                <option value="{{$value->id}}" {{ old('patient_type_id') == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('patient_type_id'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('patient_type_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="contactType">Contact Type</label>
                            <!-- <input type="text" class="form-control" id="contactType"> -->
                            <select id="patient_type" name="contact_type" id="contact_type" class="form-select">
                                <option selected>-Choose Contact Type-</option>
                                <option value="caretaker" {{ old('contact_type') == "caretaker" ? 'selected' : '' }}>Care Taker</option>
                                <option value="patient" {{ old('contact_type') == "patient" ? 'selected' : '' }}>Patient</option>
                            </select>
                            @if ($errors->has('contact_type'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('contact_type') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label for="indicationRxed">Indication Rxed</label>
                            <select name="indication_id" id="indication_id" class="form-select"></select>
                            @if ($errors->has('indication_id'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('indication_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="schedule">Schedule</label>
                            <select id="schedule" name="schedule" class="form-select">
                                <option value="weekly">Weekly</option>
                                <option value="2weekly">2 Weekly</option>
                                <option value="3weekly">3 Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                            @if ($errors->has('schedule'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('schedule') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="dose">Dose</label>
                                    <input type="text" class="form-control" value="{{ old('dose') }}" id="dose" name="dose">
                                    @if ($errors->has('dose'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('dose') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <label for="start_date">Treatment Start Date</label>
                                    <input type="date" value="{{ old('start_date') }}" class="form-control" id="start_date" name="start_date">
                                    @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-4">
                            <div class="row">
                                <div class="col-md-5" style="display: none;">
                                    <label for="cycle_repeat">Cycle Repeated</label>
                                    <select id="cycle_repeat" name="cycle_repeat" class="form-select">
                                        <option value="yes" selected>Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    @if ($errors->has('cycle_repeat'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('cycle_repeat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-7 upload-file">
                                    <input type="file" id="rx_copy_link" name="rx_copy_link" hidden />
                                    <label for="rx_copy_link"><img src="images/icons/upload.png"> Upload Rx Copy</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4" style="display: none;">
                            <label for="reason">Reason for Dose Delay/Discontinuation</label>
                            <input type="text" class="form-control" id="reason" name="reason">
                        </div>
                    </div>
                    <div class="add-rx-button">
                        <button type="submit" class="btn btn-warning">SAVE</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    let token = "{{csrf_token()}}";

    (function($) {
        $('#brand_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/fetch_indications',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val()
                },
                success: function(response) {
                    if (response.success == '1') {
                        var data = response.data;
                        var option = "<option value='0'>Choose Indications</option>";
                        $.each(data, function(index, value) {
                            option = option + "<option value=" + value['id'] + ">" + value['name'] + "</option>";
                        });
                        $("#indication_id").html(option);
                    } else {
                        var option = "<option value='0'>Choose Indications</option>";
                        $("#indication_id").html(option);
                    }
                }

            });
        });

        $('#speciality_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/fetch_doctor_details',
                async: true,
                data: {
                    _token: token,
                    doctor_id: $('#doctor_id').val(),
                    speciality_id: $('#speciality_id').val()
                },
                success: function(response) {
                    console.log('value', response);
                    if (response.success == '1') {
                        var data = response.data;
                        console.log('value', data);
                        $("#city_id").val(data.city.city);
                        $("#institute_id").val(data.institute.institute_name);
                        $("#institute_type").val(data.institute.institute_type);
                    } else {
                        $("#city_id").val("");
                        $("#institute_id").val("");
                        $("#institute_type").val("");
                    }
                }

            });
        });

    })(jQuery);
</script>

@endsection