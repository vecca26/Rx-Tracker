<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RxEntryModel;
use App\Models\DoctorsModel;
use Carbon\Carbon;

class PrescriberController extends Controller
{
    public $successStatus = 200;

    // public function index()
    // { 
    // }
   public function prescriber_rx_analysis(Request $request)
 {

  $patient_type_rxcount = RxEntryModel::join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','rx_entry.created_at as created_at')->where('rx_entry.brand_id','=',$request->brand_id)->get();
  
  $patient_type_rxcount =$patient_type_rxcount->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });//echo "<pre>";print_r($patient_type_rxcount);exit;
  //dd($patient_type_rxcount);
$returnData3 = [];
$patientdynamicTypes = RxEntryModel::join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','doctor_name')->distinct('doctor_id')->where('rx_entry.brand_id','=',$request->brand_id)->get();
foreach ($patient_type_rxcount as $key => $value) {
  foreach ($patientdynamicTypes as $key2 => $value2) {
    # code...
    if($value->where('doctor_id',$value2['doctor_id'])->count()!=0)
    {
  $returnData3[$key][$value2['doctor_name']] = $value->where('doctor_id',$value2['doctor_id'])->count();
   }
}
}//echo "<pre>";print_r($returnData3);exit;
$returnData3 = json_encode($returnData3);
  return($returnData3);exit;
}
 public function prescriber_count(Request $request)
 {
$object = new GeneralFunctionsController();
     $daterange = $object->dateRange('default');
     $start_date = $daterange['start_date'];
     $end_date = $daterange['end_date'];
  $users =RxEntryModel::select('rx_entry.id', 'rx_entry.created_at')->where('rx_entry.brand_id','=',$request->brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date])->get()->groupBy(function($date) {
                 return Carbon::create($date->created_at)->format('M/Y');
                });
  $usermcount = array();
       foreach ($users as $key => $value) {
        $usermcount[$key] = count($value);
        }
       $returnData = json_encode($usermcount);  //echo "<pre>";print_r($returnData);exit;   
       return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    
}
}
