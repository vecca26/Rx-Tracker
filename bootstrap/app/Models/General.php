<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\RxEntryModel;
use App\Models\PrescriptionCycleModel;
use App\Models\PrescriptionsModel;
use App\Models\ProfessionalDetails;
use App\Models\User;
use App\Models\Teams;
use App\Models\Brands;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
class General extends Model
{ 
	public static function quickview($type,$user_type,$user_id,$first_name,$last_name,$start='',$end='')
    {
    	
      if($type=='default')
        {
            $year = date('Y');
            $month = date('m');
            if($month<4){
                $year = $year-1;
            }
        }
        $start_date = date('Y-m-d',strtotime(($year).'-04-01'));
        $end_date = date('Y-m-d',strtotime(($year+1).'-03-31'));
        $response = array('start_date' => $start_date, 'end_date' => $end_date);
        $end     = $response['end_date'];
        $start   = $response['start_date'];

        $zsm_list  = DB::table('users')->select('user_id','first_name','last_name','hq','region')
        			->join('professional_details', 'users.id', '=', 'professional_details.user_id')
        			->join('region', 'region.id', '=', 'professional_details.region_id')
        			->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                    ->where('users.user_type','LIKE','zsm')
                    ->get();
        
        $bdm_list  = DB::table('users')->select('user_id','first_name','last_name','hq','region')
        			->join('professional_details', 'users.id', '=', 'professional_details.user_id')
        			->join('region', 'region.id', '=', 'professional_details.region_id')
        			->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                    ->where('users.user_type','LIKE','bdm');
          if($user_type=='zsm')
          {
          	$bdm_list = $bdm_list->where('zsm_id','=',$user_id);
                      
          }
          $bdm_list =$bdm_list->get();
        $ff_list  = DB::table('users')->select('user_id','first_name','last_name','hq','region')
        			->join('professional_details', 'users.id', '=', 'professional_details.user_id')
        			->join('region', 'region.id', '=', 'professional_details.region_id')
        			->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                    ->where('users.user_type','LIKE','ff');
                   
         if($user_type=='bdm')
          {
          	    $ff_list = $ff_list->where('bdm_id','=',$user_id);
                      
          }
          $ff_list = $ff_list->get();
        
        $team_list  = Teams::get();
        $brand_list  = Brands::get();


        
        $match = ['status' => '1'];
        $rx_entry_count = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($match);
        $patients_ongoing_count = $rx_entry_count->whereBetween('rx_entry.created_at', [$start, $end]);
        $status = ['cycle_repeated' => 'no'];
        $patient_dropout = PrescriptionCycleModel::join('professional_details', 'prescription_cycle.ff_id', '=', 'professional_details.user_id');
        $patient_dropout_count = $patient_dropout->whereBetween('prescription_cycle.start_date', [$start, $end]);
        $total_rxCount =RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start, $end]);
        $dose_scheduled =PrescriptionsModel::join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('prescriptions.start_date', [$start, $end]);

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
          $patients_ongoing_count = $patients_ongoing_count->count();

          $avg_cycle_count    = $patient_dropout_count->count();
          $patient_dropout_count  = $patient_dropout_count->where($status)->count();
          $patients_ongoing_count =$patients_ongoing_count-$patient_dropout_count;
          $total_rxCount = $total_rxCount->count();
          $dose_scheduled = $dose_scheduled->sum('dose_value');

        $returnData = [
            'zsm_list' => $zsm_list,
            'bdm_list' => $bdm_list,
            'ff_list' => $ff_list,
            'team_list' => $team_list,
            'brand_list' => $brand_list, 
            'patients_ongoing_count' => $patients_ongoing_count,
            'patient_dropout_count' => $patient_dropout_count,
            'total_rxCount' => $total_rxCount,
            'dose_scheduled' => $dose_scheduled,
            'user_type' => $user_type,
            'start_date' => $start,
            'end_date' => $end,
            'avg_cycle_count' => $avg_cycle_count,
            'first_name' =>$first_name,
            'last_name' => $last_name

        ];
        return $returnData;

    }

}