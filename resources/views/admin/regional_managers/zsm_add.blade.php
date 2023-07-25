@extends('layouts.app')
@section('content')
  <div class="container client-profile mt-4">
                    <h3>ADD ZSM</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                               
                                 <div class="modal-body">
                                                <form method='post' action="{{route('regional_manager.store') }}" >
                                               @csrf
                                                <div class="form-row">
                                                     <div class="form-group col-md-4">
                                                        <label for="">Enter First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                                            placeholder="Enter Manager Name" >
                                                            @if ($errors->has('first_name'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                     <div class="form-group col-md-4">
                                                        <label for="">Enter Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                                            placeholder="Enter Manager Name" >
                                                            @if ($errors->has('last_name'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                                            placeholder="Enter Email" >
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                     
                                                     <div class="form-group col-md-4">
                                                        <label for="">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password" >
                                                        @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Phone</label>
                                                        <input type="phone" class="form-control" name="phone" id="phone"  value="{{ old('phone') }}" placeholder="Enter Phone Number" >
                                                        @if ($errors->has('phone'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                     <div class="form-group col-md-4">
                                                        <label for="">Employee id</label>
                                                        <input type="text" class="form-control" name="employee_id" id="employee_id" value="{{ old('employee_id') }}" placeholder="Enter employee id" >
                                                        @if ($errors->has('employee_id'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('employee_id') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                      <div class="form-group col-md-4">
                                                        <label for="teamSelect">Select Team</label>
                                                        <select id="team_select" name="team_select"  class="form-select" >
                                                            <option value="">choose team</option>
                                                           @foreach ($teams as $key => $teams)
                                                            <!-- <option value="{{$teams->id}}">{{$teams->team}}</option> -->
                                                            <option value="{{$teams->id}}" {{ old('team_select') == $teams->id ? 'selected' : '' }}>{{$teams->team}}</option>
                                                           @endforeach  
                                                        </select>
                                                        @if ($errors->has('team_select'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('team_select') }}</strong>
                                                                </span>
                                                                @endif
                                                      </div>
                                                       <div class="form-group col-md-4">
                                                        <label for="teamSelect">Select Region</label>
                                                        <select id="region_select" name="region_select" class="form-select" >
                                                             <option value="">Choose region</option>
                                                           @foreach ($region_list as $key => $region_list)
                                                            <!-- <option value="{{$region_list->id}}">{{$region_list->region}}</option> -->
                                                            <option value="{{$region_list->id}}" {{ old('region_select') == $region_list->id ? 'selected' : '' }}>{{$region_list->region}}</option>
                                                           @endforeach  
                                                        </select>
                                                        @if ($errors->has('region_select'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('region_select') }}</strong>
                                                                </span>
                                                                @endif
                                                      </div>
                                                      <div class="form-group col-md-4">
                                                        <label for="teamSelect">Select HQ</label>
                                                        <select id="hq_select" name="hq_select"  class="form-select" >
                                                       <option value="">choose hq</option>
                                                           @foreach ($hq_list as $key => $hq_list)
                                                            <!-- <option value="{{$hq_list->id}}">{{$hq_list->hq}}</option> -->
                                                            <option value="{{$hq_list->id}}" {{ old('hq_select') == $hq_list->id ? 'selected' : '' }}>{{$hq_list->hq}}</option>
                                                           @endforeach  
                                                        </select>
                                                        @if ($errors->has('hq_select'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('hq_select') }}</strong>
                                                                </span>
                                                                @endif
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