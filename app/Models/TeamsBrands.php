<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamsBrands extends Model
{
	protected $table = 'team_brands';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'team_id',
		'brand_id',
		'created_at',
		'updated_at',
	];
}