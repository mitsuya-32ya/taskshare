<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['鈴木正史','佐藤美知子','高橋拓海','田中幸子','伊藤武志','渡辺加奈子','山本花子','中村優希','小林太郎','加藤次郎'];
        
        foreach( $users as $user ){
            DB::table('users')->insert([
                'name' => $user,
                'email' => str_random(5) . '@example.com',
                'password' => Hash::make('password'),
                'remember_token' => str_random(10),
                'created_at' => now(),
                'updated_at' =>now()
            ]);
        }
    }
}
