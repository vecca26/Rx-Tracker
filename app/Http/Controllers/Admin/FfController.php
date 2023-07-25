<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use App\Models\ProfessionalDetails;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FfController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $object = new GeneralFunctionsController();
        $returnData = $object->get_master_datas();
        $users = $this->users_query();
        if ($user->user_type == 'zsm') {
            $users = $users->select(
                'users.id',
                'users.first_name',
                'users.last_name',
                'hq.hq',
                'teams.team'
            )
                ->where('professional_details.zsm_id', '=', $user->id)
                ->paginate('10');
        } else {
            $users = $users->select(
                'users.id',
                'users.first_name',
                'users.last_name',
                'hq.hq',
                'teams.team'
            )->paginate('10');
        }
        return view('admin/ff/ff_list', $returnData, compact('users'));
    }

    public function filter_ff_details(Request $request)
    {
        $brand_id = $request->get('brand_id');
        $region_id = $request->get('region_id');
        $hq_id = $request->get('hq_id');
        $team_id = $request->get('team_id');
        $users = $this->users_query();
        if ($request->filled('brand_id')) {
            $users = $users->where('professional_details.brand_id', $brand_id);
        }
        if ($request->filled('hq_id')) {
            $users = $users->where('professional_details.hq_ids', $hq_id);
        }
        if ($request->filled('region_id')) {
            $users = $users->where('professional_details.region_id', $region_id);
        }
        if ($request->filled('team_id')) {
            $users = $users->where('professional_details.team_id', $team_id);
        }
        $users = $users->select(
            'users.id',
            'users.first_name',
            'users.last_name',
            'hq.hq',
            'teams.team'
        )->paginate(10);
        $returnData = $users;
        if ($returnData) {
            return view('admin/ff/ff_list_table', compact('users'));
        }
    }

    function users_query()
    {
        $users = DB::table('users')->where('users.user_type', 'ff')
            ->join('professional_details', 'professional_details.user_id', '=', 'users.id')
            ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
            ->join('teams', 'teams.id', '=', 'professional_details.team_id');
        return $users;
    }

    public function create()
    {
        $object = new GeneralFunctionsController();
        $returnData = $object->get_master_datas();
        return view('admin/ff/ff_add', $returnData);
    }

    public function store(Request $request)
    {
        $insert_array = [
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'employee_id'  => $request->employee_id,
            'user_type'    => 'ff',
            'team_id'      => $request->team_select
        ];
        $sts = User::create($insert_array);

        $zsm_details =  DB::table('professional_details')->where('user_id', $request->bdm_select)->get();
        $zsm = json_decode($zsm_details, true);
        $insert_manager_array = [
            'user_id'      => $sts->id,
            'team_id'      => $request->team_select,
            'region_id'    => $request->region_select,
            'hq_ids'       => $request->hq_select,
            'brand_id'     => $request->brand_select,
            'hq_ids'       => $request->hq_select,
            'bdm_id'       => $request->bdm_select,
            'zsm_id'       => $zsm[0]['zsm_id']
        ];
        $professional_sts =  DB::table('professional_details')->insert($insert_manager_array);
        if ($professional_sts == 1) {
            \Session::flash('success', 'FF Added Successfully.');
            return redirect('/ff');
        } else {
            \Session::flash('error', 'Error adding Users.');
            return \Redirect::back();
        }
    }

    public function edit(Request $request, $id)
    {
        $users = $this->users_query();
        $users = $users->where('users.id', decrypt($id))->first();
        $object = new GeneralFunctionsController();
        $returnData = $object->get_master_datas();
        if ($users) {
            return view('admin/ff/ff_edit', $returnData, compact('id', 'users'));
        } else {
            \Session::flash('error', 'Error');
            return redirect('/ff');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name'        => 'required',
                'email'        => 'required',
                'employe_id'        => 'required',
                'phone'        => 'required',
                'last_name'        => 'required',
            ]
        );

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
            $users  = UsersModel::where('id', decrypt($id))->first();
            if ($users) {
                $users->first_name = $request->get('first_name');
                //$users->email = $request->get('email');
                $users->employee_id = $request->get('employe_id');
                $users->phone = $request->get('phone');
                $users->last_name = $request->get('last_name');
                $is_save = $users->save();
                if ($is_save) {
                    $ffArray = ['team_id' => $request->team_select, 'region_id' => $request->region_select, 'hq_ids' => $request->hq_select, 'brand_id' => $request->brand_select];
                    $update_ff_proffession = ProfessionalDetails::where('user_id', decrypt($id))->update($ffArray);
                    if ($update_ff_proffession) {
                        \Session::flash('success', 'FF Updated Successfully.');
                        return redirect('/ff');
                    } else {
                        \Session::flash('error', 'Error adding Users.');
                        return \Redirect::back();
                    }
                }
            } else {
                \Session::flash('error', 'Nothing to update');
                return \Redirect::back();
            }
        }
    }

    public function fetch_ff_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ff_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $ff_id = $request->get('ff_id');
            $object = new GeneralFunctionsController();
            $returnData = $object->get_master_datas();
            $users = DB::table('users')->where('users.user_type', 'ff')
                ->join('professional_details', 'professional_details.user_id', '=', 'users.id')
                ->join('hq', 'hq.id', '=', 'professional_details.hq_id')
                ->join('teams', 'teams.id', '=', 'professional_details.team_id')
                ->where('users.id', $ff_id)
                ->first();
            return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $users = UsersModel::where('id', $id)->first();
            if ($users->id) {
                UsersModel::destroy($id);
                $msg = "Success";
            } else {
                $msg = "Error";
            }
        } else {
            $msg = "Error";
        }
        return $msg;
    }
}
