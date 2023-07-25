<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProfessionalDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BdmController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
        $user = Auth::user();
        // if($request->region_listing=='')
        // { 
        // 	$keyword ='';
        //        $returnData =ProfessionalDetails::Bdm_data($request,'list');
        // }
        // else{ 
        //        $keyword = $request->keyword;
        if ($user->user_type == 'zsm') {
            $userData = DB::table('users')
                ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                ->join('teams', 'teams.id', '=', 'professional_details.team_id')
                ->join('region', 'region.id', '=', 'professional_details.region_id')
                ->where('users.user_type', '=', 'bdm')
                ->where('professional_details.zsm_id', '=', $user->id)
                ->paginate('10');
        } else {
            $userData = DB::table('users')
                ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                ->join('teams', 'teams.id', '=', 'professional_details.team_id')
                ->join('region', 'region.id', '=', 'professional_details.region_id')
                ->where('users.user_type', '=', 'bdm')
                ->paginate('10');
        }
        $region_list = DB::table('region')->get();
        $list        = DB::table('hq')->get();
        $zsm_list    = DB::table('users')
            ->select('id', 'first_name', 'last_name')
            ->where('users.user_type', 'LIKE', 'zsm')
            ->get();
        $teams = DB::table('teams')->get();
        $returnData = [
            'region_list'  => $region_list,
            'regions'      => $region_list,
            'userData'     => $userData,
            'hq_list'      => $list,
            'teams'        => $teams,
            'zsm_list'     => $zsm_list
        ];
        // }
        return view('admin/bdm/admin_bdm', $returnData);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name'    => 'required|min:2|max:30',
                'last_name'     => 'required|min:1|max:30',
                'employee_id'    => 'required|unique:users',
                'email'         => 'required|min:6|max:50|unique:users',
                'phone'         => 'required|min:6|max:20',
                'password'      => 'required|min:2|max:30',
                'team_select'   => 'required',
                'region_select' => 'required',
                'hq_select'     => 'required',
                'zsm_select'    => 'required'
            ]
        );

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
            $status = ProfessionalDetails::ProfessionalDetails($request, 'bdm');
            if (isset($status->id)) {
                return redirect('/admin_bdm')->with('status', 'BDM Added!');
            } else {
                return redirect('/admin_bdm')->with('status', 'Something went wrong!');
            }
        }
    }
    public function fetch_bdm_data(Request $request)
    {
        $returnData = ProfessionalDetails::Bdm_data($request->user_id, "fetch");

        return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
    public function show($id)
    {
        $id         = decrypt($id);
        $returnData = ProfessionalDetails::Bdm_data($id, "fetch");
        return view('admin/bdm/bdm_view', $returnData);
    }
    public function update(Request $request)
    {
        $updateArray = [
            'first_name'   => $request->first_names,
            'last_name'    => $request->last_names,
            'email'        => $request->emails,
            'phone'        => $request->phones,
        ];

        $update_status = User::where('id', $request->user_id)->update($updateArray);
        $professionalArray = [
            'region_id'    => $request->region_selects,
            'hq_ids'       => $request->hq_selects,
            'zsm_id'       => $request->zsm_lists,
        ];
        $update_brand_status = ProfessionalDetails::where('user_id', $request->user_id)->update($professionalArray);
        if ($update_status) {
            return redirect('/admin_bdm')->with('status', 'BDM Updated!');
        } else {
            return redirect('/admin_bdm')->with('status', 'Something went wrong!');
        }
    }
    public function create()
    {
        $region_list = DB::table('region')->get();
        $list = DB::table('hq')->get();
        $zsm_list = DB::table('users')
            ->select('id', 'first_name', 'last_name')
            ->where('users.user_type', 'LIKE', 'zsm')
            ->get();
        $teams = DB::table('teams')->get();
        $returnData = [
            'region_list'  => $region_list,
            'hq_list'      => $list,
            'teams'        => $teams,
            'zsm_list'     => $zsm_list
        ];
        return view('admin/bdm/bdm_add', $returnData);
    }
}
