<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class NotificationsModel extends Model
{
	protected $table = 'notifications';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'user_id',
		'region_id',
		'hq_id',
		'team_id',
		'name',
		'description',
		'due_date',
		'created_at',
		'updated_at',
		'heading',
	];
public function region() {
return $this->belongsTo('App\Models\RegionModel','region_id','id');
}

public function teams() {
return $this->belongsTo('App\Models\TeamsModel','team_id','id');
}

public function hq() {
return $this->belongsTo('App\Models\HqModel','hq_id','id');
}

public function users() {
return $this->belongsTo('App\Models\UsersModel','user_id','id');
}

}