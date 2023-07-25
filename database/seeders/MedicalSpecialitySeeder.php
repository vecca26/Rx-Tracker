<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class MedicalSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       DB::table('medical_speciality')->delete();
        $speciality = [
            ['speciality' => 'Medical Oncologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Radiation Oncologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Surgical Oncologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Hematologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Uro-Oncologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Gastroenetrologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Hepatologist','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
           ['speciality' => 'Transp Surgeon','created_at' => \Carbon\Carbon::now(),'updated_at' =>\Carbon\Carbon::now()],
        ];
        DB::table('medical_speciality')->insert($speciality);
    }
}
