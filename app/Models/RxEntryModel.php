<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RxEntryModel extends Model
{
	protected $table = 'rx_entry';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'ff_id',
		'brand_id',
		'doctor_id',
		'patient_name',
		'phone',
		'contact_type',
		'patient_type_id',
		'prescriber',
		'status',
		'created_at',
		'updated_at',
		'speciality_id',
		'city_id',
		'institute_id',
	];
	public function brands()
	{
		return $this->belongsTo('App\Models\BrandsModel', 'brand_id', 'id');
	}

	// public function city()
	// {
	// 	return $this->belongsTo('App\Models\CityModel', 'city_id', 'id');
	// }

	public function doctors()
	{
		return $this->belongsTo('App\Models\DoctorsModel', 'doctor_id', 'id');
	}

	public function users()
	{
		return $this->belongsTo('App\Models\UsersModel', 'ff_id', 'id');
	}

	// public function institute()
	// {
	// 	return $this->belongsTo('App\Models\InstituteModel', 'institute_id', 'id');
	// }

	public function patient_type()
	{
		return $this->belongsTo('App\Models\PatientTypeModel', 'patient_type_id', 'id');
	}

	// public function medical_speciality()
	// {
	// 	return $this->belongsTo('App\Models\MedicalSpecialityModel', 'speciality_id', 'id');
	// }
}
