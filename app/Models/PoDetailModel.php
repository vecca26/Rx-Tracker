<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoDetailModel extends Model
{
	protected $table = 'po_details';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'institute_id',
		'ps_id',
		'po_date',
		'po_amount',
		'po_amountlakhs',
		'status',
		'created_at',
		'modified_at'
	];
	public function users()
	{
		return $this->belongsTo('App\Models\UsersModel', 'ps_id', 'id');
	}
	public function PoInstitutes()
	{
		return $this->belongsTo('App\Models\PoInstitutesModel', 'institute_id', 'id');
	}

};
