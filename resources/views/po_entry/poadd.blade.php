@extends('layouts.poapp')
@section('content')
<div class="container client-dashboard mt-4">
    <div class="ff-dashboard-date align-items-center">
        <h3>Add PO</h3>
    </div>
    <br><br>
    <form method="POST" enctype="multipart/form-data" action="{{ Route('po_enteries.store') }}">
        @csrf
        <div class="row mb-5">
            <div class="form-group col-md-3">
                <label for="ins_id">Institute Name <span class="text-danger">*</span></label>
                <span id="error-brand" style="color:red;"></span>
                <select id="ins_id" name="ins_id" onchange="getval(this);" class="form-select">
                    <option value="">Choose Institute</option>
                    @foreach($institutes as $key=> $value)
                    <option value="{{$value->id}}" {{ old('id') == $value->id ? 'selected' : '' }}>{{$value->institute_name}}</option>
                    @endforeach
                </select>

                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <label for="city">City</label>
                <input type="text" placeholder="City" class="form-control" id="city_name" value="{{ old('city_name') }}" name="city_name" readonly>
                <span class="help-block">

            </div>
            <div class="form-group col-md-3">
                <label for="institute_type">Institute Type</label>
                <span id="error-institute_type" style="color:red;"></span>
                <input type="text" class="form-control" id="institute_type" value="{{ old('institute_type') }}" name="institute_type" readonly>
                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>
            </div>

            <div class="form-group col-md-3">
                <label for="brand_id">PO Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="date" name="daterange" id="daterange" class="form-control" placeholder="Choose Date" />
                </div>
            </div>
        </div>
        <div class="row skuDetails" id="skuDetails">
            <div class="form-group col-md-3">
                <label for="brand_id">Add SKU<span class="text-danger">*</span></label>
                <span id="error-brand" style="color:red;"></span>
                <select id="brand_id" name="brand_id" onchange="getvals(this);" class="form-select">
                    <option value="">Choose Product</option>
                    @foreach($sku_details as $key=> $value)
                    <option value="{{$value->id}}" {{ old('id') == $value->id ? 'selected' : '' }}>{{$value->brand_name}}</option>
                    @endforeach
                </select>

                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <label for="brand_id">Quantity<span class="text-danger">*</span></label>
                <span id="error-brand" style="color:red;"></span>
                <input type="number" placeholder="Enter No of Quantity" class="form-control" id="quantity" value="" name="quantity" oninput="multiply()">
                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <label for="points">SKU rate<span class="text-danger">*</span></label>
                <span id="error-brand" style="color:red;"></span>
                <div class="input-group">
                    <input type="number" class="form-control" id="points" value="{{ old('points') }}"" name=" points" oninput="multiply()">
                </div>
                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <label for="brand_id">Order value</label>
                <span id="error-brand" style="color:red;"></span>
                <div class="input-group">
                    <input type="text" class="form-control" id="orderval" value="{{ old('orderval') }}" name="orderval" readonly>
                    <input type="hidden" class="form-control" id="actualorderval" value="{{ old('actualorderval') }}" name="actualorderval" readonly>
                </div>
                </select>

                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
        </div>
        <div class="row skuDetail" id="skuDetail" hidden>
            <div class="form-group col-md-3">
                <span id="error-brand" style="color:red;"></span>
                <select id="brand_id" name="brand_id" onchange="getvals(this);" class="form-select">
                    @foreach($sku_details as $key=> $value)
                    <option value="{{$value->id}}" {{ old('id') == $value->id ? 'selected' : '' }}>{{$value->brand_name}}</option>
                    @endforeach
                </select>

                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <span id="error-brand" style="color:red;"></span>
                <input type="number" placeholder="Enter No of Quantity" class="form-control" id="quantity" value="" name="quantity" oninput="multiply()">
                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <span id="error-brand" style="color:red;"></span>
                <div class="input-group">
                    <input type="number" class="form-control" id="points" value="{{ old('points') }}"" name=" points" oninput="multiply()">
                </div>
                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
            <div class="form-group col-md-3">
                <span id="error-brand" style="color:red;"></span>
                <div class="input-group">
                    <input type="text" class="form-control" id="orderval" value="{{ old('orderval') }}" name="orderval" readonly>
                    <input type="text" class="form-control" id="actualorderval" value="{{ old('actualorderval') }}" name="actualorderval" readonly>
                </div>

                </select>

                <span class="help-block">
                    <strong class="text-danger"></strong>
                </span>

            </div>
        </div>
        <div id="addsku"></div>
        <div class="form-group col-md-12">
            <div class="text-right mt-5">
                <input type="button" class="btn btn-sm btn-md btn-info" style="width:20%" value="Add" onclick="addSKU()">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="brand_id">Total Po Value</label>
            <span id="error-brand" style="color:red;"></span>
            <div class="input-group">
                <input type="text" class="form-control" id="poorderVal" value="{{ old('poorderVal') }}" name="poorderVal" readonly>
                <input type="hidden" class="form-control" id="poactualorderval" value="{{ old('poactualorderval') }}" name="poactualorderval" readonly>
            </div>

            </select>

            <span class="help-block">
                <strong class="text-danger"></strong>
            </span>

        </div>
        <div class="form-group col-md-12">
            <div class="text-right  pl-5 pb-5">
                <button type="submit" class="btn btn-xl btn-success">Save</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/additional-methods.js"></script>
<script type="text/javascript">
    let token = "{{csrf_token()}}";
    var sku_product = [];

    function getval(sel) {
        $.ajax({
            type: "get",
            url: "{{url('/fetch_institute_details')}}",
            async: true,
            data: {
                _token: token,
                ins_id: sel.value,
            },
            success: function(response) {
                if (response.success == '1') {
                    var data = response.data[0];
                    $("#city_name").val(data.city);
                    $("#institute_type").val(data.institute_type);
                } else {
                    $("#city_name").val("");
                    $("#institute_type").val("");
                }
            }
        });
    }

    function getvals(sel) {
        $.ajax({
            type: "get",
            url: "{{url('/fetch_sku_details')}}",
            async: true,
            data: {
                _token: token,
                brand_id: sel.value,
            },
            success: function(response) {
                if (response.success == '1') {
                    var data = response.data[0];
                    $('#points').val(data.pts)
                } else {
                    $('#points').val('')
                }
            }
        });
    }


    function multiply() {
        const quantity = $('#quantity').val() || 0;
        const points = $('#points').val() || 0;
        const order_value = parseInt(quantity) * parseInt(points);
        $("#actualorderval").val(order_value);
        $("#poactualorderval").val(order_value);
        const val = (order_value / 100000).toFixed(2);
        $("#orderval").val(val);
        $("#poorderVal").val(val);
    }

    function addSKU() {
        var addproducts = {
            'sku_id': $("#brand_id").val(),
            'quantity': $('#quantity').val(),
            'price': $('#points').val(),
            'total': $('#orderval').val(),
            'total_lakhs': $('#actualorderval').val()
        };
        sku_product.push(addproducts);
        $("#skuDetail").clone().removeAttr("hidden").appendTo($("#addsku"));
        if ($('#removebutton').length === 1) {} else {
            $('#buttons').append('<button class="btn btn-md btn-danger" id="removebutton" onclick="removeSku()">Remove</button>');
        };
        $('#product_list').val(sku_product)
        console.log(sku_product);
    }



    function removeSku() {
        $("#skuDetails").remove();

        if ($('.skuDetails').length === 1) {
            $('#removebutton').remove();
            console.log($('.skuDetails').length);
        }
    }
</script>


@endsection