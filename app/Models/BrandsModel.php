<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BrandsModel extends Model
{
	protected $table = 'brands';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'brand_name',
		'status',
		'created_at',
		'updated_at',
	];
}