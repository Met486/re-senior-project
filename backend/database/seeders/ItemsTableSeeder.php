<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ISBN = array(
            "1" => 9784480815583,
            "2" => 9784863893993,
            "3" => 9784167915544,
            "4" => 9784150503918,
            "5" => 9784492973301,
            "6" => 9784344033337,
            "7" => 9784798060996,
            "8" => 9784295005094,
            "9" => 9784873119656,
            "10" => 9784797397406,
    
        );
    
        $category = array(
            "1" => 4,
            "2" => 7,
            "3" => 4,
            "4" => 266,
            "5" => 279,
            "6" => 264,
            "7" => 122,
            "8" => 136,
            "9" => 124,
            "10" =>124
        );

        $user = DB::table('users')->first();

        foreach(range(1,10) as $num){
            DB::table('items')->insert([
                'title' => "サンプルアイテム{$num}",
                'price' => rand(5,10)*100,
                'seller_id' => $user->id,
                'buyer_id' => null,
                // 'category' => ($num > 5) ? 4 : 11, 
                'category' => $category[$num],
                // 'sub_category' => $num,
                'isbn_13' => $ISBN[$num],
                'status' => 1,
                'scratches' => rand(1,4),
                'comment' => "テストコメント URL例:https://azkari.jp/share/t/{$num}",
                'url' => "https://azkari.jp/share/t/{$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
