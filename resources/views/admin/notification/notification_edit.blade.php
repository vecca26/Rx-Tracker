@extends('layouts.app')
@section('content')
<div class="container client-profile mt-4">
    <h3>Edit Notification</h3>
    <div class="card">
        <div class="card-body">
            <div class="row mt-4 justify-content-between">
                <div class="col-md-5">
                    <form method="POST" action="{{ Route('notifications.update', $id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="notiTitle">Title</label>
                            <input type="text" class="form-control" value="{{$notifications->name}}" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter Title">
                            <small id="title" class="form-text text-muted text-right">Max. 65
                                characters</small>
                            @if ($errors->has('title'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="notiText">Text</label>
                            <textarea class="form-control" id="description"  name="description" rows="3" placeholder="Write Content">{{$notifications->description}}</textarea>
                            <small id="texts" class="form-text text-muted text-right">Max. 240
                                characters</small>
                        </div>

                        <h4 class="pt-3">Add Destination</h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Select Region</label>
                                <!-- <select class="form-select" id="exampleFormControlSelect1" name="region_id" id="region_id">
                                    <option>Choose Region</option>
                                    <option>region 1</option>

                                </select> -->
                                <select class="form-select" name="region_id" id="region_id" required>
                                    <option value="" selected="selected" disabled>-Select-</option>
                                    @foreach($region as $key =>$value)
                                    <option value="{{ $value->id }}" {{ $notifications->region_id == $value->id ? 'selected' : '' }}>{{ $value->region }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('region_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('region_id') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Select Head Quarters</label>

                                <select class="form-select" name="hq_id" id="hq_id" required>
                                    <option value="" selected="selected" disabled>-Select-</option>
                                    @foreach($hq as $key =>$value)
                                    <option value="{{ $value->id }}" {{ $notifications->hq_id == $value->id ? 'selected' : '' }}>{{ $value->hq }}</option>
                                    @endforeach
                                </select> @if ($errors->has('hq_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('hq_id') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Select Team</label>
                                <select class="form-select" name="team_id" id="team_id" required>
                                    <option value="" selected="selected" disabled>-Select-</option>
                                    @foreach($teams as $key =>$value)
                                    <option value="{{ $value->id }}" {{ $notifications->team_id == $value->id ? 'selected' : '' }}>{{ $value->team }}</option>
                                    @endforeach
                                </select> @if ($errors->has('team_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('team_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Select Field Force</label>

                                <select class="form-select" name="user_id" id="user_id" required>
                                    <option value="" selected="selected" disabled>-Select-</option>
                                    @foreach($users as $key =>$value)
                                    <option value="{{ $value->id }}" {{ $notifications->user_id == $value->id ? 'selected' : '' }}>{{ $value->first_name }}</option>
                                    @endforeach
                                </select> @if ($errors->has('user_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="notify-btn-send">
                            <button type="submit" class="btn btn-warning mt-3">Send Notification</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-6">
                    <div class="notify-bulb">
                        <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.00001 18.6667H5.33335C5.15654 18.6667 4.98697 18.7369 4.86194 18.8619C4.73692 18.987 4.66668 19.1565 4.66668 19.3333C4.66668 19.5101 4.73692 19.6797 4.86194 19.8047C4.98697 19.9298 5.15654 20 5.33335 20H8.00001C8.17682 20 8.34639 19.9298 8.47142 19.8047C8.59644 19.6797 8.66668 19.5101 8.66668 19.3333C8.66668 19.1565 8.59644 18.987 8.47142 18.8619C8.34639 18.7369 8.17682 18.6667 8.00001 18.6667ZM8.66668 16.6667H4.66668C4.48987 16.6667 4.3203 16.7369 4.19528 16.8619C4.07025 16.987 4.00001 17.1565 4.00001 17.3333C4.00001 17.5101 4.07025 17.6797 4.19528 17.8047C4.3203 17.9298 4.48987 18 4.66668 18H8.66668C8.84349 18 9.01306 17.9298 9.13808 17.8047C9.26311 17.6797 9.33334 17.5101 9.33334 17.3333C9.33334 17.1565 9.26311 16.987 9.13808 16.8619C9.01306 16.7369 8.84349 16.6667 8.66668 16.6667ZM11.3925 1.94543C10.1396 0.690852 8.46126 1.88936e-05 6.66668 1.88936e-05C5.79062 -0.00206921 4.92277 0.168944 4.11299 0.503235C3.30321 0.837527 2.56745 1.32851 1.94798 1.94798C1.32851 2.56746 0.837527 3.30321 0.503235 4.11299C0.168944 4.92277 -0.00206921 5.79062 1.88936e-05 6.66668C1.88936e-05 8.60918 0.744602 10.4263 2.04168 11.6517L2.22335 11.8221C2.97377 12.5238 4.00001 13.485 4.00001 14.3333V15.3333C4.00001 15.5101 4.07025 15.6797 4.19528 15.8047C4.3203 15.9298 4.48987 16 4.66668 16H5.66668C5.75509 16 5.83987 15.9649 5.90238 15.9024C5.96489 15.8399 6.00001 15.7551 6.00001 15.6667V10.7842C6.00003 10.7168 5.97962 10.6509 5.94146 10.5954C5.9033 10.5398 5.84918 10.4971 5.78626 10.4729C5.4013 10.3159 5.03559 10.1153 4.69626 9.87501C4.62001 9.82632 4.55447 9.76261 4.50362 9.68777C4.45278 9.61294 4.4177 9.52853 4.40053 9.4397C4.38335 9.35087 4.38443 9.25948 4.40371 9.17108C4.42299 9.08268 4.46006 8.99914 4.51266 8.92552C4.56527 8.85191 4.6323 8.78978 4.70969 8.74291C4.78708 8.69604 4.87319 8.66541 4.9628 8.65288C5.0524 8.64036 5.14362 8.64621 5.23089 8.67007C5.31816 8.69393 5.39966 8.73531 5.47043 8.79168C5.77876 9.01001 6.37251 9.33334 6.66668 9.33334C6.96085 9.33334 7.5546 9.00918 7.86376 8.79168C8.00772 8.70118 8.18081 8.6691 8.34763 8.70202C8.51445 8.73493 8.6624 8.83035 8.76119 8.96874C8.85998 9.10713 8.90216 9.27805 8.87909 9.44652C8.85602 9.61498 8.76945 9.76827 8.63709 9.87501C8.29771 10.1148 7.932 10.315 7.5471 10.4717C7.48417 10.4959 7.43006 10.5386 7.3919 10.5941C7.35374 10.6497 7.33332 10.7155 7.33335 10.7829V15.6667C7.33335 15.7551 7.36846 15.8399 7.43098 15.9024C7.49349 15.9649 7.57827 16 7.66668 16H8.66668C8.84349 16 9.01306 15.9298 9.13808 15.8047C9.26311 15.6797 9.33334 15.5101 9.33334 15.3333V14.3333C9.33334 13.505 10.3483 12.5446 11.0896 11.8429L11.2942 11.6488C12.6283 10.375 13.3333 8.65043 13.3333 6.66668C13.3378 5.79053 13.1685 4.92219 12.8354 4.11184C12.5023 3.30148 12.0119 2.56516 11.3925 1.94543Z" fill="#F39100" />
                        </svg>

                        <p>The Notification will be send to the FF in the Team A under the area A under
                            the
                            Region A</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection