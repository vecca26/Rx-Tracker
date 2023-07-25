<?php

namespace App\Http\Controllers;

use App\Models\DoctorsModel;
use Illuminate\Http\Request;
use Validator;

class DoctorsController extends Controller
{
    public $successStatus = 200;

    public function fetch_doctor_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
        ]);
        if ($validator->fails()) {


            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $doctor_id = $request->get('doctor_id');
            $institute_city = DoctorsModel::where('id', $doctor_id)->get();

            //   $indications = IndicationsModel::where('brand_id',$brand_id)->get();
            if ($institute_city) {
                return response()->json(['success' => 1, 'message' => 'success', 'data' => $institute_city], $this->successStatus);
            } else {
                return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }
}
