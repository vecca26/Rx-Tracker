<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RxEntryModel;
use App\Models\PrescriptionCycleModel;
use App\Models\PrescriptionsModel;
use App\Models\ProfessionalDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class GeneralFunctionsController extends Controller
{ 
    public  function filter(Request $request)
    {
     echo "hexxre";exit;
    }
    
   public  function quick_summary($user_type,$user_id,$start_date='',$end_date='',$ff_select='')
   {    
       $match = ['status' => '1'];
        $rx_entry_count = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($match);
        $patients_ongoing_count = $rx_entry_count->whereBetween('rx_entry.created_at', [$start_date, $end_date]);
        $status = ['cycle_repeated' => 'no'];
        $patient_dropout = PrescriptionCycleModel::join('professional_details', 'prescription_cycle.ff_id', '=', 'professional_details.user_id');
        $patient_dropout_count = $patient_dropout->whereBetween('.prescription_cycle.start_date', [$start_date, $end_date]);
        $total_rxCount =RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date]);
        $dose_scheduled =PrescriptionsModel::join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('prescriptions.start_date', [$start_date, $end_date]);

            if($user_type=='zsm')
          {    
                $zsm_status = ['zsm_id' => $user_id];
                $patients_ongoing_count = $patients_ongoing_count->where($zsm_status);
                $patient_dropout_count = $patient_dropout_count->where($zsm_status);
                $total_rxCount = $total_rxCount->where($zsm_status);
                $dose_scheduled = $dose_scheduled->where($zsm_status);
                      
          }
          if($user_type=='bdm')
          {
                $bdm_status = ['bdm_id' => $user_id];
                $patients_ongoing_count = $patients_ongoing_count->where($bdm_status);
                $patient_dropout_count = $patient_dropout_count->where($bdm_status);
                $total_rxCount = $total_rxCount->where($bdm_status);
                $dose_scheduled = $dose_scheduled->where($bdm_status);
                      
          }
          $patients_ongoing_count = $patients_ongoing_count->where('ff_id','=',$ff_select)->count();
          $avg_cycle_count    = $patient_dropout_count->where('ff_id','=',$ff_select)->count();
          $patient_dropout_count  = $patient_dropout_count->where($status)->where('ff_id','=',$ff_select)->count();
          $total_rxCount = $total_rxCount->where('ff_id','=',$ff_select)->count();
          $dose_scheduled = $dose_scheduled->where('ff_id','=',$ff_select)->sum('dose_value');

        $returnData = [ 
            'patients_ongoing_count' => $patients_ongoing_count,
            'patient_dropout_count' => $patient_dropout_count,
            'total_rxCount' => $total_rxCount,
            'dose_scheduled' => $dose_scheduled,
            'avg_cycle_count' => $avg_cycle_count

        ];
        return $returnData;

   }
    public  function monthArray($type,$start='',$end='')
    {
        if($type=='default')
        {
         $usermcount =  ['Apr'=>0,'May'=>0,'Jun'=>0,'Jul'=>0,'Aug'=>0,'Sep'=>0,'Oct'=>0,'Nov'=>0,'Dec'=>0,'Jan'=>0,'Feb'=>0,'Mar'=>0];
        }
        return $usermcount;
    }
    public  function dateRange($type)
    { 
        if($type=='default')
        {
         $year = date('Y');
            $month = date('m');
            if($month<4){
                $year = $year-1;
            }
        $start_date = date('Y-m-d',strtotime(($year).'-04-01'));
        $end_date = date('Y-m-d',strtotime(($year+1).'-03-31'));
        $response = array('start_date' => $start_date, 'end_date' => $end_date);
        $end     = $response['end_date'];
        $start   = $response['start_date'];
        }
        $returnData =  $returnData = [
            'start_date' => $start,
            'end_date' => $end];
        return $returnData;
    }
   
}
