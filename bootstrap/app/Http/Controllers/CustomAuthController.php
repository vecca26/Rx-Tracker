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
            $credentials = $request->only('employee_id','password');
            if (Auth::attempt($credentials)) { //echo "success";exit;

                return redirect()->route("home");

            } else {
                Session::flash('error', 'Invalid Credentials');
                return \Redirect::back();
            }
        }
    }

    public function getInitialData(Request $request){

        $user = Auth::user();
        $user_type = $user->user_type;//echo $user_type;exit;
        $user_first_name = $user->first_name;//echo $user_first_name;exit;
        $user_last_name = $user->last_name;//echo $user_type;exit;
        $user_id = $user->id;

        $generalInformation = User::generalInformation();
        
        $returnData = General::quickview('default',$user_type,$user_id,$user_first_name,$user_last_name);
        return view('analytics',$returnData);
    }

    public function logout(Request $request){

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}