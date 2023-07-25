<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RegionModel extends Model
{
	protected $table = 'region';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'region',
		'created_at',
		'updated_at',
	];
}