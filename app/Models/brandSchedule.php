<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class brandSchedule extends Model
{
	protected $table = 'brand_schedule';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'created_at',
		'updated_at',
		'brand_id',
		'schedule',
		'number_of_days'
	];
public function brands() {
return $this->belongsTo('App\Models\BrandsModel','brand_id','id');
}

}