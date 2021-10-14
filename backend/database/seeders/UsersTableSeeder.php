<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '太郎',
            'email' => 'Test1@example.com',
            'password' => bcrypt('test1234'), // bcryptは暗号化
            'birth' => Carbon::yesterday(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '次郎',
            'email' => 'Test2@example.com',
            'password' => bcrypt('test1234'), // bcryptは暗号化
            'birth' => Carbon::yesterday(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
