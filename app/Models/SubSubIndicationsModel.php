<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SubSubIndicationsModel extends Model
{
	protected $table = 'sub_sub_indications';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'sub_indications_id',
		'name',
	];
}