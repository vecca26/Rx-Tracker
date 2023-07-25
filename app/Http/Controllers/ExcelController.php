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
use Maatwebsite\Excel\Facades\Excel;
//use App\Imports\ImportUser;
use App\Models\ExportUser;

use Carbon\Carbon;

class ExcelController extends Controller
{
    public $successStatus = 200;

    // public function index()//
    // { 
    // }
//  public function institute_type_rxcount(Request $request)
//  { echo "pp";exit;
 
//    }

public function excel_export(Request $request)
 {
    
    $object = new GeneralFunctionsController();
    $daterange = $object->dateRange('default');
    $user_type = $request->user_type;
    $user_id = $request->user_id;
    $brand_id =$request->brand_id;
    $start_date = $request->start_date;
    $end_date = $request->end_date;
    $ff_id = $request->ff_id;
    $type = $request->type;
      return Excel::download(new ExportUser($start_date, $end_date,$user_type,$user_id,$brand_id,$ff_id,$type),'report.xlsx');

if($type==3)
{ 
$returnData3 = [];
        $patient_type_rxcount = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','rx_entry.created_at as created_at')->where('rx_entry.brand_id','=',$brand_id)->whereBetween('rx_entry.created_at', [$start_date,$end_date]);
         $patient_type_rxcount =$patient_type_rxcount->get();
         $patientdynamicTypes = RxEntryModel::join('doctors', 'rx_entry.doctor_id','=', 'doctors.id')->select('doctor_id','doctor_name')->distinct('doctor_id')->where('rx_entry.brand_id','=',$brand_id)->get();
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
}download($output);
    exit;

}

   
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
                //   header('Content-Type: text/csv');
}
//return (new ReportExport($sdate, $edate))->download('report.xlsx');

                 //return Excel::download(new ExportUser, 'users.xlsx');
//         $myfile = Excel::download(new ExportUser, 'users.xlsx');
//         $response =  array(
//    'name' => "filename", //no extention needed
//    'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myfile) //mime type of used format
// );
// return response()->json($response);
        
       $returnData = json_encode($usermcount);     
       return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
  //patient graph ends

 }
}
