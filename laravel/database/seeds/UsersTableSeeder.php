<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ファクトリー作成
        // factory(User::class, 5)->create();
        DB::table('users')->insert([
            [
                'name' => 'kb995 (デモ用ユーザー)',
                'thumbnail' => null,
                'email' => 'kb995@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('11111111'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'sub (サブユーザ)',
                'thumbnail' => null,
                'email' => 'sub@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('22222222'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
