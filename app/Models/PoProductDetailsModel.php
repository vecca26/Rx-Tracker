<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoProductDetailsModel extends Model
{
	protected $table = 'po_productdetails';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'po_id',
		'sku_id',
		'quantity',
		'price',
		'total',
		'total_lakhs',
		'created_at'
	];
	public function SkuDetails()
	{
		return $this->belongsTo('App\Models\SkuDetailsModel', 'sku_id', 'id');
	}
	public function PoDetails()
	{
		return $this->belongsTo('App\Models\PoDetailModel', 'po_id', 'id');
	}
};
