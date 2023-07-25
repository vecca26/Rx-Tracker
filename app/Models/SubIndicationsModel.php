<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SubIndicationsModel extends Model
{
	protected $table = 'sub_indications';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'indication_id',
		'sub_indication',
		'created_at',
		'updated_at',
	];
}