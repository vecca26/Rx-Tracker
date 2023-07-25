<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Region;
use App\Models\User;
use App\Models\ProfessionalDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegionalManagerController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
   { 
	if(!isset($request->keyword))
	{
		$keyword ='';
	}
	else{
        $keyword= $request->keyword;
	}
    $region_list = DB::table('region')->get();
	$list        = DB::table('hq')->get();
    $teams       = DB::table('teams')->get();
    $userData    = DB::table('users')
                    ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                    ->join('teams', 'teams.id', '=', 'professional_details.team_id')
                    ->where('users.user_type','=',"zsm")
                    ->where('users.first_name','LIKE',"%".$keyword."%")
                    ->paginate('10');
	$returnData = [
            'region_list' => $region_list,
            'userData'    => $userData,
            'hq_list'      => $list,
            'teams'        => $teams
        ];
    return view('admin/regional_managers/admin_regional_managers',$returnData);
    }
    public function addRegion(Request $request)
	{
		$regionData = DB::table('zones')
                      ->where('zone','LIKE',"%".$request->region."%")
                      ->get();
         
		$insert_array = [
            'zone'   => $request->region
            
             ];
	    $sts = Zones::create($insert_array);
	    return redirect('/regional_manager')->with('status', 'Region Added!');
	   
	}
	public function addRegionalManager(Request $request)
    { 
	$status = ProfessionalDetails::ProfessionalDetails($request,'zsm'); 
	if($status->id!='')
	{
    return redirect('/regional_manager')->with('status', 'Regional manager Added!');
    }
    else
    {
     return redirect('/regional_manager')->with('status', 'Something went wrong!');
    }
 
    }
    public function fetch_regional_manager_data(Request $request)
    {
        try 
        {   
        $userData = DB::table('users')
                    ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                    ->join('teams', 'teams.id', '=', 'professional_details.team_id')
                    ->join('region', 'region.id', '=', 'professional_details.region_id')
                    ->where('users.id','LIKE',"%".$request->user_id."%")
                    ->get();
        $region_list = DB::table('region')->get();
        $list = DB::table('hq')->get();
        $teams = DB::table('teams')->get();
        $returnData = [
            'region_list' => $region_list,
            'userData'    => $userData,
            'hq_list'     => $list,
            'teams'       => $teams
        ];
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
        } catch (Exception $ex) {
            return response()->json(['success' => 0, 'message' => $ex->getMessage()], $this->successStatus);
        }
    }
     public function create()
    {
        $region_list = DB::table('region')->get();
        $list = DB::table('hq')->get();
        $teams = DB::table('teams')->get();
        $returnData = [
            'region_list' => $region_list,
            'hq_list'     => $list,
            'teams'       => $teams];
      return view('admin/regional_managers/zsm_add',$returnData);
      }
      public function show($id)
    {
        $id       = decrypt($id);
        $userData = DB::table('users')
                    ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                    ->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
                    ->join('teams', 'teams.id', '=', 'professional_details.team_id')
                    ->join('region', 'region.id', '=', 'professional_details.region_id')
                    ->where('users.id','LIKE',"%".$id."%")
                    ->get();
        $returnData = [
            'userData'    => $userData
        ];
       return view('admin/regional_managers/zsm_view',$returnData);
    }
    public function regional__manager_update(Request $request){
        
       $updateArray = [
            'first_name'   => $request->first_names,
            'last_name'    => $request->last_names,
            'email'        => $request->emails,
            'phone'        => $request->phones,
        ];

        $update_status = User::where('id',$request->user_id)->update($updateArray);
        $professionalArray= [
            'region_id'    =>$request->region_selects,
            'hq_ids'       =>$request->hq_selects,
         ];
        $update_brand_status = ProfessionalDetails::where('user_id',$request->user_id)->update($professionalArray);
        if($update_status){
           return redirect('/regional_manager')->with('status', 'Regional manager Data Updated!');
        }
        else{
            return redirect('/regional_manager')->with('status', 'Something went wrong!');
        }
        
    }
    public function store(Request $request)
{
     $validator = Validator::make(
            $request->all(),
            [
                'first_name'    => 'required|min:2|max:30',
                'last_name'     => 'required|min:1|max:30',
                'employee_id'    => 'required|unique:users',
                'email'         => 'required|min:6|max:50|unique:users',
                'phone'         => 'required|min:6|max:20',
                'password'      => 'required|min:2|max:30',
                'team_select'   => 'required',
                'region_select' => 'required',
                'hq_select'     => 'required',
                'team_select'   => 'required'
            ]
        );

    if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } 
    else
    {
    $status = ProfessionalDetails::ProfessionalDetails($request,'zsm'); 
    if($status->id!='')
    {
    return redirect('/regional_manager')->with('status', 'Regional manager Added!');
    }
    else
    {
     return redirect('/regional_manager')->with('status', 'Something went wrong!');
    }
    }
}
}