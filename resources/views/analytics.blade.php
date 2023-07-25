<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Digital Rx</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dashbaord.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="main white-bg">
                        <nav class="navbar navbar-expand navbar-light navbar-bg">
                            <img src="images/SunPharma 1.png" class="analytics-logo">

                            <div class="navbar-collapse collapse">
                                <ul class="navbar-nav navbar-align">
                                    <li class="nav-item">
                                    </li>
                                    <li class="nav-item dropdown topprofile">


                                        <a class="nav-link d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                            <span class="text-blue">{{$first_name}} {{$last_name}}</span>
                                            <small class="d-block">{{$user_type}}</small>
                                        </a>
                                        <img src="images/profile-img.png">
                                        <div class="dropdown-menu dropdown-menu-end">

                                            <a class="sidebar-link" href="{{ Route('profile.index') }}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.99974 0C5.88646 0.0269505 3.86731 0.878431 2.37287 2.37287C0.878431 3.86731 0.0269505 5.88646 0 7.99974C0.00987878 9.23083 0.303767 10.443 0.858781 11.542C1.4138 12.6409 2.21496 13.5969 3.1999 14.3355V14.3995H3.27989C4.6344 15.4375 6.29328 16 7.99974 16C9.70621 16 11.3651 15.4375 12.7196 14.3995H12.7996V14.3355C13.7845 13.5969 14.5857 12.6409 15.1407 11.542C15.6957 10.443 15.9896 9.23083 15.9995 7.99974C15.9725 5.88646 15.1211 3.86731 13.6266 2.37287C12.1322 0.878431 10.113 0.0269505 7.99974 0ZM4.85584 13.5436C4.97263 13.0087 5.26875 12.5299 5.69508 12.1865C6.12142 11.8431 6.65234 11.6558 7.19977 11.6556H8.79972C9.34715 11.6558 9.87807 11.8431 10.3044 12.1865C10.7307 12.5299 11.0269 13.0087 11.1436 13.5436C10.1908 14.1042 9.10531 14.3998 7.99974 14.3998C6.89417 14.3998 5.80872 14.1042 4.85584 13.5436ZM12.4876 12.5116C12.1833 11.7844 11.6709 11.1633 11.0148 10.7263C10.3586 10.2894 9.58803 10.0561 8.79972 10.0557H7.19977C6.41145 10.0561 5.64083 10.2894 4.9847 10.7263C4.32857 11.1633 3.81617 11.7844 3.51189 12.5116C2.91244 11.922 2.43504 11.2201 2.10698 10.4459C1.77892 9.67174 1.60663 8.84052 1.59995 7.99974C1.6207 6.30886 2.30162 4.69307 3.49735 3.49735C4.69307 2.30162 6.30886 1.6207 7.99974 1.59995C9.69063 1.6207 11.3064 2.30162 12.5021 3.49735C13.6979 4.69307 14.3788 6.30886 14.3995 7.99974C14.3929 8.84052 14.2206 9.67174 13.8925 10.4459C13.5644 11.2201 13.087 11.922 12.4876 12.5116Z" fill="#7D7D7D" />
                                                    <path d="M7.99957 3.19995C7.57666 3.19009 7.15615 3.26613 6.76347 3.42345C6.37078 3.58077 6.01409 3.81611 5.71497 4.11524C5.41584 4.41436 5.1805 4.77105 5.02318 5.16373C4.86586 5.55642 4.78982 5.97693 4.79968 6.39984C4.78982 6.82275 4.86586 7.24327 5.02318 7.63595C5.1805 8.02863 5.41584 8.38532 5.71497 8.68445C6.01409 8.98357 6.37078 9.21891 6.76347 9.37623C7.15615 9.53356 7.57666 9.60959 7.99957 9.59974C8.42248 9.60959 8.843 9.53356 9.23568 9.37623C9.62836 9.21891 9.98505 8.98357 10.2842 8.68445C10.5833 8.38532 10.8186 8.02863 10.976 7.63595C11.1333 7.24327 11.2093 6.82275 11.1995 6.39984C11.2093 5.97693 11.1333 5.55642 10.976 5.16373C10.8186 4.77105 10.5833 4.41436 10.2842 4.11524C9.98505 3.81611 9.62836 3.58077 9.23568 3.42345C8.843 3.26613 8.42248 3.19009 7.99957 3.19995ZM7.99957 7.99979C7.78674 8.01008 7.57411 7.97574 7.37533 7.89897C7.17656 7.82221 6.99604 7.70472 6.84537 7.55405C6.6947 7.40337 6.57721 7.22285 6.50044 7.02408C6.42368 6.82531 6.38934 6.61267 6.39962 6.39984C6.38934 6.18701 6.42368 5.97438 6.50044 5.7756C6.57721 5.57683 6.6947 5.39631 6.84537 5.24564C6.99604 5.09497 7.17656 4.97747 7.37533 4.90071C7.57411 4.82394 7.78674 4.7896 7.99957 4.79989C8.21241 4.7896 8.42504 4.82394 8.62381 4.90071C8.82259 4.97747 9.00311 5.09497 9.15378 5.24564C9.30445 5.39631 9.42194 5.57683 9.4987 5.7756C9.57547 5.97438 9.60981 6.18701 9.59952 6.39984C9.60981 6.61267 9.57547 6.82531 9.4987 7.02408C9.42194 7.22285 9.30445 7.40337 9.15378 7.55405C9.00311 7.70472 8.82259 7.82221 8.62381 7.89897C8.42504 7.97574 8.21241 8.01008 7.99957 7.99979Z" fill="#7D7D7D" />
                                                </svg>
                                                User Profile</a>

                                            <div class="dropdown-divider"></div>
                                            <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.7097 11.3372H12.4835C12.3998 11.3372 12.3213 11.3738 12.269 11.4384C12.1469 11.5866 12.0161 11.7297 11.8783 11.8657C11.3147 12.4298 10.6472 12.8794 9.91258 13.1895C9.15152 13.511 8.33352 13.6759 7.50735 13.6744C6.67189 13.6744 5.86259 13.5105 5.10212 13.1895C4.36752 12.8794 3.69999 12.4298 3.13643 11.8657C2.57186 11.3035 2.12169 10.6371 1.81085 9.9035C1.48818 9.14303 1.32597 8.33548 1.32597 7.50001C1.32597 6.66455 1.48992 5.85699 1.81085 5.09653C2.12131 4.36223 2.56782 3.70118 3.13643 3.13432C3.70503 2.56746 4.36608 2.12095 5.10212 1.81049C5.86259 1.48956 6.67189 1.32561 7.50735 1.32561C8.34281 1.32561 9.15211 1.48781 9.91258 1.81049C10.6486 2.12095 11.3097 2.56746 11.8783 3.13432C12.0161 3.27211 12.1451 3.41514 12.269 3.56165C12.3213 3.62618 12.4015 3.66281 12.4835 3.66281H13.7097C13.8195 3.66281 13.8876 3.54072 13.8265 3.44828C12.4887 1.36921 10.148 -0.00695033 7.48816 2.64046e-05C3.3091 0.0104915 -0.0414724 3.40293 0.000388001 7.57676C0.0422484 11.6843 3.38759 15 7.50735 15C10.1603 15 12.4905 13.6256 13.8265 11.5518C13.8858 11.4593 13.8195 11.3372 13.7097 11.3372ZM15.2602 7.39013L12.7852 5.43665C12.6928 5.36339 12.5585 5.42967 12.5585 5.54653V6.87211H7.08177C7.00503 6.87211 6.94224 6.9349 6.94224 7.01164V7.98838C6.94224 8.06513 7.00503 8.12792 7.08177 8.12792H12.5585V9.4535C12.5585 9.57036 12.6945 9.63664 12.7852 9.56338L15.2602 7.6099C15.2769 7.59684 15.2904 7.58017 15.2997 7.56113C15.309 7.54209 15.3138 7.52119 15.3138 7.50001C15.3138 7.47884 15.309 7.45794 15.2997 7.4389C15.2904 7.41986 15.2769 7.40318 15.2602 7.39013Z" fill="#7D7D7D" />
                                                </svg>
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <main class="content">
                            <div class="container-fluid analytics-page mt-4">
                                <form method='post' id="fliterform" action="{{route('analytics.search')}}">
                                    @csrf

                                    <div class="row align-items-end">
                                        <div class="sub-group-yellow col-sm-6 col-md-4">
                                            @if(($user_type =='ho') || ($user_type=='admin'))
                                            <div class="col">
                                                <label for="inlineFormCustomSelect">Team</label><br>

                                                <select class="custom-select mr-sm-2 team_select" id="team_select">
                                                    <option value="">Choose Team</option>
                                                    @foreach ($team_list as $key => $team_list)
                                                    <option value="{{$team_list->id}}">{{$team_list->team}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error-team_select" style="color:red;"></span>
                                            </div>
                                            @endif
                                            @if($user_type =='ho' || 'zsm' || 'bdm' )
                                            <div class="col">
                                                <label for="inlineFormCustomSelect">Choose Brand</label><br>
                                                <select class="custom-select mr-sm-2 " id="brand_select">
                                                    <option value="">Choose Brand</option>
                                                    @foreach ($brand_list as $key => $brand_list)
                                                    <option value="{{$brand_list->id}}">{{$brand_list->brand_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error-brand_select" style="color:red;"></span>
                                            </div>
                                            @endif

                                        </div>
                                        <div class="sub-group-gray col-sm-6 col-md-4">
                                            @if(($user_type =='ho') || ($user_type=='admin'))
                                            <div class="col">
                                                <label for="inlineFormCustomSelect">Zone ZSM</label><br>
                                                <select class="custom-select mr-sm-2 zsm_select" id="zsm_select">
                                                    <option value="">Choose ZSM</option>
                                                    @foreach ($zsm_list as $key => $zsm_list)
                                                    <!-- <option value="{{$zsm_list->user_id}}">{{$zsm_list->first_name}} {{$zsm_list->last_name}}</option> -->
                                                    <option value="{{$zsm_list->user_id}}">{{$zsm_list->first_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error-zsm_select" style="color:red;"></span>
                                            </div>
                                            @endif


                                            @if(($user_type =='ho')||($user_type=='zsm') || ($user_type=='admin'))
                                            <div class="col">
                                                <label for="inlineFormCustomSelect">BDM</label><br>
                                                <select class="custom-select mr-sm-2 bdm_select" id="bdm_select">
                                                    <option value="">Choose BDM</option>
                                                    @if($user_type=='zsm')
                                                    @foreach ($bdm_list as $key => $bdm_list)
                                                    <option value="{{$bdm_list->user_id}}">{{$bdm_list->first_name}} {{$bdm_list->last_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span id="error-bdm_select" style="color:red;"></span>
                                            </div>
                                            @endif
                                            @if(($user_type =='ho')||($user_type=='zsm') || ($user_type=='admin'))

                                            <div class="col">
                                                <label for="inlineFormCustomSelect">Field Force (PS)</label><br>
                                                <select class="custom-select mr-sm-2 ff_select" id="ff_select">
                                                    <option value="">Choose FF</option>

                                                </select>

                                            </div>
                                           
                                            @if($user_type =='bdm')

                                            <div class="col">
                                                <label for="inlineFormCustomSelect">Field Force (PS)</label><br>
                                                <select class="custom-select mr-sm-2 ff_select" id="ff_select">
                                                    <option value="">Choose FF </option>
                                                    @foreach ($ff_list as $key => $ff_list)
                                                    <option value="{{$ff_list->user_id}}">{{$ff_list->first_name}} {{$ff_list->last_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            @endif
                                            <div class="text-center"><span id="error-ff_select" style="color:red;"></span></div>
                                        </div>

                                        <div class="sub-group-green col-sm-6 col-md-4">

                                            <div class="col">
                                                <label for="inlineFormCustomSelect">Start Date</label><br>
                                                <input type="date" name="start_date" id="start_date" class="form-control">
                                                <span id="error-start_date" style="color:red;"></span>
                                            </div>
                                            <div class="col">
                                                <label for="inlineFormCustomSelect">End Date</label><br>
                                                <input type="date" name="end_date" id="end_date" class="form-control">
                                                <span id="error-end_date" style="color:red;"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="col">
                                            <button type="button" class="search-submit btn btn-warning">Export
                                                Excel</button>
                                        </div> -->
                                        <input type="hidden" id="user_type" value={{auth()->user()->user_type}}>
                                        <input type="hidden" id="user_id" value={{auth()->user()->id}}>
                                        <div class="col" id="filter-block">
                                            <button type="button" class="btn btn-sm btn-danger filter" id="clearfilter" onclick="clearFilter()">
                                                Clear Filter
                                                <svg width="10" height="7" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3333 0V1.94833L10.5 7.5005V14H5.83333V7.5005L0 1.94717V0H16.3333ZM7 7V12.8333H9.33333V7L15.1667 1.44667V1.16667H1.16667V1.44667L7 7Z" fill="white" />
                                                </svg>
                                            </button>
                                            <br>
                                            <button type="button" class="btn btn-sm btn-dark filter" id="filter">
                                                Filter
                                                <svg width="10" height="7" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3333 0V1.94833L10.5 7.5005V14H5.83333V7.5005L0 1.94717V0H16.3333ZM7 7V12.8333H9.33333V7L15.1667 1.44667V1.16667H1.16667V1.44667L7 7Z" fill="white" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <span id="main_error_text" style="color:red;"></span>
                                </form>
                                <div class="loader text-center" id="loader"></div>
                                <div class="row quick-summary mt-5">
                                    <div class="qs-head">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="mb-4">Quick summary
                                                </h5>
                                            </div>
                                            <div class="col-md-6 text-right">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-items-center">
                                        <div class="qs-card clr1 align-items-center">
                                            <div class="qs-card-img">
                                                <svg width="40" height="40" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="37.5" cy="37.5" r="37.5" fill="#F39100" />
                                                    <path d="M19 45.2577C19.0822 44.9523 19.1762 44.6587 19.2467 44.3533C20.1863 40.4066 23.7219 37.5406 27.7625 37.5171C33.1774 37.4936 38.6041 37.4936 44.019 37.5171C46.3564 37.5289 48.3768 38.4098 50.0564 40.0425C50.7847 40.7473 50.8434 41.3463 50.3031 42.1803C49.4809 42.8146 48.8466 42.7793 48.0948 42.0511C46.932 40.9352 45.546 40.3362 43.9485 40.3244C38.5688 40.3127 33.1892 40.3009 27.8095 40.3244C25.0257 40.3362 22.5943 42.3095 21.9835 45.0228C21.8895 45.4574 21.819 45.9155 21.819 46.3736C21.7955 48.1003 21.8073 49.8269 21.8073 51.5771C21.9952 51.5771 22.1362 51.5771 22.2771 51.5771C25.1314 51.5771 27.9974 51.5771 30.8517 51.5771C31.9676 51.5771 32.3904 51.9177 32.6254 52.9866C32.3904 54.0555 31.9676 54.3961 30.8517 54.3961C27.5746 54.3961 24.2857 54.3726 21.0086 54.4079C20.1276 54.4196 19.4346 54.2434 19 53.4212C19 50.7079 19 47.9828 19 45.2577Z" fill="white" />
                                                    <path d="M36.8416 15C37.2409 15.0822 37.6521 15.1644 38.0514 15.2584C42.3152 16.2333 45.4397 20.3092 45.2517 24.6552C45.052 29.2714 41.6692 33.0536 37.2057 33.6526C32.0022 34.3574 27.3626 30.8571 26.5756 25.6536C25.8473 20.8025 29.3007 16.0102 34.1283 15.1644C34.3044 15.1292 34.4689 15.0587 34.6451 15C35.3851 15 36.1133 15 36.8416 15ZM35.8549 30.9393C39.4727 30.9511 42.4327 28.0263 42.4562 24.4085C42.4679 20.826 39.5314 17.8425 35.9489 17.819C32.3076 17.7838 29.3359 20.7203 29.3124 24.3498C29.2889 27.9558 32.2254 30.9276 35.8549 30.9393Z" fill="white" />
                                                    <path d="M47.1555 53.1275C48.2478 50.7783 49.3285 48.4174 50.4443 46.0799C50.6205 45.7041 50.9847 45.4339 51.2666 45.105C52.2297 44.9053 52.7231 45.1403 53.2047 46.0212C54.8256 48.9929 56.4583 51.9647 58.0675 54.9482C58.2319 55.2536 58.4081 55.3475 58.7488 55.3475C59.9938 55.324 61.2389 55.3358 62.484 55.3358C63.3884 55.3358 64.011 55.9113 64.011 56.7218C64.011 57.5323 63.3884 58.1313 62.4957 58.1431C60.8513 58.1548 59.2186 58.1431 57.5742 58.1431C56.9046 58.1431 56.4466 57.8377 56.1294 57.2504C54.8256 54.8307 53.4983 52.4228 52.1828 50.0148C52.1123 49.8739 52.0301 49.7329 51.9126 49.5333C51.6777 50.0736 51.4663 50.5552 51.2666 51.0367C50.9729 51.6828 50.6675 52.3171 50.3739 52.9631C49.4694 54.8894 48.5767 56.8158 47.6723 58.7421C47.6253 58.8361 47.5901 58.9301 47.5548 59.024C47.3082 59.5878 46.9088 59.9637 46.2628 59.9989C45.6285 60.0224 45.1939 59.6935 44.8885 59.1532C44.1485 57.8377 43.3967 56.5456 42.6568 55.2301C42.3866 54.7485 42.0929 54.2669 41.8345 53.7853C41.6936 53.5269 41.5409 53.4094 41.2237 53.4212C39.9904 53.4447 38.7688 53.4212 37.5355 53.4329C37.0187 53.4447 36.5841 53.3155 36.2199 52.9631C35.8558 52.458 35.7501 51.9294 36.0438 51.3656C36.3609 50.7783 36.8895 50.6021 37.512 50.6021C39.0742 50.6139 40.6482 50.6139 42.2104 50.6021C42.9269 50.5904 43.4437 50.884 43.7726 51.5183C44.031 52.0117 44.3247 52.4815 44.6066 52.9631C45.0764 53.7971 45.5463 54.631 46.0513 55.5355C46.4507 54.7015 46.8031 53.9145 47.1555 53.1275Z" fill="white" />
                                                    <path d="M50.373 52.9869C50.6667 52.3409 50.9721 51.7066 51.2657 51.0605C51.2892 51.6478 51.3245 52.2469 51.3362 52.8342C51.3362 52.8812 51.1718 52.9751 51.0778 52.9869C50.8429 53.0104 50.608 52.9869 50.373 52.9869Z" fill="#E5E8EA" />
                                                    <path d="M47.1543 53.1276C46.8019 53.9146 46.4496 54.7016 46.0619 55.5708C45.5451 54.6546 45.087 53.8324 44.6172 52.9984C45.3219 52.9984 46.0267 52.9866 46.7197 52.9984C46.8724 52.9984 47.0134 53.0806 47.1543 53.1276Z" fill="#F9F9F9" />
                                                </svg>
                                            </div>
                                            <div class="qs-card-text">
                                                <h4>Number of<br>
                                                    Patients <br>on going</h4>
                                            </div>
                                            <div class="qs-card-count">
                                                <h1><span id="patients_ongoing_count"></span></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-items-center">
                                        <div class="qs-card clr2">
                                            <div class="qs-card-img">
                                                <svg width="40" height="40" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="37.5" cy="37.5" r="37.5" fill="#1A1A18" />
                                                    <path d="M26.8 47.6H30V50.8H49.2V25.2H30V28.4H26.8V23.6C26.8 23.1757 26.9686 22.7687 27.2686 22.4686C27.5687 22.1686 27.9757 22 28.4 22H50.8C51.2243 22 51.6313 22.1686 51.9314 22.4686C52.2314 22.7687 52.4 23.1757 52.4 23.6V52.4C52.4 52.8243 52.2314 53.2313 51.9314 53.5314C51.6313 53.8314 51.2243 54 50.8 54H28.4C27.9757 54 27.5687 53.8314 27.2686 53.5314C26.9686 53.2313 26.8 52.8243 26.8 52.4V47.6ZM30 36.4H41.2V39.6H30V44.4L22 38L30 31.6V36.4Z" fill="white" />
                                                </svg>

                                            </div>
                                            <div class="qs-card-text">
                                                <h4>Number of<br>
                                                    Patients <br>on dropout</h4>
                                            </div>
                                            <div class="qs-card-count">
                                                <h1><span id="patient_dropout_count"></span></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-items-center">
                                        <div class="qs-card clr3">
                                            <div class="qs-card-img">
                                                <svg width="40" height="40" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="37.5" cy="37.5" r="37.5" fill="#F39100" />
                                                    <path d="M29.667 46.6667H46.3337V43.3333H29.667V46.6667ZM46.3337 40H29.667V36.6667H46.3337V40ZM29.667 33.3333H36.3337V30H29.667V33.3333Z" fill="white" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M28 20C26.6739 20 25.4021 20.5268 24.4645 21.4645C23.5268 22.4021 23 23.6739 23 25V48.3333C23 49.6594 23.5268 50.9312 24.4645 51.8689C25.4021 52.8066 26.6739 53.3333 28 53.3333H48C49.3261 53.3333 50.5979 52.8066 51.5355 51.8689C52.4732 50.9312 53 49.6594 53 48.3333V31.6667C53 28.5725 51.7708 25.605 49.5829 23.4171C47.395 21.2292 44.4275 20 41.3333 20H28ZM28 23.3333H39.6667V31.6667H49.6667V48.3333C49.6667 48.7754 49.4911 49.1993 49.1785 49.5118C48.866 49.8244 48.442 50 48 50H28C27.558 50 27.134 49.8244 26.8215 49.5118C26.5089 49.1993 26.3333 48.7754 26.3333 48.3333V25C26.3333 24.558 26.5089 24.134 26.8215 23.8215C27.134 23.5089 27.558 23.3333 28 23.3333V23.3333ZM43 23.5C44.31 23.7684 45.5363 24.3475 46.5758 25.1886C47.6153 26.0297 48.4375 27.1082 48.9733 28.3333H43V23.5Z" fill="white" />
                                                </svg>

                                            </div>
                                            <div class="qs-card-text">
                                                <h4>Number <br>of
                                                    RX<br> Entries</h4>
                                            </div>
                                            <div class="qs-card-count">
                                                <h1><span id="total_rxCount"></span></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col align-items-center">
                                        <div class="qs-card clr4">
                                            <div class="qs-card-img">
                                                <svg width="40" height="40" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="37.5" cy="37.5" r="37.5" fill="#1A1A18" />
                                                    <path d="M39.2375 19.4641C38.525 18.8453 37.4563 18.8453 36.7437 19.4641C27.5937 27.5266 23 34.5391 23 40.5016C23 49.8391 30.125 55.8766 38 55.8766C45.875 55.8766 53 49.8391 53 40.5016C53 34.5391 48.4062 27.5266 39.2375 19.4641ZM30.1812 40.8766C30.875 40.8766 31.4375 41.3641 31.5687 42.0391C32.3375 46.2016 35.8438 47.6266 38.3938 47.4203C39.2 47.3828 39.875 48.0203 39.875 48.8266C39.875 49.5766 39.275 50.1953 38.525 50.2328C34.5312 50.4766 29.8625 48.1891 28.7938 42.5078C28.7612 42.3068 28.7726 42.1011 28.8274 41.9049C28.8821 41.7088 28.9788 41.5268 29.1107 41.3717C29.2427 41.2166 29.4067 41.092 29.5916 41.0065C29.7764 40.921 29.9776 40.8767 30.1812 40.8766Z" fill="white" />
                                                </svg>


                                            </div>
                                            <div class="qs-card-text">
                                                <h4>Total<br> Dose<br>
                                                    Prescribed</h4>
                                            </div>
                                            <div class="qs-card-count">
                                                <h1><span id="dose_scheduled"></span></h1>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col align-items-center">
                                        <div class="qs-card clr4">
                                            <div class="qs-card-img">
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="20" cy="20" r="20" fill="#F39100" />
                                                    <path d="M14.5 25.5H11.5V28.5" fill="white" />
                                                    <path d="M14.5 25.5H11.5V28.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M28.5 28.5H25.5V25.5" fill="white" />
                                                    <path d="M28.5 28.5H25.5V25.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M25.5 14.5H28.5V11.5" fill="white" />
                                                    <path d="M25.5 14.5H28.5V11.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M11.5 11.5H14.5V14.5" fill="white" />
                                                    <path d="M11.5 11.5H14.5V14.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M14.5 11.647C11.7889 13.4357 10 16.5089 10 19.9999C10 20.5097 10.0381 21.0106 10.1117 21.4999" fill="white" />
                                                    <path d="M14.5 11.647C11.7889 13.4357 10 16.5089 10 19.9999C10 20.5097 10.0381 21.0106 10.1117 21.4999" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M21.4999 29.8883C21.0106 29.9619 20.5097 30 19.9999 30C16.5089 30 13.4357 28.2111 11.647 25.5" fill="white" />
                                                    <path d="M21.4999 29.8883C21.0106 29.9619 20.5097 30 19.9999 30C16.5089 30 13.4357 28.2111 11.647 25.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M29.8883 18.5C29.9619 18.9893 30 19.4902 30 20C30 23.4911 28.2111 26.5643 25.5 28.353" fill="white" />
                                                    <path d="M29.8883 18.5C29.9619 18.9893 30 19.4902 30 20C30 23.4911 28.2111 26.5643 25.5 28.353" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M18.5 10.1117C18.9893 10.0381 19.4902 10 20 10C23.4911 10 26.5643 11.7889 28.353 14.5" fill="white" />
                                                    <path d="M18.5 10.1117C18.9893 10.0381 19.4902 10 20 10C23.4911 10 26.5643 11.7889 28.353 14.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="qs-card-text">
                                                <h4>Total <br> Number<br>
                                                    of Cycles<br> </h4>
                                            </div>
                                            <div class="qs-card-count">
                                                <h1><span id="avg_cycle_count"></span></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="detailed-report mt-5 mb-12">
                                    <div class="text-center">
                                        <h5>Detailed Report</h5>
                                    </div>

                                    <div class="row mt-4">

                                        <div class="col-md-12 mb-5">
                                            <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active">Patient Analysis</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="tab-content">
                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>No. of patients ongoing,No. of patients ongoing trend and no of
                                                                                patients drop
                                                                                out</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="dropout_ongoing">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="twoLinechartContainer" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Patient drop out reason with their
                                                                                percentage
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_dropout_reason">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="PieDiagram" style="height: 300px; width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-5" style="margin-top: 5%;margin-bottom: 5% !important;;">
                                                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active">Prescriber Analysis</a>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Major Consistent Prescribers with their
                                                                                no. of
                                                                                Rx</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_prescriber">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="twoLinechartPrescriber" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>New prescriber addition trend month wise
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_prescriber_count">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="singleBarchartContainer" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-top: 5%;margin-bottom:5%;">
                                                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active">Rx Entry Analysis</a>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Rx Split between Institution type</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_institution">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">

                                                                        <div id="sharpLinechartContainer" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Rx Split between patient Type</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_patient_type">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="sharpLinechartContainerTwo" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="col-md-12 mb-5 Indication" style="margin-top: 5%;margin-bottom: 5% !important;;">
                                                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active">Indication wise Analysis</a>

                                                    </div>
                                                </div>
                                                <div class="Indication">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-6">
                                                                            <h5>Indication Wise</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_indications">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="LinechartContainer" style="height: 300px; width: 100%;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Indication wise average dose prescribed
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_indication_dose">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="singleBarchartContainerTwo" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Rx Split between Dosing Schedule</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <button type="button" class="btn btn-warnin-outline" id="excel_dose_schedule">Export
                                                                                Excel</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="singleBarchartContainerTwoone" style="height: 300px; width: 100%;"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-8">
                                                                            <h5>Number of cycles Repeated</h5>
                                                                        </div>
                                                                        <div class="col-md-4 text-right">
                                                                            <!-- <button type="button" class="btn btn-warnin-outline">Export
                                                                                Excel</button> -->
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="chart chart-sm">
                                                                        <div id="multiBarchartContainer" style="height: 300px; width: 100%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </main>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($user_type =='ff')
    <style>
        .sub-group-gray {
            display: none;
        }

        .filter,
        #clearfilter {
            width: 20% !important;
        }

        #filter-block {
            height: 145px;
        }
    </style>
    @endif
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/canvasjs.min.js"></script>

    <script>
        $('#clearfilter').hide();
        $('#loader').hide();
        $('.Indication').hide();
        let token = "{{ csrf_token() }}";
        $('.team_select').on('change', function(e) {
            $.ajax({
                type: "get",
                url: '/ff_brands',
                async: true,
                data: {
                    _token: token,
                    team_id: $('.team_select').val(),
                    type: 'brand_list'
                },
                success: function(response) {
                    var data = response.data;
                    option1 = "<option value=''>Choose Brands</option>";
                    $.each(data.brand_list, function(index, value) {
                        option1 = option1 + "<option value=" + value['id'] + ">" + value['brand_name'] + "</option>";
                    });
                    $("#brand_select").html(option1);
                    option2 = "<option value=''>Choose ZSM</option>";
                    $.each(data.user_list, function(index, value) {
                        option2 = option2 + "<option value=" + value['user_id'] + ">" + value['first_name'] + ' ' + "</option>";
                    });
                    $(".zsm_select").html(option2);
                },
                error: function(error_message) {}
            });
        });
        $(".zsm_select").change(function() {
            $.ajax({
                type: "get",
                url: '/user_selected_details',
                async: true,
                data: {
                    _token: token,
                    zsm_id: $('.zsm_select').val(),
                    type: 'bdm_list'
                },
                success: function(response) {
                    var data = response.data;

                    option1 = "<option value=''>Choose BDM</option>";
                    $.each(data.user_list, function(index, value) {
                        option1 = option1 + "<option value=" + value['user_id'] + ">" + value['first_name'] + ' ' + "</option>";
                    });
                    $(".bdm_select").html(option1);
                },
                error: function(error_message) {

                }
            });
        });
        $(".bdm_select").change(function() {
            $.ajax({
                type: "get",
                url: '/user_selected_details',
                async: true,
                data: {
                    _token: token,
                    bdm_id: $('.bdm_select').val(),
                    type: 'ff_list'
                },
                success: function(response) {
                    var data = response.data;
                    option1 = "<option value=''>Choose FF</option>";
                    $.each(data.user_list, function(index, value) {
                        option1 = option1 + "<option value=" + value['user_id'] + ">" + value['first_name'] + ' ' + "</option>";
                    });
                    $(".ff_select").html(option1);
                },
                error: function(error_message) {}
            });
        });




        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {

            });
        });

        $('#dropout_ongoing').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,

                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 1,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=1&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        $('#dropout_trend').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 2,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=2&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        $('#excel_prescriber').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 3,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=3&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        ///excel institution type
        $('#excel_institution').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    zsm_id: $('.zsm_select').val(),
                    end_date: end_date,
                    type: 4,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=4&ff_id=' + ff_select;
                    return false;


                }
            });
        });

        $('#excel_dropout_reason').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 5,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=5&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        $('#excel_prescriber_count').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 6,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=6&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        //excel based on patient type rx entry 
        $('#excel_patient_type').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 7,
                    ff_id: ff_select
                },
                success: function(response) {

                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=7&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        //excel based on dose schedule 
        $('#excel_dose_schedule').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 8,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=8&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        //excel generation based on indications 
        $('#excel_indications').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 9,
                    ff_id: ff_select
                },
                success: function(response) {
                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=9&ff_id=' + ff_select;
                    return false;


                }
            });
        });
        //excel based on indication and average dose prescribed 
        $('#excel_indication_dose').on('click', function(e) {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();


            $.ajax({
                type: "get",
                url: '/excel_export',
                async: true,
                data: {
                    _token: token,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date,
                    type: 10,
                    ff_id: ff_select
                },
                success: function(response) {


                    window.location.href = '/excel_export?_token=' + token + '&brand_id=' + brand_select + '&user_type=' + user_type + '&user_id=' + user_id + '&start_date=' + start_date + '&end_date=' + end_date + '&type=10&ff_id=' + ff_select;
                    return false;


                }
            });
        });

        $('#filter').on('click', function(e) {
            $('#loader').show();
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var team_select = $("#team_select").val();
            var zsm_select = $("#zsm_select").val();
            var bdm_select = $("#bdm_select").val();
            var ff_select = $("#ff_select").val();
            var brand_select = $("#brand_select").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            $('#error-team_select').text('');
            $('#error-zsm_select').text('');
            $('#error-bdm_select').text('');
            $('#error-ff_select').text('');
            $('#error-brand_select').text('');
            $('#error-start_date').text('');
            $('#error-end_date').text('');
            if (brand_select != '') {
                $('.Indication').show();
            }
            var flag = true;
            if (start_date > end_date) {
                // Do something
                $('#error-end_date').text('End Date Must be Larger than StartDate');
                $("#end_date").focus();
                flag = false;
            }
            if (user_type == 'ho') {
                if (team_select == '' && bdm_select == '' && zsm_select == '' && bdm_select == '' && brand_select == '') {
                    $('#main_error_text').text('Please Select atlest one of the filter');
                    $("#team_select").focus();
                    flag = false;
                }

            }
            // if (user_type == 'ff') {
            //     if (brand_select == '') {
            //         $('#main_error_text').text('Please Select the brand filter');
            //         $("#team_select").focus();
            //         flag = false;
            //     }
            // }
            if (user_type == 'zsm') {
                if (bdm_select == '' && bdm_select == '' && brand_select == '') {
                    $('#main_error_text').text('Please Select atlest one of the filter');
                    $("#team_select").focus();
                    flag = false;
                }
            }

            if (flag == false) {
                return false;
            }
            $('#clearfilter').show();
            $('#main_error_text').hide();

            graphLoad(user_type, user_id, team_select, brand_select, start_date, end_date, ff_select);
            // quickView(user_type, user_id, team_select, brand_select, start_date, end_date, ff_select);
        });
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'click'
            })
        })

        function clearFilter() {
            location.reload();

        }
    </script>

    <script>
        function graphLoad(user_type, user_id, team_select, brand_select, start_date, end_date, ff_select) {
            if (user_type == 'zsm') {
                zsm_ids = user_id
            } else {
                zsm_ids = $('#zsm_select').val()
            }
            if (user_type == 'bdm') {
                bdm_ids = user_id
            } else {
                bdm_ids = $('#bdm_select').val()
            }
            if (user_type == 'ff') {
                ff_ids = user_id
            } else {
                ff_ids = ff_select
            }
            $.ajax({
                type: "get",
                url: '/quick_summary',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 1,
                    ff_id: ff_ids
                },
                success: function(response) {
                    console.log('quick_summary', response)
                    $('#patients_ongoing_count').text(response['patients_ongoing_count']);
                    $('#patient_dropout_count').text(response['patient_dropout_count']);
                    $('#total_rxCount').text(response['total_rxCount']);
                    $('#dose_scheduled').text(response['dose_scheduled']);
                    $('#avg_cycle_count').text(response['avg_cycle_count']);
                }
            });

            $.ajax({
                type: "get",
                url: '/patient_recruitement_trend',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 3,
                    ff_id: ff_ids
                },
                success: function(response) {
                    console.log('Patient drop out reason with their percentage', response)
                    let sum = 0;
                    for (i = 0; i < response.length; i++) {
                        sum += response[i]['prescriber_count'];
                    }
                    datanew = [];
                    newdata = [];

                    for (i = 0; i < response.length; i++) {
                        datanew = {
                            y: Math.round(response[i]['prescriber_count'] / sum * 100),
                            indexLabel: `"${response[i]['prescriber_count']}"`,
                            label: response[i]['reason'],
                            name: response[i]['reason']
                        }
                        newdata.push(datanew);
                    }

                    var chart = new CanvasJS.Chart("PieDiagram", {
                        animationEnabled: true,
                        data: [{
                            type: "pie",
                            startAngle: 240,
                            showInLegend: true,
                            indexLabelPlacement: "inside",
                            yValueFormatString: "##0\"%\"",
                            indexLabel: "{label} {y}",
                            indexLabelFontWeight: "bolder",
                            indexLabelFontColor: "white",
                            dataPoints: newdata
                        }]
                    });
                    chart.render();
                }
            });

            $.ajax({
                type: "get",
                url: '/patient_recruitement_trend',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 4,
                    ff_id: ff_ids
                },
                success: function(response) {
                    console.log('patient_ongoing,patient_dropout', response);
                    var general1 = response.general
                    var general2 = response.general
                    var patient_dropout = response.patient_dropout
                    var patient_ongoing = response.patient_ongoing
                    var hold_trend_ongoing = []
                    for (let i = 0; i < general1.length; i++) {
                        for (let j = 0; j < patient_dropout.length; j++) {
                            if (general1[i]['label'] == patient_dropout[j]['label']) {
                                general1[i]['y'] = patient_dropout[j]['y']
                            }
                        }
                    }
                    var j = 0;
                    var k = 1
                    for (let i = 0; i < general2.length; i++) {
                        if (k == 1) {
                            hold_ongoing_patient = {
                                label: patient_ongoing[i]['label'],
                                y: patient_ongoing[i]['y'],
                            }
                            hold_trend_ongoing.push(hold_ongoing_patient);
                            k++;
                        } else {
                            var hold = hold_trend_ongoing[j]['y'] + patient_ongoing[i]['y']
                            hold = hold - general1[i]['y']

                            hold_ongoing_patient = {
                                label: patient_ongoing[i]['label'],
                                y: hold
                            }
                            hold_trend_ongoing.push(hold_ongoing_patient);
                            j++;
                        }
                    }
                    var chart3 = new CanvasJS.Chart("twoLinechartContainer", {
                        animationEnabled: true,
                        exportEnabled: true,

                        axisY: {
                            title: "Patients"
                        },
                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: toggleDataSeries
                        },
                        data: [{

                            type: "spline",
                            name: "New Patient",
                            showInLegend: true,
                            dataPoints: patient_ongoing,
                            indexLabel: "{y}",
                        }, {
                            type: "spline",
                            name: "Dropout",
                            showInLegend: true,
                            dataPoints: general1,
                            indexLabel: "{y}",
                        }, {

                            type: "spline",
                            name: "Total Patient",
                            showInLegend: true,
                            dataPoints: hold_trend_ongoing,
                            indexLabel: "{y}",
                        }]
                    });
                    chart3.render();
                }
            });

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart3.render();
            }

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart3.render();
            }

            $.ajax({
                type: "get",
                url: '/patient_recruitement_trend',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 5,
                    ff_id: ff_ids
                },
                success: function(response) {
                    console.log('Major Consistent Prescribers with their no. of Rx', response);
                    datanew = [];
                    newdata = [];
                    for (i = 0; i < response.length; i++) {
                        datanew = {
                            label: response[i]['doctor_name'],
                            y: response[i]['prescriber_count'],
                        }
                        newdata.push(datanew);
                    };
                    var chart5 = new CanvasJS.Chart("twoLinechartPrescriber", {
                        animationEnabled: true,
                        theme: "light1",
                        axisX: {
                            interval: 1,
                            labelFontSize: 8,
                        },
                        axisY: {
                            title: "Prescribers Count"
                        },
                        data: [{
                            type: "column",
                            indexLabel: "{y}",
                            indexLabelPlacement: "outside",
                            dataPoints: newdata,
                        }]
                    });

                    chart5.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        chart5.render();
                    }
                }
            });

            $.ajax({
                type: "get",
                url: '/patient_recruitement_trend',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 6,
                    ff_id: ff_ids
                },
                success: function(response) {
                    console.log('New prescriber addition trend month wise', response);
                    data = response.data;
                    datanew = [];
                    newdata = [];
                    for (i = 0; i < data.length; i++) {
                        datanew = {
                            label: data[i]['created_at'],
                            y: data[i]['ids']
                        }
                        newdata.push(datanew);
                    }
                    var chart6 = new CanvasJS.Chart("singleBarchartContainer", {
                        animationEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"

                        axisY: {
                            title: "Prescribers",
                            interval: 5,
                        },
                        data: [{
                            type: "column",
                            indexLabel: "{y}",
                            indexLabelPlacement: "outside",
                            indexLabelOrientation: "horizontal",
                            dataPoints: newdata,
                        }]
                    });
                    chart6.render();
                }
            });



            $.ajax({
                type: "get",
                url: '/patient_recruitement_trend',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 9,
                    ff_id: ff_ids
                },
                success: function(response) {
                    console.log('Rx Split between Institution type', response);
                    var data = response.data;
                    datas = [];
                    holddata = [];
                    let sum = 0;
                    for (i = 0; i < data.length; i++) {
                        sum += data[i]['prescriber_count'];
                    }
                    for (i = 0; i < data.length; i++) {
                        let cap = data[i]['institute_type']
                        cap = cap.charAt(0).toUpperCase() + cap.slice(1);
                        datas = {
                            label: cap,
                            name: cap,
                            indexLabel: `"${data[i]['prescriber_count']}"`,
                            y: data[i]['prescriber_count'] / sum * 100
                        }
                        holddata.push(datas)
                    }

                    var chart7 = new CanvasJS.Chart("sharpLinechartContainer", {

                        axisY: [{
                            title: "Rx Entries",
                            lineColor: "#cccccc",
                            tickColor: "#cccccc",
                            labelFontColor: "#000000",
                            titleFontColor: "#000000",
                            includeZero: true
                        }],

                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor: "pointer",
                            itemclick: toggleDataSeries
                        },

                        data: [{
                            type: "pie",
                            startAngle: 240,
                            showInLegend: true,
                            indexLabelPlacement: "inside",
                            indexLabelFontWeight: "bolder",
                            indexLabelFontColor: "white",
                            yValueFormatString: "##\"%\"",
                            indexLabel: "{label} {y}",
                            dataPoints: holddata
                        }]
                    });
                    chart7.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        e.chart.render();
                    }
                },
            });

            $.ajax({
                type: "get",
                url: '/patient_recruitement_trend',
                async: true,
                data: {
                    _token: token,
                    team_id: team_select,
                    brand_id: brand_select,
                    user_type: user_type,
                    user_id: user_id,
                    zsm_id: zsm_ids,
                    bdm_id: bdm_ids,
                    start_date: start_date,
                    end_date: end_date,
                    type: 10,
                    ff_id: ff_ids
                },
                success: function(response) {
                    $('#loader').hide()
                    console.log('Rx Split between patient Type', response);
                    var data = response.data;
                    datanew = [];
                    newdata = [];
                    let sum = 0;
                    for (i = 0; i < data.length; i++) {
                        sum += data[i]['patienttypes_count'];
                    }
                    for (i = 0; i < data.length; i++) {
                        datanew = {
                            y: data[i]['patienttypes_count'] / sum * 100,
                            indexLabel: `"${data[i]['patienttypes_count']}"`,
                            label: data[i]['name'],
                            name: data[i]['name']
                        }
                        newdata.push(datanew)
                    }
                    var chart8 = new CanvasJS.Chart("sharpLinechartContainerTwo", {

                        toolTip: {
                            shared: true
                        },

                        data: [{
                            type: "pie",
                            showInLegend: true,
                            indexLabelPlacement: "inside",
                            indexLabelFontWeight: "bolder",
                            indexLabelFontColor: "white",
                            yValueFormatString: "##\"%\"",
                            indexLabel: "{label} {y}",
                            dataPoints: newdata
                        }]
                    });
                    chart8.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        e.chart.render();
                    }

                }
            });

            if (brand_select >= 0) {

                $.ajax({
                    type: "get",
                    url: '/patient_recruitement_trend',
                    async: true,
                    data: {
                        _token: token,
                        team_id: team_select,
                        brand_id: brand_select,
                        user_type: user_type,
                        user_id: user_id,
                        zsm_id: zsm_ids,
                        bdm_id: bdm_ids,
                        start_date: start_date,
                        end_date: end_date,
                        type: 7,
                        ff_id: ff_ids
                    },
                    success: function(response) {
                        console.log('Indication Wise', response);
                        var data = response.data;
                        datas = [];
                        holddata = [];
                        let sum = 0;
                        for (i = 0; i < data.length; i++) {
                            sum += data[i]['prescriber_count'];
                        }
                        for (i = 0; i < data.length; i++) {
                            let cap = data[i]['name']
                            cap = cap.charAt(0).toUpperCase() + cap.slice(1);
                            datas = {
                                label: cap,
                                name: cap,
                                indexLabel: `"${data[i]['prescriber_count']}"`,
                                y: data[i]['prescriber_count'] / sum * 100
                            }
                            holddata.push(datas)
                        }
                        var chart2 = new CanvasJS.Chart("LinechartContainer", {
                            animationEnabled: true,
                            exportEnabled: true,
                            data: [{
                                type: "pie",
                                startAngle: 240,
                                showInLegend: true,
                                indexLabelPlacement: "inside",
                                indexLabelFontWeight: "bolder",
                                indexLabelFontColor: "white",
                                yValueFormatString: "##0\"%\"",
                                indexLabel: "{label} {y}",
                                dataPoints: holddata
                            }]
                        });

                        chart2.render();

                        function toggleDataSeries(e) {
                            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            } else {
                                e.dataSeries.visible = true;
                            }
                            chart2.render();
                        }
                    }
                });

                $.ajax({
                    type: "get",
                    url: '/patient_recruitement_trend',
                    async: true,
                    data: {
                        _token: token,
                        team_id: team_select,
                        brand_id: brand_select,
                        user_type: user_type,
                        user_id: user_id,
                        zsm_id: zsm_ids,
                        bdm_id: bdm_ids,
                        start_date: start_date,
                        end_date: end_date,
                        type: 8,
                        ff_id: ff_ids
                    },
                    success: function(response) {
                        console.log("Indication wise average dose prescribed", response);
                        var data = response.data;
                        datas = [];
                        holddata = [];
                        let sum = 0;
                        for (i = 0; i < data.length; i++) {
                            sum += data[i]['prescriber_count'];
                        }
                        for (i = 0; i < data.length; i++) {
                            let cap = `` + data[i]['name'] + `(` + data[i]['rx_count'] + `mg)`
                            cap = cap.charAt(0).toUpperCase() + cap.slice(1);
                            var roundUp = Math.ceil(data[i]['doses'] / data[i]['rx_count'])
                            datas = {
                                label: cap,
                                name: cap,
                                y: data[i]['doses'],
                                indexLabel: `"${roundUp}"`,

                            }
                            holddata.push(datas)
                        }
                        var chart10 = new CanvasJS.Chart("singleBarchartContainerTwo", {
                            animationEnabled: true,
                            theme: "light1",

                            axisY: {
                                title: "Average Dose (mg)",
                                interval: 1,
                            },
                            data: [{
                                type: "pie",
                                startAngle: 240,
                                showInLegend: true,
                                indexLabelPlacement: "inside",
                                indexLabelFontWeight: "bolder",
                                indexLabelFontColor: "white",
                                yValueFormatString: "##0\" Doses\"",
                                indexLabel: "{label} {y}",
                                dataPoints: holddata
                            }]
                        });

                        for (var i = 0; i < chart10.options.data[0].dataPoints.length; i++) {
                            if (chart10.options.data[0].dataPoints[i].y === 0)
                                chart10.options.data[0].dataPoints[i].label = "";

                        }
                        chart10.render();
                    }
                });

                $.ajax({
                    type: "get",
                    url: '/patient_recruitement_trend',
                    async: true,
                    data: {
                        _token: token,
                        team_id: team_select,
                        brand_id: brand_select,
                        user_type: user_type,
                        user_id: user_id,
                        zsm_id: zsm_ids,
                        bdm_id: bdm_ids,
                        start_date: start_date,
                        end_date: end_date,
                        type: 11,
                        ff_id: ff_ids
                    },
                    success: function(response) {
                        console.log('Number of cycles repeated', response);
                        var data = response.data;
                        newdata = []
                        for (i = 0; i < data.length; i++) {
                            datanew = {
                                label: data[i]['created_at'],
                                y: data[i]['ids'],
                            }
                            newdata.push(datanew);
                        }
                        var chart4 = new CanvasJS.Chart("multiBarchartContainer", {
                            animationEnabled: true,
                            theme: "light1",

                            axisY: {
                                title: "",
                                interval: 1,
                            },
                            data: [{
                                type: "column",
                                indexLabel: "{y}",
                                dataPoints: newdata
                            }]
                        });
                        chart4.render();
                    }
                });

                $.ajax({
                    type: "get",
                    url: '/patient_recruitement_trend',
                    async: true,
                    data: {
                        _token: token,
                        team_id: team_select,
                        brand_id: brand_select,
                        user_type: user_type,
                        user_id: user_id,
                        zsm_id: zsm_ids,
                        bdm_id: bdm_ids,
                        start_date: start_date,
                        end_date: end_date,
                        type: 12,
                        ff_id: ff_ids
                    },
                    success: function(response) {
                        console.log('Rx Split between Dosing Schedule', response);
                        var data = response.data;
                        datas = [];
                        holddata = [];
                        let sum = 0;
                        for (i = 0; i < data.length; i++) {
                            sum += data[i]['prescriber_count'];
                        }
                        for (i = 0; i < data.length; i++) {
                            let cap = data[i]['schedule']
                            cap = cap.charAt(0).toUpperCase() + cap.slice(1);
                            datas = {
                                label: cap,
                                name: cap,
                                indexLabel: `"${data[i]['prescriber_count']}"`,
                                y: data[i]['prescriber_count'] / sum * 100
                            }
                            holddata.push(datas)
                        }
                        var chart14 = new CanvasJS.Chart("singleBarchartContainerTwoone", {
                            animationEnabled: true,
                            theme: "light1", // "light1", "light2", "dark1", "dark2"

                            axisY: {
                                title: "RX entries"
                            },
                            data: [{
                                type: "pie",
                                startAngle: 240,
                                showInLegend: true,
                                indexLabelPlacement: "inside",
                                indexLabelFontWeight: "bolder",
                                indexLabelFontColor: "white",
                                yValueFormatString: "##0\"%\"",
                                indexLabel: "{label} {y}",
                                dataPoints: holddata
                            }]
                        });
                        for (var i = 0; i < chart14.options.data[0].dataPoints.length; i++) {
                            if (chart14.options.data[0].dataPoints[i].y === 0)
                                chart14.options.data[0].dataPoints[i].label = "";
                        }
                        chart14.render();
                    }
                });
            };

        }

        document.addEventListener("DOMContentLoaded", function() {
            var user_type = $("#user_type").val();
            var user_id = $("#user_id").val();
            var brand_select = brand_select;
            graphLoad(user_type, user_id, brand_select);

        });
    </script>
</body>

</html>