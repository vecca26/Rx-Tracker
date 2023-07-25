<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BrandScheduleModel extends Model
{
	protected $table = 'brand_schedule';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'brand_id',
		'schedule',
		'created_at',
		'updated_at',
		'number_of_days',
	];
}