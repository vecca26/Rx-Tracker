<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RxEntryModel;
use App\Models\PrescriptionsModel;
use App\Models\IndicationsModel;
use Carbon\Carbon;

class IndicationController extends Controller
{
    public $successStatus = 200;

  public function indication_dose_prescribed(Request $request)
 {

 
//  $object = new GeneralFunctionsController();
//  $returnData3 = [];
//  $indicationTypes = IndicationsModel::where('brand_id','=','1')->get();


//   foreach ($indicationTypes as $key => $value) {
//   $indications = PrescriptionsModel::join('indications', 'prescriptions.indication_id','=', 'indications.id')->select('indication_id','prescriptions.start_date','indications.name')->where('prescriptions.indication_id','=',$value['id'])->get()->groupBy(function($date) {
//         //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
//         return Carbon::create($date->start_date)->format('M/Y'); // grouping by months
//     })->count();
 
//  $returnData3[$key][$value['name']] =$indications;
//       // $returnData3[$key][$value2['name']] = $value->where('indication_id',$value2['id'])->count();
  
//   }
//  // $usermcount = array();
//  // foreach ($indications as $key => $value) {
//  //              $usermcount[$key] = count($value);
//  //           }
// $returnData3 = json_encode($returnData3);//echo "<pre>";print_r($returnData3);exit;
// return($returnData3);
 }

 public function indication_line_graph(Request $request)
 {
  
//   $indicationTypes = IndicationsModel::where('brand_id','=','1')->get();
//   $returnData3 = [];
//   foreach ($indicationTypes as $key => $value) {
//      $returnData3[$key][$value['name']] = DB::table('prescriptions')->join('indications', 'prescriptions.indication_id','=', 'indications.id')->select('indication_id','prescriptions.start_date')->where('prescriptions.indication_id','=',$value['id'])->get()->groupBy(function($date) {
//         //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
//         return Carbon::create($date->start_date)->format('M/Y'); // grouping by months
//     });
//   }
//   $usermcount =[];
// foreach ($returnData3 as $key => $value) {
//   foreach ($value as $key1 => $value1){
//     $i=0;
//     foreach ($value1 as $key2 => $value2){
//  // echo "<pre>";print_r([$key1][0]);print_r([$key2][0]);
// $usermcount[$key1][$key2] = count($value2);

// }

// }}
// //$bb = array_count_values($usermcount);echo "<pre>";print_r($bb);exit;
// //echo "<pre>";print_r($usermcount);exit;
//   return(json_encode($usermcount));
//    return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData3], $this->successStatus);

 }

 public function avg_cycle_count(Request $request)
 {
  $avg_cycle_count = RxEntryModel::join('prescription_cycle', 'rx_entry.id','=', 'prescription_cycle.rx_id')->where('rx_entry.brand_id','=',$request->brand_id)->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->start_date)->format('M'); // grouping by months
    });
   $object = new GeneralFunctionsController();
     $usermcount = $object->monthArray('default');
   foreach ($avg_cycle_count as $key => $value) {
      $usermcount[$key] = count($value);
   }
  $returnData = json_encode($usermcount);    
  
  print_r($returnData);exit;
 }
}
