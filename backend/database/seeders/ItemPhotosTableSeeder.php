<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ItemPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,20) as $num){
            DB::table('item_photos')->insert([
                'item_id' => intdiv($num+1,2),
                'index' => ($num+1)%2,
                'path' => "item/photos/" . intdiv($num+1,2) ."/_" .($num+1)%2 . ".png",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
