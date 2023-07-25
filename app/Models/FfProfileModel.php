<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FfProfileModel extends Model
{
	protected $table = 'ff_profile';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'user_id',
		'profile_pic',
		'address',
		'description',
		'created_at',
		'updated_at',
		'team_id',
	];
public function teams() {
return $this->belongsTo('App\Models\TeamsModel','team_id','id');
}

public function users() {
return $this->belongsTo('App\Models\UsersModel','user_id','id');
}

}