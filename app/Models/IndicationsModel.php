<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class IndicationsModel extends Model
{
	protected $table = 'indications';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'created_at',
		'updated_at',
		'brand_id',
		'name',
		'description',
		'is_subindication'
	];
public function brands() {
return $this->belongsTo('App\Models\BrandsModel','brand_id','id');
}

}