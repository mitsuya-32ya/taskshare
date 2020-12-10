<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i = 1; $i <= 10; $i++) {
            DB::table('favorites')->insert([
                'user_id' => 1,
                'task_id' => $i
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('favorites')->insert([
                'user_id' => 2,
                'task_id' => $i
            ]);
        }
    }
}
