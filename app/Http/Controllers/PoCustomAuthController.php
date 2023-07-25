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
use Carbon\Carbon;


class PoCustomAuthController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $user_type = $user->user_type;
        $user_id = $user->id;
        $date = Carbon::now()->subDays(2);
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
            $returnData = $object->get_po_dashboard_details($datas);
            return view('pohome', compact('returnData'));
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
                // return redirect()->intended('dashboard')
                //             ->withSuccess('Signed in');
                $user = Auth::user();
                $user_type = $user->user_type;
                $user_id = $user->id;
                if ($user_type == "ff") {
                    $object = new GeneralFunctionsController();
                    $date = Carbon::now()->subDays(2);
                    $general = NotificationsModel::where('user_id', $user_id)->where('due_date', '>=', $date)->orderBy('id', 'DESC')->get();
                    $brand_id = 0;
                    // $user_id,$brand_id
                    $datas = [
                        'user_id' => $user_id,
                        'brand_id' => $brand_id,
                        'date' => $date,
                        'start_date' => "",
                        'end_date' => ""
                    ];
                    $returnData = $object->get_dashboard_details($datas);
                    $returnData['notifications'] = $general;
                    return view('landingpage', $returnData);
                } else {
                    $object = new GeneralFunctionsController();
                    $returnData = $object->get_dashboardCount();

                    return view('admin.admin_dashboard', $returnData);
                }
            } else {
                Session::flash('error', 'Invalid Credentials');
                return \Redirect::back();
            }
        }
    }
}
