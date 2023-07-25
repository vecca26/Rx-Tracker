<?php

namespace App\Http\Controllers;

use App\Models\IndicationsModel;
use App\Models\Brands;
use App\Models\DoseModel;
use App\Models\SubIndicationsModel;
use App\Models\SubSubIndicationsModel;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class IndicationsController extends Controller
{
    public $successStatus = 200;

    public function fetch_indications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $brand_id = $request->get('brand_id');
            $indications = IndicationsModel::where('brand_id', $brand_id)->get();
            $dose_unit = Brands::select('dose_unit')->where('id', $brand_id)->first();
            $schedule_list = DB::table('brand_schedule')->where('brand_id', $brand_id)->get();
            // Rj Work 20-06-2022
            $dose_for_teamb = DoseModel::where('brand_id', $brand_id)->get();

            $returnData = [
                'indications' => $indications,
                'dose_unit'   => $dose_unit->dose_unit,
                'schedule_list' => $schedule_list,
                'doses' => $dose_for_teamb
            ];

            if ($indications) {
                return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
            } else {
                return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }

    public function fetch_sub_indications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indication_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $indication_id = $request->get('indication_id');
            $sub_indications = SubIndicationsModel::where('indication_id', $indication_id)->orderBy('id', 'ASC')->get();

            $returnData = [
                'sub_indications' => $sub_indications,
            ];
            if ($sub_indications) {
                return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
            } else {
                return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }

    public function fetch_sub_sub_indications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_indication_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try {
            $sub_indication_id = $request->get('sub_indication_id');
            $match = ['id' => $sub_indication_id, 'is_comment' => '1'];
            $sub_indication_comment = SubIndicationsModel::where($match)->first();
          
            if($sub_indication_comment)
            {
                return response()->json(['success' => 2, 'message' => 'success'], $this->successStatus);
            }
            $sub_sub_indications = SubSubIndicationsModel::where('sub_indications_id', $sub_indication_id)->orderBy('id', 'ASC')->get();
            $returnData = [
                'sub_sub_indications' => $sub_sub_indications,
            ];
            if ($sub_sub_indications->count() > 0) {
                return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
            } else {
                return response()->json(['success' => 0, 'message' => 'No data found'], $this->successStatus);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }
}
