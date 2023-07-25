@extends('layouts.app')
@section('content')
<div class="container client-profile mt-4">
    <h3>Add FF Details</h3>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ Route('ff.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> First Name <span style="color:red;"> * </span></label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" id="first_name" value="{{ old('first_name')}}" required>
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
                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" id="last_name" value="{{ old('last_name')}}" required>
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
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" value="{{ old('email')}}" required>
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
                            <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Enter Employee Id" value="{{ old('employee_id')}}" required>
                            @if ($errors->has('employe_id'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('employe_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Phone <span style="color:red;"> * </span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone" id="phone" value="{{ old('phone')}}" required>
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Password <span style="color:red;"> * </span></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" id="password" value="{{ old('password')}}" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select Team</label>
                            <select id="team_select" name="team_select" required="required" class="form-select">
                                <option selected value=0>Choose...</option>
                                @foreach ($teams as $key => $value)
                                <option value="{{$value->id}}">{{$value->team}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select Region</label>
                            <select id="region_select" name="region_select" required="required" class="form-select">
                                <option selected value=0>Choose...</option>
                                @foreach ($region as $key => $value)
                                <option value="{{$value->id}}">{{$value->region}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select HQ</label>
                            <select id="hq_select" name="hq_select" required="required" class="form-select">
                                <option selected value=0>Choose...</option>
                                @foreach ($hq as $key => $value)
                                <option value="{{$value->id}}">{{$value->hq}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="teamSelect">Select BDM</label>
                            <select id="bdm_select" name="bdm_select" required="required" class="form-select">
                               <option value="">Choose bdm</option>
                               @foreach ($bdm_list as $key => $value)
                             <option value="{{$value->id}}" {{ old('bdm_select') == $value->id ? 'selected' : '' }}>{{$value->first_name}} {{$value->last_name}}</option>
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