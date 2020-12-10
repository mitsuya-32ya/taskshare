<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <=10; $i++){
        DB::table('comments')->insert([
            'user_id' => 1,
            'task_id'=> $i,
            'text' => '頑張ってください',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        }
    }
}
