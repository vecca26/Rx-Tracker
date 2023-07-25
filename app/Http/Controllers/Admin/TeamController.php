<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Teams;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $team_listing = array();
        $team_list    = DB::table('teams')->get();
        if ($user->user_type == 'zsm') {
            $team_list = $team_list->where('id', '=', $user->team_id);
        }
        $team_listing = json_decode(json_encode($team_list), true);
        foreach ($team_listing as $key => $value) {

            if ($user->user_type == 'zsm') {
                $team_listing[$key]['member_count'] = DB::table('professional_details')
                    ->where('team_id', "=", $value['id'])
                    ->where('zsm_id', '=', $user->id)
                    ->count();
            } else {
                $team_listing[$key]['member_count'] = DB::table('professional_details')
                    ->where('team_id', "=", $value['id'])
                    ->count();
            }
            $team_listing[$key]['brand_count'] = DB::table('team_brands')
                ->where('team_id', "=", $value['id'])
                ->count();
        }
        $team_listing = json_decode(json_encode($team_listing), FALSE);
        $returnData = [
            'team_list' => $team_listing
        ];
        return view('admin/teams/admin-team-listing', $returnData);
    }
    public function searchTeams(Request $request)
    {
        $date  = explode('-', $request->daterange);
        $date1 = strtotime($date[0]);
        $date1 = date("Y-m-d", $date1);
        $date2 = strtotime($date[1]);
        $date2 = date("Y-m-d", $date2);
        $userData = DB::table('teams')
            ->join('professional_details', 'professional_details.team_id', '=', 'teams.id')
            ->join('users', 'users.id', '=', 'professional_details.user_id')
            ->where('professional_details.team_id', "=", $request->team_id)
            ->where('users.first_name', 'LIKE', "%" . $request->keyword . "%")
            ->orwhere('users.last_name', 'LIKE', "%" . $request->keyword . "%")
            ->whereBetween('users.created_at', [$date1, $date2])
            ->paginate(10);
        $returnData = [
            'userData'   => $userData,
            'search_id'  => $request->team_id
        ];
        return view('admin/teams/admin-team-details', $returnData);
    }
    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $id       = decrypt($id);
        if ($user->user_type == 'zsm') {
            $userData = DB::table('users')
                ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
                ->where('users.team_id', '=', $id)
                ->where('professional_details.zsm_id', '=', $user->id)
                ->paginate('10');
            $returnData = [
                'userData'   => $userData,
                'search_id'  => $id
            ];
        } else {
            $userData = Teams::join('professional_details', 'professional_details.team_id', '=', 'teams.id')
                ->join('users', 'users.id', '=', 'professional_details.user_id')
                ->where('teams.id', "=", $id)
                ->paginate('10');
            $returnData = [
                'userData'   => $userData,
                'search_id'  => $id
            ];
        }
        return view('admin/teams/admin-team-details', $returnData);
    }
    public function show($id)
    {
        $id       = decrypt($id);
        $userData = DB::table('users')
            ->join('professional_details', 'users.id', '=', 'professional_details.user_id')
            ->where('users.id', '=', $id)
            ->get();
        $returnData = [
            'id'         => $id,
            'userData'   => $userData
        ];
        return view('admin/teams/teams_view', $returnData);
    }
}
