<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $node = Category::create([
            'name' => '',
            'children' => [
                [
                    'name' => 'コミック・ラノベ',
                    'children' =>[
                        [
                            'name' => 'コミック',
        
                            'children' => [
                                ['name' => '少年コミック'],
                                ['name' => '少女コミック'],
                            ],
                        ],
                        [
                            'name' => 'ラノベ',
                            'children' => [
                                ['name' => '文庫'],
                                ['name' => '単行本'],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'ビジネス・経済',

                    'children' => [
                        [
                            'name' => '経済',
                            'children' =>  [
                                [ 'name' => '経済学'],
                                [ 'name' => '財政学'],
                            ],
                        ],
                        [
                            'name' => 'IT',
                            'children' => [
                                [ 'name' => '情報社会'],
                                [ 'name' => '情報・コンピュータ産業'],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        // DB::table('categories')->insert([
        //     'name' => "",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        // DB::table('categories')->insert([
        //     'parent_id' => 1,
        //     'name' => "コミック",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // DB::table('categories')->insert([
        //     'parent_id' => 1,
        //     'name' => "ビジネス",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // DB::table('categories')->insert([
        //     'parent_id' => 2,
        //     'name' => "青年コミック",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // DB::table('categories')->insert([
        //     'parent_id' => 3,
        //     'name' => "ビジネス-1",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // $category = DB::table('categories')->first();

        // foreach(range(1,5) as $num){
        //     DB::table('categories')->insert([
        //         'parent_id' => $num-1,
        //         'name' => "サンプルカテゴリ{$num}",

        //     ]);
        // }


    }
}
