<?php

use Illuminate\Database\Seeder;
use App\Models\Folder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folders')->insert([
            [
                'name' => '引用',
                'user_id' => '1',
                 'book_id' => '1'

            ],
            [
                'name' => '語彙',
                'user_id' => '1',
                 'book_id' => '1'
            ],
        ]);
    }
}
