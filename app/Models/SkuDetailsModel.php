<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkuDetailsModel extends Model
{
	protected $table = 'sku_details';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'brand_name',
		'pts',
		'team_id',
		'status',
		'created_at',
		'modified_at'
	];
	public function teams()
	{
		return $this->belongsTo('App\Models\TeamsModel', 'team_id', 'id');
	}
}
