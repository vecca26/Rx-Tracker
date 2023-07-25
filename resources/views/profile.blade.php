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
    <div class="wrapper">
        
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <!-- <h4>DASHBOARD</h4> -->


                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                       
                        <li class="nav-item">
                            <a class="nav-icon notification d-inline-block" href="#" data-bs-toggle="dropdown">
                                <span><i class="fa fa-bell-o" aria-hidden="true"></i>
                                </span>
                                <span class="badge">3</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown topprofile">


                            <a class="nav-link d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-blue">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            </a>
                            <img src="images/profile-img.png">
                           <!--- <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Profile</a>

                                <a class="dropdown-item" href="#"><i class="fal fa-calendar-alt"></i></i> Subscription Plan</a> -->


                                <!---<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>--->
                        </li>

                    </ul>
                </div>
            </nav>


            <main class="content">
                <div class="container client-profile mt-4">
                    <h3>Admin Profile</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="update-pp">
                                        <input type="file" id="upload" hidden="">
                                        <label for="upload"><img src="images/pp.jpg">
                                            <span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.75 3.75L10.25 6.25M0.75 10.25V13.25H3.75L13.25 3.75L10.25 0.75L0.75 10.25Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </label>
                                        <h4>{{Auth::user()->first_name}}</h4>
                                        <p>{{Auth::user()->user_type}}</p>
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
                                                <input class="input100" type="text" name="firstName" value="{{ Auth::user()->first_name }}">
                                                <span class="bbb-input" data-placeholder="First Name"></span>
                                            </div>
                                            <div class="wrap-input100 validate-input">
                                                <input class="input100" type="text" name="lastName" value="{{Auth::user()->last_name}}">
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
                                                <input class="input100" type="text" name="email" value="{{ Auth::user()->email }}" readonly>
                                                <span class="bbb-input" data-placeholder="Your Email"></span>
                                            </div>
                                            <div class="wrap-input100 validate-input">
                                                <input class="input100" type="text" name="mobileNumber" value="{{ Auth::user()->phone }}" readonly>
                                                <span class="bbb-input" data-placeholder="Mobile Number"></span>
                                            </div>
                                            <!-- <div class="wrap-input100 validate-input">
                                                <input class="input100" type="text" name="location">
                                                <span class="bbb-input" data-placeholder="Location"></span>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                    </div>
                </div>

            </main>

            <div class="dashboard-footer">
                <p>2022 &#169; Sun Oncology.  </p>
            </div>
        </div>
    </div>







    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>