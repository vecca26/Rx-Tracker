<?php

namespace App\Http\Controllers;

use App\Models\PrescriptionCycleModel;
use App\Models\PrescriptionsModel;
use App\Models\General;
use App\Models\User;
//use App\Http\Controllers\GeneralFunctionsController;
use App\Models\RxEntryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\DB;


class CustomAuthController extends Controller
{


    public function customLogin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee_id' => 'required',
                'password' => 'required'
            ]
        );

        $user = Auth::user();

        if ($validator->fails()) {

            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
            $credentials = $request->only('employee_id', 'password');
            if (Auth::attempt($credentials)) { //echo "success";exit;

                return redirect()->route("home");
            } else {
                Session::flash('error', 'Invalid Credentials');
                return \Redirect::back();
            }
        }
    }

    public function getInitialData(Request $request)
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route("login");
        } else {
            $user_type = $user->user_type; //echo $user_type;exit;
            $user_first_name = $user->first_name; //echo $user_first_name;exit;
            $user_last_name = $user->last_name; //echo $user_type;exit;
            $user_id = $user->id;
        }

        $generalInformation = User::generalInformation();

        $returnData = General::quickview('default', $user_type, $user_id, $user_first_name, $user_last_name);
        return view('analytics', $returnData);
    }

    public function quicksummaryview(Request $request)
    {
        $team_id = '';
        if ($request->team_id != '') {
            $team_id = $request->team_id;
        }
        $zsm_id = '';
        if ($request->zsm_id != '') {
            $zsm_id = $request->zsm_id;
        }
        $bdm_id = '';
        if ($request->bdm_id != '') {
            $bdm_id = $request->bdm_id;
        }
        $brand_id = '';
        if ($request->brand_id != '') {
            $brand_id = $request->brand_id;
        }
        $start_date = '';
        if ($request->start_date != '') {
            $start_date = $request->start_date;
        }
        $end_date = '';
        if ($request->end_date != '') {
            $end_date = $request->end_date;
        }
        $ff_id = '';
        if ($request->ff_id != '') {
            $ff_id = $request->ff_id;
        }
        $returnData = General::quickviews($team_id, $zsm_id, $bdm_id, $brand_id, $start_date, $end_date, $ff_id);
        return $returnData;
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
