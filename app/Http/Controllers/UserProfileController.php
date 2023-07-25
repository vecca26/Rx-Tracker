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
        $user = DB::table('users')->leftJoin('professional_details', 'professional_details.user_id', '=', 'users.id')->where('users.id', $user_id)->first();
        $team = TeamsModel::where('id', $team_id)->first();
        return view('profile/profile_list', compact('user','team'));
    }

    public function edit(Request $request,$id)
    {
        $id = Auth::user()->id;
        $user = DB::table('users')->leftJoin('ff_profile', 'ff_profile.user_id', '=', 'users.id')->where('users.id', $id)->first();
        return view('profile/profile_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        } else {
        }
        
        $user = Auth::user();
        $user_id = $user->id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $issave = $user->save();
        if ($issave) {
            $profile = FfProfile::where('user_id', $user_id)->first();
            if (!$profile) {
                $profile = new FfProfile();
                $profile->user_id = $user_id;
            }
            if (isset($request->profile_pic)) {
                $imageName = $request->first_name . '-' . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path('images/profile_pc'), $imageName);
                $profile->profile_pic = $imageName;
            }

            $profile->address = $request->location;
            $profile->description = $request->description;
            $profile->save();
            \Session::flash('success', 'Profile details updated successfully.');
            return redirect('profile');
        }
    }
}
