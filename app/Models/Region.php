<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
   protected $table = 'region';
   protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'region',
		'created_at',
		'updated_at',
	];
}
