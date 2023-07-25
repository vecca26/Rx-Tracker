@extends('layouts.app')
@section('content')
<div class="container client-data-form mt-4">
  <h3>Update Rx</h3>
  <div class="card">
    <div class="card-body">
      @if( Session::has("error") )
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ Session::get("error") }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <form method="POST" enctype="multipart/form-data" action="{{ Route('rx_entries.update', $id) }}">
        @csrf
        {{ method_field('PUT') }}
        <input type="hidden" id="prescription_id" name="prescription_id" value="{{ $prescriptions->id }}">
        <div id="rx_form_1">
          @include('rx_entry.rx_entry_edit_step1')
        </div>
        <div id="rx_form_2" style="display:none;">
          @include('rx_entry.rx_entry_edit_step2')
        </div>
        <div id="rx_form_3" style="display:none;">
          @include('rx_entry.rx_entry_edit_step3')
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
  let token = "{{csrf_token()}}";

  (function($) {
    // robin 13-09-2022
    $('#doctor').on('change', function(e) {
      var doctor = $('#doctor').val();
      if (doctor == 0) {
        $('#speciality_name').prop('readonly', false);
        $('#city_name').prop('readonly', false);
        $('#institute_name').prop('readonly', false);
        $("#city_name").val("");
        $("#institute_name").val("");
        $("#speciality_name").val("");
        $('#doctor_id').hide();
        $('#new_doctor_id').show();
      } else {
        $('#speciality').prop('readonly', true);
        $('#city').prop('readonly', true);
        $('#institute').prop('readonly', true);
        $('#doctor_id').show();
        $('#new_doctor_id').hide();
      }
    });

    $('#indication_id').on('change', function(e) {
      $('#sub_indication_div').hide();
      $('#sub_indication_comment_div').hide();
      var indication_id = $('#indication_id').val();
      if (indication_id == 0) {
        $('#indications_other').show();
      } else {
        $('#indications_other').hide();
      }
      $("#dose_value").val("");
      $("#schedule").val("");
      $("#start_date").val("");
      $("#end_date").val("");
      $("#sub_indication_comment").val("");

      $.ajax({
        type: "get",
        url: "{{url('/fetch_sub_indications')}}",
        // url: '/fetch_sub_indications',
        async: true,
        data: {
          _token: token,
          indication_id: $('#indication_id').val()
        },
        success: function(response) {
          console.log(response);

          if (response.success == '1') {
            var data = response.data;
            if (data.sub_indications.length == 0) {
              $('#sub_indication_div').hide();
            } else {
              $('#sub_indication_div').show();
              var option = "<option value=''>Choose Sub Indications</option>";
              $.each(data.sub_indications, function(index, value) {
                option = option + "<option value=" + value['id'] + " myTag=" + value['id'] + ">" + value['sub_indication'] + "</option>";
              });
            }


            $("#sub_indication_id").html(option);
          } else {}
        }
      });

    });

    //Rj 23-06-2022
    $('#sub_indication_id').on('change', function(e) {
      $('#indications_other').hide();
      $('#sub_indication_comment_div').hide();
      $("#dose_value").val("");
      $("#schedule").val("");
      $("#start_date").val("");
      $("#end_date").val("");
      $("#sub_indication_comment").val("");
      $.ajax({
        type: "get",
        url: "{{url('/fetch_sub_sub_indications')}}",
        // url: '/fetch_sub_sub_indications',
        async: true,
        data: {
          _token: token,
          sub_indication_id: $('#sub_indication_id').val()
        },
        success: function(response) {
          console.log(response.success);
          if (response.success == '1') {
            var data = response.data;
            var option = "<option value=''>Choose Sub Indications</option>";

            $.each(data.sub_sub_indications, function(index, value) {
              option = option + "<option value=" + value['id'] + ">" + value['name'] + "</option>";
            });
            $("#sub_sub_indication_id").html(option);
            $('#sub_sub_indication_div').show();
          } else if (response.success == '2') {
            $('#sub_indication_comment_div').show();
          } else {
            $('#sub_sub_indication_div').hide();
          }
        }
      });
    });

    $('#schedule').on('change', function(e) {
      var schedule_name = $('option:selected', this).attr('mytag'); //alert(schedule_name);return false;
      $("#schedule_name").val(schedule_name);
      $("#start_date").val("");
      $("#end_date").val("");
    });

    $('#brand_id').on('change', function(e) {
      $("#doctor_id").val("");
      $("#city_id").val("");
      $("#institute_id").val("");
      $("#city_name").val("");
      $("#institute_name").val("");
      $("#speciality_id").val("");
      $("#speciality_name").val("");
      $("#patient_name").val("");
      $("#phone").val("");
      $("#patient_type_id").val("");
      $("#contact_type").val("");
      $("#schedule").val("");
      $("#start_date").val("");
      $("#end_date").val("");
      $("#dose_value_select").val("");
      $("#dose_value").val("");
      $("#priscriber").val("");
      $("#institute_type").val("");

      $.ajax({
        type: "get",
        url: "{{url('/fetch_indications')}}",
        // url: '/fetch_indications',
        async: true,
        data: {
          _token: token,
          brand_id: $('#brand_id').val()
        },
        success: function(response) {
          if (response.success == '1') {
            var data = response.data;
            var option = "<option value=''>Choose Indications</option>";

            $.each(data.indications, function(index, value) {
              if (value['name'] == 'others') {
                value['id'] = 0;
              }
              option = option + "<option value=" + value['id'] + " myTag=" + value['is_subindication'] + ">" + value['name'] + "</option>";
            });
            $("#indication_id").html(option);
            var dose_unit = data.dose_unit;
            $("#dose_unit").val(dose_unit);
            option1 = "<option value=''>Choose schedule</option>";
            $.each(data.schedule_list, function(index, value) {
              option1 = option1 + "<option value=" + value['number_of_days'] + ">" + value['schedule'] + "</option>";
            });
            $("#schedule").html(option1);

            // Rj 21-06-2022
            if (data.doses.length == 0) {
              $('#dose_value_div').show()
            } else {
              $('#dose_value_select_div').show()
              $('#dose_value_div').hide()
              option2 = "<option value=''>Choose Dose</option>";
              $.each(data.doses, function(index, value) {
                if (value['value'] == 'other') {
                  value['id'] = 0;
                }
                option2 = option2 + "<option value=" + value['id'] + " myTag=" + value['value'] + ">" + value['value'] + "</option>";
              });
              $("#dose_value_select").html(option2);
            }
          }
        }
      });


    });

    $('#doctor_id').on('change', function(e) {
      $.ajax({
        type: "get",
        url: "{{url('/fetch_doctor_details')}}",
        // url: '/fetch_doctor_details',
        async: true,
        data: {
          _token: token,
          doctor_id: $('#doctor_id').val(),
        },
        success: function(response) { //console.log(response);return false;
          console.log(response)
          if (response.success == '1') {
            var data = response.data[0];
            $("#speciality_id").val(data.speciality);
            $("#speciality").val(data.speciality);
            $("#speciality_name").val(data.speciality);
            $("#city_name").val(data.city);
            $("#city_id").val(data.city);
            $("#institute_name").val(data.institute);
            $("#institute_id").val(data.institute);
            $("#institute_type").val(data.institute_type);
          } else {
            $("#city_id").val("");
            $("#institute_id").val("");
            $("#institute_type").val("");
            $("#city_name").val("");
            $("#institute_name").val("");

          }
          $("#priscriber").val("");
        }

      });
    });

    $('#add_rx_step1_next').on('click', function(e) {
      var brand_ids = $("#brand_id").val();
      var prescriber = $("#priscriber").val();
      if (prescriber == 0) {
        var doctor_ids = $("#new_doctor_id").val();
      } else {
        var doctor_ids = $("#doctor_id").val();
      }


      var institute_type = $("#institute_type").val();

      $('#error-brand').text('');
      $('#error-doctor').text('');
      $('#error-institute_type').text('');

      var flag = true;
      if (brand_ids == '') {
        $('#error-brand').text('brand required');
        $("#brand_id").focus();
        flag = false;
      }
      if (doctor_ids == "") {
        $('#error-doctor').text('doctor name required');
        $("#doctor_id").focus();
        flag = false;
      }
      if (speciality_id == "") {
        $('#error-speciality').text('speciality required');
        $("#speciality_id").focus();
        flag = false;
      }
      if (institute_type == "") {
        $('#error-institute_type').text('institute type required');
        $("#institute_type").focus();
        flag = false;
      }
      if (flag == false) {
        return false;
      }
      $('#rx_form_1').hide();
      $('#rx_form_2').show();
    });

    $('#add_rx_step2_next').on('click', function(e) {
      var patient_names = $("#patient_name").val();
      var phones = $("#phone").val();
      var patient_type_ids = $("#patient_type_id").val();
      var contact_types = $("#contact_type").val();
      var flag = true;
      $('#error-patient_name').text('');
      $('#error-phone').text('');
      $('#error-patient_type_id').text('');
      $('#error-contact_type').text('');

      if (patient_names == '') {
        $('#error-patient_name').text('patient initials required');
        $("#patient_name").focus();
        flag = false;

      }
      if (phones == "") {
        $('#error-phone').text('phone number required');
        $("#phone").focus();
        flag = false;
      }
      if (patient_type_ids == '') {
        $('#error-patient_type_id').text('choose patient type');
        $("#patient_type_id").focus();
        flag = false;
      }
      if (contact_types == "") {
        $('#error-contact_type').text('choose contact type');
        $("#contact_type").focus();
        flag = false;
      }
      if (flag == false) {
        return false;
      }
      $('#rx_form_2').hide();
      $('#rx_form_3').show();
    });

    $('#add_rx_step3_next').on('click', function(e) {
      var indication_ids = $("#indication_id").val();
      var dose_values = $("#dose_value").val();
      var schedules = $("#schedule").val();
      var start_dates = $("#start_date").val();
      var teamid = $("#teamid").val();
      var flag = true;

      $('#error-indication_id').text('');
      $('#error-dose_value').text('');
      $('#error-schedule').text('');
      $('#error-start_date').text('');
      $('#error-ir_name').text('');
      $('#error-nm_name').text('');
      $('#error-pvt_involvement').text('');
      $('#error-bclc_stage_id').text('');
      $('#error-pugh_score_id').text('');
      $('#error-liver_tumour_volume').text('');
      $('#error-indication_id').text('');
      $('#error-lung_shunt').text('');
      $('#error-dmode_id').text('');

      if ((teamid == 1) || (teamid == 2)) {
        if (indication_ids == '') {
          $('#error-indication_id').text('choose indication');
          $("#indication_id").focus();
          flag = false;
        }
        // if (dose_values == "") {
        //   $('#error-dose_value').text('dose value required');
        //   $("#dose_value").focus();
        //   flag = false;
        // }
        if (schedules == '') {
          $('#error-schedule').text('choose schedule');
          $("#schedule").focus();
          flag = false;
        }
        if (start_dates == "") {
          $('#error-start_date').text('start date required');
          $("#start_date").focus();
          flag = false;
        }
      }
      if (teamid == 3) {
        var ir_name = $("#ir_name").val();
        var nm_name = $("#nm_name").val();
        var pvt_involvement = $("#pvt_involvement").val();
        var bclc_stage_id = $("#bclc_stage_id").val();
        var pugh_score_id = $("#pugh_score_id").val();
        var liver_tumour_volume = $("#liver_tumour_volume").val();
        var lung_shunt = $("#lung_shunt").val();
        var dmode_id = $("#dmode_id").val();
        var dose_values = $("#dose_value").val();
        var indication_id = $("#indication_id").val();
        if (ir_name == '') {
          $('#error-ir_name').text('ir name required');
          $("#ir_name").focus();
          flag = false;
        }
        if (nm_name == "") {
          $('#error-nm_name').text('nm name required');
          $("#nm_name").focus();
          flag = false;
        }
        if (pvt_involvement == '') {
          $('#error-pvt_involvement').text('pvt involvment required');
          $("#pvt_involvement").focus();
          flag = false;
        }
        if (bclc_stage_id == "") {
          $('#error-bclc_stage_id').text('bclc_stage_id required');
          $("#bclc_stage_id").focus();
          flag = false;
        }
        if (dose_values == "") {
          $('#error-dose_value').text('dose value required');
          $("#dose_value").focus();
          flag = false;
        }
        if (pugh_score_id == '') {
          $('#error-pugh_score_id').text('pugh score id required');
          $("#pugh_score_id").focus();
          flag = false;
        }
        if (liver_tumour_volume == "") {
          $('#error-liver_tumour_volume').text('liver tumour volume required');
          $("#liver_tumour_volume").focus();
          flag = false;
        }
        if (indication_id == "") {
          $('#error-indication_id').text('tumour type required');
          $("#indication_id").focus();
          flag = false;
        }
        if (lung_shunt == '') {
          $('#error-lung_shunt').text('lung shunt required');
          $("#lung_shunt").focus();
          flag = false;
        }
        if (dmode_id == "") {
          $('#error-dmode_id').text('dmode id required');
          $("#dmode_id").focus();
          flag = false;
        }
      }
      if (flag == false) {
        return false;
      }


    });

    $('#add_rx_step2_prev').on('click', function(e) {
      $('#rx_form_2').hide();
      $('#rx_form_1').show();
    });

    $('#add_rx_step3_prev').on('click', function(e) {
      $('#rx_form_3').hide();
      $('#rx_form_2').show();
    });

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

    $('#dose_value_select').on('change', function(e) {
      var dose_value_select = $('#dose_value_select').val();
      console.log(dose_value_select);
      if (dose_value_select == 0) {
        $('#dose_value_div').show()
      }
    });
    // 24-06-2022
    $('#dose_value').on('change', function(e) {
      $("#schedule").val("");
      $("#start_date").val("");
      $("#end_date").val("");
    });

  })(jQuery);
</script>
@endsection