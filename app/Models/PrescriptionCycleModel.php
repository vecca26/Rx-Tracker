<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PrescriptionCycleModel extends Model
{
	protected $table = 'prescription_cycle';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'rx_id',
		'prescription_id',
		'cycle_number',
		'cycle_repeated',
		'reason_id',
		'reason',
		'start_date',
		'end_date',
		'created_at',
		'updated_at',
	];
public function prescriptions() {
return $this->belongsTo('App\Models\PrescriptionsModel','prescription_id','id');
}

public function rx_entry() {
return $this->belongsTo('App\Models\RxEntryModel','rx_id','id');
}

public function reasons() {
	return $this->belongsTo('App\Models\RxDiscontinueReasonModel','reason_id','id');
	}

}