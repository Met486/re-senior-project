<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            'name' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'name' => "コミック",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 1,
            'name' => "ビジネス",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'parent_id' => 2,
            'name' => "青年コミック",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // $category = DB::table('categories')->first();

        // foreach(range(1,5) as $num){
        //     DB::table('categories')->insert([
        //         'parent_id' => $num-1,
        //         'name' => "サンプルカテゴリ{$num}",

        //     ]);
        // }


    }
}
