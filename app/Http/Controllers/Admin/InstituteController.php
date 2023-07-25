<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\InstituteModel;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InstituteController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
          $institute = InstituteModel::get();
          $returnData =[
                    'institute' =>$institute
          ];
          return view('admin/institute/institute',$returnData);
          
    }
     public function store(Request $request)
  { 
    
     $validator = Validator::make(
            $request->all(),
            [
                'institute'    => 'required'
            ]
        );

    if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } 
        else
        {
           
            $insert_array = [
            'institute_name'  => $request->institute,
            'institute_type'  => $request->institute_type
        ];
        $sts = InstituteModel::create($insert_array);
      
      
     return redirect('/institute')->with('status', 'institute added!');
   

        }
   }
   public function delete_institute(Request $request)
  { 
    $delete_status = InstituteModel::where('id', ($request->id))->delete();
        if($delete_status==1){
            return response()->json(['success' => 1, 'message' => 'success', 'data' => $delete_status], $this->successStatus);
        }
        else{
            return response()->json(['success' => 0, 'message' => 'success']);
        }
  }
 
}
