<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Brands;
use App\Models\User;
use App\Models\ProfessionalDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BrandManagerController extends Controller
{
    public $successStatus = 200;

public function index(Request $request)
{ 
	if($request->keyword)
	{
		$keyword= $request->keyword;
	}
	else
    {
        $keyword ='';
      
	}
	$list = Brands::getBrandList();
   
    $userData       = User::join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('brands', 'brands.id', '=', 'professional_details.brand_id')
                    ->where('users.user_type','LIKE','brand_manager')
                    ->where('users.first_name','LIKE',"%".$keyword."%")
                    ->orwhere('users.last_name','LIKE',"%".$keyword."%")
                    ->orwhere('brands.brand_name','LIKE',"%".$keyword."%")
                    ->paginate('10');
	$returnData = [
            'brand_list' => $list,
            'userData'   => $userData 
        ];
    return view('admin/brand_managers/admin_brand_managers',$returnData);
}

public function store(Request $request)
{
     $validator = Validator::make(
            $request->all(),
            [
                'first_name'    => 'required|min:2|max:30',
                'last_name'     => 'required|min:1|max:30',
                'employee_id'    =>'required|unique:users',
                'email'         => 'required|min:6|max:50|unique:users',
                'phone'         => 'required|min:6|max:13',
                'password'      => 'required|min:2|max:30',
                'brand_select'  => 'required'
            ]
        );

    if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } 
    else
    {
     $status = ProfessionalDetails::ProfessionalDetails($request,'brand_manager'); 
        if($status->id!='')
        {
        return redirect('/brand_manager')->with('status', 'Brand manager Added!');
        }
        else
        {
         return redirect('/brand_manager')->with('status', 'Something went wrong!');
        }
    }
}
public function delete_manager(Request $request){ 
	
	$delete_status = User::where('id', ($request->user_id))->delete();
	    if($delete_status==1){
            return response()->json(['success' => 1, 'message' => 'success', 'data' => $delete_status], $this->successStatus);
        }
        else{
            return response()->json(['success' => 0, 'message' => 'success']);
        }
      
    }
public function fetch_brand_manager_data(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'message' => $validator->messages()->first()], $this->successStatus);
        }
        try 
        {
           
        $list = Brands::getBrandList();
        $userData = DB::table('users')
                    ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('brands', 'brands.id', '=', 'professional_details.brand_id')
                    ->where('users.id','LIKE',"%".$request->user_id."%")
                    ->get();
        $returnData = [
            'brand_list' => $list,
            'userData'   => $userData 
        ];
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }
   
    public function show($id)
    {
        $id       = decrypt($id);
        $list     = Brands::getBrandList();
        $userData = DB::table('users')
                    ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('brands', 'brands.id', '=', 'professional_details.brand_id')
                    ->where('users.id','LIKE',"%".$id."%")
                    ->get();
        $returnData = [
            'id'         => $id,
            'brand_list' => $list,
            'userData'   => $userData 
        ];
       return view('admin/brand_managers/brand_manager_view',$returnData);
    }
    public function edit(Request $request, $id)
    {     
        $id       = decrypt($id);
        $list     = Brands::getBrandList();
        $userData = DB::table('users')
                    ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('brands', 'brands.id', '=', 'professional_details.brand_id')
                    ->where('users.id','LIKE',"%".$id."%")
                    ->get();
        $returnData = [
            'id'         => $id,
            'brand_list' => $list,
            'userData'   => $userData 
        ];
       return view('admin/brand_managers/brand_manager_edit',$returnData);
    }
    public function create()
    {
        $list     = Brands::getBrandList();
        $returnData = [
            'brand_list'         => $list];
      return view('admin/brand_managers/brand_manager_add',$returnData);
      }
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_names'    => 'required',
                'last_names'     => 'required',
                'emails'         => 'required',
                'phones'         => 'required'
            ]
        );

    if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } 
    else
    {
        $updateArray = [
            'first_name'   => $request->first_names,
            'last_name'    => $request->last_names,
            'email'        => $request->emails,
            'phone'        => $request->phones,
        ];

        $update_status = User::where('id',$request->user_id)->update($updateArray);
        $brandArray= ['brand_id'    =>$request->brand_selects ];
        $update_brand_status = ProfessionalDetails::where('user_id',$request->user_id)->update($brandArray);
        if($update_status){
           return redirect('/brand_manager')->with('status', 'Brand manager Data Updated!');
        }
        else{
            return redirect('/brand_manager')->with('status', 'Something went wrong!');
        }
    }
    }
}
