<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            '物理攻略のヒント p68~p72',
            '漆原晃の物理が面白いほどわかる本 電磁気 p102~p154',
            '漆原晃の物理が面白いほどわかる本 電磁気 p102~p154',
            '漆原晃の物理が面白いほどわかる本 力学 p102~p154',
            '漆原晃の物理が面白いほどわかる本 波動 p102~p154',
            '漆原晃の物理が面白いほどわかる本 力学 p102~p154',
            '化学重要問題集 問題5~15',
            '物理重要問題集 問題79~112',
            '物理重要問題集 問題2~12',
            '生物重要問題集 問題46~68',
            '登木難関大英語長文の実況中継 長文1',
            '登木難関大英語長文の実況中継 長文5',
            '登木難関大英語長文の実況中継 長文7',
            '竹岡広信の英作文が面白いほどかける本 p59~p80',
            '竹岡広信の英作文が面白いほどかける本 p13~p22',
            'フォーカスゴールド数学1A 問1~6',
            'フォーカスゴールド数学2B 問22~26',
            'フォーカスゴールド数学1A 問9~13',
            'フォーカスゴールド数学3 問72~78',
            'フォーカスゴールド数学3 問200~204',
        ];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('tasks')->insert([
                'user_id' => $i,
                'task_name' => $tasks[$i - 1],
                'status' => 1,
                'due_date' => now()->addDay($i),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('tasks')->insert([
                'user_id' => $i,
                'task_name' => $tasks[$i + 9],
                'status' => 2,
                'due_date' => now()->addDay($i +10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
