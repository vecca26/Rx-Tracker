<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorsModel extends Model
{
	protected $table = 'doctors';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'doctor_name',
		'speciality',
		'institute',
		'status',
		'created_at',
		'updated_at',
		'city',
		'institute_type',
		'institute_id',
		'speciality_id',
	];
	// public function institute()
	// {
	// 	return $this->belongsTo('App\Models\InstituteModel', 'institute_id', 'id');
	// }

	public function city()
	{
		return $this->belongsTo('App\Models\CityModel', 'city_id', 'id');
	}

	// public function medical_speciality()
	// {
	// 	return $this->belongsTo('App\Models\MedicalSpecialityModel', 'speciality_id', 'id');
	// }
}
