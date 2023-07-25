<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teams extends Model
{
    use HasFactory;

    public static function getMembersList(){
    return DB::table('team_members')
    ->join('users', 'team_members.ff_id', '=', 'users.id')
    ->get();
        
    }
    public static function getTeamList(){
    return DB::table('teams')
                ->get();
    }
}
