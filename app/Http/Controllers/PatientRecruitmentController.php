<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RxEntryModel;
use App\Models\IndicationsModel;
use App\Models\PrescriptionsModel;
use App\Models\PrescriptionCycleModel;
use App\Models\PatientTypeModel;
use App\Models\brandSchedule;
use App\Models\ProfessionalDetails;
use Carbon\Carbon;
use App\Models\TeamsBrands;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;

class PatientRecruitmentController extends Controller
{
  public $successStatus = 200;

  public function recruitement_trend(Request $request)
  {
    $object = new GeneralFunctionsController();
    $daterange = $object->dateRange('default');
    $user_type = $request->user_type;
    $user_id = $request->user_id;
    $team_type =  $request->team_type;
    $brand_id = $request->brand_id;
    $start_date = $request->start_date;
    $end_date = $request->end_date;
    $teams_id = $request->team_id;
    $ff_id = $request->ff_id;
    $zsm_id = $request->zsm_id;
    $bdm_id = $request->bdm_id;

    if ($start_date == '') {
      $object = new GeneralFunctionsController();
      $daterange = $object->dateRange('default');
      $start_date = $daterange['start_date'];
      $end_date = $daterange['end_date'];
    }
    if ($user_type == 'zsm') {
      $usertype = 'zsm_id';
    }
    if ($user_type == 'bdm') {
      $usertype = 'bdm_id';
    }

    if ($request->type == 3) {
      $returnData =   RxEntryModel::select('rx_discontinue_reason.reason', DB::raw('COUNT(rx_entry.id) as prescriber_count'))->join('prescription_cycle', 'prescription_cycle.rx_id', '=', 'rx_entry.id')->join('rx_discontinue_reason', 'rx_discontinue_reason.id', '=', 'prescription_cycle.reason_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->groupBy('rx_discontinue_reason.id');
      if ($brand_id != "") {
        $returnData = $returnData->where('rx_entry.brand_id', '=', $brand_id);
      }
      if ($teams_id != "" && $brand_id == "") {
        $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $request->team_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.brand_id', $teambrands);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      if ($ff_id != '') {
        $returnData = $returnData->where('rx_entry.ff_id', '=', $ff_id);
      }
      $returnData = $returnData->get();
      return $returnData;
    }

    if ($request->type == 4) {
      $usersOngoing = RxEntryModel::select(DB::raw('DATE_FORMAT(rx_entry.created_at, "%M-%Y") as label'), DB::RAW('count(rx_entry.id) AS y'))->whereBetween('rx_entry.created_at', [$start_date, $end_date])->groupBy(DB::RAW('month(rx_entry.created_at)'), DB::RAW('year(rx_entry.created_at)'));
      $usersDropout = RxEntryModel::select(DB::raw('DATE_FORMAT(prescription_cycle.updated_at, "%M-%Y") as label'), DB::RAW('count(rx_entry.id) AS y'))->join('prescription_cycle', 'prescription_cycle.rx_id', '=', 'rx_entry.id')->wherenotnull('prescription_cycle.reason_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->groupBy(DB::RAW('month(prescription_cycle.updated_at)'), DB::RAW('year(prescription_cycle.updated_at)'));
      $general = RxEntryModel::select(DB::raw('DATE_FORMAT(prescription_cycle.updated_at, "%M-%Y") as label'), DB::raw("0 as y"))->join('prescription_cycle', 'prescription_cycle.rx_id', '=', 'rx_entry.id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->groupBy(DB::RAW('month(prescription_cycle.updated_at)'), DB::RAW('year(prescription_cycle.updated_at)'))->orderBy('label', 'DESC');

      if ($brand_id != "") {
        $usersOngoing = $usersOngoing->where('rx_entry.brand_id', '=', $brand_id);
        $usersDropout = $usersDropout->where('rx_entry.brand_id', '=', $brand_id);
        $general = $general->where('rx_entry.brand_id', '=', $brand_id);
      }
      if ($teams_id != "" && $brand_id == "") {
        $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $request->team_id)->get()->toArray();
        $usersOngoing = $usersOngoing->whereIn('rx_entry.brand_id', $teambrands);
        $usersDropout = $usersDropout->whereIn('rx_entry.brand_id', $teambrands);
        $general = $general->whereIn('rx_entry.brand_id', $teambrands);
      }
      if ($ff_id != '') {
        $usersOngoing = $usersOngoing->where('rx_entry.ff_id', '=', $ff_id);
        $usersDropout = $usersDropout->where('rx_entry.ff_id', '=', $ff_id);
        $general = $general->where('rx_entry.ff_id', '=', $ff_id);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $usersOngoing = $usersOngoing->whereIn('rx_entry.ff_id', $zsm_ff_id);
        $usersDropout = $usersDropout->whereIn('rx_entry.ff_id', $zsm_ff_id);
        $general = $general->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $usersOngoing = $usersOngoing->whereIn('rx_entry.ff_id', $bdm_ff_id);
        $usersDropout = $usersDropout->whereIn('rx_entry.ff_id', $bdm_ff_id);
        $general = $general->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      $usersOngoing = $usersOngoing->get();
      $usersDropout = $usersDropout->get();
      $general = $general->get();
      $returnData = [
        'patient_ongoing'   => $usersOngoing,
        'patient_dropout'   => $usersDropout,
        'general' => $general
      ];
      return $returnData;
    }

    if ($request->type == 5) {
      $patient_type_rxcount = RxEntryModel::join('doctors', 'rx_entry.doctor_id', '=', 'doctors.id')->select(array('doctors.doctor_name', 'rx_entry.brand_id', DB::raw('COUNT(rx_entry.id) as prescriber_count')))->whereBetween('rx_entry.created_at', [$start_date, $end_date])->groupby('doctors.id')->limit(10)->orderby('prescriber_count', "desc");
      if ($brand_id != "") {
        $patient_type_rxcount = $patient_type_rxcount->where('rx_entry.brand_id', '=', $brand_id);
      }
      if ($teams_id != "" && $brand_id == "") {
        $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $request->team_id)->get()->toArray();
        $patient_type_rxcount = $patient_type_rxcount->whereIn('rx_entry.brand_id', $teambrands);
      }
      if ($ff_id != '') {
        $patient_type_rxcount = $patient_type_rxcount->where('rx_entry.ff_id', '=', $ff_id);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $patient_type_rxcount = $patient_type_rxcount->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $patient_type_rxcount = $patient_type_rxcount->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      $patient_type_rxcount = $patient_type_rxcount->get();
      $returnData3 = $patient_type_rxcount;
      return ($returnData3);
      exit;
    }

    if ($request->type == 6) {
      $returnData = RxEntryModel::select(DB::RAW('count(rx_entry.id) AS ids'), DB::raw('DATE_FORMAT(created_at, "%M-%Y") as created_at'))->whereBetween('rx_entry.created_at', [$start_date, $end_date])->where('rx_entry.prescriber', '=', '0')->groupBy(DB::RAW('month(created_at)'), DB::RAW('year(created_at)'));
      if ($brand_id != "") {
        $returnData = $returnData->where('rx_entry.brand_id', '=', $brand_id);
      }
      if ($teams_id != "" && $brand_id == "") {
        $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $request->team_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.brand_id', $teambrands);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      if ($ff_id != '') {
        $returnData = $returnData->where('rx_entry.ff_id', '=', $ff_id);
      }
      $users = $returnData->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $users], $this->successStatus);
    }

    if ($request->type == 8) {
      $data = RxEntryModel::select('indications.name', DB::raw('SUM(prescription_cycle.dose_value) as doses'), DB::raw('count(rx_entry.id) as  rx_count'))->join('prescriptions', 'prescriptions.rx_id', '=', 'rx_entry.id')->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->join('indications', 'indications.id', '=', 'prescriptions.indication_id')->join('prescription_cycle', 'prescription_cycle.rx_id', '=', 'rx_entry.id')->where('rx_entry.brand_id', $brand_id)->groupBY('indications.id');

      if ($ff_id != '') {
        $data = $data->where('prescriptions.ff_id', '=', $ff_id);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $data = $data->whereIn('prescriptions.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $data = $data->whereIn('prescriptions.ff_id', $bdm_ff_id);
      }
      $data = $data->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $data], $this->successStatus);
    }

    if ($request->type == 9) {
      $returnData = RxEntryModel::select('doctors.institute_type', DB::raw('COUNT(rx_entry.id) as prescriber_count'))->join('doctors', 'rx_entry.doctor_id', '=', 'doctors.id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->whereNotNull('doctors.institute_type')->groupBY('doctors.institute_type');
      if ($brand_id != "") {
        $returnData = $returnData->where('rx_entry.brand_id', '=', $brand_id);
      }
      if ($teams_id != "" && $brand_id == "") {
        $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $request->team_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.brand_id', $teambrands);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      if ($ff_id != '') {
        $returnData = $returnData->where('rx_entry.ff_id', '=', $ff_id);
      }
      $data = $returnData->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $data], $this->successStatus);
    }

    if ($request->type == 7) {
      $data = RxEntryModel::select('indications.name', DB::raw('COUNT(rx_entry.id) as prescriber_count'))->join('prescriptions', 'prescriptions.rx_id', '=', 'rx_entry.id')->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->join('indications', 'indications.id', '=', 'prescriptions.indication_id')->where('rx_entry.brand_id', $brand_id)->groupBY('indications.id');

      if ($ff_id != '') {
        $data = $data->where('prescriptions.ff_id', '=', $ff_id);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $data = $data->whereIn('prescriptions.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $data = $data->whereIn('prescriptions.ff_id', $bdm_ff_id);
      }
      $data = $data->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $data], $this->successStatus);
    }

    if ($request->type == 10) {
      $returnData = RxEntryModel::select('patient_types.name', DB::raw('COUNT(rx_entry.id) as patienttypes_count'))->join('patient_types', 'patient_types.id', '=', 'rx_entry.patient_type_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->where('patient_types.status', '1')->groupBY('patient_types.id');
      if ($brand_id != "") {
        $returnData = $returnData->where('rx_entry.brand_id', '=', $brand_id);
      }
      if ($teams_id != "" && $brand_id == "") {
        $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $request->team_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.brand_id', $teambrands);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $returnData = $returnData->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      if ($ff_id != '') {
        $returnData = $returnData->where('rx_entry.ff_id', '=', $ff_id);
      }
      $data = $returnData->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $data], $this->successStatus);
    }

    if ($request->type == 11) {
      $data = RxEntryModel::select(DB::RAW('count(prescription_cycle.id) AS ids'), DB::raw('DATE_FORMAT(prescription_cycle.start_date, "%M-%Y") as created_at'))->join('prescription_cycle', 'prescription_cycle.rx_id', '=', 'rx_entry.id')->where('prescription_cycle.cycle_repeated', 'yes')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->where('rx_entry.brand_id', $brand_id)->groupBy(DB::RAW('month(prescription_cycle.start_date)'), DB::RAW('year(prescription_cycle.start_date)'));

      if ($ff_id != '') {
        $data = $data->where('rx_entry.ff_id', '=', $ff_id);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $data = $data->whereIn('rx_entry.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $data = $data->whereIn('rx_entry.ff_id', $bdm_ff_id);
      }
      $data = $data->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $data], $this->successStatus);
    }
    if ($request->type == 12) {
      $data = RxEntryModel::select('brand_schedule.schedule', DB::raw('COUNT(rx_entry.id) as prescriber_count'))->join('prescriptions', 'prescriptions.rx_id', '=', 'rx_entry.id')->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date])->join('brand_schedule', 'brand_schedule.schedule', '=', 'prescriptions.schedule_name')->where('prescriptions.brand_id', $brand_id)->where('brand_schedule.brand_id', $brand_id)->groupBY('brand_schedule.id')->where('rx_entry.brand_id', $brand_id);
      if ($ff_id != '') {
        $data = $data->where('prescriptions.ff_id', '=', $ff_id);
      }
      if ($zsm_id != "" && $bdm_id == "") {
        $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $request->zsm_id)->get()->toArray();
        $data = $data->whereIn('prescriptions.ff_id', $zsm_ff_id);
      }
      if ($bdm_id != "" && $ff_id == '') {
        $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $request->bdm_id)->get()->toArray();
        $data = $data->whereIn('prescriptions.ff_id', $bdm_ff_id);
      }
      $data = $data->get();
      return response()->json(['success' => 1, 'message' => 'success', 'data' => $data], $this->successStatus);
    }
  }
}
