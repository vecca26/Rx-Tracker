<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('institute')->insert([
            'institute_name' => 'medical trust',
            'description'    => 'test',
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now(),
            'institute_type' =>'trade'
        ]);
    }
}
