<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            UsersTableSeeder::class,
            ItemsTableSeeder::class,
            ItemPhotosTableSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
        // 追加後は composer dump-autoloadの実行必要あり らしいが、実際どうなのかはわからない
    }
}
