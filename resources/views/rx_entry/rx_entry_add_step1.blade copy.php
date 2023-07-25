 <div>
                <div class="steps">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="active-class">
                                <h5>Step 1</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="step-s">
                                <h5>Step 2</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="step-s">
                                <h5>Step 3</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="brand_id">Brand Name <span class="text-danger">*</span></label>
                        <span id="error-brand" style="color:red;"></span>
                        <select id="brand_id" name="brand_id" class="form-select" value="{{ old('brand_id') }}">
                            <option value="">Choose Brands</option>
                            @foreach($brands as $key=> $value)
                            <option value="{{$value->brands->id}}" {{ old('brand_id') == $value->brands->id ? 'selected' : '' }}>{{$value->brands->brand_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('brand_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    @dd($doctors)
                    <!-- @foreach($doctors as $key=> $value)
                            @dd($value->doctor_name)
                            @endforeach -->
                    <div class="form-group col-md-4">
                        <label for="doctor_id">Doctor Name <span class="text-danger">*</span></label>
                        <span id="error-doctor" style="color:red;"></span>
                        <select id="doctor_id" name="doctor_id" class="form-select">
                            <option value="">Choose Doctor</option>
                            @foreach($doctors as $key=> $value)
                            <option value="{{$value->id}}" {{ old('doctor_id') == $value->id ? 'selected' : '' }}>{{$value->doctor_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('doctor_id') }}</strong>
                        </span>
                        @endif

                        <!-- <select id="doctor_id" name="doctor_id" class="form-select">
                            <option value="">Choose Doctor</option>
                            @foreach($doctors as $key=> $value)
                            @dd($value)
                            <option value="{{$value->doctors->id}}" {{ old('doctor_id') == $value->doctors->id ? 'selected' : '' }}>{{$value->doctors->doctor_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('doctor_id') }}</strong>
                        </span>
                        @endif -->



                    </div>
                    <div class="form-group col-md-4">
                        <label for="speciality">Speciality <span class="text-danger">*</span></label>
                        <input type="hidden" id="speciality_id" name="speciality_id" value="{{ old('speciality_id') }}">
                        <input type="text" class="form-control" id="speciality_name" value="{{ old('speciality_name') }}" name="speciality_name" readonly>
                        <!-- <select id="speciality_name" name="speciality_name" class="form-select">
                            <option selected>Choose Speciality</option>
                            @foreach($speciality as $key=> $value)
                            <option value="{{$value->id}}" {{ old('speciality_id') == $value->id ? 'selected' : '' }}>{{$value->speciality}}</option>
                            @endforeach
                        </select> -->
                        @if ($errors->has('speciality_name'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('speciality_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">

                    
                    <input type="hidden" id="city_id" name="city_id" value="{{ old('city_id') }}">
                    <input type="hidden" id="institute_id" name="institute_id" value="{{ old('institute_id') }}">
                    <div class="form-group col-md-4">
                        <label for="city">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="city_name" value="{{ old('city_name') }}" name="city_name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="institute">Institute <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="institute_name" value="{{ old('institute_name') }}" name="institute_name" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="institute_type">Institute Type <span class="text-danger">*</span></label>
                        <span id="error-institute_type" style="color:red;"></span>

                        <!-- <input type="text" class="form-control" id="institute_type" value="{{ old('institute_type') }}" name="institute_type" readonly> -->
                           <select id="institute_type" name="institute_type" class="form-select">
                            <option value="">Choose Institute Type</option>
                            <option value="corperate">Corporate</option>
                            <option value="government">Government</option>
                            <option value="trade">Trade</option>
                            </select>
                    </div>
                </div>

                @if(auth()->user()->team_id!='3')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="priscriber">Prescriber <span class="text-danger">*</span></label>
                        <select id="priscriber" name="priscriber" class="form-select">
                        <option value="">Choose Prescriber</option>
                            <option value="1" {{ old('priscriber') == "1" ? 'selected' : '' }}>Existing</option>
                            <option value="0" {{ old('priscriber') == "0" ? 'selected' : '' }}>New</option>
                        </select>
                        @if ($errors->has('priscriber'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('priscriber') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                @endif

                <div class="form-row">
                    <div class="form-group col-md-6">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="add-rx-button">
                            <a href="#" id="add_rx_step1_next" class="btn btn-warning">NEXT</a>
                        </div>

                    </div>

                </div>

            </div>
