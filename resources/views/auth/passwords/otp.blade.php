<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Digital Rx</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashbaord.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background: url(/images/watermark.png);
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row login d-flex align-items-center justify-content-center">
            <div class="col-md-4 login-contents">
                <div class="card">

                    <div class="card-body">
                        <h3>OTP</h3>
                        @if (Session::has('error'))
                                <div class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('error') }}
                                </div>
                                @endif
                        <div class="otp-head pt-3">
                            <!-- <h5>Please Enter OTP</h5> -->
                            <p>We have sent you one time password <br>to your registered email address.</p>

                            <!-- <div class="time-count">
                               1:00
                           </div> -->
                            <form class="mt-4" method="GET" action="{{ url('postotp') }}">
                                <!-- @csrf -->
                                <div class="form-group d-flex flex-row mt-3">
                                    <input type="hidden" value="{{$otp_token}}" name="otp_token" id="otp_token">
                                    <input type="hidden" value="{{$identifier}}" name="identifier" id="identifier">
                                    <input type="hidden" value="{{$tokenData->token}}" name="token" id="token">

                                    <input type="text" name="otp_value" id="otp_value" class="form-control" autofocus="" required>

                                    <!-- <input type="text" name="first_digit" id="first_digit" class="form-control" autofocus="" required>
                                    <input type="text" name="second_digit" id="second_digit" class="form-control" required>
                                    <input type="text" name="third_digit" id="third_digit" class="form-control" required>
                                    <input type="text" name="fourth_digit" id="fourth_digit" class="form-control" required> -->
                                </div>

                                <!-- <div class="resend">
                               <p>Did not receive the OTP! <a href="#">RESEND</a></p>
                           </div> -->
                                <input type="submit" class="btn btn-warning mt-4 mb-4" value="VERIFY">
                            </form>

                            <!-- </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>