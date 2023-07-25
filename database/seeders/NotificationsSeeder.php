<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            ['name' => '2nd Cycle is Started
            Robin Joseph',
            'description'=>'The cycle of compressions and breaths is continued (see table CPR Techniques for ... Procainamide is a 2nd-line drug for treatment of refractory VF or VT.) for 1 minute starting at 08:38 am',
            'user_id'=>'5',
            'send_date'=> \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
            
            ['name' => '3rd Cycle is Repeated
            Chikku Jimmy',
            'description'=>'The cycle of compressions and breaths is continued (see table CPR Techniques for ... Procainamide is a 2nd-line drug for treatment of refractory VF or VT.) for 1 minute starting at 08:38 am',
            'user_id'=>'5',
            'send_date'=> \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],

            ['name' => '3rd Cycle is Repeated
            Irfan',
            'description'=>'The cycle of compressions and breaths is continued (see table CPR Techniques for ... Procainamide is a 2nd-line drug for treatment of refractory VF or VT.) for 1 minute starting at 08:38 am',
            'user_id'=>'5',
            'send_date'=> \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
            
        ]);
    }
}
