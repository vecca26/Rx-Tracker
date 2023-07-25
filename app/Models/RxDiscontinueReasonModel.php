<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RxDiscontinueReasonModel extends Model
{
	protected $table = 'rx_discontinue_reason';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'reason',
		'created_at',
		'updated_at',
	];
}