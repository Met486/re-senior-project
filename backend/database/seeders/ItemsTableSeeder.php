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
        $user = DB::table('users')->first();

        foreach(range(1,10) as $num){
            DB::table('items')->insert([
                'title' => "サンプルアイテム{$num}",
                'seller_id' => $user->id,
                'buyer_id' => null,
                'category' => ($num > 5) ? 4 : 11, // 暫定値 コミックとビジネスに該当
                // 'sub_category' => $num,
                'isbn_13' => 1234567890123,
                'status' => 1,
                'comment' => "テストコメント URL例:https://azkari.jp/share/t/{$num}",
                'url' => "https://azkari.jp/share/t/{$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
