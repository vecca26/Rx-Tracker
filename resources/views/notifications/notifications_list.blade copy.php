@extends('layouts.app')
@section('content')
<div class="container client-notification mt-4">
    <h3>Notifications</h3>
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                @if($notifications->count() > 0)
                @foreach($notifications as $key=> $value)
                <div class="col-md-6 cn-detail">
                    <div class="card">
                        <div class="card-body">
                            <div class="cn-detail-head align-items-center">
                                <div class="cd-dh-icon pink">
                                    <img src="images/icons/capsule.svg">
                                </div>
                                <div class="cd-dh-title">
                                    <h4>{{ $value->name }}</h4>
                                    <!-- <p>John Smith</p> -->
                                </div>
                                <div class="cd-dh-time">
                                    <p>Now</p>
                                </div>
                            </div>
                            <div class="cn-details-texts">
                                <p>{{$value->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection