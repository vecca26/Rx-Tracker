<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoInstitutesModel extends Model
{
	protected $table = 'po_institutes';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'institute_name',
		'city',
		'institute_type',
		'ps_id',
		'status',
		'created_at',
		'modified_at'
	];
	public function users()
	{
		return $this->belongsTo('App\Models\UsersModel', 'ps_id', 'id');
	}
};
