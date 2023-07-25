@extends('layouts.app')
@section('content')
<div class="container client-notification mt-4">
    <h3>Notifications</h3>
    <div class="card">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-important-tab" data-toggle="tab" href="#nav-important" role="tab" aria-controls="nav-important" aria-selected="true" onclick="show(1)">All</a>
                    <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false" onclick="show(2)">3 Days</a>
                    <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false" onclick="show(3)">1 Week</a>
                    <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false" onclick="show(4)">2 Weeks</a>
                    <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false" onclick="show(5)">1 Month</a>
                    <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false" onclick="show(6)">Expaired</a>
                </div>
            </nav>
            <div class="showAll">
                <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                            <div class="datalist-table table-responsive">
                                <div id="list_table">
                                    <table class="table">
                                        <thead class="thead">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="col-md-1">S.NO</th>
                                                    <th scope="col" class="col-md-2">Doctor</th>
                                                    <th scope="col" class="col-md-2">Brand</th>
                                                    <th scope="col" class="col-md-2">Patient Name</th>
                                                    <th scope="col" class="col-md-2">Cycle</th>
                                                    <th scope="col" class="col-md-2">Due Date</th>
                                                    <th scope="col" class="col-md-2"></th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            @if($allnotifications->count() > 0)
                                            @foreach($allnotifications as $key=> $value)
                                            <tr class="showAll">
                                                <td>{{ (($allnotifications->currentPage() - 1 ) * $allnotifications->perPage() ) + $loop->iteration }}</td>
                                                <td>{{$value->doctor_name}}</td>
                                                <td>{{$value->brand_name}}</td>
                                                <td>{{$value->patient_name}}</td>
                                                <td><span>Cycle </span>{{$value->cycle_number}}</td>
                                                <td>{{ $value->end_date}}<br><span>due in {{$value->days}} days</span></td>
                                                <td class="actions">
                                                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                                                        @if(auth()->user()->team_id!='3')
                                                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="2Days" style="display:none ;">
                <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                            <div class="datalist-table table-responsive">
                                <div id="list_table">
                                    <table class="table">
                                        <thead class="thead">
                                            <thead class="table-warning">
                                                <tr>
                                                    <th scope="col" class="col-md-1">S.NO</th>
                                                    <th scope="col" class="col-md-2">Doctor</th>
                                                    <th scope="col" class="col-md-2">Brand</th>
                                                    <th scope="col" class="col-md-2">Patient Name</th>
                                                    <th scope="col" class="col-md-2">Cycle</th>
                                                    <th scope="col" class="col-md-2">Due Date</th>
                                                    <th scope="col" class="col-md-2"></th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            @if($twodaysnotifications->count() > 0)
                                            @foreach($twodaysnotifications as $key=> $value)
                                            <tr>
                                                <td>{{ (($twodaysnotifications->currentPage() - 1 ) * $twodaysnotifications->perPage() ) + $loop->iteration }}</td>
                                                <td>{{$value->doctor_name}}</td>
                                                <td>{{$value->brand_name}}</td>
                                                <td>{{$value->patient_name}}</td>
                                                <td><span>Cycle </span>{{$value->cycle_number}}</td>
                                                <td>{{ $value->end_date}}<br><span>due in {{$value->days}} days</span></td>
                                                <td class="actions">
                                                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                                                        @if(auth()->user()->team_id!='3')
                                                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="1Week" style="display:none ;">
                <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                            <div class="datalist-table table-responsive">
                                <div id="list_table">
                                    <table class="table">
                                        <thead class="thead">
                                            <thead class="table-info">
                                                <tr>
                                                    <th scope="col" class="col-md-1">S.NO</th>
                                                    <th scope="col" class="col-md-2">Doctor</th>
                                                    <th scope="col" class="col-md-2">Brand</th>
                                                    <th scope="col" class="col-md-2">Patient Name</th>
                                                    <th scope="col" class="col-md-2">Cycle</th>
                                                    <th scope="col" class="col-md-2">Due Date</th>
                                                    <th scope="col" class="col-md-2"></th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            @if($oneweeknotifications->count() > 0)
                                            @foreach($oneweeknotifications as $key=> $value)
                                            <tr class="showAll">
                                                <td>{{ (($oneweeknotifications->currentPage() - 1 ) * $oneweeknotifications->perPage() ) + $loop->iteration }}</td>
                                                <td>{{$value->doctor_name}}</td>
                                                <td>{{$value->brand_name}}</td>
                                                <td>{{$value->patient_name}}</td>
                                                <td><span>Cycle </span>{{$value->cycle_number}}</td>
                                                <td>{{ $value->end_date}}<br><span>due in {{$value->days}} days</span></td>
                                                <td class="actions">
                                                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                                                        @if(auth()->user()->team_id!='3')
                                                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="2Week" style="display:none ;">
                <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                            <div class="datalist-table table-responsive">
                                <div id="list_table">
                                    <table class="table">
                                        <thead class="thead">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col" class="col-md-1">S.NO</th>
                                                    <th scope="col" class="col-md-2">Doctor</th>
                                                    <th scope="col" class="col-md-2">Brand</th>
                                                    <th scope="col" class="col-md-2">Patient Name</th>
                                                    <th scope="col" class="col-md-2">Cycle</th>
                                                    <th scope="col" class="col-md-2">Due Date</th>
                                                    <th scope="col" class="col-md-2"></th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            @if($twoweeknotifications->count() > 0)
                                            @foreach($twoweeknotifications as $key=> $value)
                                            <tr>
                                                <td>{{ (($twodaysnotifications->currentPage() - 1 ) * $twoweeknotifications->perPage() ) + $loop->iteration }}</td>
                                                <td>{{$value->doctor_name}}</td>
                                                <td>{{$value->brand_name}}</td>
                                                <td>{{$value->patient_name}}</td>
                                                <td><span>Cycle </span>{{$value->cycle_number}}</td>
                                                <td>{{ $value->end_date}}<br><span>due in {{$value->days}} days</span></td>
                                                <td class="actions">
                                                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                                                        @if(auth()->user()->team_id!='3')
                                                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="1Month" style="display:none ;">
                <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                            <div class="datalist-table table-responsive">
                                <div id="list_table">
                                    <table class="table">
                                        <thead class="thead">
                                            <thead class="table-success">
                                                <tr>
                                                    <th scope="col" class="col-md-1">S.NO</th>
                                                    <th scope="col" class="col-md-2">Doctor</th>
                                                    <th scope="col" class="col-md-2">Brand</th>
                                                    <th scope="col" class="col-md-2">Patient Name</th>
                                                    <th scope="col" class="col-md-2">Cycle</th>
                                                    <th scope="col" class="col-md-2">Due Date</th>
                                                    <th scope="col" class="col-md-2"></th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            @if($onemonthnotifications->count() > 0)
                                            @foreach($onemonthnotifications as $key=> $value)
                                            <tr>
                                                <td>{{ (($onemonthnotifications->currentPage() - 1 ) * $onemonthnotifications->perPage() ) + $loop->iteration }}</td>
                                                <td>{{$value->doctor_name}}</td>
                                                <td>{{$value->brand_name}}</td>
                                                <td>{{$value->patient_name}}</td>
                                                <td><span>Cycle </span>{{$value->cycle_number}}</td>
                                                <td>{{ $value->end_date}}<br><span>due in {{$value->days}} days</span></td>
                                                <td class="actions">
                                                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                                                        @if(auth()->user()->team_id!='3')
                                                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="expaired" style="display:none ;">
                <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-important" role="tabpanel" aria-labelledby="nav-important-tab">
                            <div class="datalist-table table-responsive">
                                <div id="list_table">
                                    <table class="table">
                                        <thead class="thead">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th scope="col" class="col-md-1">S.NO</th>
                                                    <th scope="col" class="col-md-2">Doctor</th>
                                                    <th scope="col" class="col-md-2">Brand</th>
                                                    <th scope="col" class="col-md-2">Patient Name</th>
                                                    <th scope="col" class="col-md-2">Cycle</th>
                                                    <th scope="col" class="col-md-2">Due Date</th>
                                                    <th scope="col" class="col-md-2"></th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            @if($expaired->count() > 0)
                                            @foreach($expaired as $key=> $value)
                                            <tr id="expaired">
                                                <td>{{ (($expaired->currentPage() - 1 ) * $expaired->perPage() ) + $loop->iteration }}</td>
                                                <td>{{$value->doctor_name}}</td>
                                                <td>{{$value->brand_name}}</td>
                                                <td>{{$value->patient_name}}</td>
                                                <td><span>Cycle </span>{{$value->cycle_number}}</td>
                                                <td>{{$value->end_date}}</td>
                                                <td class="actions">
                                                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                                                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                                                        @if(auth()->user()->team_id!='3')
                                                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection


    <script>
        function show(values) {
            if (values == 1) {
                $('.2Days').hide();
                $('.1Week').hide();
                $('.2Week').hide();
                $('.1Month').hide();
                $('.showAll').show();
                $('.expaired').hide();
            } else if (values == 2) {
                $('.showAll').hide();
                $('.2Days').show();
                $('.1Week').hide();
                $('.2Week').hide();
                $('.1Month').hide();
                $('.expaired').hide();
            } else if (values == 3) {
                $('.showAll').hide();
                $('.2Days').hide();
                $('.1Week').show();
                $('.2Week').hide();
                $('.1Month').hide();
                $('.expaired').hide();
            } else if (values == 4) {
                $('.showAll').hide();
                $('.2Days').hide();
                $('.1Week').hide();
                $('.2Week').show();
                $('.1Month').hide();
                $('.expaired').hide();
            } else if (values == 5) {
                $('.2Days').hide();
                $('.1Week').hide();
                $('.2Week').hide();
                $('.1Month').show();
                $('.showAll').hide();
                $('.expaired').hide();
            } else if (values == 6) {
                $('.showAll').hide();
                $('.2Days').hide();
                $('.1Week').hide();
                $('.2Week').hide();
                $('.1Month').hide();
                $('.expaired').show();
            }
        }
    </script>