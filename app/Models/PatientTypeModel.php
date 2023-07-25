<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PatientTypeModel extends Model
{
	protected $table = 'patient_types';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];
}