@extends('layouts.app')
@section('content')
<div class="container client-profile mt-4">
    <h3>User Profile</h3>
    <div class="card">
        <div class="card-body">
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
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="update-pp">
                        <label for="upload"><img src="{{ asset('images/profile-img.png') }}">
                        </label>
                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                        <p>{{$team->team}}</p>
                        <!-- <div class="border-bottom"></div> -->
                    </div>
                </div>
                <div class="col-md-4 profile-datails">
                    <h4>Details</h4>
                    <div class="bb-profile mt-5">
                        <form class="bb-form validate-form">
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="Fullname" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly>
                                <span class="bbb-input" data-placeholder="Display Name"></span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="firstName" value="{{ $user->first_name }}" readonly>
                                <span class="bbb-input" data-placeholder="First Name"></span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="lastName" value="{{ $user->last_name }}" readonly>
                                <span class="bbb-input" data-placeholder="Last Name"></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 profile-datails">
                    <h4>Contact</h4>
                    <div class="bb-profile mt-5">
                        <form class="bb-form validate-form">
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="email" value="{{ $user->email }}" readonly>
                                <span class="bbb-input" data-placeholder="Your Email"></span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="mobileNumber" value="{{ $user->phone }}" readonly>
                                <span class="bbb-input" data-placeholder="Mobile Number"></span>
                            </div>
                        </form>
                    </div>
                </div>
  
            </div>
        </div>
    </div>
</div>
@endsection