<?php

namespace App\Http\Controllers;

use App\Models\FfProfile;
use App\Models\TeamsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $team_id = Auth::user()->team_id;
        $user = DB::table('users')->leftJoin('professional_details', 'professional_details.user_id', '=', 'users.id')->where('users.id', $user_id)->first();//echo "<pre>";print_r($user->first_name);exit;
        $team = TeamsModel::where('id', $team_id)->first();
        $returnData = [
            'name' => $user->first_name,
            'team'   => $team_id 
        ];
    return view('profile',$returnData);
    }

    
}
