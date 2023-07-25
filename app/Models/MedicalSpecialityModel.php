<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MedicalSpecialityModel extends Model
{
	protected $table = 'medical_speciality';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'speciality',
		'created_at',
		'updated_at',
	];
}