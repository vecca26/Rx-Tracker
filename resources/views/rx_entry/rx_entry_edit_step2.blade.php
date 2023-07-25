<div>
    <div class="steps">
        <div class="row">
            <div class="col-md-4">
                <div class="step-s">
                    <h5>Step 1</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="active-class">
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

    <div class="patient-details mt-5">
        <h4>Patient Details</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="patientName">Patient Initials <span class="text-danger">*</span></label>
                <span id="error-patient_name" style="color:red;"></span>
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{$rx_entry->patient_name}}">
                @if ($errors->has('patient_name'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('patient_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="contactNumber">Contact Number <span class="text-danger">*</span></label>
                <span id="error-phone" style="color:red;"></span>
                <input type="text" class="form-control" value="{{$rx_entry->phone}}" id="phone" name="phone">
                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="patient_type">Patient Type <span class="text-danger">*</span></label>
                <span id="error-patient_type_id" style="color:red;"></span>
                <select id="patient_type_id" name="patient_type_id" class="form-select">
                <option value="">Choose Patient Type</option>

                    @foreach($patient_type as $key=> $value)
                    <option value="{{$value->id}}" {{ $rx_entry->patient_type_id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('patient_type_id'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('patient_type_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="contactType">Contact Type <span class="text-danger">*</span></label>
                <span id="error-contact_type" style="color:red;"></span>
                <!-- <input type="text" class="form-control" id="contactType"> -->
                <select  name="contact_type" id="contact_type" class="form-select">
                    <option value="">-Choose Contact Type-</option>
                    <option value='caretaker' {{ $rx_entry->contact_type=="caretaker"  ? 'selected' : ''  }}>caretaker</option>
                    <option value='patient' {{ $rx_entry->contact_type=="patient"  ? 'selected' : ''  }}>patient</option>
                </select>
                @if ($errors->has('contact_type'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('contact_type') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="add-rx-button">
            <a href="#" class="btn btn-warning" id="add_rx_step2_prev">PREVIOUS</a>
            <a href="#" class="btn btn-warning" id="add_rx_step2_next">NEXT</a>
        </div>

    </div>
</div>