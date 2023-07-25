<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DoctorssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            [
                'doctor_name' => 'Dr.Alex',
                'city_id' => '1',
                'speciality_id' => '1',
                'institute_id'=>'1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'doctor_name' => 'Dr.Sam',
                'city_id' => '1',
                'speciality_id' => '1',
                'institute_id'=>'1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
