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
    <link  href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background: url(./images/watermark.png);
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
                    <div class="login-img">

                        <img src="images/SunPharma 1.png">
                    </div>
                    <div class="card-body">
                        <h3>Login</h3>
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                            </div>
                            <div class="forget-password">
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="login-submit">
                                <!-- <a href="dashboard.html"></a> -->
                                <button type="submit" class="btn btn-warning">SUBMIT</button>
                            </div>
                        </form>
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








