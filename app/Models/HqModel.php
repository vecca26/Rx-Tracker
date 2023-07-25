<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HqModel extends Model
{
	protected $table = 'hq';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'hq',
		'created_at',
		'updated_at',
	];
}