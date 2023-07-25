<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/additional-methods.js"></script>
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


        @if(auth()->user()->team_id!='3')
        <div class="form-group col-md-4">
            <label for="doctor">Add New Doctor<span class="text-danger">*</span></label>
            <span id="error-doctors" style="color:red;"></span>
            <select id="doctor" name="doctor" class="form-select">
                <option value="">Add New Doctor</option>
                <option value="1" {{ old('doctor') == "1" ? 'selected' : '' }}>No</option>
                <option value="0" {{ old('doctor') == "0" ? 'selected' : '' }}>Yes</option>
            </select>
            @if ($errors->has('doctor'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('doctor') }}</strong>
            </span>
            @endif
        </div>
        @endif

        <div class="form-group col-md-4">
            <label for="doctor_id">Doctor Name <span class="text-danger">*</span></label>
            <span id="error-doctor" style="color:red;"></span>
            <select id="doctor_id" name="doctor_id" class="form-select">
                <option value="">Choose Doctor</option>
                @foreach($doctors as $key=> $value)
                <option value="{{$value->doctor_id}}" {{ old('doctor_id') == $value->doctor_id ? 'selected' : '' }}>{{$value->doctor_name}}</option>
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
            <input type="hidden" id="speciality_id" name="speciality_id" value="{{ old('speciality_id') }}">
            <input type="text" class="form-control" placeholder="Speciality" id="speciality_name" value="{{ old('speciality') }}" name="speciality_name" readonly>
            @if ($errors->has('speciality_name'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('speciality_name') }}</strong>
            </span>
            @endif
        </div>

        <input type="hidden" id="city_id" name="city_id" value="{{ old('city_id') }}">
        <input type="hidden" id="institute_id" name="institute_id" value="{{ old('institute_id') }}">
        <div class="form-group col-md-4">
            <label for="city">City <span class="text-danger">*</span></label>
            <input type="text" placeholder="City" class="form-control" id="city_name" value="{{ old('city_name') }}" name="city_name" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="institute">Institute <span class="text-danger">*</span></label>
            <input type="text" placeholder="Institute" class="form-control" id="institute_name" value="{{ old('institute') }}" name="institute_name" readonly>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="institute_type">Institute Type <span class="text-danger">*</span></label>
            <span id="error-institute_type" style="color:red;"></span>
            <select id="institute_type" name="institute_type" class="form-select">
                <option value="">Choose Institute Type</option>
                <option value="corperate">Corporate</option>
                <option value="government">Government</option>
                <option value="trade">Trade</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="priscriber">Prescriber<span class="text-danger">*</span></label>
            <span id="error-priscriber" style="color:red;"></span>
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