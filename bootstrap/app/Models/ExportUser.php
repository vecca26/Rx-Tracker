<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Http\Controllers\GeneralFunctionsController;
use App\Models\RxEntryModel;
use App\Models\PatientTypeModel;
use App\Models\IndicationsModel;
use Carbon\Carbon;


class ExportUser implements FromQuery,WithHeadings
{
	    use Exportable;
public function __construct($start, $end,$user_type,$user_id,$brand_id,$ff_id,$type)
    {
        $this->start = $start;
        $this->end = $end;
        $this->user_type = $user_type;
        $this->user_id = $user_id;
        $this->brand_id = $brand_id;
        $this->ff_id = $ff_id;
        $this->type = $type;
    }
public function query()
    {
    	
      $start_date = $this->start;
      $end_date = $this->end;
    	if($start_date=='')
		   {
		     $object = new GeneralFunctionsController();
		     $daterange = $object->dateRange('default');
		     $start_date = $daterange['start_date'];
		     $end_date = $daterange['end_date'];
		   }
		   if($this->user_type=='zsm')
		   {
		    $usertype ='zsm_id';
		   }
		   if($this->user_type=='bdm')
		   {
		    $usertype ='bdm_id';
		   }
      
      //patient recruitment graph starts
      if($this->type==1)
      {
        $users = RxEntryModel::query()->join('users', 'rx_entry.ff_id', '=', 'users.id');
          if($this->user_type !='ho')
           { 

                $users =$users->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id');
              }
                if($this->ff_id!='')
                {
                  $users = $users->where('ff_id','=',$this->ff_id);
                }
                $users = $users->select('rx_entry.id','first_name','patient_name','rx_entry.phone','contact_type','rx_entry.created_at')->where('rx_entry.brand_id','=',$this->brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);return $users;
        }
  //patient graph ends
  //patient drop out graph
      if($this->type==2)
      {
        $users = RxEntryModel::query()->join('users', 'rx_entry.ff_id', '=', 'users.id')->join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id');
          if($this->user_type !='ho')
           { 
          $users =$users->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$user_id);
        }
        $users = $users->select('rx_entry.id','first_name','patient_name','rx_entry.phone','contact_type','prescription_cycle.start_date')->where('rx_entry.brand_id','=',$this->brand_id)->where('cycle_repeated','=','no')->whereBetween('start_date', [$start_date,$end_date]);
              if($this->ff_id!='')
                {
                  $users = $users->where('rx_entry.ff_id','=',$this->ff_id);
                }
                return $users;
        }
  //patient dropout graph ends
//prescriber excel starts
if($this->type==3)
      {
         $returnData3 = [];
         $patient_type_rxcount = RxEntryModel::query()->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','rx_entry.created_at as created_at')->where('rx_entry.brand_id','=',$this->brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
         $patient_type_rxcount =$patient_type_rxcount->get();
         $patientdynamicTypes = RxEntryModel::query()->join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','doctor_name')->distinct('doctor_id')->where('rx_entry.brand_id','=',$this->brand_id)->get();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Name', 'count'));
 
  foreach ($patient_type_rxcount as $key => $value) {
  foreach ($patientdynamicTypes as $key2 => $value2) {
    # code...
    if($value->where('doctor_id',$value2['doctor_id'])->count()!=0)
    {
    $returnData3[$key][$value2['doctor_name']] = $value->where('doctor_id',$value2['doctor_id'])->count(); 
    $result_arr = array($value2['doctor_name'],$value->where('doctor_id',$value2['doctor_id'])->count());
    fputcsv($output, $result_arr);
    }
    }
    fclose($output);
    exit;
    }
    }
//prescriber excel ends
//institution based rx excel starts
if($this->type==4)
      {
        $data_government = RxEntryModel::join('institute', 'rx_entry.institute_id','=', 'institute.id');
     if($this->user_type !='ho')
     {
      $data_government = $data_government->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$this->user_id);
     }
     if($this->ff_id!='')
                {
                  $data_government = $data_government->where('rx_entry.ff_id','=',$this->ff_id);
                }
     $data_government = $data_government->whereBetween('rx_entry.created_at', [$start_date,$end_date])->select('rx_entry.created_at','institute_id')->where('rx_entry.brand_id','=',$this->brand_id)->where('institute_type','=','government')->get()->groupBy(function($date) {
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
      
      $data_corperate = RxEntryModel::join('institute', 'rx_entry.institute_id','=', 'institute.id');
     if($this->user_type !='ho')
     {
      $data_corperate = $data_corperate->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$this->user_id);
     }
     if($this->ff_id!='')
                {
                  $data_corperate = $data_corperate->where('rx_entry.ff_id','=',$this->ff_id);
                }
     $data_corperate = $data_corperate->whereBetween('rx_entry.created_at', [$start_date,$end_date])->select('rx_entry.created_at','institute_id')->where('rx_entry.brand_id','=',$this->brand_id)->where('institute_type','=','corperate')->get()->groupBy(function($date) {
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
     
     $data_trade = RxEntryModel::join('institute', 'rx_entry.institute_id','=', 'institute.id');
     if($this->user_type !='ho')
     {
      $data_trade = $data_trade->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$this->user_id);
     }
     if($this->ff_id!='')
                {
                  $data_trade = $data_trade->where('rx_entry.ff_id','=',$this->ff_id);
                }
     $data_trade = $data_trade->whereBetween('rx_entry.created_at', [$start_date,$end_date])->select('rx_entry.created_at','institute_id')->where('rx_entry.brand_id','=',$this->brand_id)->where('institute_type','=','trade')->get()->groupBy(function($date) {
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
      $government_count = [];
      $corperate_count = [];
      $trade_count = [];
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=institution-type-excel.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('government'));
    fputcsv($output, array('month ', 'count of rx entries'));
    foreach ($data_government as $key => $value) { //echo "<pre>";print_r($key);exit;
          //  $government_count[$key] = count($value);
            $result_arr = array($key,count($value));
            fputcsv($output, $result_arr);
           }
    fputcsv($output, array('corperate'));
    fputcsv($output, array('month ', 'count of rx entries'));
      foreach ($data_corperate as $key => $value) { 
           // $corperate_count[$key] = count($value);
          $result_arr = array($key,count($value));
            fputcsv($output, $result_arr);
           }
    fputcsv($output, array('trade'));
    fputcsv($output, array('month ', 'count of rx entries'));
    foreach ($data_trade as $key => $value) { 
             $trade_count[$key] = count($value);
               $result_arr = array($key,count($value));
            fputcsv($output, $result_arr);
            }fclose($output);
    
    $returnData = [
            'data_government'  => json_encode($government_count),
            'data_corperate'   => json_encode($corperate_count),
            'data_trade'       => json_encode($trade_count)
         ];
          return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
   
          }
  //dropout reason excel
  if($this->type==5)
  {
     
           $returnData =   RxEntryModel::query()->join('prescription_cycle', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->select('reason', DB::raw('(count(*)/7)*100 as total'));
        if($this->user_type !='ho')
        {
          $returnData = $returnData->where($usertype,'=',$this->user_id);
        }

        $returnData = $returnData->where('cycle_repeated','=','no')->where('rx_entry.brand_id','=',$this->brand_id)->whereBetween('start_date', [$start_date,$end_date])
                 ->groupBy('reason');
               if($this->ff_id!='')
                {
                  $returnData = $returnData->where('prescription_cycle.ff_id','=',$ff_id);
                }
          
           $returnData = $returnData->get();
            header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=dropout-reason.csv');
    $output = fopen("php://output", "w");

    fputcsv($output, array('dropout reason ', 'percentage'));
    foreach ($returnData as $key => $value) { 
           // $government_count[$key] = count($value);
            $result_arr = array($value['reason'],$value['total']);
    fputcsv($output, $result_arr);
           }
    fclose($output);
    exit;
  }
   //excel report of prescriber in monthwise
  if($this->type==6)
  {
     
    $users = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id');
          if($this->user_type !='ho')
        {
             $users = $users->where($usertype,'=',$this->user_id);
          }
             $users = $users->select('rx_entry.id', 'rx_entry.created_at')->where('rx_entry.brand_id','=',$this->brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
             if($this->ff_id!='')
                {
                  $users = $users->where('rx_entry.ff_id','=',$this->ff_id);
                }

           $users = $users->get()->groupBy(function($date) {
                 return Carbon::create($date->created_at)->format('M/Y');
                });
          $prescribercount = array();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=prescriber-monthwise-report.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Month ', 'Prescriber count'));
          foreach ($users as $key => $value) {
           $prescribercount[$key] = count($value);
          // $result_arr = array($prescribercount[$key],count($value));
           //fputcsv($output, $result_arr);
           }//
           foreach ($prescribercount as $key => $value) {//echo "<pre>";print_r($value);exit;
            $result_arr = array($key,$value);
            fputcsv($output, $result_arr);
                }
           fclose($output);
    exit;
  }
  ///excel based on patient type

  if($this->type==7)
  {
     $patientdynamicTypes = PatientTypeModel::get();
    foreach ($patientdynamicTypes as $key => $value) {
       $datarx = RxEntryModel::join('patient_types', 'rx_entry.patient_type_id','=', 'patient_types.id');
      if($this->user_type !='ho')
      {
      $datarx = $datarx->join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$this->user_id);
      }
     if($this->ff_id!='')
                {
                  $datarx = $datarx->where('rx_entry.ff_id','=',$this->ff_id);
                }

       $datarx = $datarx->select('patient_type_id','rx_entry.created_at')->where('rx_entry.brand_id','=',$this->brand_id)->where('rx_entry.patient_type_id','=',$value['id'])->whereBetween('rx_entry.created_at', [$start_date,$end_date])->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->created_at)->format('M/Y'); // grouping by months
    });
       $returnData3[$key][$value['name']] = $datarx;
 }
$data =[];
foreach ($returnData3 as $key => $value) {
  foreach ($value as $key1 => $value1){
    $i=0;
    foreach ($value1 as $key2 => $value2){
$data[$key1][$key2] = count($value2);

}

}}
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=prescriber-monthwise-report.csv');
    $output = fopen("php://output", "w");
   foreach ($data as $key => $value) {
   fputcsv($output, array($key)); 
   fputcsv($output, array('patient type ', 'Rx count'));

   foreach ($value as $key1 => $value1) { //echo "<pre>";print_r($value1);exit;
   fputcsv($output, array($key1, $value1));
   }
   }fclose($output);
    exit;
  }
  //excel based on dose schedule
   if($this->type==8)
  {
   
 $returnData3 = [];
 $doseTypes = brandSchedule::where('brand_id','=',$this->brand_id)->get();
 header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=dosing-schedule-report.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('schedule type ', 'Rx count'));
   foreach ($doseTypes as $key => $value) {
   $prescriptions = PrescriptionsModel::join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id');
if($this->user_type !='ho')
     {
      $prescriptions = $prescriptions->where($usertype,'=',$this->user_id);
     }
 if($this->ff_id!='')
                {
                  $prescriptions = $prescriptions->where('prescriptions.ff_id','=',$this->ff_id);
                }

  $prescriptions = $prescriptions->where('prescriptions.brand_id','=',$this->brand_id)->where('prescriptions.schedule_name','=',$value['schedule'])->whereBetween('prescriptions.start_date', [$start_date,$end_date])->get()->groupBy(function($date) {
        //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        return Carbon::create($date->start_date)->format('M/Y'); // grouping by months
    })->count();
     fputcsv($output, array($value['schedule'], $prescriptions));
  }fclose($output);
    exit;

  }
  //excel generation based on indications
  if($this->type==9)
  {
   
 $returnData3 = [];
 $indicationTypes = IndicationsModel::where('brand_id','=',$this->brand_id)->get();
      $returnData3 = [];
     foreach ($indicationTypes as $key => $value) {
      
     $data= DB::table('prescriptions')->join('indications', 'prescriptions.indication_id','=', 'indications.id');
     if($this->user_type !='ho')
     {
      $data = $data->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$this->user_id);
     }
     $data = $data->select('indication_id','prescriptions.start_date')->where('prescriptions.indication_id','=',$value['id'])->whereBetween('prescriptions.start_date', [$start_date,$end_date]);
     if($this->ff_id!='')
                {
                  $data = $data->where('prescriptions.ff_id','=',$this->ff_id);
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
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=indication-wise rx-report.csv');
$output = fopen("php://output", "w");
foreach ($usermcount as $key => $value) {//echo "<pre>";print_r($key);exit;
fputcsv($output, array('indication-'.$key)); 
fputcsv($output, array('month ', 'Rx count'));

foreach ($value as $key1 => $value1) { //echo "<pre>";print_r($key1);exit;
 fputcsv($output, array($key1, $value1));
  }
  }fclose($output);
    exit;

  }
  //excel generation based on indication and average dose prescribed
  if($this->type==10)
  {
   
 $returnData3 = [];
 $indicationTypes = IndicationsModel::where('brand_id','=',$this->brand_id)->get();
      $returnData3 = [];
     foreach ($indicationTypes as $key => $value) {
      
     $data= DB::table('prescriptions')->join('indications', 'prescriptions.indication_id','=', 'indications.id');
     if($this->user_type !='ho')
     {
      $data = $data->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->where($usertype,'=',$this->user_id);
     }
     $data = $data->select('indication_id','prescriptions.start_date',DB::raw('sum(dose_value) as dose_sum'))->where('prescriptions.indication_id','=',$value['id'])->whereBetween('prescriptions.start_date', [$start_date,$end_date]);
     if($this->ff_id!='')
                {
                  $data = $data->where('prescriptions.ff_id','=',$this->ff_id);
                }
     $data = $data->get();
     $returnData3[$key][$value['name']] = $data;
  } 
      $usermcount =[];
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=indication-wise-dose-report.csv');
    $output = fopen("php://output", "w");
     fputcsv($output, array('indication','dose prescribed'));
  foreach ($returnData3 as $key => $value) { 
  foreach ($value as $key1 => $value1){ 
  
    $i=0;
    foreach ($value1 as $key2 => $value2){ //echo "<pre>";print_r($value2);exit;
    if(empty($value2->dose_sum))
    {
      $value2->dose_sum =0;
    }
     fputcsv($output, array($key1,$value2->dose_sum));
    

  }

  }}

fclose($output);
    exit;

  }
    }
	public function headings(): array
    {
        return ['id','ff name','patient_name','phone','contact_type','created date'];
    }
}
