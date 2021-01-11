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
                'name' => '久保島 卓哉(デモユーザー)',
                'thumbnail' => null,
                'email' => 'test@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('11111111'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
