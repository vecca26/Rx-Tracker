@extends('layouts.app')
@section('content')
  <div class="container client-profile mt-4">
                    <h3>ADD BRAND MANAGER</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                               
                                 <div class="modal-body">
                                                <form method='post' action="{{route('brand_manager.store') }}" >
                                               @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Enter First Name</label>
                                                        <input type="text" class="form-control"  name="first_name" id="first_name" value="{{ old('first_name') }}"
                                                            placeholder="First Name" >
                                                            @if ($errors->has('first_name'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Enter Last Name</label>
                                                        <input type="text" class="form-control"  name="last_name" id="last_name"  value="{{ old('last_name') }}"
                                                            placeholder="Last Name" >
                                                            @if ($errors->has('last_name'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                      <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email"  value="{{ old('email') }}"
                                                            placeholder="Enter Email" >
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password" >
                                                         @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                      <div class="form-group col-md-6">
                                                        <label for="">Employee id</label>
                                                        <input type="text" class="form-control" name="employee_id" id="employee_id" value="{{ old('employee_id') }}" placeholder="Enter employee id">
                                                        @if ($errors->has('employee_id'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('employee_id') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Phone</label>
                                                        <input type="phone" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                                        @if ($errors->has('phone'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                                @endif
                                                    </div>
                                                    
                                                </div>
                                                 <div class="form-row">
                                                    
                                                      <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select Brand</label>
                                                        <select id="brand_select" name="brand_select"  class="form-select" >
                                                            <option value="">Choose Brand</option>
                                                             @foreach ($brand_list as $key => $brand_list)
                                                             <option value="{{$brand_list->id}}" {{ old('brand_select') == $brand_list->id ? 'selected' : '' }}>{{$brand_list->brand_name}}</option>
                                                            
                                                           @endforeach
                                                        </select>
                                                        @if ($errors->has('brand_select'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('brand_select') }}</strong>
                                                </span>
                                                @endif
                                                      </div>
                                                  </div>
                                                     
                                                      <!-- <div class="modal-footer">
                                                <div class="add-rx-btn">
                                                    <button type="submit" class="btn btn-add">ADD</button>
                                                </div>
                                            </div> -->
                                              <div class="add-rx-button">
                            <input type="submit" value="Submit" class="btn btn-warning">
                            <!-- <a href="#" id="add_rx_step1_next" class="btn btn-warning">Save</a> -->
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