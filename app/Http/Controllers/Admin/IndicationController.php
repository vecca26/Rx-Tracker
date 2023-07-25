<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\IndicationsModel;
use App\Models\SubIndicationsModel;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class IndicationController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
          $indications = IndicationsModel::get();
          $brands =Brands::get();
          $returnData =[
                    'indications' =>$indications,
                    'brands' => $brands
          ];
          return view('admin/indications/indications',$returnData);
          
    }
     public function store(Request $request)
  { 
    
     $validator = Validator::make(
            $request->all(),
            [
                'brandSelect'    => 'required',
                'indication'     => 'required'
            ]
        );

    if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } 
        else
        {
            if($request->subindications[0]!='')
            {
               $stss   = '1';
            }
            else{
                $stss   = '0';
            } 
            $insert_array = [
            'brand_id'  => $request->brandSelect,
            'name'      => $request->indication,
            'is_subindication' =>$stss
        ];
        $sts = IndicationsModel::create($insert_array);
        $subind = [];
        if($request->subindications[0]!='')
        { 
                foreach ($request->subindications as $subind) {
                 $insert_subindications = [
                    'indication_id'        => $sts->id,
                    'sub_indication'       => $subind
                    ];
                 $status = SubIndicationsModel::create($insert_subindications);
                // $subind[] = $statSubIndicationsModelus->id;
                  
                }
            
        }
      
     return redirect('/indications')->with('status', 'indications added!');
   

        }
   }
    public function delete_indication(Request $request)
  { 
    $delete_status = IndicationsModel::where('id', ($request->id))->delete();
    $delete_subindicTion = SubIndicationsModel::where('indication_id', ($request->id))->delete();
        if($delete_status==1){
            return response()->json(['success' => 1, 'message' => 'success', 'data' => $delete_status], $this->successStatus);
        }
        else{
            return response()->json(['success' => 0, 'message' => 'success']);
        }
  }

}
