<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamsModel extends Model
{
	protected $table = 'teams';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'team',
		'status',
		'created_at',
		'updated_at',
	];
}