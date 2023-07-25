<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UsersModel extends Model
{
	protected $table = 'users';
public $timestamps = false;
protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'first_name',
		'email',
		'employee_id',
		'team_id',
		'phone',
		'email_verified_at',
		'password',
		'user_type',
		'remember_token',
		'created_at',
		'updated_at',
		'last_name',
	];
}