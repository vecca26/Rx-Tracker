<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FfProfile extends Model
{
    use HasFactory;
    protected $table = 'ff_profile';
    public $timestamps = false;
    protected $primaryKey = 'id';
        protected $fillable = [
            'id',
            'user_id',
            'profile_pic',
            'address',
            'description',
        ];

        public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
}
