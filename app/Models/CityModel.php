<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CityModel extends Model
{
	protected $table = 'city';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'city',
		'state_id',
		'created_at',
		'updated_at',
	];
public function state() {
return $this->belongsTo('App\Models\StateModel','state_id','id');
}

}