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
    <link rel="stylesheet" href="css/dashbaord.css">
    <link href="css/style.css" rel="stylesheet">
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
                        <h3>Create New Password</h3>
                        <form method="POST" action="{{ route('new.resetpassword') }}">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if($user_login !='1')
                            <div></div>
                            @else
                            <div class="form-group">
                                <label for="exampleInputPassword1">Current Password</label>
                                <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                            @endif
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="login-submit">
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