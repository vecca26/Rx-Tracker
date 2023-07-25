<div class="steps">
    <div class="row">
        <div class="col-md-4">
            <div class="step-s">
                <h5>Step 1</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="step-s">
                <h5>Step 2</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="active-class">
                <h5>Step 3</h5>
            </div>
        </div>
    </div>
</div>
<div class="patient-details mt-5">
    @if(auth()->user()->team_id!='3')
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="indicationRxed">Indication Rxed <span class="text-danger">*</span></label>
            <span id="error-indication_id" style="color:red;"></span>
            <select name="indication_id" id="indication_id" class="form-select">

                @foreach($indications as $key=> $value)
                <option value="">Choose Indications</option>
                <option value="{{$value->id}}" myTag="{{$value->is_subindication}}" {{ old('indication_id') == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                @endforeach

            </select>
            @if ($errors->has('indication_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('indication_id') }}</strong>
            </span>
            @endif
        </div>
        <input type="hidden" name="schedule_name" id="schedule_name">

        
        <div class="form-group col-md-4" id="sub_indication_div" style="display:none;">
            <label for="subindicationRxed">Sub Indication <span class="text-danger">*</span></label>
            <select name="sub_indication_id" id="sub_indication_id" class="form-select">
            </select>
            @if ($errors->has('sub_indication_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('sub_indication_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-md-4" id="sub_sub_indication_div" style="display:none;">
            <label for="subindicationRxed">Sub Indication<span class="text-danger">*</span></label>
            <select name="sub_sub_indication_id" id="sub_sub_indication_id" class="form-select">
            </select>
            @if ($errors->has('sub_sub_indication_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('sub_sub_indication_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-md-4" id="indications_other" style="display: none;">
            <label for="indicationRxed">Enter indication <span class="text-danger">*</span></label>
            <input type="text" value=" " class="form-control" id="ind_other" name="ind_other">
        </div>

        <div class="form-group col-md-4" id="sub_indication_comment_div" style="display: none;">
            <label for="indicationRxed">Enter Comments <span class="text-danger">*</span></label>
            <input type="text" value="" class="form-control" id="sub_indication_comment" name="sub_indication_comment">
        </div>

        @if(auth()->user()->team_id=='2')
        <div class="form-group col-md-4" style="display:none;" id="dose_value_select_div">
            <label for="dose_value">Dose(mg) <span class="text-danger">*</span></label>
            <span id="error-dose_value" style="color:red;"></span>
            <div class="row">
                <div class="form-group col-md-12">
                    <select name="dose_value_select" id="dose_value_select" class="form-select">
                    </select>

                    @if ($errors->has('dose_value_select'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('dose_value_select') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group col-md-4" style="display:none;" id="dose_value_div">
            <label for="dose_value">Dose(mg)<span class="text-danger">*</span></label>
            <span id="error-dose_value" style="color:red;"></span>
            <input type="text" class="form-control" value="{{ old('dose_value') }}" id="dose_value" name="dose_value">
            @if ($errors->has('dose_value'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('dose_value') }}</strong>
            </span>
            @endif
        </div>
        @else
        <div class="form-group col-md-4">
            <label for="dose_value">Dose(mg)<span class="text-danger">*</span></label>
            <span id="error-dose_value" style="color:red;"></span>
            <input type="text" class="form-control" value="{{ old('dose_value') }}" id="dose_value" name="dose_value">
            @if ($errors->has('dose_value'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('dose_value') }}</strong>
            </span>
            @endif
        </div>
        @endif
        <!--  <div class="form-group col-md-4">
              <label for="dose_value">Dose Unit</label>
            <input type="text" class="form-control" value="mg" id="dose_unit" name="dose_unit" readonly>
          
           <div style="margin-top: 50px">(mg)</div>
        </div> -->
        <div class="form-group col-md-4">
            <label for="schedule">Schedule <span class="text-danger">*</span></label>
            <span id="error-schedule" style="color:red;"></span>
            <select id="schedule" name="schedule" class="form-select">
            </select>
            @if ($errors->has('schedule'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('schedule') }}</strong>
            </span>
            @endif
        </div>
                            <div class="form-group col-md-4" id="schedule_others_name_div" style="display:none">
                                <label> Schedule Name <span style="color:red;"> * </span></label>
                                <span id="new_schedule_name_1" style="color:red;"></span>
                                <input type="text" class="form-control" name="new_schedule_name" placeholder="Enter New Schedule Name" id="new_schedule_name">
                                @if ($errors->has('new_schedule_name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('new_schedule_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        <div class="form-group col-md-4" id="schedule_others_days_div" style="display:none">
                                <label> No of Days <span style="color:red;"> * </span></label>
                                <span id="error-ir_name" style="color:red;"></span>
                                <input type="text" class="form-control" name="schedule_no_of_days" placeholder="Enter No of Days" id="schedule_no_of_days">
                                @if ($errors->has('schedule_no_of_days'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('schedule_no_of_days') }}</strong>
                                </span>
                                @endif
                        </div>
                   



        <div class="form-group col-md-4">
            <label for="start_date">Treatment Start Date <span class="text-danger">*</span></label>
            <span id="error-start_date" style="color:red;"></span>
            <input type="date" value="{{ old('start_date') }}" class="form-control" id="start_date" name="start_date">
            @if ($errors->has('start_date'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-md-4" id="end_date_div" style="display: none;">
            <label for="end_date">Treatment End Date</label>
            <input type="date" readonly value="{{ old('end_date') }}" class="form-control" id="end_date" name="end_date">
            @if ($errors->has('end_date'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-md-4 upload-file">
            <input type="file" id="file-upload" name="rx_copy_link" />
            <label for="file-upload"><img src="{{ asset('images/icons/upload.png') }}"> Upload Rx
                Copy</label>
            <div id="file-upload-filename"></div>
        </div>
    </div>
    @else
    <!-- Team E Section -->

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label> IR Name <span style="color:red;"> * </span></label>
                <span id="error-ir_name" style="color:red;"></span>
                <input type="text" class="form-control" name="ir_name" placeholder="Enter IR Name" id="ir_name" value="{{ old('ir_name')}}" required>
                @if ($errors->has('ir_name'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('ir_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Nm Name <span style="color:red;"> * </span></label>
                <span id="error-nm_name" style="color:red;"></span>
                <input type="text" class="form-control" name="nm_name" placeholder="Enter Nm Name" id="nm_name" value="{{ old('nm_name')}}" required>
                @if ($errors->has('nm_name'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('nm_name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <label for="indicationRxed">Tumour Type <span style="color:red;"> * </span></label>
            <span id="error-indication_id" style="color:red;"></span>

            <select name="indication_id" id="indication_id" class="form-select">
                <option value="">Choose Tumour Type</option>
                @foreach($indications as $key=> $value)
                <option value="{{$value->id}}" myTag="{{$value->is_subindication}}" {{ old('indication_id') == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('indication_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('indication_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-md-4" id="indications_other" style="display: none;">
            <label for="indicationRxed">Enter TumourType <span class="text-danger">*</span></label>
            <input type="text" value=" " class="form-control" id="ind_other" name="ind_other">
        </div>


   
        <div class="col-md-4">
            <div class="form-group">
                <label>Pvt Involvement<span style="color:red;"> * </span></label>
                <span id="error-pvt_involvement" style="color:red;"></span>
                <select class="form-select" name="pvt_involvement" id="pvt_involvement" required>
                    <option value="">Choose Pvt Involvement</option>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select> @if ($errors->has('pvt_involvement'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('pvt_involvement') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>BCLC Stage<span style="color:red;"> * </span></label>
                <span id="error-bclc_stage_id" style="color:red;"></span>
                <select class="form-select" name="bclc_stage_id" id="bclc_stage_id" required>
                    <option value="">Choose BCLC Stage</option>
                    <option value='A'>A</option>
                    <option value='B'>B</option>
                    <option value='C'>C</option>
                    <option value='D'>D</option>
                </select>
                @if ($errors->has('bclc_stage_id'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('bclc_stage_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Child Pugh Score<span style="color:red;"> * </span></label>
                <span id="error-pugh_score_id" style="color:red;"></span>
                <select class="form-select" name="pugh_score_id" id="pugh_score_id" required>
                    <option value="">Choose Child Pugh Score</option>
                    <option value='A'>A</option>
                    <option value='B'>B</option>
                    <option value='C'>C</option>
                </select>
                @if ($errors->has('pugh_score_id'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('pugh_score_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
  
        <div class="col-md-4">
            <div class="form-group">
                <label>Liver Tumour Volume<span style="color:red;"> * </span></label>
                <span id="error-liver_tumour_volume" style="color:red;"></span>
                <input type="text" class="form-control" name="liver_tumour_volume" placeholder="Enter Liver Tumour Volume" id="liver_tumour_volume" value="{{ old('liver_tumour_volume')}}" required>
                @if ($errors->has('liver_tumour_volume'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('liver_tumour_volume') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Lung Shunt(%)<span style="color:red;"> * </span></label>
                <span id="error-lung_shunt" style="color:red;"></span>
                <input type="text" class="form-control" name="lung_shunt" placeholder="Enter Lung Shunt" id="lung_shunt" value="{{ old('lung_shunt')}}" required>
                @if ($errors->has('lung_shunt'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('lung_shunt') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <label for="dose_value">Dose Delivered(GBq) <span style="color:red;"> * </span></label>
            <span id="error-dose_value" style="color:red;"></span>
            <input type="text" class="form-control" value="{{ old('dose_value') }}" placeholder="Enter Dose Delivered" id="dose_value" name="dose_value">
            @if ($errors->has('dose_value'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('dose_value') }}</strong>
            </span>
            @endif
        </div>

   
        <div class="col-md-4">
            <div class="form-group">
                <label>Mode of Dose Calculation<span style="color:red;"> * </span></label>
                <span id="error-dmode_id" style="color:red;"></span>
                <!-- <input type="text" class="form-control" name="dmode_id" placeholder="Enter Mode of Dose Calculation" id="dmode_id" value="{{ old('dmode_id')}}" required> -->
                <select class="form-select" name="dmode_id" id="dmode_id" required>
                            <option value="">Choose D-Mode Calculation</option>
                            <option value='0'>BSA</option>
                            <option value='1'>Partion Model</option>
                        </select>
                @if ($errors->has('dmode_id'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('dmode_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="add-rx-button">
                <a href="#" class="btn btn-warning" id="add_rx_step3_prev">PREVIOUS</a>
                <!-- <button type="submit" class="btn btn-warning">SAVE</button> -->
                <input type="hidden" id="teamid" value={{auth()->user()->team_id}}>
                <button type="submit" id="add_rx_step3_next" class="btn btn-warning">SAVE</button>
            </div>
        </div>
    </div>

</div>

<script>
    var input = document.getElementById('file-upload');
    var infoArea = document.getElementById('file-upload-filename');

    input.addEventListener('change', showFileName);

    function showFileName(event) {

        // the change event gives us the input it occurred in
        var input = event.srcElement;

        // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
        var fileName = input.files[0].name;

        // use fileName however fits your app best, i.e. add it into a div
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>