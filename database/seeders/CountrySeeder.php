<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
