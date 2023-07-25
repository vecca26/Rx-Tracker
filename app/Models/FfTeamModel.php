<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FfTeamModel extends Model
{
	protected $table = 'ff_team';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'team_id',
		'ff_id',
		'created_at',
		'updated_at',
	];
}