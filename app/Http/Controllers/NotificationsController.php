<?php

namespace App\Http\Controllers;

use App\Models\HqModel;
use App\Models\NotificationsModel;
use App\Models\PrescriptionCycleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\query;

class NotificationsController extends Controller
{
	public function index()
	{
		$this->send_sms();
		$user_type = Auth::user()->user_type;
		if ($user_type == 'ff') {
			$ff_id = Auth::user()->id;
			$dates = Carbon::now();
			$curdate = Carbon::now()->format('Y-m-d');
			$date = Carbon::now()->addDays(3);
			$sevendays = Carbon::now()->addDays(7);
			$fourteeendays = Carbon::now()->addDays(14);
			$onemonth = Carbon::now()->addDays(30);
			// $notifications = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number', 'prescription_cycle.end_date')->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBy('prescription_cycle.end_date', 'ASC');
			DB::statement("SET SQL_MODE=''");
			$allnotifications = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number', DB::raw('DATE_FORMAT(prescription_cycle.end_date, "%d-%b-%Y") as end_date'), DB::raw('DATEDIFF(prescription_cycle.end_date,CURDATE()) as days'))->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBy('prescription_cycle.end_date', 'ASC')->whereBetween('prescription_cycle.end_date',  [$dates, $onemonth])->paginate(config('constants.PAGINATION_COUNT'));
			$twodaysnotifications = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number',  DB::raw('DATE_FORMAT(prescription_cycle.end_date, "%d-%b-%Y") as end_date'), DB::raw('DATEDIFF(prescription_cycle.end_date,CURDATE()) as days'))->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBy('prescription_cycle.end_date', 'ASC')->whereBetween('prescription_cycle.end_date', [$dates, $date])->paginate(config('constants.PAGINATION_COUNT'));
			$oneweeknotifications = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number',  DB::raw('DATE_FORMAT(prescription_cycle.end_date, "%d-%b-%Y") as end_date'), DB::raw('DATEDIFF(prescription_cycle.end_date,CURDATE()) as days'))->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBy('prescription_cycle.end_date', 'ASC')->whereBetween('prescription_cycle.end_date', [$date, $sevendays])->paginate(config('constants.PAGINATION_COUNT'));
			$twoweeknotifications = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number',  DB::raw('DATE_FORMAT(prescription_cycle.end_date, "%d-%b-%Y") as end_date'), DB::raw('DATEDIFF(prescription_cycle.end_date,CURDATE()) as days'))->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBy('prescription_cycle.end_date', 'ASC')->whereBetween('prescription_cycle.end_date', [$sevendays, $fourteeendays])->paginate(config('constants.PAGINATION_COUNT'));
			$onemonthnotifications = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', 'prescription_cycle.cycle_number',  DB::raw('DATE_FORMAT(prescription_cycle.end_date, "%d-%b-%Y") as end_date'), DB::raw('DATEDIFF(prescription_cycle.end_date,CURDATE()) as days'))->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBy('prescription_cycle.end_date', 'ASC')->whereBetween('prescription_cycle.end_date', [$fourteeendays, $onemonth])->paginate(config('constants.PAGINATION_COUNT'));
			$expaired = PrescriptionCycleModel::select('prescription_cycle.rx_id AS id', 'doctors.doctor_name', 'brands.brand_name', 'rx_entry.patient_name', DB::RAW('MAX(prescription_cycle.cycle_number) AS cycle_number'), DB::raw('DATE_FORMAT(prescription_cycle.end_date, "%d-%b-%Y") as end_date'), DB::raw('DATEDIFF(CURDATE(),prescription_cycle.end_date) as days'))->join('rx_entry', 'rx_entry.id', '=', 'prescription_cycle.rx_id')->join('brands', 'brands.id', '=', 'rx_entry.brand_id')->join('doctors', 'doctors.id', '=', 'rx_entry.doctor_id')->where('prescription_cycle.ff_id', $ff_id)->orderBY('prescription_cycle.cycle_number', 'DESC')->orderBY('prescription_cycle.end_date', 'ASC')->where('prescription_cycle.end_date', '<', $dates)->groupBy('prescription_cycle.rx_id')->paginate(config('constants.PAGINATION_COUNT'));
			return view('notifications/notifications_list', compact('allnotifications', 'twodaysnotifications', 'oneweeknotifications', 'twoweeknotifications', 'onemonthnotifications', 'expaired'));
		} else {
			$notifications = NotificationsModel::paginate(config('constants.PAGINATION_COUNT'));
			return view('admin/notification/notification_list', compact('notifications'));
		}
	}


	function send_sms()
	{
		//This is SMS template use same for testing, will share updated one once registered
		$Dlt = '1207164302276201210';
		//Actual message going to user
		$message = urlencode("Toujeo Basal Academy update: Congratulations on successfully completing your Module on Wed Jul 27 2022 at 3:01 pm IST. We will soon reach out to you with further updates -Basal Academy
		");
		$route = 4;
		//SMS sender ID
		$speaker_phone = "9072461237";
		$senderId = "BASLAC";
		//Actual Data
		$postData = array(
			'mobiles' => $speaker_phone,
			'message' => $message,
			"DLT_TE_ID" => $Dlt,
			'sender' => $senderId,
			'route' => $route
		);

		$url = "http://api.msg91.com/api/v2/sendsms";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_HTTPHEADER => array(
				"authkey: 268197A5ZORkn1DU0L60fe3d1aP1",
				"content-type: multipart/form-data"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	}

	public function create()
	{
		$object = new GeneralFunctionsController();
		$returnData = $object->get_master_datas();
		return view('admin/notification/notification_add', $returnData);
	}

	public function store(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			[
				'region_id'		=> 'required',
				'hq_id'		=> 'required',
				'team_id'		=> 'required',
				'user_id'		=> 'required',
				'title'		=> 'required',
				'description'		=> 'required',
			]
		);

		if ($validator->fails()) {
			return \Redirect::back()->withErrors($validator)->withInput();
		} else {
			$notifications = new NotificationsModel();
			$notifications->user_id = $request->get('user_id');
			$notifications->region_id = $request->get('region_id');
			$notifications->hq_id = $request->get('hq_id');
			$notifications->team_id = $request->get('team_id');
			$notifications->name = $request->get('title');
			$notifications->description = $request->get('description');
			//$notifications->heading = $request->get('heading');
			$is_saved = $notifications->save();
			if ($is_saved) {
				\Session::flash('success', 'Notifications added successfully.');
				return redirect('/notifications');
			} else {
				\Session::flash('error', 'Error adding Notifications.');
				return \Redirect::back();
			}
		}
	}

	public function edit(Request $request, $id)
	{
		$notifications  = NotificationsModel::where('id', decrypt($id))->first();
		if ($notifications) {
			$object = new GeneralFunctionsController();
			$returnData = $object->get_master_datas();
			return view('admin/notification/notification_edit', $returnData, compact('id', 'notifications'));
		} else {
			\Session::flash('error', 'Error');
			return redirect('/notifications');
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make(
			$request->all(),
			[
				'user_id' => 'required',
				'region_id'		=> 'required',
				'hq_id'		=> 'required',
				'team_id'		=> 'required',
				'title'		=> 'required',
				'description'		=> 'required',
			]
		);

		if ($validator->fails()) {
			return \Redirect::back()->withErrors($validator)->withInput();
		} else {
			$notifications  = NotificationsModel::where('id', decrypt($id))->first();
			if ($notifications) {
				$notifications->user_id = $request->get('user_id');
				$notifications->region_id = $request->get('region_id');
				$notifications->hq_id = $request->get('hq_id');
				$notifications->team_id = $request->get('team_id');
				$notifications->name = $request->get('title');
				$notifications->description = $request->get('description');
				$notifications->save();
				\Session::flash('success', 'Notifications details updated successfully.');
				return redirect('/notifications');
			} else {
				\Session::flash('error', 'Nothing to update');
				return \Redirect::back();
			}
		}
	}

	public function destroy(Request $request)
	{
		$id = $request->id;
		if ($id) {
			$notifications = NotificationsModel::where('id', $id)->first();
			if ($notifications->id) {
				NotificationsModel::destroy($id);
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
