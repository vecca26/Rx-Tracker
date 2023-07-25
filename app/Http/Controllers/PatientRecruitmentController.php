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
use App\Models\PatientTypeModel;
use App\Models\brandSchedule;
use Carbon\Carbon;

class PatientRecruitmentController extends Controller
{
    public $successStatus = 200;

 public function recruitement_trend(Request $request)
 {
    $object = new GeneralFunctionsController();
    $daterange = $object->dateRange('default');
    $user_type = $request->user_type;
    $user_id = $request->user_id;
    $brand_id =$request->brand_id;
    $start_date = $request->start_date;
    $end_date = $request->end_date;
    $ff_id = $request->ff_id;
   
   if($start_date=='')
   {
     $object = new GeneralFunctionsController();
     $daterange = $object->dateRange('default');
     $start_date = $daterange['start_date'];
     $end_date = $daterange['end_date'];
   }
   if($user_type=='zsm')
   {
    $usertype ='zsm_id';
   }
   if($user_type=='bdm')
   {
    $usertype ='bdm_id';
   }
    //patient recruitment graph starts
    if($request->type==1)
    {
       
           if($user_type =='ho')
           { 

                $users =RxEntryModel::select('rx_entry.id', 'rx_entry.created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]); 
                if($ff_id!='')
                {
                  $users = $users->where('ff_id','=',$ff_id);
                }
                $users = $users->get()->groupBy(function($date) {
                 return Carbon::create($date->created_at)->format('M/Y');
                });
           }
           else
           {

              $users = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id');
              $users = $users->select('rx_entry.id', 'rx_entry.created_at')->where($usertype,'=',$user_id)->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
              if($ff_id!='')
                {
                  $users = $users->where('ff_id','=',$ff_id);
                }
                $users = $users->get()->groupBy(function($date) {
                return Carbon::create($date->created_at)->format('M/Y');
                });
           }
       $usermcount = array();
       foreach ($users as $key => $value) {
        $usermcount[$key] = count($value);
        }
       $returnData = json_encode($usermcount);     
       return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
  //patient graph ends
  //patient dropout graph starts
    if($request->type==2)
    {
      if($user_type =='ho')
           { 

                $users =RxEntryModel::join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->select('rx_id','start_date')->where('rx_entry.brand_id','=',$brand_id)->where('cycle_repeated','=','no')->whereBetween('start_date', [$start_date,$end_date]);
                if($ff_id!='')
                {
                  $users = $users->where('rx_entry.ff_id','=',$ff_id);
                }
                $users = $users->get()->groupBy(function($date) {
                 return Carbon::create($date->start_date)->format('M/Y');
                });
           }
           else
           {

              $users =RxEntryModel::join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->select('rx_id','start_date')->where($usertype,'=',$user_id)->where('rx_entry.brand_id','=',$brand_id)->where('cycle_repeated','=','no')->whereBetween('start_date', [$start_date,$end_date]);
              if($ff_id!='')
                {
                  $users = $users->where('rx_entry.ff_id','=',$ff_id);
                }
                $users = $users->get()->groupBy(function($date) {
                return Carbon::create($date->start_date)->format('M/Y');
                });
           }
          $usermcount = array();
           $userArr = [];

           foreach ($users as $key => $value) {
              $usermcount[$key] = count($value);
           }
           $returnData = json_encode($usermcount);    
           return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
    //patient dropout code ends
    //patient dropout reason graph starts
    if($request->type==3)
    {
      if($user_type =='ho')
           { 
            $returnData =   RxEntryModel::join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')
                 ->select('reason', DB::raw('(count(*)/7)*100 as total'))->where('cycle_repeated','=','no')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('start_date', [$start_date,$end_date])
                 ->groupBy('reason');
      
                if($ff_id!='')
                {
                  $returnData = $returnData->where('prescription_cycle.ff_id','=',$ff_id);
                }
                
           }
           else
           {
           $returnData =   RxEntryModel::join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->select('reason', DB::raw('(count(*)/7)*100 as total'))->where($usertype,'=',$user_id)->where('cycle_repeated','=','no')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('start_date', [$start_date,$end_date])
                 ->groupBy('reason');
               if($ff_id!='')
                {
                  $returnData = $returnData->where('prescription_cycle.ff_id','=',$ff_id);
                }
               
              
           }
           $returnData = $returnData->get();
           $new = json_decode($returnData,true);
           return response()->json(['success' => 1, 'message' => 'success', 'data' => json_encode($new)], $this->successStatus);
           
    }
   //Patient dropout reason graph ends
  //patient ongoing dropout graph starts
     if($request->type==4)
    {
      if($user_type =='ho')
           { 
            $usersOngoing = RxEntryModel::select('id', 'created_at')->where('brand_id','=',$brand_id)->whereBetween('created_at', [$start_date,$end_date]);
            $usersDropout = RxEntryModel::join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->select('rx_id','start_date')->where('rx_entry.brand_id','=',$brand_id)->where('cycle_repeated','=','no')->whereBetween('start_date', [$start_date,$end_date]);
                if($ff_id!='')
                {
                  $usersOngoing = $usersOngoing->where('rx_entry.ff_id','=',$ff_id);
                  $usersDropout = $usersDropout->where('prescription_cycle.ff_id','=',$ff_id);
                }
                
           }
           else
           {
            $usersOngoing = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id)->select('rx_entry.id', 'rx_entry.created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
            $usersDropout = RxEntryModel::join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id)->select('rx_id','start_date')->where('rx_entry.brand_id','=',$brand_id)->where('cycle_repeated','=','no')->whereBetween('start_date', [$start_date,$end_date]);
                if($ff_id!='')
                {
                  $usersOngoing = $usersOngoing->where('rx_entry.ff_id','=',$ff_id);
                  $usersDropout = $usersDropout->where('prescription_cycle.ff_id','=',$ff_id);
                }
           }
           $usersOngoing = $usersOngoing->get()->groupBy(function($date) {
              return Carbon::create($date->created_at)->format('M/Y'); 
                });
           $usersDropout = $usersDropout->get()->groupBy(function($date) {
               return Carbon::create($date->start_date)->format('M/Y');
                 });
           $usersOngoingcount = array();
           foreach ($usersOngoing as $key => $value) {
                         $usersOngoingcount[$key] = count($value);
                     }
            $returnData1 = json_encode($usersOngoingcount);  
            $usersDropoutcount = array();
           foreach ($usersDropout as $key => $value) {
                         $usersDropoutcount[$key] = count($value);
                     }
            $returnData2 = json_encode($usersDropoutcount);    
            $returnData = [
            'patient_ongoing'   => $returnData1,
            'patient_dropout'   => $returnData2 
        ];
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
           
    }

    //patient ongoing dropout graph ends
    //prescriber line graph starts
    if($request->type==5)
    {
      
      if($user_type =='ho')
           { 
          $patient_type_rxcount = RxEntryModel::join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','rx_entry.created_at as created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
  
                if($ff_id!='')
                {
                  $patient_type_rxcount = $patient_type_rxcount->where('rx_entry.ff_id','=',$ff_id);
                }
           }
           else
           {
             $patient_type_rxcount = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','rx_entry.created_at as created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
             if($ff_id!='')
                {
                  $patient_type_rxcount = $patient_type_rxcount->where('rx_entry.ff_id','=',$ff_id);
                }

           }
           $patient_type_rxcount =$patient_type_rxcount->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
          
      $returnData3 = [];
      $patientdynamicTypes = RxEntryModel::join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','doctor_name')->distinct('doctor_id')->where('rx_entry.brand_id','=',$brand_id)->get();
      foreach ($patient_type_rxcount as $key => $value) {
            foreach ($patientdynamicTypes as $key2 => $value2) {
  
                 if($value->where('doctor_id',$value2['doctor_id'])->count()!=0)
                    {
                  $returnData3[$key][$value2['doctor_name']] = $value->where('doctor_id',$value2['doctor_id'])->count();
                   }
            }
      }
      $returnData3 = json_encode($returnData3);
      return($returnData3);exit;
    }
  //prescriber line graph ends

  //prescriber count graph starts
     if($request->type==6)
    {
      
      if($user_type =='ho')
           { 
           $users =RxEntryModel::select('rx_entry.id', 'rx_entry.created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
                if($ff_id!='')
                {
                  $users = $users->where('rx_entry.ff_id','=',$ff_id);
                }
                
           }
           else
           {
             $users = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id)->select('rx_entry.id', 'rx_entry.created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
             if($ff_id!='')
                {
                  $users = $users->where('rx_entry.ff_id','=',$ff_id);
                }

           }
           $users = $users->get()->groupBy(function($date) {
                 return Carbon::create($date->created_at)->format('M/Y');
                });
          $prescribercount = array();
          foreach ($users as $key => $value) {
           $prescribercount[$key] = count($value);
           }
          $returnData = json_encode($prescribercount);  //echo "<pre>";print_r($returnData);exit;   
          return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    
    }
    //prescriber count graph ends
    //indication line graph starts
    if($request->type==7)
    {
      $indicationTypes = IndicationsModel::where('brand_id','=',$brand_id)->get();
      $returnData3 = [];
     foreach ($indicationTypes as $key => $value) {
      
     $data= DB::table('prescriptions')->join('indications', 'prescriptions.indication_id','=', 'indications.id');
     if($user_type !='ho')
     {
      $data = $data->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
     }
     $data = $data->select('indication_id','prescriptions.start_date')->where('prescriptions.indication_id','=',$value['id'])->whereBetween('prescriptions.start_date', [$start_date,$end_date]);
     if($ff_id!='')
                {
                  $data = $data->where('prescriptions.ff_id','=',$ff_id);
                }
     $data = $data->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->start_date)->format('M/Y'); // grouping by months
    });
     $returnData3[$key][$value['name']] = $data;
  } 
      $usermcount =[];
  foreach ($returnData3 as $key => $value) {
  foreach ($value as $key1 => $value1){
    $i=0;
    foreach ($value1 as $key2 => $value2){
    $usermcount[$key1][$key2] = count($value2);

  }

  }}
  return(json_encode($usermcount));
  return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData3], $this->successStatus);
  }
  //indication line graph ends
  //indication bar graph starts
if($request->type==8)
    {
 $object = new GeneralFunctionsController();
 $returnData3 = [];
 $indicationTypes = IndicationsModel::where('brand_id','=',$brand_id)->get();
 foreach ($indicationTypes as $key => $value) {
  $indications = PrescriptionsModel::join('indications', 'prescriptions.indication_id','=', 'indications.id');
  if($user_type !='ho')
     {
      $indications = $indications->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
     }
     $indications =$indications->select('indication_id','prescriptions.start_date','indications.name',DB::raw('sum(dose_value) as dose_sum'))->where('prescriptions.indication_id','=',$value['id'])->whereBetween('prescriptions.start_date', [$start_date,$end_date]);

       if($ff_id!='')
                {
                  $indications = $indications->where('prescriptions.ff_id','=',$ff_id);
                }
     $indications = $indications->get();
     $returnData3[$key][$value['name']] = $indications;
   
  }
  $usermcount =[];
  foreach ($returnData3 as $key => $value) { 
  foreach ($value as $key1 => $value1){ 
  
    $i=0;
    foreach ($value1 as $key2 => $value2){
    if(empty($value2->dose_sum))
    {
      $value2->dose_sum =0;
    }
    $usermcount[$key1] = $value2->dose_sum;
    
  }

  }} 
$returnData3 = json_encode($usermcount);
return($returnData3);
}
//indication bar graph ends
//rx split btw institution type
if($request->type==9)
    {
    $data_government = RxEntryModel::join('institute', 'rx_entry.institute_id','=', 'institute.id');
     if($user_type !='ho')
     {
      $data_government = $data_government->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
     }
     if($ff_id!='')
                {
                  $data_government = $data_government->where('rx_entry.ff_id','=',$ff_id);
                }
     $data_government = $data_government->whereBetween('rx_entry.created_at', [$start_date,$end_date])->select('rx_entry.created_at','institute_id')->where('rx_entry.brand_id','=',$brand_id)->where('institute_type','=','government')->get()->groupBy(function($date) {
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
      
      $data_corperate = RxEntryModel::join('institute', 'rx_entry.institute_id','=', 'institute.id');
     if($user_type !='ho')
     {
      $data_corperate = $data_corperate->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
     }
     if($ff_id!='')
                {
                  $data_corperate = $data_corperate->where('rx_entry.ff_id','=',$ff_id);
                }
     $data_corperate = $data_corperate->whereBetween('rx_entry.created_at', [$start_date,$end_date])->select('rx_entry.created_at','institute_id')->where('rx_entry.brand_id','=',$brand_id)->where('institute_type','=','corperate')->get()->groupBy(function($date) {
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
     
     $data_trade = RxEntryModel::join('institute', 'rx_entry.institute_id','=', 'institute.id');
     if($user_type !='ho')
     {
      $data_trade = $data_trade->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
     }
     if($ff_id!='')
                {
                  $data_trade = $data_trade->where('rx_entry.ff_id','=',$ff_id);
                }
     $data_trade = $data_trade->whereBetween('rx_entry.created_at', [$start_date,$end_date])->select('rx_entry.created_at','institute_id')->where('rx_entry.brand_id','=',$brand_id)->where('institute_type','=','trade')->get()->groupBy(function($date) {
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
      $government_count = [];
      $corperate_count = [];
      $trade_count = [];
      foreach ($data_government as $key => $value) { 
            $government_count[$key] = count($value);
           }
      
      foreach ($data_corperate as $key => $value) { 
            $corperate_count[$key] = count($value);

           }
      
      foreach ($data_trade as $key => $value) { 
             $trade_count[$key] = count($value);

            }
      $returnData = [
            'data_government'  => json_encode($government_count),
            'data_corperate'   => json_encode($corperate_count),
            'data_trade'       => json_encode($trade_count)
         ];
          return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
//rx split institution graph ends
//rx split btw patient type starts
if($request->type==10)
    {
    
 $object = new GeneralFunctionsController();
 $returnData3 = [];
 $patientdynamicTypes = PatientTypeModel::get();


 foreach ($patientdynamicTypes as $key => $value) {
       $datarx = RxEntryModel::join('patient_types', 'rx_entry.patient_type_id','=', 'patient_types.id');
      if($user_type !='ho')
      {
      $datarx = $datarx->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
      }
     if($ff_id!='')
                {
                  $datarx = $datarx->where('rx_entry.ff_id','=',$ff_id);
                }

       $datarx = $datarx->select('patient_type_id','rx_entry.created_at')->where('rx_entry.brand_id','=',$brand_id)->where('rx_entry.patient_type_id','=',$value['id'])->whereBetween('rx_entry.created_at', [$start_date,$end_date])->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
       $returnData3[$key][$value['name']] = $datarx;
 }
$data =[];//echo "<pre>";print_r($returnData3);exit;
foreach ($returnData3 as $key => $value) {
  foreach ($value as $key1 => $value1){
    $i=0;
    foreach ($value1 as $key2 => $value2){
     $data[$key1][$key2] = count($value2);

   }
  }
}
  return(json_encode($data));
      }
//rx split btw patient type ends
//average cycle purchased graph starts
if($request->type==11)
{
    
$object = new GeneralFunctionsController();
$returnData3 = [];
$avg_cycle_count = RxEntryModel::join('prescription_cycle', 'rx_entry.id','=', 'prescription_cycle.rx_id');
if($user_type !='ho')
     {
      $avg_cycle_count = $avg_cycle_count->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
     }
     if($ff_id!='')
                {
                  $avg_cycle_count = $avg_cycle_count->where('rx_entry.ff_id','=',$ff_id);
                }
     
  $avg_cycle_count = $avg_cycle_count->whereBetween('rx_entry.created_at', [$start_date,$end_date])->where('rx_entry.brand_id','=',$brand_id)->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->start_date)->format('M/Y'); // grouping by months
    });

  foreach ($avg_cycle_count as $key => $value) {
      $returnData3[$key] = count($value);
   }
  return(json_encode($returnData3));
      }
//average cycle graph ends
//rx dosing graph starts
if($request->type==12)
{ 
 $object = new GeneralFunctionsController();
 $returnData3 = [];
 $doseTypes = brandSchedule::where('brand_id','=',$brand_id)->get();


  foreach ($doseTypes as $key => $value) {
  $prescriptions = PrescriptionsModel::join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id');
if($user_type !='ho')
     {
      $prescriptions = $prescriptions->where($usertype,'=',$user_id);
     }
 if($ff_id!='')
                {
                  $prescriptions = $prescriptions->where('prescriptions.ff_id','=',$ff_id);
                }

  $prescriptions = $prescriptions->where('prescriptions.brand_id','=',$brand_id)->where('prescriptions.schedule_name','=',$value['schedule'])->whereBetween('prescriptions.start_date', [$start_date,$end_date])->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->start_date)->format('M/Y'); // grouping by months
    })->count();
    
 $returnData3[$key][$value['schedule']] =$prescriptions;
   
  }
$returnData3 = json_encode($returnData3);
return($returnData3);
      }
//dose graph ends
 } 

 

}
