@extends('layouts.app')
@section('content')
<div class="container client-data-form mt-4">
    <h3>Add New Cycle</h3>
    <div class="card">
        <div class="card-body">
            <div class="patient-details mt-4">
                <h4>Next Cycle</h4>
                <form class="mt-4" method="POST" enctype="multipart/form-data" action="{{ url('update_cycle') }}">
                    @csrf
                    <input type="hidden" id="rx_id" name="rx_id" value="{{ $id }}">
                    <input type="hidden" id="brand_ids" name="brand_ids" value="{{ $brand_ids }}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cycle_repeated">Next Cycle Repeated</label>
                            <select id="cycle_repeated" name="cycle_repeated" class="form-select">
                                <option>Choose Options</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        @if(auth()->user()->team_id !='3')
                        <div class="form-group col-md-4" id="schedule_div" style="display:none;">
                            <label for="schedule">Schedule</label>
                            <select id="schedule" name="schedule" class="form-select">

                                @foreach($schedule_list as $key=> $value)
                                <option value="{{$value->number_of_days}}">{{$value->schedule}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('schedule'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('schedule') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4" id="start_date_div" style="display:none;">
                            <label for="start_date">Start Date of Next Cycle</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>

                        <div class="form-group col-md-4" id="end_date_div" style="display:none;">
                            <label for="end_date">End Date of Next Cycle</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        @endif


                        <div class="form-group col-md-4" id="dose_value_div" style="display:none;">
                            <label for="dose_value">Dose Value</label>
                            <input type="text" class="form-control" placeholder="Enter Dose Value" id="dose_value" name="dose_value">
                        </div>

                        <div class="form-group col-md-4" id="reason_div" style="display:none;">
                            <label for="patientType">Reason for Dose Delay/Discontinuation</label>
                            <select id="reason_id" name="reason_id" class="form-select" value="{{ old('reason_id') }}">
                                <option value="" selected>Choose Reasons</option>
                                @foreach($discontinue_reason as $key=> $value)
                                <option value="{{$value->id}}" {{ old('reason_id') == $value->reason_id ? 'selected' : '' }}>{{$value->reason}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4" id="brand_shift_div" style="display:none;">
                            <label for="contactType">BrandShift/Other Reason</label>
                            <input type="text" class="form-control" id="reason" name="reason" placeholder="Enter the Reasons">
                        </div>

                        <!-- <input type="file" id="file-upload" multiple required />
            <label for="file-upload"><img src="{{ asset('images/icons/upload.png') }}"> Upload Rx
                Copy</label> -->

                        <!-- <div class="form-group col-md-4 upload-file" id="image_div" style="display:none;">
                            <input type="file" id="rx_copy_link" name="rx_copy_link" multiple required hidden />
                            <label for="rx_copy_link"><img src="{{ asset('images/icons/upload.png') }}">Upload Rx Copy</label>
                            <div id="rx_copy_link-filename"></div>
                        </div> -->

                        <div class="form-group col-md-4 upload-file" id="image_div" style="display:none;">
                            <input type="file" id="rx_copy_link" name="rx_copy_link" multiple  hidden />
                            <label for="rx_copy_link"><img src="{{ asset('images/icons/upload.png') }}">Upload Rx Copy</label>
                            <div id="rx_copy_link-filename"></div>
                        </div>



                    </div>
                    <div class="add-rx-button mt-5">
                        <button type="submit" class="btn btn-warning">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    var input = document.getElementById('rx_copy_link');
    var infoArea = document.getElementById('rx_copy_link-filename');

    input.addEventListener('change', showFileName);

    function showFileName(event) {

        // the change event gives us the input it occurred in
        var input = event.srcElement;

        // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
        var fileName = input.files[0].name;

        // use fileName however fits your app best, i.e. add it into a div
        infoArea.textContent = 'File name: ' + fileName;
    }

    let token = "{{csrf_token()}}";
    (function($) {
        $('#cycle_repeated').on('change', function(e) {
            if ($('#cycle_repeated').val() == 'yes') {
                $('#reason_div').hide();
                $('#schedule_div').show();
                $('#start_date_div').show();
                $('#dose_value_div').show();
                $('#image_div').show();
            } else if ($('#cycle_repeated').val() == 'no') {
                $('#reason_div').show();
                $('#schedule_div').hide();
                $('#start_date_div').hide();
                $('#dose_value_div').hide();
                $('#image_div').hide();
            } else {
                $('#reason_div').hide();
                $('#schedule_div').hide();
                $('#start_date_div').hide();
                $('#dose_value_div').hide();
                $('#image_div').hide();
            }
        });


        //End Date Calculation

        $('#start_date').on('change', function(e) {
            var schedule = $('#schedule').val();
            var start_date = $('#start_date').val();
            $.ajax({
                type: "get",
                url: "{{url('/get_end_date')}}",
                // url: '/get_end_date',
                async: true,
                data: {
                    _token: token,
                    schedule: schedule,
                    start_date: start_date
                },
                success: function(response) {
                    console.log(response);
                    $('#end_date_div').show()
                    $('#end_date').val(response);
                }

            });
        });


        $('#reason_id').on('change', function(e) {
            if ($('#reason_id').val() == '5' || $('#reason_id').val() == '6') {
                $('#brand_shift_div').show();
            } else {
                $('#brand_shift_div').hide();
            }
        });

    })(jQuery);
</script>
@endsection