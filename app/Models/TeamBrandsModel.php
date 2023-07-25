<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamBrandsModel extends Model
{
	protected $table = 'team_brands';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'team_id',
		'brand_id',
		'created_at',
		'updated_at',
	];
	public function brands()
	{
		return $this->belongsTo('App\Models\BrandsModel', 'brand_id', 'id');
	}

	public function teams()
	{
		return $this->belongsTo('App\Models\TeamsModel', 'team_id', 'id');
	}
}
