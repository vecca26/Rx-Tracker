<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Doctors;
use App\Models\User;
use Validator;

class DoctorController extends Controller
{
    public $successStatus = 200;

   public function index(Request $request)
    {
        if($request->keyword)
        {
          $keyword = $request->keyword;
        }
        else
        {
           $keyword =''; 
        }
        $list   = Doctors::select('doctor_name','institute_name','speciality','doctors.id')
                  ->join('medical_speciality', 'doctors.speciality_id', '=', 'medical_speciality.id')
                  ->join('institute', 'doctors.institute_id', '=', 'institute.id')
                  ->where('doctor_name','LIKE',"%".$keyword."%")
                  ->paginate('10');
        $speciality_list = Doctors::specialityList();
        $city_list       = Doctors::cityList();
        $instituteList   = Doctors::instituteList();
            $ff_list     = User::select('id','first_name','last_name')
                          ->where('users.user_type','LIKE','ff')
                          ->get();
        $returnData = [
            'doctor_list'    => $list,
            'speciality'     => $speciality_list,
            'city_list'      => $city_list,
            'institute_list' => $instituteList,
            'ff_list'        => $ff_list
        ];
      
        return view('admin/doctor/admin-doctor-list',$returnData);
    }


    public function addDoctor(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_name'        => 'required',
                'city_select'        => 'required',
                'institute_select'   => 'required',
                'speciality_select'  => 'required',
            ]
        );
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
        $response = Doctors::AddDoctor($request);
        return redirect('/doctors')->with('status', 'Doctor Added!');
        }
    }

    public function updateDoctor(Request $request)
    {
       $updateArray = [
            'doctor_name'   => $request->doctor,
            'city'          => $request->city_selects,
            'speciality_id' => $request->speciality_selects,
            'institute_id'  => $request->institute_selects,
        ];

        $update_status = Doctors::where('id',$request->doc_id)->update($updateArray);
        if($update_status){
           return redirect('/doctors')->with('status', 'Doctor Data Updated!');
        }
        else{
            return redirect('/doctors')->with('status', 'Something went wrong!');
        }
    }
    
    public function delete_doctor_data(Request $request){
        $delete_status = Doctors::deleteDoctor($request->doctor_id);
        if($delete_status == true){
             return response()->json(['success' => 1, 'message' => 'success', 'data' => $delete_status], $this->successStatus);
        }
        else{
            return response()->json(['success' => 0, 'message' => 'success', 'data' => $delete_status]);
        }
    }

    public function fetch_doctor_data(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try 
        {
            
        $list     = Doctors::select('doctor_name','institute_name','speciality','doctors.id','city','institute_id','speciality_id')
                           ->join('medical_speciality', 'doctors.speciality_id', '=', 'medical_speciality.id')
                  ->join('institute', 'doctors.institute_id', '=', 'institute.id')
                  ->where('doctors.id','=',$request->doctor_id)->get();
        $speciality_list = Doctors::specialityList();
        $city_list       = Doctors::cityList();
        $instituteList   = Doctors::instituteList();
        $returnData = [
            'doctor_list'   => $list,
            'speciality'    => $speciality_list,
            'city_list'     => $city_list,
            'institute_list'=> $instituteList
        ];//echo "<pre>";print_r($list);exit;
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }
}
