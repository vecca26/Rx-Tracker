<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->delete();
        $users = [
            ['first_name' => 'robin','last_name' => 'joseph','email' => 'robin.reubro@gmail.com','password' => bcrypt('12345678'),'phone' => '9072451234','user_type' => 'ff'],
            ['first_name' => 'roy','last_name' => 's','email' => 'roy.reubro@gmail.com','password' => bcrypt('12345678'),'phone' => '9072451234','user_type' => 'admin'],
        ];
        DB::table('users')->insert($users);

        // DB::table('users')->insert([
        //     'first_name' => 'robin',
        //     'last_name' => 'joseph',
        //     'email' => 'robin.reubro@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'phone' => '9072451234',
        //     'user_type'=>'admin'
        // ]);
    }
}
