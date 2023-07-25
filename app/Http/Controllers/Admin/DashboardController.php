<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $user = Auth::user();
        if ($user->user_type == 'zsm') {
            $result = DB::select("SELECT (SELECT count(*)  FROM `professional_details` left join users on users.id = professional_details.user_id where professional_details.zsm_id = " . $user->id . " and professional_details.bdm_id IS NULL ) as bdm_count, (SELECT COUNT(*) FROM `users` left JOIN brands on brands.team_id = users.team_id WHERE users.id = " . $user->id . ") as brand_count,(SELECT count(*) FROM `users` Left JOIN professional_details on professional_details.user_id = users.id WHERE professional_details.zsm_id = " . $user->id . " and users.user_type = 'ff') as ff_count");
            $returnData = [
                'data' => $result[0]
            ];
        }
        else if($user->user_type == 'bdm'){
            $result = DB::select("SELECT (SELECT COUNT(*) FROM `users` left JOIN brands on brands.team_id = users.team_id WHERE users.id = ". $user->id .") as brand_count,(SELECT count(*) FROM `users` Left JOIN professional_details on professional_details.user_id = users.id WHERE professional_details.bdm_id = " . $user->id . " and users.user_type = 'ff') as ff_count");
            $returnData = [
                'data' => $result[0]
            ];
        } else {
            $result = DB::select("SELECT (SELECT COUNT(*) FROM brands) as brand_count, (SELECT COUNT(*) FROM users where user_type='zsm') as zsm_count,(SELECT COUNT(*) FROM users where user_type='bdm') as bdm_count,(SELECT COUNT(*) FROM users where user_type='brand_manager') as brand_manager_count");
            $returnData = [
                'data' => $result[0]
            ];
        }

        return view('admin/admin_dashboard', $returnData);
    }

    public function fetch_dashboard_details(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $user_id = Auth::user()->id;
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $datas = [
            'user_id'    => $user_id,
            'brand_id'   => $brand_id,
            'start_date' => $start_date,
            'end_date'   => $end_date
        ];
        $object = new GeneralFunctionsController();
        $returnData = $object->get_dashboard_details($datas);
        if ($returnData) {
            return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
        } else {
            return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
        }
    }
}
