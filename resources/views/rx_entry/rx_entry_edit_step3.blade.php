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
            <select name="indication_id" id="indication_id" value="{{ $prescriptions->indications->name }}" class="form-select">
                <option value="">Choose Indications</option>
                @foreach($indications as $key=> $value)
                @if ($value->name=='others')
                <?php $val = 0; ?>
                @else
                <?php $val = $value->id; ?>
                @endif
                <option value="{{ $val }}" {{ $prescriptions->indications->id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('indication_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('indication_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-md-4" id="sub_indication_div" @if($prescriptions->sub_indication_id==null) style="display:none;"@endif>
            <label for="subindicationRxed">Sub Indication <span class="text-danger">*</span></label>
            <select name="sub_indication_id" id="sub_indication_id" class="form-select">
                <option value=''>Choose Sub Indications</option>
                @foreach($sub_indications as $key=> $value)
                <option value="{{ $value->id }}" {{ $prescriptions->sub_indication_id == $value->id ? 'selected' : '' }}>{{ $value->sub_indication }}</option>
                @endforeach
            </select>
            @if ($errors->has('sub_indication_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('sub_indication_id') }}</strong>
            </span>
            @endif
        </div>

        @if($prescriptions->sub_indication_comment!=null)
        <div class="form-group col-md-4" id="sub_indication_comment_div">
            @else
            <div class="form-group col-md-4" id="sub_indication_comment_div" style="display: none;">
                @endif

                <label for="indicationRxed">Enter Comments <span class="text-danger">*</span></label>
                <input type="text" value="{{ $prescriptions->sub_indication_comment }}" class="form-control" id="sub_indication_comment" name="sub_indication_comment">
            </div>




            <div class="form-group col-md-4" id="indications_other" style="display: none;">
                <label for="indicationRxed">Enter indication <span class="text-danger">*</span></label>
                <input type="text" value=" " class="form-control" id="ind_other" name="ind_other">

            </div>

            <!-- Rj Edits 27-06-2022 -->

            @if($prescriptions->sub_sub_indication_id!=null)
            <div class="form-group col-md-4" id="sub_sub_indication_div">
                @else
                <div class="form-group col-md-4" id="sub_sub_indication_div" style="display:none;">
                    @endif
                    <label for="subindicationRxed">Sub Indication's Sub<span class="text-danger">*</span></label>
                    <select name="sub_sub_indication_id" id="sub_sub_indication_id" class="form-select">
                        <option value="">-SELECT-</option>
                        @foreach($all_sub_sub_indication as $key=> $value)
                        <option value="{{$value->id}}" {{ $prescriptions->sub_sub_indication_id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('sub_sub_indication_id'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('sub_sub_indication_id') }}</strong>
                    </span>
                    @endif
                </div>




                <!-- Rj Edits 21-06-2022 -->
                @if(auth()->user()->team_id=='2' && $dose !=0)
                <div class="form-group col-md-4" id="dose_value_select_div">
                    <label for="dose_value">Dose(mg)<span class="text-danger">*</span></label>
                    <span id="error-dose_value" style="color:red;"></span>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select name="dose_value_select" id="dose_value_select" class="form-select">
                                @foreach($dose as $key=> $value)
                                @if($value->value=='other')
                                <option value="0" {{ $prescriptions->dose_id_teamb == $value->id ? 'selected' : '' }}>{{$value->value}}</option>
                                @else
                                <option value="{{$value->id}}" {{ $prescriptions->dose_id_teamb == $value->id ? 'selected' : '' }}>{{$value->value}}</option>
                                @endif
                                @endforeach
                            </select>

                            @if ($errors->has('dose_value_select'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('dose_value_select') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @if($prescriptions->dose_unit==null)
                <div class="form-group col-md-4" style="display:none;" id="dose_value_div">
                    @else
                    <div class="form-group col-md-4" id="dose_value_div">
                        @endif
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
                        <input type="text" class="form-control" value="{{ $prescriptions->dose_value }}" id="dose_value" name="dose_value">
                        @if ($errors->has('dose_value'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('dose_value') }}</strong>
                        </span>
                        @endif
                    </div>
                    @endif

                    <input type="hidden" name="schedule_name" id="schedule_name">
                    <input type="hidden" name="brands" id="brands">
                    <div class="form-group col-md-4">
                        <label for="schedule">Schedule <span class="text-danger">*</span></label>
                        <select id="schedule" name="schedule" class="form-select">
                            <option value="">Choose Schedule</option>
                            @foreach($scheduleList as $key=> $value)
                            <option value="{{ $value->number_of_days }}" myTag="{{ $value->schedule }}" {{ $prescriptions->schedule_name == $value->schedule ? 'selected' : '' }}>{{ $value->schedule}}</option>


                            @endforeach
                        </select>
                        @if ($errors->has('schedule'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('schedule') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="start_date">Treatment Start Date <span class="text-danger">*</span></label>
                        <input type="date" value="{{ $prescriptions->start_date }}" class="form-control" id="start_date" name="start_date">
                        @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4" id="end_date_div">
                        <label for="end_date">Treatment End Date <span class="text-danger">*</span></label>
                        <span id="error-start_date" style="color:red;"></span>

                        <input type="date" readonly value="{{ $prescriptions->end_date }}" class="form-control" id="end_date" name="end_date">
                        @if ($errors->has('end_date'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 upload-file">
                        <input type="file" id="file-upload" name="rx_copy_link" multiple />
                        <label for="file-upload"><img src="{{ asset('images/icons/upload.png') }}"> Upload Rx
                            Copy</label>
                        <div id="file-upload-filename"></div>
                    </div>


                </div>
                @else

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> IR Name <span style="color:red;"> * </span></label>
                            <span id="error-ir_name" style="color:red;"></span>
                            <input type="text" class="form-control" name="ir_name" placeholder="Enter IR Name" id="ir_name" value="{{ $prescriptions->ir_name }}" required>
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
                            <input type="text" class="form-control" name="nm_name" placeholder="Enter Nm Name" id="nm_name" value="{{ $prescriptions->nm_name }}" required>
                            @if ($errors->has('nm_name'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('nm_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="indicationRxed">Tumour Type <span class="text-danger">*</span></label>
                        <span id="error-indication_id" style="color:red;"></span>
                        <select name="indication_id" id="indication_id" class="form-select">
                            <option value="">Choose Tumour Type</option>
                            @foreach($indications as $key=> $value)
                            @if ($value->name=='others')
                            <?php $val = 0; ?>
                            @else
                            <?php $val = $value->id; ?>
                            @endif
                            <option value="{{$val}}" {{ $prescriptions->indication_id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
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
                                <option value='yes' {{ $prescriptions->pvt_involvement == "yes" ? 'selected' : '' }}>Yes</option>
                                <option value='no' {{ $prescriptions->pvt_involvement == "no" ? 'selected' : '' }}>No</option>
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
                                <option value='A' {{ $prescriptions->bclc_stage_id == "A" ? 'selected' : '' }}>A</option>
                                <option value='B' {{ $prescriptions->bclc_stage_id == "B" ? 'selected' : '' }}>B</option>
                                <option value='C' {{ $prescriptions->bclc_stage_id == "C" ? 'selected' : '' }}>C</option>
                                <option value='D' {{ $prescriptions->bclc_stage_id == "D" ? 'selected' : '' }}>D</option>
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
                                <option value='A' {{ $prescriptions->pugh_score_id == "A" ? 'selected' : '' }}>A</option>
                                <option value='B' {{ $prescriptions->pugh_score_id == "B" ? 'selected' : '' }}>B</option>
                                <option value='C' {{ $prescriptions->pugh_score_id == "C" ? 'selected' : '' }}>C</option>
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
                            <input type="text" class="form-control" name="liver_tumour_volume" value="{{ $prescriptions->liver_tumour_volume }}" placeholder="Enter Liver Tumour Volume" id="liver_tumour_volume" required>
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
                            <input type="text" class="form-control" name="lung_shunt" placeholder="Enter Lung Shunt" id="lung_shunt" value="{{ $prescriptions->lung_shunt }}" required>
                            @if ($errors->has('lung_shunt'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('lung_shunt') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="dose_value">Dose Delivered(GBq)<span class="text-danger">*</span></label>
                        <span id="error-dose_value" style="color:red;"></span>
                        <input type="text" class="form-control" value="{{ $prescriptions->dose_value }}" placeholder="Enter Dose Delivered" id="dose_value" name="dose_value">
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
                            <select class="form-select" name="dmode_id" id="dmode_id" required>
                                <option value="">Choose D-Mode Calculation</option>
                                <option value='0' {{ $prescriptions->dmode_id == "0" ? 'selected' : '' }}>BSA</option>
                                <option value='1' {{ $prescriptions->dmode_id == "1" ? 'selected' : '' }}>Partion Model</option>
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

                <div class="add-rx-button">
                    <a href="#" class="btn btn-warning" id="add_rx_step3_prev">PREVIOUS</a>
                    <input type="hidden" id="teamid" value={{auth()->user()->team_id}}>
                    <button type="submit" id="add_rx_step3_next" class="btn btn-warning">SAVE</button>
                </div>
            </div>