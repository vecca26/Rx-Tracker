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
                        <select id="brand_id" name="brand_id" class="form-select" value="{{ old('brand_id') }}" disabled>
                            <option value="">Choose Brands</option>
                            @foreach($brands as $key=> $value)
                            <option value="{{$value->brands->id}}" {{ $rx_entry->brand_id == $value->brands->id ? 'selected' : '' }}>{{$value->brands->brand_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('brand_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    @if(auth()->user()->team_id!='3')
                    <div class="form-group col-md-4">
                        <label for="doctor">Add New Doctor</label>
                        <select id="doctor" name="doctor" class="form-select" disabled>
                            <option value="">Add New Doctor</option>
                            <option value="1" {{ $rx_entry->status=="1"  ? 'selected' : ''  }}>No</option>
                            <option value="0" {{ $rx_entry->status=="0"  ? 'selected' : ''  }}>Yes</option>
                        </select>
                        @if ($errors->has('priscriber'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('priscriber') }}</strong>
                        </span>
                        @endif
                    </div>
                    @endif

                    <div class="form-group col-md-4">
                        <label for="doctor_id">Doctor Name <span class="text-danger">*</span></label>
                        <span id="error-doctor" style="color:red;"></span>
                        <select id="doctor_id" name="doctor_id" class="form-select" disabled>
                            <option value="">Choose Doctor</option>
                            @foreach($doctors as $key=> $value)
                            <option value="{{$value->doctors->id}}" {{ $rx_entry->doctor_id == $value->doctors->id ? 'selected' : '' }}>{{$value->doctors->doctor_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('doctor_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('doctor_id') }}</strong>
                        </span>
                        @endif

                        <input type="text" class="form-control" placeholder="Doctor Name" id="new_doctor_id" value="{{ old('new_doctor_id') }}" name="new_doctor_id" style="display:none">
                        @if ($errors->has('new_doctor_id'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('new_doctor_id') }}</strong>
                        </span>
                        @endif

                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="speciality">Speciality <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="speciality_name" value="{{ $rx_entry->speciality }}" name="speciality" readonly>
                        <input type="hidden" id="speciality_id" name="speciality_id" value="{{ $rx_entry->speciality_id }}">
                    </div>
                    <input type="hidden" value="{{ $rx_entry->institute }}" id="institute" name="institute_id">
                    <input type="hidden" value="{{ $rx_entry->city }}" id="city_id" name="city">
                    <div class="form-group col-md-4">
                        <label for="city">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="city_name" value="{{ $rx_entry->city }}" name="city" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="institute">Institute <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="institute_name" value="{{ $rx_entry->institute }}" name="institute" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="institute_type">Institute Type <span class="text-danger" >*</span></label>
                        <span id="error-institute_type" style="color:red;"></span>
                        <select id="institute_type" name="institute_type" class="form-select" disabled>
                            <option value="">Choose Institute Type</option>
                            <option value="corperate" {{ $rx_entry->institute_type=="corperate"  ? 'selected' : ''  }}>Corporate</option>
                            <option value="government" {{ $rx_entry->institute_type=="government"  ? 'selected' : ''  }}>Government</option>
                            <option value="trade" {{ $rx_entry->institute_type=="trade"  ? 'selected' : ''  }}>Trade</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="prescriber">Prescriber<span class="text-danger" >*</span></label>
                        <select id="prescriber" name="prescriber" class="form-select" disabled>
                            <option value="">Prescriber</option>
                            <option value="1" {{ $rx_entry->prescriber=="1"  ? 'selected' : ''  }}>Existing</option>
                            <option value="0" {{ $rx_entry->prescriber=="0"  ? 'selected' : '' }}>New</option>
                        </select>
                        @if ($errors->has('priscriber'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('priscriber') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

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