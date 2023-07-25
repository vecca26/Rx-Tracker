<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GeneralFunctionsController;
use App\Models\PrescriptionCycleModel;
use App\Models\PrescriptionsModel;
use App\Models\RxEntryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationsModel;
use App\Models\UsersModel;
use Carbon\Carbon;
use App\Http\Controllers\Admin\DashboardController;

class CustomAuthController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $user_type = $user->user_type;
        $user_id = $user->id;
        $date = Carbon::now()->subDays(2);
        $general = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number', 'prescription_cycle.end_date')->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $user_id)->orderBy('prescription_cycle.end_date', 'ASC')->where('prescription_cycle.end_date', '>=', $date)->count();

        if ($user_type == "ff") {
            $brand_id = 0;
            $object = new GeneralFunctionsController();
            $datas = [
                'user_id' => $user_id,
                'brand_id' => $brand_id,
                'date' => $date,
                'start_date' => "",
                'end_date' => ""
            ];
            // $user_id,$brand_id
            $returnData = $object->get_dashboard_details($datas);
            $returnData['notification'] = $general;
            // return $general;    
            return view('home', $returnData);
        } else {
            return view('admin.admin_dashboard');
        }
    }

    public function customLogin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee_id' => 'required',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
            $credentials = $request->only('employee_id', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $user_type = $user->user_type;
                $user_id = $user->id;
                if ($user_type == "zsm" || $user_type == "admin" || $user_type == "bdm") {
                    $user = Auth::user();
                    $object = new DashboardController();
                    $returnData = $object->index();
                    return $returnData;
                } else if ($user_type == "ff") {
                    $object = new GeneralFunctionsController();
                    $date = Carbon::now()->subDays(2);
                    $general = NotificationsModel::where('user_id', $user_id)->where('due_date', '>=', $date)->orderBy('id', 'DESC')->get();
                    $brand_id = 0;
                    $datas = [
                        'user_id' => $user_id,
                        'brand_id' => $brand_id,
                        'date' => $date,
                        'start_date' => "",
                        'end_date' => ""
                    ];
                    $returnData = $object->get_dashboard_details($datas);
                    $returnData['notifications'] = $general;
                    $returnData['user_login'] = '0';
                    if ($user->is_1stlogin == '0') {
                        return view('auth/passwords/changepassword', $returnData);
                    } else {
                        return view('landingpage', $returnData);
                    }
                }
            } else {
                Session::flash('error', 'Invalid Credentials');
                return \Redirect::back();
            }
        }
    }

    public function passwordError()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $object = new GeneralFunctionsController();
        $date = Carbon::now()->subDays(2);
        $general = NotificationsModel::where('user_id', $user_id)->where('due_date', '>=', $date)->orderBy('id', 'DESC')->get();
        $brand_id = 0;
        $returnData = [
            'user_id' => $user_id,
            'brand_id' => $brand_id,
            'date' => $date,
            'start_date' => "",
            'end_date' => ""
        ];
        if ($user->is_1stlogin == '0') {
            $returnData['user_login'] = '0';
        } else {
            $returnData['user_login'] = '1';
        }
        return view('auth/passwords/changepassword', $returnData);
    }
}
