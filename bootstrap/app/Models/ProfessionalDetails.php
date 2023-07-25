<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\Region;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;

class ProfessionalDetails extends Model
{

	protected $table = 'professional_details';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'user_id',
		'brand_id',
		'regional_manager_id',
		'zsm_id',
		'bdm_id',
		'area_manager_id',
		'region_id',
		'hq_ids',
		'team_id',
		'profile_img',
		'created_at',
		'updated_at',
	];
	public static function ProfessionalDetails($request, $type)
	{
		$insert_array = [
			'first_name'   => $request->first_name,
			'last_name'    => $request->last_name,
			'email'        => $request->email,
			'password'     => Hash::make($request->password),
			'phone'        => $request->phone,
			'employee_id'  => $request->employee_id,
			'user_type'    => $type,
			'team_id'      => $request->team_select
		];
		$sts = User::create($insert_array);
		if ($type == 'zsm') {
			$insert_manager_array = [
				'user_id'      => $sts->id,
				'team_id'      => $request->team_select,
				'region_id'    => $request->region_select,
				'hq_ids'       => $request->hq_select,
				'brand_id'     => $request->brand_select
			];
		} else if ($type == 'brand_manager') {
			$insert_manager_array = [
				'user_id'     => $sts->id,
				'brand_id'    => $request->brand_select
			];
		} else if ($type == 'bdm') {
			$insert_manager_array = [
				'user_id'      => $sts->id,
				'team_id'      => $request->team_select,
				'region_id'    => $request->region_select,
				'hq_ids'       => $request->hq_select,
				'zsm_id'       => $request->zsm_select
			];
		}

		$professional_sts = self::create($insert_manager_array);
		return $professional_sts;
	}
	public static function Bdm_data($request, $type)
	{
		$region_list = DB::table('region')->get();
		$list = DB::table('hq')->get();
		$zsm_list = DB::table('users')
			->select('id', 'first_name', 'last_name')
			->where('users.user_type', 'LIKE', 'zsm')
			->get();
		$teams = DB::table('teams')->get();
		if ($type == 'fetch') {
			$cond = 'users.id';
			$keyword = $request;
			$userData = DB::table('users')
				->join('professional_details', 'users.id', '=', 'professional_details.user_id')
				->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
				->join('teams', 'teams.id', '=', 'professional_details.team_id')
				->join('region', 'region.id', '=', 'professional_details.region_id')
				->where($cond, 'LIKE', "%" . $keyword . "%")
				->get();
		} else if ($type == 'list') {
			$cond = 'users.user_type';
			$keyword = 'bdm';
			$userData = DB::table('users')
				->join('professional_details', 'users.id', '=', 'professional_details.user_id')
				->join('hq', 'hq.id', '=', 'professional_details.hq_ids')
				->join('teams', 'teams.id', '=', 'professional_details.team_id')
				->join('region', 'region.id', '=', 'professional_details.region_id')
				->where($cond, 'LIKE', "%" . $keyword . "%")
				->paginate('10');
		}

		if (isset($userData[0])) {
			$zsm_name =    DB::table('users')
				->select('first_name', 'last_name')
				->where('users.id', 'LIKE', "%" . $userData[0]->zsm_id . "%")
				->get();
		} else {
			$zsm_name = '';
		}

		$returnData = [
			'region_list'  => $region_list,
			'regions'      => $region_list,
			'userData'     => $userData,
			'hq_list'      => $list,
			'teams'        => $teams,
			'zsm_list'	   => $zsm_list,
			'zsm_name'     => $zsm_name,
		];
		return $returnData;
	}
}
