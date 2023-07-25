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
use App\Http\Controllers\GeneralFunctionsController;

class General extends Model
{
    public static function quickview($type, $user_type, $user_id, $first_name, $last_name, $start = '', $end = '')
    {

        if ($type == 'default') {
            $year = date('Y');
            $month = date('m');
            if ($month < 4) {
                $year = $year;
            }
        }

        $team_list  = Teams::get();
        $brand_list  = Brands::get();

        $start_date = date('Y-m-d', strtotime(($year) . '-01-01'));
        $end_date = date('Y-m-d', strtotime(($year + 2) . '-03-31'));
        $response = array('start_date' => $start_date, 'end_date' => $end_date);
        $end     = $response['end_date'];
        $start   = $response['start_date'];

        $zsm_list  = DB::table('users')->select('user_id', 'first_name', 'last_name', 'hq', 'region')
            ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
            ->join('region', 'region.id', '=', 'professional_details.region_id')
            ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
            ->where('users.user_type', 'LIKE', 'zsm')
            ->get();

        $bdm_list  = DB::table('users')->select('user_id', 'first_name', 'last_name', 'hq', 'region')
            ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
            ->join('region', 'region.id', '=', 'professional_details.region_id')
            ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
            ->where('users.user_type', 'LIKE', 'bdm');
        if ($user_type == 'zsm') {
            $team_id = Auth::user()->team_id;
            $brand_list = $brand_list->where('team_id', '=', $team_id);
            $bdm_list = $bdm_list->where('zsm_id', '=', $user_id);
        }
        $bdm_list = $bdm_list->get();
        $ff_list  = DB::table('users')->select('user_id', 'first_name', 'last_name', 'hq', 'region')
            ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
            ->join('region', 'region.id', '=', 'professional_details.region_id')
            ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
            ->where('users.user_type', 'LIKE', 'ff');
        $ff_list = $ff_list->get();
        if ($user_type == 'bdm') {
            $ff_list = $ff_list->where('bdm_id', '=', $user_id);
            $team_id = Auth::user()->team_id;
            $brand_list = $brand_list->where('team_id', '=', $team_id);
            $ff_list  =  DB::table('users')->select('user_id', 'first_name', 'last_name')
                ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                ->where('professional_details.bdm_id', '=', $user_id);
            $ff_list = $ff_list->get();
        }

        if ($user_type == 'ff') {
            $team_id = Auth::user()->team_id;
            $brand_list = $brand_list->where('team_id', '=', $team_id);
        }



        $match = ['status' => '1'];
        $rx_entry_count = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->where($match);
        $patients_ongoing_count = $rx_entry_count->whereBetween('rx_entry.created_at', [$start, $end]);
        $status = ['cycle_repeated' => 'no'];
        $patient_dropout = PrescriptionCycleModel::join('professional_details', 'prescription_cycle.ff_id', '=', 'professional_details.user_id');
        $patient_dropout_count = $patient_dropout->whereBetween('prescription_cycle.start_date', [$start, $end]);
        $total_rxCount = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start, $end]);
        $dose_scheduled = PrescriptionsModel::join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('prescriptions.start_date', [$start, $end]);

        if ($user_type == 'zsm') {
            $zsm_status = ['zsm_id' => $user_id];
            $patients_ongoing_count = $patients_ongoing_count->where($zsm_status);
            $patient_dropout_count = $patient_dropout_count->where($zsm_status);
            $total_rxCount = $total_rxCount->where($zsm_status);
            $dose_scheduled = $dose_scheduled->where($zsm_status);
        }
        if ($user_type == 'bdm') {
            $bdm_status = ['bdm_id' => $user_id];
            $patients_ongoing_count = $patients_ongoing_count->where($bdm_status);
            $patient_dropout_count = $patient_dropout_count->where($bdm_status);
            $total_rxCount = $total_rxCount->where($bdm_status);
            $dose_scheduled = $dose_scheduled->where($bdm_status);
        }
        $patients_ongoing_count = $patients_ongoing_count->count();
        $avg_cycle_count    = $patient_dropout_count->count();
        $patient_dropout_count  = $patient_dropout_count->where($status)->count();
        $patients_ongoing_count = $patients_ongoing_count - $patient_dropout_count;
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
            'first_name' => $first_name,
            'last_name' => $last_name

        ];
        return $returnData;
    }

    public static function quickviews($team_id, $zsm_id, $bdm_id, $brand_id, $start_date, $end_date, $ff_id)
    {
        if ($start_date == '') {
            $object = new GeneralFunctionsController();
            $daterange = $object->dateRange('default');
            $start_date = $daterange['start_date'];
            $end_date = $daterange['end_date'];
        }

        $rx_entry_count = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id');
        $patients_ongoing_count = $rx_entry_count->whereBetween('rx_entry.created_at', [$start_date, $end_date]);
        $patient_dropout = RxEntryModel::join('prescription_cycle', 'prescription_cycle.rx_id', '=', 'rx_entry.id')->join('professional_details', 'prescription_cycle.ff_id', '=', 'professional_details.user_id');
        $patient_dropout_count = $patient_dropout->whereBetween('prescription_cycle.start_date', [$start_date, $end_date]);
        $total_rxCount = RxEntryModel::join('professional_details', 'rx_entry.ff_id', '=', 'professional_details.user_id')->whereBetween('rx_entry.created_at', [$start_date, $end_date]);
        $dose_scheduled = RxEntryModel::join('prescriptions', 'prescriptions.rx_id', '=', 'rx_entry.id')->join('professional_details', 'prescriptions.ff_id', '=', 'professional_details.user_id')->whereBetween('prescriptions.start_date', [$start_date, $end_date]);

        if ($brand_id != "") {
            $patients_ongoing_count = $patients_ongoing_count->where('rx_entry.brand_id', '=', $brand_id);
            $total_rxCount = $total_rxCount->where('rx_entry.brand_id', '=', $brand_id);
            $dose_scheduled = $dose_scheduled->where('rx_entry.brand_id', '=', $brand_id);
            $patient_dropout_count = $patient_dropout_count->where('rx_entry.brand_id', '=', $brand_id);
        }
        if ($team_id != "" && $brand_id == "") {
            $teambrands = TeamsBrands::select('brand_id')->where('team_id', '=', $team_id)->get()->toArray();
            $patients_ongoing_count = $patients_ongoing_count->whereIn('rx_entry.brand_id', $teambrands);
            $total_rxCount = $total_rxCount->whereIn('rx_entry.brand_id', $teambrands);
            $dose_scheduled = $dose_scheduled->whereIn('rx_entry.brand_id', $teambrands);
            $patient_dropout_count = $patient_dropout_count->whereIn('rx_entry.brand_id', $teambrands);
        }
        if ($zsm_id != "" && $bdm_id == "") {
            $zsm_ff_id = ProfessionalDetails::select('user_id')->where('zsm_id', '=', $zsm_id)->get()->toArray();
            $patients_ongoing_count = $patients_ongoing_count->whereIn('rx_entry.ff_id', $zsm_ff_id);
            $total_rxCount = $total_rxCount->whereIn('rx_entry.ff_id', $zsm_ff_id);
            $dose_scheduled = $dose_scheduled->whereIn('rx_entry.ff_id', $zsm_ff_id);
            $patient_dropout_count = $patient_dropout_count->whereIn('rx_entry.ff_id', $zsm_ff_id);
        }
        if ($bdm_id != "" && $ff_id == '') {
            $bdm_ff_id = ProfessionalDetails::select('user_id')->where('bdm_id', '=', $bdm_id)->get()->toArray();
            $patients_ongoing_count = $patients_ongoing_count->whereIn('rx_entry.ff_id', $bdm_ff_id);
            $total_rxCount = $total_rxCount->whereIn('rx_entry.ff_id', $bdm_ff_id);
            $dose_scheduled = $dose_scheduled->whereIn('rx_entry.ff_id', $bdm_ff_id);
            $patient_dropout_count = $patient_dropout_count->whereIn('rx_entry.ff_id', $bdm_ff_id);
        }
        if ($ff_id != '') {
            $patients_ongoing_count = $patients_ongoing_count->where('rx_entry.ff_id', '=', $ff_id);
            $total_rxCount = $total_rxCount->where('rx_entry.ff_id', '=', $ff_id);
            $dose_scheduled = $dose_scheduled->where('rx_entry.ff_id', '=', $ff_id);
            $patient_dropout_count = $patient_dropout_count->where('rx_entry.ff_id', '=', $ff_id);
        }

        $patients_ongoing_count = $patients_ongoing_count->count();
        $avg_cycle_count    = $patient_dropout_count->count();
        $patient_dropout_count  = $patient_dropout_count->wherenotnull('prescription_cycle.reason_id')->count();
        $patients_ongoing_count = $patients_ongoing_count - $patient_dropout_count;
        $total_rxCount = $total_rxCount->count();
        $dose_scheduled = $dose_scheduled->sum('dose_value');

        $returnData = [
            'avg_cycle_count' => $avg_cycle_count,
            'patients_ongoing_count' => $patients_ongoing_count,
            'patient_dropout_count' => $patient_dropout_count,
            'total_rxCount' => $total_rxCount,
            'dose_scheduled' => $dose_scheduled,
        ];

        return $returnData;
    }
}
