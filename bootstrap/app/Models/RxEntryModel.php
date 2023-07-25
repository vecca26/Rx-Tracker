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
		'status',
		'created_at',
		'updated_at',
		'speciality_id',
		'city_id',
		'institute_id',
	];

}