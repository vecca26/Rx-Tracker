<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RxEntryModel;
use App\Models\InstituteModel;
use App\Models\PatientTypeModel;
use Carbon\Carbon;

class RxEntryController extends Controller
{
    public $successStatus = 200;

    // public function index()//
    // { 
    // }
//  public function institute_type_rxcount(Request $request)
//  { echo "pp";exit;
 
//    }

public function patient_type_rxcount(Request $request)
 {

$patient_type_rxcount = RxEntryModel::join('patient_types', 'rx_entry.patient_type_id','=', 'patient_types.id')->select('patient_type_id','rx_entry.created_at')->where('rx_entry.brand_id','=',$request->brand_id)->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
$returnData3 = [];
$patientdynamicTypes = PatientTypeModel::get();
foreach ($patient_type_rxcount as $key => $value) {
  foreach ($patientdynamicTypes as $key2 => $value2) {
    # code...
  $returnData3[$key][$value2['name']] = $value->where('patient_type_id',$value2['id'])->count();
}
}
$returnData3 = json_encode($returnData3);print_r($returnData3);exit;
return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData3], $this->successStatus);
 }
}
