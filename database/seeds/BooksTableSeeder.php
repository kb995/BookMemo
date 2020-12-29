<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ファクトリー作成
        // factory(Book::class, 50)->create();
        DB::table('books')->insert([
        //    [
        //         'title' => '',
        //         'cover' => '',
        //         'author' => '',
        //         'isbn' => '',
        //         'description' => '',
        //         'category' => '',
        //         'status' => '',
        //         'rank' => '',
        //         'read_at' => '',
        //         'user_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //    ],
           [
                'title' => '嫌われる勇気―――自己啓発の源流「アドラー」の教え',
                'cover' => 'content.jpeg',
                'author' => '岸見 一郎',
                'isbn' => '9784478025819',
                'description' => '本書は、フロイト、ユングと並び「心理学の三大巨頭」と称される、アルフレッド・アドラーの思想(アドラー心理学)を、「青年と哲人の対話篇」という物語形式を用いてまとめた一冊です。欧米で絶大な支持を誇るアドラー心理学は、「どうすれば人は幸せに生きることができるか」という哲学的な問いに、きわめてシンプルかつ具体的な“答え”を提示します。この世界のひとつの真理とも言うべき、アドラーの思想を知って、あなたのこれからの人生はどう変わるのか?もしくは、なにも変わらないのか…。さあ、青年と共に「扉」の先へと進みましょう―。',
                'category' => null,
                'read_at' => null,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
           ],


        ]);


    }
}
