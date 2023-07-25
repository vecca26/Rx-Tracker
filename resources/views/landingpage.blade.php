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
            background: url(./images/watermark.png);
            background-repeat: no-repeat;
            background-size: cover;

        }

        .module-1,
        .module-2 {
            width: 100%;
            padding: 20%;
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0px 0px 10px 0px #71858f;
            font-weight: 900;
        }

        h3 {
            color: #f39100;

        }

        a,u{
            text-decoration: none !important;
        }
    </style>
</head>

<body>

    <div class="col col-sm-12 col-md-12 col-xl-12 col-lg-12">

        <div class="container text-center">
            <img class="p-5" src="{{ asset('images/SunPharma 1.png') }}">
            <div class="row p-5" style="margin-top: 3%;">
                <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6 text-center">
                    <a href="/pohome">
                        <div class="module-1">
                            <h3>Institute Tracking</h3>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-xl-6 col-lg-6 text-center">
                    <a href="/home">
                        <div class="module-2">
                            <h3>Rx Entry</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>