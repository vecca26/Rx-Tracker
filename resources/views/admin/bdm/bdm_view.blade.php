@extends('layouts.app')
@section('content')
  <div class="container client-profile mt-4">
                    <h3> Profile</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                               
                                 <div class="modal-body">
                                                <form>
                                               @csrf
                                                {{ method_field('PUT') }}
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="">First Name</label>
                                                        <input type="text" class="form-control" value="{{$userData[0]->first_name}}" readonly disabled >
                                                            
                                                    </div>
                                                      <div class="form-group col-md-4">
                                                        <label for=""> Last Name</label>
                                                        <input type="text" class="form-control" value="{{$userData[0]->last_name}}" readonly disabled>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="emails" name="emails" value="{{$userData[0]->email}}" readonly disabled >
                                                            
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                      <div class="form-group col-md-4">
                                                        <label for="">Phone</label>
                                                        <input type="phone" class="form-control" name="phones" id="phones"  value="{{$userData[0]->phone}}" readonly disabled>
                                                    </div>
                                                     <div class="form-group col-md-4">
                                                        <label for="">Employee id</label>
                                                        <input type="text" class="form-control" name="employee_ids" id="employee_ids" value="{{$userData[0]->employee_id}}"  readonly disabled>
                                                    </div>
                                                     <div class="form-group col-md-4">
                                                        <label for="">HQ</label>
                                                        <input type="text" class="form-control" value="{{$userData[0]->hq}}" readonly disabled>
                                                    </div>
                                                </div>
                                                    
                                                     
                                                      <div class="modal-footer">
                                                
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