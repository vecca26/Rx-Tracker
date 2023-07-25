<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\BrandScheduleModel;
use App\Models\DoctorsModel;
use App\Models\DoseModel;
use App\Models\FfDoctorModel;
use App\Models\FfProfile;
use App\Models\FfTeamModel;
use App\Models\MedicalSpecialityModel;
use App\Models\PatientTypeModel;
use App\Models\PrescriptionCycleModel;
use App\Models\PrescriptionsModel;
use Illuminate\Http\Request;
use App\Models\RxEntryModel;
use App\Models\TeamBrandsModel;
use App\Models\IndicationsModel;
use App\Models\InstituteModel;
use App\Models\PoDetailModel;
use App\Models\PoDetailsModel;
use App\Models\PoInstitutesModel;
use App\Models\PoProductDetailsModel;
use App\Models\SkuDetailsModel;
use App\Models\SubIndicationsModel;
use App\Models\SubSubIndicationsModel;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class PoController extends Controller
{

    public $successStatus = 200;

    public function create()
    {
        $user_id = Auth::user()->id;
        $team_id = Auth::user()->team_id;
        $match = ['team_id' => $team_id, 'status' => '1'];
        $institutes = PoInstitutesModel::where('status', 1)->get();
        $sku_details = SkuDetailsModel::where($match)->get();
        return view('po_entry/poadd', compact('institutes', 'sku_details'));
    }



    public function get_institute_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ins_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $ins_id = $request->get('ins_id');
            $institute_city = PoInstitutesModel::where('id', $ins_id)->get();
            if ($institute_city) {
                return response()->json(['success' => 1, 'message' => 'success', 'data' => $institute_city], $this->successStatus);
            } else {
                return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }

    public function get_sku_details_pts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $brand_id = $request->get('brand_id');
            $Sku_details = SkuDetailsModel::where('id', $brand_id)->get();
            if ($Sku_details) {
                return response()->json(['success' => 1, 'message' => 'success', 'data' => $Sku_details], $this->successStatus);
            } else {
                return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }

    public function index()
    {
        $ins_id = "";
        $returnData = $this->get_po_details($ins_id);
        return view('po_entry/po_list', $returnData);
    }


    public function get_po_details($ins_id)
    {
        $user_id = Auth::user()->id;
        $team_id = Auth::user()->team_id;
        $match = ['team_id' => $team_id, 'status' => '1'];
        if ($ins_id == "") {
            $match = ['po_details.ps_id' => $user_id, 'po_details.status' => '1'];
            $po_entry = PoDetailModel::join('po_institutes', 'po_details.institute_id', '=', 'po_institutes.id')->where($match);
        } else {
            $match = ['po_details.ps_id' => $user_id, 'po_details.institute_id' => $ins_id, 'po_details.status' => '1'];
            $po_entry = PoDetailModel::join('po_institutes', 'po_details.institute_id', '=', 'po_institutes.id')->where($match);
        }
        $po_entry = $po_entry->orderBy('po_details.created_at', 'DESC')->paginate(config('constants.PAGINATION_COUNT'));
        $brands = PoInstitutesModel::where('status', '1')->get();
        $returnData = [
            'institutes' => $brands,
            'po_entry' => $po_entry
        ];
        return $returnData;
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $team_id = $user->team_id;
        $validator = Validator::make(
            $request->all(),
            [
                'institute_id'        => 'required',
                'ps_id'        => 'required',
                'daterange'        => 'required',
                'po_amount'        => 'required',
                'poorderVal'        => 'required',
                'poactualorderval' => 'required'
            ]
        );

        // if ($validator->fails()) {
        //     return \Redirect::back()->withErrors($validator)->withInput();
        // } else {
        $po_details = new PoDetailModel();
        $po_details->institute_id = $request->get('ins_id');
        $ps_id = $user->id;
        $po_details->ps_id = $ps_id;
        $po_details->po_date = $request->get('daterange');
        $po_details->po_amount = $request->get('poactualorderval');
        $po_details->po_amountlakhs = $request->get('poorderVal');
        $po_save = $po_details->save();
        // if ($po_save) {
        //     $productDetails = $request->get('po_productdetails');
        //     // $po_productdetails = [{sku_id: '27', quantity: '1', price: '1900', total: '0.02', total_lakhs: '1900'}];
        //     foreach ($productDetails->sku as $values) {
        //         $po_productdetails = new PoProductDetailsModel();
        //         $po_productdetails->po_id = $po_details->id;
        //         $po_productdetails->sku_id = $values['sku_id'];
        //         $po_productdetails->quantity = $values['quantity'];
        //         $po_productdetails->price = $values['price'];
        //         $po_productdetails->total = $values['total'];
        //         $po_productdetails->total_lakhs = $values['total_lakhs'];
        //         $po_productdetails->save();
        //     }
        //     \Session::flash('success', 'Po added successfully.');
        //     return redirect('/po_entries');
        // } else {
        //     \Session::flash('error', 'Error adding Po.');
        //     return \Redirect::back();
        // }    
        \Session::flash('success', 'Po added successfully.');
        return redirect('/po_enteries');
        // }
    }

    // public $successStatus = 200;
    // public function index()
    // {
    //     $brand_id = "";
    //     $returnData = $this->get_rx_details($brand_id);
    //     return view('po', $returnData);
    // }

    // public function get_rx_details($brand_id)
    // {
    //     $ff_id = Auth::user()->id;
    //     if ($brand_id == "") {
    //         $match = ['ff_id' => $ff_id, 'status' => '1'];
    //         $rx_entry = RxEntryModel::where($match);
    //     } else {
    //         $match = ['ff_id' => $ff_id, 'brand_id' => $brand_id, 'status' => '1'];
    //         $rx_entry = RxEntryModel::where($match);
    //     }
    //     $rx_entry = $rx_entry->with('doctors')->with('patient_type')->with('brands')->paginate(config('constants.PAGINATION_COUNT'));
    //     $object = new GeneralFunctionsController();
    //     $team_id = Auth::user()->team_id;
    //     $brands = TeamBrandsModel::with('brands')->where('team_id', $team_id)->get();
    //     $returnData = [
    //         'brand_list' => $brands,
    //         'rx_entry' => $rx_entry
    //     ];
    //     return $returnData;
    // }

    // public function create()
    // {
    //     $user_id = Auth::user()->id;
    //     $object = new GeneralFunctionsController();
    //     $team_id = Auth::user()->team_id;
    //     $indications = $object->get_indications();
    //     $brands = TeamBrandsModel::with('brands')->where('team_id', $team_id)->get(); // get only assigned brands for the team

    //     $doctors = DoctorsModel::join('ff_doctor', 'ff_doctor.doctor_id', '=', 'doctors.id')
    //         ->where('ff_doctor.ff_id', $user_id)
    //         ->orderBy('doctors.doctor_name')->get();

    //     //$doctors = collect(FfDoctorModel::with('doctors')->where('ff_id', $user_id)->get());
    //     $doctors = $doctors->unique('doctor_id');
    //     $doctors->all();
    //     // $speciality = $object->get_speciality();
    //     if ($team_id == '3') {
    //         $patient_type = PatientTypeModel::get();
    //     } else {
    //         $patient_type = PatientTypeModel::where('status', '1')->get();
    //     }
    //     if (Auth::user()->team_id == '2') {
    //         $dose = DoseModel::get();
    //     } else {
    //         $dose = 0;
    //     }
    //     return view('rx_entry/rx_entry_add', compact('brands', 'doctors', 'patient_type', 'indications', 'dose'));
    // }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();
    //     $team_id = $user->team_id;
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'institute_id'        => 'required',
    //             'ps_id'        => 'required',
    //             'po_date'        => 'required',
    //             'po_amount'        => 'required',
    //             'po_amountlakhs'        => 'required',
    //             'po_productdetails' => 'required'
    //         ]
    //     );
    //     if ($validator->fails()) {
    //         return \Redirect::back()->withErrors($validator)->withInput();
    //     } else {
    //         $po_details = new PoDetailsModel();
    //         $po_details->institute_id = $request->get('institute_id');
    //         $ps_id = $user->id;
    //         $po_details->ps_id = $ps_id;
    //         $po_details->po_date = $request->get('po_date');
    //         $po_details->po_amount = $request->get('po_amount');
    //         $po_details->po_amountlakhs = $request->get('po_amountlakhs');
    //         $po_save = $po_details->save();
    //         if ($po_save) {
    //             $productDetails = $request->get('po_productdetails');
    //             foreach ($productDetails->sku as $values) {
    //                 $po_productdetails = new PoProductDetailsModel();
    //                 $po_productdetails->po_id = $po_details->id;
    //                 $po_productdetails->sku_id = $values['sku_id'];
    //                 $po_productdetails->quantity = $values['quantity'];
    //                 $po_productdetails->price = $values['price'];
    //                 $po_productdetails->total = $values['total'];
    //                 $po_productdetails->total_lakhs = $values['total_lakhs'];
    //                 $po_productdetails->save();
    //             }
    //             \Session::flash('success', 'Po added successfully.');
    //             return redirect('/po_entries');
    //         } else {
    //             \Session::flash('error', 'Error adding Po.');
    //             return \Redirect::back();
    //         }
    //     }
    // }

    // public function show($id)
    // {
    //     $id = decrypt($id);
    //     $rx_entry = RxEntryModel::with('doctors')->with('patient_type')->with('brands')->where('id', $id)->first();
    //     $prescriptions = PrescriptionsModel::with('indications')->where('rx_id', $id)->first();
    //     $cycle = PrescriptionCycleModel::with('reasons')->where('rx_id', $id)->get();
    //     $returnData = [
    //         'rx_entry' => $rx_entry,
    //         'prescriptions' => $prescriptions,
    //         'cycle' => $cycle
    //     ];
    //     return view('rx_entry/rx_entry_detail_view', $returnData);
    // }

    // public function edit(Request $request, $id)
    // {
    //     $team_id = Auth::user()->team_id;
    //     $rx_entry  = RxEntryModel::where('id', decrypt($id))->first();
    //     $schedule = "";
    //     $scheduleList = "";
    //     if ($team_id != '3') {
    //         $schedule = PrescriptionsModel::join('brand_schedule', 'prescriptions.brand_id', '=', 'brand_schedule.brand_id')->where('rx_id', $rx_entry->id)->get();
    //         $schedule = $schedule[0]->schedule_name;
    //         $scheduleList = DB::table('brand_schedule')->where('brand_id', $rx_entry->brand_id)->get();
    //     }
    //     $prescriptions = PrescriptionsModel::with('indications')->where('rx_id', $rx_entry->id)->first();
    //     $indication_id = $prescriptions->indication_id;
    //     $sub_indications = SubIndicationsModel::where('indication_id', $indication_id)->get();
    //     //rj edit 27-06-20222
    //     $all_sub_sub_indication = SubSubIndicationsModel::get();
    //     $user = Auth::user();
    //     $user_id = $user->id;
    //     $team_id = $user->team_id;
    //     $brands = TeamBrandsModel::with('brands')->where('team_id', $team_id)->get(); // get only assigned brands for the team
    //     $doctors = collect(FfDoctorModel::with('doctors')->where('ff_id', $user_id)->get());
    //     $doctors = $doctors->unique('doctor_id');
    //     $doctors->all();
    //     // $speciality = MedicalSpecialityModel::get();
    //     // $object = new GeneralFunctionsController();
    //     $indications = IndicationsModel::where('brand_id', $rx_entry->brand_id)->get();
    //     if ($team_id == '3') {
    //         $patient_type = PatientTypeModel::get();
    //     } else {
    //         $patient_type = PatientTypeModel::where('status', '1')->get();
    //     }
    //     if (Auth::user()->team_id == '2') {
    //         $dose = DoseModel::where('brand_id', $rx_entry->brand_id)->get();
    //         if ($dose->count() > 0) {
    //             $dose = $dose;
    //         } else {
    //             $dose = 0;
    //         }
    //     } else {
    //         $dose = 0;
    //     }
    //     return view('rx_entry/rx_entry_edit', compact('id', 'rx_entry', 'prescriptions', 'brands', 'doctors', 'patient_type', 'indications', 'schedule', 'scheduleList', 'dose', 'sub_indications', 'all_sub_sub_indication'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $team_id = Auth::user()->team_id;
    //     if ($team_id != '3') {
    //         $validator = Validator::make(
    //             $request->all(),
    //             [
    //                 'brand_id'        => 'required',
    //                 'doctor_id'        => 'required',
    //                 'city_id'        => 'required',
    //                 'institute_id'        => 'required',
    //                 'speciality_id'        => 'required',
    //                 'patient_name'        => 'required',
    //                 'phone'        => 'required',
    //                 'contact_type'        => 'required',
    //                 'patient_type_id'        => 'required',
    //                 'indication_id'        => 'required',
    //                 'schedule'        => 'required',
    //                 'start_date'        => 'required',
    //                 'priscriber' => 'required'
    //             ]
    //         );
    //     } else {
    //         $validator = Validator::make(
    //             $request->all(),
    //             [
    //                 'brand_id'        => 'required',
    //                 'doctor_id'        => 'required',
    //                 'city_id'        => 'required',
    //                 'institute_id'        => 'required',
    //                 'speciality_id'        => 'required',
    //                 'patient_name'        => 'required',
    //                 'phone'        => 'required',
    //                 'contact_type'        => 'required',
    //                 'patient_type_id'        => 'required',
    //                 'indication_id'        => 'required',
    //                 'dose_value'        => 'required'
    //             ]
    //         );
    //     }
    //     $rx_id = decrypt($id);
    //     $prescription_id = $request->get('prescription_id');

    //     if ($validator->fails()) {
    //         return \Redirect::back()->withErrors($validator)->withInput();
    //     } else {
    //         $rx_entry  = RxEntryModel::where('id', $rx_id)->first();
    //         if ($rx_entry) {
    //             $rx_entry->brand_id = $request->get('brand_id');

    //             //Robin 14-09-22
    //             $user = Auth::user();
    //             $ff_id = $user->id;
    //             $prescriber = $request->get('priscriber');
    //             if ($prescriber == 0) {
    //                 $doctor_id = $request->get('new_doctor_id');
    //                 $city_name = $request->get('city_name');
    //                 $speciality_name = $request->get('speciality_name');
    //                 $institute_name = $request->get('institute_name');
    //                 $speciality = MedicalSpecialityModel::where('speciality', $speciality_name)->first();
    //                 if (!$speciality) {
    //                     $speciality = new MedicalSpecialityModel();
    //                     $speciality->speciality = $speciality_name;
    //                     $speciality->save();
    //                 }
    //                 $speciality_id = $speciality->id;

    //                 $institute = InstituteModel::where('institute_name', $institute_name)->first();
    //                 if (!$institute) {
    //                     $institute = new InstituteModel();
    //                     $institute->institute_name = $institute_name;
    //                     $institute->save();
    //                 }
    //                 $institute_id = $institute->id;

    //                 $doctor = new DoctorsModel();
    //                 $doctor->doctor_name = $doctor_id;
    //                 $doctor->city = $city_name;
    //                 $doctor->institute_id = $institute_id;
    //                 $doctor->speciality_id = $speciality_id;

    //                 $is_save = $doctor->save();
    //                 if ($is_save) {
    //                     $ff_doctor = new FfDoctorModel();
    //                     $ff_doctor->ff_id = $ff_id;
    //                     $ff_doctor->doctor_id = $doctor->id;
    //                     $ff_doctor->save();
    //                 }
    //                 $doctor_id = $doctor->id;
    //                 $city_id = $city_name;
    //             } else {

    //                 $doctor_id = $request->get('doctor_id');
    //                 $city_id = $request->get('city_id');
    //                 $speciality_id = $request->get('speciality_id');
    //                 $institute_id = $request->get('institute_id');
    //             }
    //             $rx_entry->doctor_id = $doctor_id;
    //             $rx_entry->city_id = $city_id;
    //             $rx_entry->speciality_id = $speciality_id;
    //             $rx_entry->institute_id = $institute_id;

    //             //       End
    //             $rx_entry->patient_name = $request->get('patient_name');
    //             $rx_entry->phone = $request->get('phone');
    //             $rx_entry->contact_type = $request->get('contact_type');
    //             $rx_entry->patient_type_id = $request->get('patient_type_id');
    //             if ($request->get('priscriber') == '0') {
    //                 $rx_entry->status = '0';
    //             } else {
    //                 $rx_entry->status = '1';
    //             }
    //             $is_saved = $rx_entry->save();
    //             if ($is_saved) {
    //                 $prescriptions  = PrescriptionsModel::where('id', $prescription_id)->first();
    //                 $prescriptions->rx_id = $rx_entry->id;
    //                 $prescriptions->brand_id = $request->get('brand_id');
    //                 $prescriptions->schedule = $request->get('schedule');
    //                 $prescriptions->schedule_name = $request->get('schedule_name');
    //                 // 10-06-2022
    //                 if ($team_id == '2') {
    //                     if ($request->get('dose_value_select') == 0) {
    //                         $dose_value_select = null;
    //                     } else {
    //                         $dose_value_select = $request->get('dose_value_select');
    //                     }
    //                     $prescriptions->dose_id_teamb = $dose_value_select;
    //                     $prescriptions->dose_value = $request->get('dose_value');
    //                 } else {
    //                     $prescriptions->dose_value = $request->get('dose_value');
    //                 }

    //                 // 15-06-2022  Rj
    //                 $prescriptions->indication_id = $request->get('indication_id');
    //                 if ($team_id != '3') {
    //                     $prescriptions->start_date = $request->get('start_date');
    //                     $prescriptions->end_date = $request->get('end_date');
    //                     $prescriptions->rx_copy_link = $request->get('rx_copy_link');
    //                     if (isset($request->rx_copy_link)) {
    //                         $imageName = $request->patient_name . '-' . time() . '.' . $request->rx_copy_link->extension();
    //                         $request->rx_copy_link->move(public_path('images/rx_prescriptions'), $imageName);
    //                         $prescriptions->rx_copy_link = $imageName;
    //                     }
    //                 } else {
    //                     $prescriptions->ir_name = $request->get('ir_name');
    //                     $prescriptions->nm_name = $request->get('nm_name');
    //                     $prescriptions->pvt_involvement = $request->get('pvt_involvement');
    //                     $prescriptions->bclc_stage_id = $request->get('bclc_stage_id');
    //                     $prescriptions->pugh_score_id = $request->get('pugh_score_id');
    //                     $prescriptions->liver_tumour_volume = $request->get('liver_tumour_volume');
    //                     $prescriptions->lung_shunt = $request->get('lung_shunt');
    //                     $prescriptions->dmode_id = $request->get('dmode_id');
    //                 }
    //                 if ($request->get('sub_indication_id') != '') {
    //                     $prescriptions->sub_indication_id = $request->get('sub_indication_id');
    //                     if (isset($request->sub_sub_indication_id)) {
    //                         $prescriptions->sub_sub_indication_id = $request->get('sub_sub_indication_id');
    //                     }
    //                 }

    //                 if ($request->get('ind_other') != '') {
    //                     $insert_ind_array = [
    //                         'name'      => $request->get('ind_other'),
    //                         'brand_id'  => $request->get('brand_id')
    //                     ];
    //                     $ind_sts = IndicationsModel::create($insert_ind_array);
    //                     $prescriptions->indication_id = $ind_sts->id;
    //                 }
    //                 if (isset($request->sub_indication_comment)) {
    //                     $prescriptions->sub_indication_comment = $request->get('sub_indication_comment');
    //                 }
    //                 if (!isset($request->sub_indication_comment)) {
    //                     $prescriptions->sub_indication_comment = '';
    //                 }
    //                 // if (isset($request->rx_copy_link)) { 
    //                 //  // dd($request->rx_copy_link->getClientOriginalName());
    //                 //     $imageName = $request->patient_name . '-' . time() . '.' . $request->rx_copy_link->getClientOriginalName();
    //                 //     dd($imageName);
    //                 //     $request->rx_copy_link->move(public_path('images/rx_prescriptions'), $imageName);
    //                 //     $prescriptions->rx_copy_link = $imageName;
    //                 // }
    //                 $is_prescription_save = $prescriptions->save();
    //                 if ($is_prescription_save) {
    //                     \Session::flash('success', 'RxEntry details updated successfully.');
    //                     return redirect('/rx_entries');
    //                 } else {
    //                     \Session::flash('error', 'Nothing to update');
    //                     return \Redirect::back();
    //                 }
    //             }
    //         }
    //     }
    // }

    // public function add_cycle_page($id)
    // {
    //     $object = new GeneralFunctionsController();
    //     $discontinue_reason = $object->get_reasons();
    //     $brand_id = RxEntryModel::where('id', decrypt($id))->first();
    //     $brand_ids = $brand_id->brand_id;
    //     $schedule_list = DB::table('brand_schedule')->where('brand_id', $brand_id->brand_id)->get();
    //     return view('rx_entry/rx_entry_cycle_add', compact('id', 'discontinue_reason', 'schedule_list', 'brand_ids'));
    // }

    // public function update_cycle(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'cycle_repeated'        => 'required',
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return \Redirect::back()->withErrors($validator)->withInput();
    //     } else {
    //         $team_id = Auth::user()->team_id;
    //         $rx_id = $request->get('rx_id');
    //         $cycle = PrescriptionCycleModel::where('rx_id', decrypt($rx_id))->latest()->first();
    //         if ($cycle) {
    //             $cycle_repeated = $request->get('cycle_repeated');
    //             if ($cycle_repeated == "yes") {
    //                 $cycle->cycle_repeated = 'yes';
    //                 $cycle_number = $cycle->cycle_number + 1;
    //                 $prescription_cycle = new PrescriptionCycleModel();
    //                 $prescription_cycle->rx_id = decrypt($rx_id);
    //                 $prescription_cycle->prescription_id = $cycle->prescription_id;
    //                 $prescription_cycle->rx_copy_link = $request->get('rx_copy_link');
    //                 if (isset($request->rx_copy_link)) {
    //                     $imageName = decrypt($rx_id) . '-' . time() . '.' . $request->rx_copy_link->extension();
    //                     $request->rx_copy_link->move(public_path('images/rx_prescriptions'), $imageName);
    //                     $prescription_cycle->rx_copy_link = $imageName;
    //                 }
    //                 $prescription_cycle->cycle_number = $cycle_number;

    //                 if ($team_id != '3') {
    //                     $prescription_cycle->start_date = $request->get('start_date');
    //                     $prescription_cycle->end_date = $request->get('end_date');
    //                     $prescription_cycle->schedule = $request->get('schedule');
    //                 }

    //                 $prescription_cycle->dose_value = $request->get('dose_value');
    //                 $prescription_cycle->brand_id = $request->get('brand_ids');
    //                 $prescription_cycle->cycle_repeated = 'yes';
    //                 $prescription_cycle->dose_unit = 'mg';
    //                 $ff_id = Auth::user()->id;
    //                 $prescription_cycle->ff_id = $ff_id;
    //                 $is_saved = $prescription_cycle->save();
    //             } else {
    //                 $cycle->cycle_repeated = 'no';
    //                 $cycle->reason_id = $request->get('reason_id');
    //                 $reason = $request->get('reason');
    //                 if ($reason) {
    //                     $cycle->reason = $reason;
    //                 }
    //             }
    //             $is_saved =  $cycle->save();
    //             if ($is_saved) {
    //                 \Session::flash('success', 'PrescriptionCycle Updated  successfully.');
    //                 return redirect('/rx_entries');
    //             } else {
    //                 \Session::flash('error', 'Error adding PrescriptionCycle.');
    //                 return \Redirect::back();
    //             }
    //         }
    //     }
    // }

    // public function fetch_brandwise_rx(Request $request)
    // {
    //     $brand_id = $request->get('brand_id');
    //     $returnData = $this->get_rx_details($brand_id);
    //     if ($request->ajax()) {
    //         if ($returnData) {
    //             return view('rx_entry/rx_entry_list_table', $returnData);
    //         } else {
    //             return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
    //         }
    //     } else {
    //         return view('rx_entry/rx_entry_list', $returnData);
    //     }
    // }
}
