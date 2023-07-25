<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InstituteModel extends Model
{
	protected $table = 'institute';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'institute_name',
		'description',
		'created_at',
		'updated_at',
		'institute_type',
	];
}