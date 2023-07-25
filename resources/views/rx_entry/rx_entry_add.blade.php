@extends('layouts.app')
@section('content')
<div class="container client-data-form mt-4">
  <h3>Add New Rx</h3>
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
      <form method="POST" enctype="multipart/form-data" action="{{ Route('rx_entries.store') }}">
        @csrf

        <div id="rx_form_1">
          @include('rx_entry.rx_entry_add_step1')
        </div>
        <div id="rx_form_2" style="display:none;">
          @include('rx_entry.rx_entry_add_step2')
        </div>
        <div id="rx_form_3" style="display:none;">
          @include('rx_entry.rx_entry_add_step3')
        </div>

      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/additional-methods.js"></script>

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
        $('#doctor_id').hide();
        $('#new_doctor_id').show();
      } else {
        $('#speciality').prop('readonly', true);
        $('#city_name').prop('readonly', true);
        $('#institute_name').prop('readonly', true);
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
      var is_subindication = $('option:selected', this).attr('mytag');
      if (is_subindication == 1) {
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
            $('#sub_indication_div').show();
            if (response.success == '1') {
              var data = response.data;
              var option = "<option value=''>Choose Sub Indications</option>";

              $.each(data.sub_indications, function(index, value) {
                option = option + "<option value=" + value['id'] + " myTag=" + value['id'] + ">" + value['sub_indication'] + "</option>";
              });

              $("#sub_indication_id").html(option);
            } else {}
          }
        });
      }
    });

    $('#sub_indication_id').on('change', function(e) {
      $('#indications_other').hide();
      $('#sub_indication_comment_div').hide();
      $("#dose_value").val("");
      $("#schedule").val("");
      $("#start_date").val("");
      $("#end_date").val("");
      $.ajax({
        type: "get",
        url: "{{url('/fetch_sub_indications')}}",
        // url: '/fetch_sub_sub_indications',
        async: true,
        data: {
          _token: token,
          sub_indication_id: $('#sub_indication_id').val()
        },
        success: function(response) {
          if (response.success == '1') {
            var data = response.data;
            var option = "<option value=''>Choose Sub Indications</option>";
            console.log(data.sub_sub_indications.count);
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
      var schedule_name = $('option:selected', this).attr('mytag');
      $("#schedule_name").val(schedule_name);
      $("#start_date").val("");
      $("#end_date").val("");
    });

    $('#brand_id').on('change', function(e) {
      $("#patient_name").val("");
      $("#phone").val("");
      $("#patient_type_id").val("");
      $("#contact_type").val("");
      $("#schedule").val("");
      $("#start_date").val("");
      $("#end_date").val("");
      $("#dose_value_select").val("");
      $("#dose_value").val("");
      $('#sub_indication_div').hide();
      $.ajax({
        type: "get",
        url: "{{url('/fetch_indications')}}",
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
              option1 = option1 + "<option value=" + value['number_of_days'] + " myTag=" + value['schedule'] + ">" + value['schedule'] + "</option>";

            });
            $("#schedule").html(option1);
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
          } else {}
        }

      });
    });



    $('#add_rx_step1_next').on('click', function(e) {
      var brand_ids = $("#brand_id").val();
      var doctor = $("#doctor").val();
      var priscriber = $("#priscriber").val();
      var doctor_id = $("#doctor_id").val();
      if (doctor == 0) {
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

      if (doctor == '') {
        $('#error-doctors').text('doctor status required');
        $("#doctor").focus();
        flag = false;
      }

      if (doctor_ids == "") {
        $('#error-doctor').text('doctor name required');
        $("#doctor_id").focus();
        flag = false;
      }
      if (institute_type == "") {
        $('#error-institute_type').text('institute type required');
        $("#institute_type").focus();
        flag = false;
      }
      if (priscriber == "") {
        $('#error-priscriber').text('priscriber status required');
        $("#priscriber").focus();
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

        if (dose_values == "") {
          $('#error-dose_value').text('dose value required');
          $("#dose_value").focus();
          flag = false;
        }

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
        success: function(response) {
          if (response.success == '1') {
            var data = response.data;
            $("#speciality_name").val(data[0].speciality);
            $("#city_name").val(data[0].city);
            $("#institute_name").val(data[0].institute);
          } else {
            $("#city_id").val("");
            $("#institute_id").val("");
            $("#city_name").val("");
            $("#institute_name").val("");
          }
        }

      });
    });


    $('#add_rx_step2_prev').on('click', function(e) {
      $('#rx_form_2').hide();
      $('#rx_form_1').show();
    });

    $('#add_rx_step3_prev').on('click', function(e) {
      $('#rx_form_3').hide();
      $('#rx_form_2').show();
    });

    //End Date Calculation

    $('#start_date').on('change', function(e) {
      var no_of_days = $('#schedule_no_of_days').val();
      if (no_of_days != '') {
        var schedule = no_of_days;
      } else {
        var schedule = $('#schedule').val();
      }


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
    //others text box display option
    // $('#indication_id').on('change', function(e) {
    //   var indication_id = $('#indication_id').val();
    //   if (indication_id == 0) {
    //     $('#indications_other').show()
    //   }
    // });

    // Others option in dose team B Rj 20-06-2022

    $('#dose_value_select').on('change', function(e) {
      var dose_value_select = $('#dose_value_select').val();
      console.log(dose_value_select);
      if (dose_value_select == 0) {
        $('#dose_value_div').show()
      }
    });

    // Robin 14-08-22
    $('#schedule').on('change', function(e) {
      var schedule = $('#schedule').val();
      if (schedule == 0) {
        $('#schedule_others_name_div').show();
        $('#schedule_others_days_div').show();
      } else {
        $('#schedule_others_name_div').hide();
        $('#schedule_others_days_div').hide();
      }
    });





  })(jQuery);
</script>
@endsection