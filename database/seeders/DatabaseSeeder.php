<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->delete();
        $users = [
            ['first_name' => 'robin', 'last_name' => 'joseph', 'email' => 'robin.reubro@gmail.com', 'password' => bcrypt('12345678'), 'phone' => '9072451234', 'user_type' => 'ff'],
            ['first_name' => 'roy', 'last_name' => 's', 'email' => 'roy.reubro@gmail.com', 'password' => bcrypt('12345678'), 'phone' => '9072451234', 'user_type' => 'admin'],
        ];
        DB::table('users')->insert($users);
        DB::table('teams')->delete();
        DB::table('teams')->insert([
            'team' => 'Team C',
            'status' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('brands')->delete();
        DB::table('brands')->insert([
            [
                'brand_name' => 'octride',
                'status' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'brand_name' => 'Bevetex',
                'status' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);

        // DB::table('team_brands')->delete();
        // DB::table('team_brands')->insert([
        //     [
        //         'team_id' => '1',
        //         'brand_id' => '1',
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now(),
        //     ]
        // ]);

        DB::table('medical_speciality')->delete();
        $speciality = [
            ['speciality' => 'Medical Oncologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Radiation Oncologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Surgical Oncologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Hematologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Uro-Oncologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Gastroenetrologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Hepatologist', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['speciality' => 'Transp Surgeon', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        ];
        DB::table('medical_speciality')->insert($speciality);

        DB::table('institute')->delete();
        DB::table('institute')->insert([
            'institute_name' => 'medical trust',
            'description'    => 'test',
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now(),
            'institute_type' => 'trade'
        ]);

        DB::table('country')->delete();
        DB::table('country')->delete();
        $countries = [
            ['country' => 'Afghanistan', 'code' => 'AF'],
            ['country' => 'India', 'code' => 'IND'],
            ['country' => 'Åland Islands', 'code' => 'AX'],
            ['country' => 'Albania', 'code' => 'AL'],
            ['country' => 'Algeria', 'code' => 'DZ'],
            ['country' => 'American Samoa', 'code' => 'AS'],
            ['country' => 'Andorra', 'code' => 'AD'],
            ['country' => 'Angola', 'code' => 'AO'],
            ['country' => 'Anguilla', 'code' => 'AI'],
            ['country' => 'Zimbabwe', 'code' => 'ZW'],
        ];
        DB::table('country')->insert($countries);

        DB::table('state')->delete();
        DB::table('state')->insert([
            'state'      => 'tamil nadu',
            'country_id' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('city')->delete();
        DB::table('city')->insert([
            'city'       => 'thrissur',
            'state_id'   => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('doctors')->delete();
        DB::table('doctors')->insert([
            [
                'doctor_name' => 'Dr.Alex',
                'city_id' => '1',
                'speciality_id' => '1',
                'institute_id' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'doctor_name' => 'Dr.Sam',
                'city_id' => '1',
                'speciality_id' => '1',
                'institute_id' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);


        DB::table('ff_doctor')->delete();
        DB::table('ff_doctor')->insert([
            'ff_id' => '1',
            'doctor_id' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('indications')->delete();
        DB::table('indications')->insert([
            [
                'brand_id' => '1',
                'name' => 'Head & Neck',
                'description' => 'test',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'brand_id' => '1',
                'name' => 'LABC',
                'description' => 'test',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'brand_id' => '1',
                'name' => 'Gastric Cancer',
                'description' => 'test',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'brand_id' => '1',
                'name' => 'CA Pancreas',
                'description' => 'test',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'brand_id' => '2',
                'name' => 'Platinum Sensitive ROC',
                'description' => 'test',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);




        DB::table('notifications')->delete();
        DB::table('notifications')->insert([
            [
                'name' => '2nd Cycle is Started
            Robin Joseph',
                'description' => 'The cycle of compressions and breaths is continued (see table CPR Techniques for ... Procainamide is a 2nd-line drug for treatment of refractory VF or VT.) for 1 minute starting at 08:38 am',
                'user_id' => '1',
                'send_date' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

            [
                'name' => '3rd Cycle is Repeated
            Chikku Jimmy',
                'description' => 'The cycle of compressions and breaths is continued (see table CPR Techniques for ... Procainamide is a 2nd-line drug for treatment of refractory VF or VT.) for 1 minute starting at 08:38 am',
                'user_id' => '1',
                'send_date' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

            [
                'name' => '3rd Cycle is Repeated
            Irfan',
                'description' => 'The cycle of compressions and breaths is continued (see table CPR Techniques for ... Procainamide is a 2nd-line drug for treatment of refractory VF or VT.) for 1 minute starting at 08:38 am',
                'user_id' => '1',
                'send_date' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],

        ]);


        DB::table('patient_type')->delete();
        DB::table('patient_type')->insert([
            [
                'name'      => 'Cash',
                'description' => 'test..',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name'      => 'Medical Tourism',
                'description' => 'test..',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name'      => 'Insurance',
                'description' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);


        DB::table('ff_team')->delete();
        DB::table('ff_team')->insert([
            'team_id' => '1',
            'ff_id' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('team_brands')->delete();
        DB::table('team_brands')->insert([
            [
                'team_id' => '1',
                'brand_id' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);


        DB::table('rx_discontinue_reason')->delete();
        DB::table('rx_discontinue_reason')->insert([
            [
                'reason' => 'Disease Progressed',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'reason' => 'Death',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'reason' => 'Tolerability Issue',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'reason' => 'Supply Issues',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'reason' => 'Brand Shift',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'reason' => 'Other',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);

   
    }
}
