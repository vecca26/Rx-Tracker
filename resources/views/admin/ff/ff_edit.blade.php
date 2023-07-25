@extends('layouts.app')
@section('content')
<div class="container client-profile mt-4">
    <h3>Edit FF Details</h3>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ Route('ff.update', $id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> First Name <span style="color:red;"> * </span></label>
                            <input type="text" class="form-control" name="first_name" value="{{$users->first_name}}" placeholder="Enter First Name" id="first_name" value="{{ old('first_name')}}" required>
                            @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Last Name <span style="color:red;"> * </span></label>
                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" id="last_name" value="{{$users->last_name}}" required>
                            @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Email <span style="color:red;"> * </span></label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$users->email}}" id="email" value="{{ old('email')}}" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Employee Id<span style="color:red;"> * </span></label>
                            <input type="text" class="form-control" name="employe_id" id="employe_id" value="{{$users->employee_id}}" placeholder="Enter Employee Id" value="{{ old('employee_id')}}" required>
                            @if ($errors->has('employee_id'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('employee_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Phone <span style="color:red;"> * </span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone" value="{{$users->phone}}" id="phone" value="{{ old('phone')}}" required>
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select Team</label>
                            <select id="team_select" name="team_select" required="required" class="form-select">
                                <option selected value=0>Choose Team</option>
                                @foreach ($teams as $key => $value)
                                <option value="{{$value->id}}" @if($value->id==$users->team_id) selected @endif>{{$value->team}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select Region</label>
                            <select id="region_select" name="region_select" required="required" class="form-select">
                                <option selected value=0>Choose Region</option>
                                @foreach ($region as $key => $value)
                                <option value="{{$value->id}}" @if($value->id==$users->region_id) selected @endif>{{$value->region}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select HQ</label>
                            <select id="hq_select" name="hq_select" required="required" class="form-select">
                                <option selected value=0>Choose HQ</option>
                                @foreach ($hq as $key => $value)
                                <option value="{{$value->id}}" @if($value->id==$users->hq_ids) selected @endif>{{$value->hq}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="bdmSelect">Select BDM</label>
                            <select id="bdm_select" name="bdm_select" required="required" class="form-select">
                                <option selected value="">Choose...</option>
                                @foreach ($bdm_list as $key => $value)
                                <option value="{{$value->id}}" @if($value->id==$users->bdm_id) selected @endif>{{$value->first_name}} {{$value->last_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
               
                <div class="form-row">
                    <div class="form-group col-md-11">
                    </div>
                    <div class="form-group col-md-1">
                        <div class="add-rx-button">
                            <input type="submit" value="Submit" class="btn btn-warning">
                            <!-- <a href="#" id="add_rx_step1_next" class="btn btn-warning">Save</a> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_pic_img_src').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile_pic").change(function() {
        readURL(this);
    });
</script>
@endsection