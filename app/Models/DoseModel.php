<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DoseModel extends Model
{
	protected $table = 'dose';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'value',
	];
}