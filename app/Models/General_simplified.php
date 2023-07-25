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
  public static function quickview($type, $user_type, $user_id, $start = '', $end = '')
  {


    if ($type == 'default') {
      $end     = date("Y-m-d");
      $start   = date("Y-m-d", strtotime("-30 days"));
      $user_list  = User::join('professional_details', 'users.id', '=', 'professional_details.user_id')
        ->join('region', 'region.id', '=', 'professional_details.region_id')
        ->join('hq', 'hq.id', '=', 'professional_details.hq_ids');
      $user_list1 = $user_list;
      $zsm_list  = $user_list->where('users.user_type', 'LIKE', 'zsm')->get();
      $bdm_list  = $user_list
        ->where('users.user_type', 'LIKE', 'bdm')->get();
      dd($bdm_list);
      if ($user_type == 'zsm') {
        $bdm_list = $bdm_list->where('zsm_id', '=', $user_id);
      }
      $bdm_list = $bdm_list->get();
      $ff_list  = $user_list
        ->where('users.user_type', 'LIKE', 'ff');

      if ($user_type == 'bdm') {
        $ff_list = $ff_list->where('bdm_id', '=', $user_id);
      }
      if ($user_type == 'admin') {
      $admin_ff_list =  $user_list1 ->where('users.user_type', 'LIKE', 'ff');
      }
      $ff_list = $ff_list->get();


      $team_list  = Teams::get();
      $brand_list  = Brands::get();
    }
    $match = ['status' => '1'];
    $rx_entry_count = RxEntryModel::where($match);
    $patients_ongoing_count = $rx_entry_count->whereBetween('created_at', [$start, $end])->count();

    $status = ['cycle_repeated' => 'no'];
    $patient_dropout = PrescriptionCycleModel::where($status);
    $patient_dropout_count = $patient_dropout->whereBetween('start_date', [$start, $end])->count();

    $total_rxCount = RxEntryModel::whereBetween('created_at', [$start, $end])->count();

    $dose_scheduled = PrescriptionsModel::whereBetween('start_date', [$start, $end])->sum('dose_value');
    $returnData = [
      'zsm_list' => $zsm_list,
      'bdm_list' => $bdm_list,
      'ff_list' => $ff_list,
      'admin_ff_list' => $admin_ff_list,
      'team_list' => $team_list,
      'brand_list' => $brand_list,
      'patients_ongoing_count' => $patients_ongoing_count,
      'patient_dropout_count' => $patient_dropout_count,
      'total_rxCount' => $total_rxCount,
      'dose_scheduled' => $dose_scheduled,
      'user_type' => $user_type,
      'start_date' => $start,
      'end_date' => $end

    ];
    dd($returnData);
    return $returnData;
  }
}
