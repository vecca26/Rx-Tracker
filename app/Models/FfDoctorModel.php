<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FfDoctorModel extends Model
{
	protected $table = 'ff_doctor';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'ff_id',
		'doctor_id',
		'created_at',
		'updated_at',
	];
public function doctors() {
return $this->belongsTo('App\Models\DoctorsModel','doctor_id','id');
}

public function users() {
return $this->belongsTo('App\Models\UsersModel','ff_id','id');
}

}