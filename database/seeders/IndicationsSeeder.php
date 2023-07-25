<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class IndicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indications')->insert([
            ['brand_id' => '6',
            'name' => 'Head & Neck',
            'description'=>'test',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
            ['brand_id' => '6',
            'name' => 'LABC',
            'description'=>'test',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
            ['brand_id' => '6',
            'name' => 'Gastric Cancer',
            'description'=>'test',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
            ['brand_id' => '6',
            'name' => 'CA Pancreas',
            'description'=>'test',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
            ['brand_id' => '5',
            'name' => 'Platinum Sensitive ROC',
            'description'=>'test',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),],
        ]);
    }
}
