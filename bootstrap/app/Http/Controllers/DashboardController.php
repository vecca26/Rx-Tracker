<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralFunctionsController;
use App\Http\Controllers\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RxEntryModel;
use App\Models\User;
use App\Models\Brands;
use App\Models\ProfessionalDetails;
use App\Models\TeamsBrands;

class DashboardController extends Controller
{
    public $successStatus = 200;
   
    public function index()
    { 
    
    $user = Auth::user();
    $user_type = $user->user_type;
    $object = new GeneralFunctionsController();
    $returnData = $object->quickview('default');
    return view('analytics');
    }
    public function search(Request $request)
    { 

    }
   public function user_selected_details(Request $request)
    { 
        if($request->type=="zsm_list")
        {
            $match = ['professional_details.team_id' => $request->team_id, 'user_type' => 'zsm']; 
        }
        else if($request->type=="bdm_list")
        {
            $match = ['professional_details.zsm_id' => $request->zsm_id, 'user_type' => 'bdm']; 
        }
        else if($request->type=="ff_list")
        {
            $match = ['professional_details.bdm_id' => $request->bdm_id, 'user_type' => 'ff']; 
        }
      $user_list = User::join('professional_details', 'users.id', '=', 'professional_details.user_id')->where($match)->get();
         $returnData = [
            'user_list' => $user_list
        ];
     return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
   public function ff_brands(Request $request)
    { 
        $team_id = TeamsBrands::select('brand_id')->where('team_id','=',$request->team_id)->get();
        $brands = Brands::wherein('id',$team_id)->get();
        $returnData = [
            'brand_list' => $brands
        ];
     return response()->json(['success' => 1, 'message' => 'success', 'data' => $returnData], $this->successStatus);
    }
}
