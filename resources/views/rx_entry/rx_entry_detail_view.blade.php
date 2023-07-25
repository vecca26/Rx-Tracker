@extends('layouts.app')
@section('content')
<div class="container client-data-detail mt-4">
    <h3>Rx Details of {{ ucfirst($rx_entry->patient_name) }}</h3>
    <div class="row pl-3 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="row pt-4">
                    <div class="col-md-7">
                        <div class="data-details-contents">
                            <p><span class="ddc-title">Brand Name </span>: &nbsp; {{ $rx_entry->brands->brand_name }}</p>
                            <p><span class="ddc-title">Doctor Name </span>: &nbsp; {{ $rx_entry->doctors->doctor_name}}</p>
                            <p><span class="ddc-title">Speciality</span>: &nbsp; {{ $rx_entry->doctors->speciality}}</p>
                            <p><span class="ddc-title">Institute</span>: &nbsp; {{ $rx_entry->doctors->institute}}</p>
                            <p><span class="ddc-title">Institute Type</span>: &nbsp; {{ $rx_entry->doctors->institute_type}}</p>
                            <p><span class="ddc-title">Prescriber</span>: &nbsp; Existing</p>

                            <h4 class="mb-4">Patient Details</h4>
                            <p><span class="ddc-title">Patient Name</span>: &nbsp; {{ $rx_entry->patient_name }}</p>
                            <p><span class="ddc-title">Contact Number</span>: &nbsp; {{ $rx_entry->phone }} </p>
                            <p><span class="ddc-title">Patient Type</span>: &nbsp; {{ $rx_entry->patient_type->name }}</p>
                            <p><span class="ddc-title">Contact Type</span>: &nbsp; {{ $rx_entry->contact_type }}</p>
                            <p><span class="ddc-title">Indication Rxed</span>: &nbsp; {{ $prescriptions->indications->name}}</p>
                            <p><span class="ddc-title">Schedule</span>: &nbsp; {{ $prescriptions->schedule_name}}</p>
                            <p><span class="ddc-title">Dose</span>: &nbsp; {{ $prescriptions->dose_value }} {{ $prescriptions->dose_unit }} mg</p>
                            <p><span class="ddc-title">Treatment Start Date</span>: &nbsp; {{date('d-m-Y', strtotime($prescriptions->start_date))  }}</p>
                        </div>
                    </div>
                    @if($prescriptions->rx_copy_link!=null)
                    <div class="col-md-5 data-img-detail">
                        <a href="{{  asset('images/rx_prescriptions/'.$prescriptions->rx_copy_link) }}" download> <img src="{{ asset('images/rx_prescriptions/'.$prescriptions->rx_copy_link) }}" class="w-100"></a>
                    </div>
                    @endif
                </div>


                @if($cycle->count() > 0)
                <div class="data-details-contents">
                    <h4 class="mb-4">Rx Cycles</h4>
                    @foreach($cycle as $key=> $value)
                    <div class="row pt-4">
                        <div class="col-md-8">
                            <b style="color:orange">Cycle {{ $value->cycle_number}}</b><br><br>
                            <p><span class="ddc-title">Cycle Repeated?</span>: &nbsp;@if($value->cycle_repeated==null) Ongoing @else @endif {{ $value->cycle_repeated}}</p>
                            <p><span class="ddc-title">Start Date</span>: &nbsp; {{ date('d-m-Y', strtotime($value->start_date)) }}</p>
                            <p><span class="ddc-title">End Date</span>: &nbsp; {{ date('d-m-Y', strtotime($value->end_date)) }}</p>
                            @if($value->reason_id!=null)
                            <p><span class="ddc-title">Reason</span>: &nbsp; {{ $value->reasons->reason }}</p>
                            <p><span class="ddc-title">Comments</span>: &nbsp; {{ $value->reason }}</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if($value->rx_copy_link!=null)
                            <a href="{{ asset('images/rx_prescriptions/'.$value->rx_copy_link)}}" download> <img src="{{ asset('images/rx_prescriptions/'.$value->rx_copy_link)}}" class="w-50"></a>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
                @endif



            </div>
        </div>
    </div>
</div>
@endsection