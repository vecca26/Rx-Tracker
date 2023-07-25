@extends('layouts.app')
@section('content')
  <div class="container client-profile mt-4">
                    <h3>Edit Profile</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                               
                                 <div class="modal-body">
                                                <form method='post' action="{{route('brand_manager.update', encrypt($id)) }}" >
                                               @csrf
                                                {{ method_field('PUT') }}
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Enter First Name</label>
                                                        <input type="text" class="form-control" value="{{$userData[0]->first_name}}" name="first_names" id="first_names"
                                                            placeholder="First Name" >
                                                             @if ($errors->has('first_names'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('first_names') }}</strong>
                                                </span>
                                                @endif
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Enter Last Name</label>
                                                        <input type="text" class="form-control"  name="last_names" id="last_names" value="{{$userData[0]->last_name}}"
                                                            placeholder="Last Name" >

                                                             @if ($errors->has('last_names'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('last_names') }}</strong>
                                                </span>
                                                @endif
                                                    </div>
                                                </div>
                                                <!-- <div class="form-row">
                                                      <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="emails" name="emails"
                                                            placeholder="Enter Email" required>
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Password</label>
                                                        <input type="password" class="form-control" name="passwords" id="passwords" placeholder="Enter Password" >
                                                    </div>
                                                </div> -->
                                                <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="emails" name="emails" value="{{$userData[0]->email}}"
                                                            placeholder="Enter Email" >
                                                             @if ($errors->has('emails'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('emails') }}</strong>
                                                </span>
                                                @endif
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Phone</label>
                                                        <input type="phone" class="form-control" name="phones" id="phones"  value="{{$userData[0]->phone}}" placeholder="Enter Phone Number">
                                                         @if ($errors->has('phones'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('phones') }}</strong>
                                                </span>
                                                @endif
                                                    </div>
                                                    <!--  <div class="form-group col-md-6">
                                                        <label for="">Employee id</label>
                                                        <input type="text" class="form-control" name="employe_ids" id="employe_ids" placeholder="Enter employee id">
                                                    </div> -->
                                                </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select Region</label>
                                                        <select id="region_selects" name="region_selects" required="required" class="form-select" >
                                                        </select>
                                                      </div>
                                                        <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select HQ</label>
                                                        <select id="hq_selects" name="hq_selects" required="required" class="form-select" >
                                                        </select>
                                                      </div>
                                                      <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                                                      <div class="modal-footer">
                                                <div class="add-rx-btn">
                                                    <button type="submit" class="btn btn-add">EDIT</button>
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