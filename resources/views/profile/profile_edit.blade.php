@extends('layouts.app')
@section('content')
<div class="container client-profile mt-4">
    <h3>Edit Profile</h3>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ url('profile/' . encrypt($user->id)) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="update-pp">
                            <input type="file" name="profile_pic" id="profile_pic" hidden="">
                            <!-- src="{{ asset('images/profile_pc/'.$user->profile_pic)}}" -->
                            <label for="profile_pic"><img id="profile_pic_img_src" name="profile_pic_img_src" @if($user->profile_pic==null)) src="{{ asset('images/edit-pp.png') }}"@else src="{{ asset('images/profile_pc/'.$user->profile_pic)}}" @endif>
                                <span>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.75 3.75L10.25 6.25M0.75 10.25V13.25H3.75L13.25 3.75L10.25 0.75L0.75 10.25Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </label>
                            <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                            <p>TEAM - A</p>
                        </div>
                    </div>

                    <div class="col-md-4 edit-profile-datails">
                        <h4>Details</h4>

                        <div class="form-group">
                            <label for="name">Display Name</label>
                            <div class=" input-container">
                                <input type="text" class="form-control" id="display_name" name="display_name" aria-describedby="" value="{{ $user->first_name }} {{ $user->last_name }}"  readonly>
                                <i class="fa fa-pencil icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <div class=" input-container">
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" aria-describedby="" placeholder="Enter Firstname">
                                <i class="fa fa-pencil icon"></i>

                            </div>

                        </div>
                        @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <div class=" input-container">
                                <input type="text" class="form-control" value="{{ $user->last_name }}" id="last_name" name="last_name" aria-describedby="" placeholder="Enter Lastname">
                                <i class="fa fa-pencil icon"></i>
                            </div>
                        </div>
                        @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif

                    </div>
                    <div class="col-md-4 edit-profile-datails">
                        <h4>Contact</h4>
                        <!-- <form class="mt-4" method="POST" action="{{ url('profile' . encrypt($user->id)) }}"> -->
                        <div class="form-group">
                            <label for="name">Your Email</label>
                            <div class=" input-container">
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" aria-describedby="" placeholder="Enter Email Address">
                                <i class="fa fa-pencil icon"></i>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <div class=" input-container">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" aria-describedby="" placeholder="Enter Phone Number">
                                <i class="fa fa-pencil icon"></i>
                            </div>
                        </div>
                        @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                        <div class="form-group">
                            <label for="location">Location</label>
                            <div class=" input-container">
                                <input type="text" class="form-control" id="location" name="location" value="{{ $user->address }}" aria-describedby="" placeholder="Enter Your Location">
                                <i class="fa fa-pencil icon"></i>
                            </div>
                        </div>
                        @if ($errors->has('location'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('location') }}</strong>
                        </span>
                        @endif

                        <div class="profile-btns mt-5 mb-4">
                            <a  href="{{url()->previous()}}"><button type="button" class="btn btn-dark">CANCEL</button></a>
                            <button type="submit" class="btn btn-warning">SAVE CHANGES</button>
                        </div>
                        <!-- </form> -->
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