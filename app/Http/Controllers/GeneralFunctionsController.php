<?php

namespace App\Http\Controllers;

use App\Models\BrandsModel;
use App\Models\FfTeamModel;
use App\Models\IndicationsModel;
use App\Models\MedicalSpecialityModel;
use App\Models\PrescriptionCycleModel;
use App\Models\PrescriptionsModel;
use App\Models\RxDiscontinueReasonModel;
use App\Models\RxEntryModel;
use App\Models\TeamBrandsModel;
use App\Models\RegionModel;
use App\Models\TeamsModel;
use App\Models\HqModel;
use App\Models\UsersModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\NotificationsModel;
use App\Models\PoDetailModel;
use DB;

class GeneralFunctionsController extends Controller
{

    // Get all master table data from here

    public  function get_reasons()
    {
        $discontinue_reason = RxDiscontinueReasonModel::get();
        return $discontinue_reason;
    }

    public  function get_ff_team_id()
    {
        $user_id = Auth::user()->id;
        $ff_team = FfTeamModel::where('ff_id', $user_id)->first();
        $team_id = $ff_team->team_id;
        return $team_id;
    }

    public  function get_speciality()
    {
        $speciality = MedicalSpecialityModel::get();
        return $speciality;
    }

    public  function get_indications()
    {
        $indications = IndicationsModel::get();
        return $indications;
    }
    public function get_dashboard_details($datas)
    {
        $user_id = $datas['user_id'];
        $brand_id = $datas['brand_id'];
        $date = Carbon::now()->subDays(2);
        $curdate = Carbon::now();
        $start_date = $datas['start_date'];
        $end_date = $datas['end_date'];
        $match = ['ff_id' => $user_id, 'status' => '1'];
        $rx_entry_count = RxEntryModel::where($match);
        $prescription_count = PrescriptionsModel::where('ff_id', $user_id);
        $cycle_count = PrescriptionCycleModel::where('ff_id', $user_id);
        $team_id = Auth::user()->team_id;
        $brand_list = TeamBrandsModel::with('brands')->where('team_id', $team_id)->get();
        $notification_count = PrescriptionCycleModel::where('prescription_cycle.ff_id', $user_id)->select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number', 'prescription_cycle.end_date')->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $user_id)->orderBy('prescription_cycle.end_date', 'ASC')->where('prescription_cycle.end_date', '>=', $curdate);
        if ($brand_id == 0) {
            $rx_entry_count = $rx_entry_count;
            $prescription_count = $prescription_count;
            $cycle_count = $cycle_count;
            $notification_count = $notification_count;
        } else {
            $rx_entry_count = $rx_entry_count->where('brand_id', $brand_id);
            $prescription_count = $prescription_count->where('brand_id', $brand_id);
            $cycle_count = $cycle_count->where('brand_id', $brand_id);
            $notification_count = $notification_count->where('rx_entry.brand_id', $brand_id);
        }

        if ($start_date != "") {
            $from = date($start_date);
            $to = date($end_date);
            $rx_entry_count = $rx_entry_count->whereBetween('created_at', [$from, $to]);
            $prescription_count = $prescription_count->whereBetween('created_at', [$from, $to]);
            $cycle_count = $cycle_count->whereBetween('created_at', [$from, $to]);
            $notification_count = $notification_count->whereBetween('created_at', [$from, $to]);
        }
        $rx_entry_count = $rx_entry_count->count();
        $prescription_count = $prescription_count->count();
        $cycle_count = $cycle_count->count();
        $notification_count = $notification_count->count();
        $returnData = [
            'brand_list' => $brand_list,
            'rx_entry_count' => $rx_entry_count,
            'prescription_count' => $prescription_count,
            'cycle_count' => $cycle_count,
            'notification_count' => $notification_count
        ];
        return $returnData;
    }

    public function get_po_dashboard_details($datas)
    {
        $user_id = $datas['user_id'];
        $brand_id = $datas['brand_id'];
        $date = Carbon::now()->subDays(2);
        $start_date = $datas['start_date'];
        $end_date = $datas['end_date'];
        $match = ['ff_id' => $user_id, 'status' => '1'];

        $po_entry_count = PoDetailModel::where($match);
        return $po_entry_count;
    }

    public function get_master_datas()
    {
        $region = RegionModel::get();
        $teams = TeamsModel::get();
        $hq = HqModel::get();
        $user_data = UsersModel::where('user_type', 'ff')->get();
        $brands = BrandsModel::get();
        $bdm_list = UsersModel::where('user_type', 'bdm')
            ->get();
        $returnData = [
            'region' => $region,
            'teams' => $teams,
            'hq' => $hq,
            'user_data' => $user_data,
            'brands' => $brands,
            'bdm_list' => $bdm_list
        ];
        return $returnData;
    }


    public function get_end_date(Request $request)
    {
        $schedule = $request->get('schedule');
        $start_date = $request->get('start_date');
        $date = Carbon::createFromFormat('Y-m-d', $start_date);
        $date = $date->addDays($schedule);
        return date('Y-m-d', strtotime($date));
    }
    public function get_dashboardCount()
    {
        $result = DB::select("SELECT (SELECT COUNT(*) FROM brands) as brand_count, (SELECT COUNT(*) FROM users where user_type='zsm') as zsm_count,(SELECT COUNT(*) FROM users where user_type='bdm') as bdm_count,(SELECT COUNT(*) FROM users where user_type='brand_manager') as brand_manager_count");

        $returnData = [
            'data' => $result[0]
        ];
        return $returnData;
    }
}
