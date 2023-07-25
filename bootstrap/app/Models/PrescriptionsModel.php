<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PrescriptionsModel extends Model
{
	protected $table = 'prescriptions';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'rx_id',
		'indication_id',
		'schedule',
		'dose',
		'start_date',
		'end_date',
		'rx_copy_link',
		'ir_name',
		'nm_name',
		'tumour_type_id',
		'pvt_involvement',
		'bclc_stage_id',
		'pugh_score_id',
		'liver_tumour_volume',
		'lung_shunt',
		'dmode_id',
		'created_at',
		'updated_at',
	];
public function indications() {
return $this->belongsTo('App\Models\IndicationsModel','indication_id','id');
}

public function rx_entry() {
return $this->belongsTo('App\Models\RxEntryModel','rx_id','id');
}

}