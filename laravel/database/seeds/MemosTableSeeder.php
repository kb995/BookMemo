<?php

use Illuminate\Database\Seeder;
use App\Models\Memo;

class MemosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Memo::class, 100)->create();

        DB::table('users')->insert([
            [
                'memo' => '・短期的な視点でなく長期的な視点・部分的な視点でなく全体的な視点・一つひとつの個別の視点でなく一貫性のある視点こういう視点を持って、事業の将来を考えることを「戦略的である」',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '一定のリソース（人やお金）は所与のものとして、その中でベストを尽くすのが戦術的であるのに対して、そもそもリソースをどのように割り当てるかを考えるのが戦略的であるという違いもあります。「そもそも」という言葉が出てきましたが、まさにこれが戦略的思考の象徴的な言葉です',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '「話の根拠がある」「一貫性がある」「客観的な見解である」「事実に基づいている」「感情に左右されない」「最終的な結論が明確である」。このような姿勢で物事を考えることが、ロジカルシンキングの基本です。',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '論理的な結論のためには正当な前提と推論という「根拠」が必要になるのです。',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '論理的であるというのは、大きく「誰が見ても」「話がつながっている」という2つの要素があると考えられます。一つ目の「誰が見ても」とは客観性を担保することで、そのためには個人が持つ思い込みを排除したものでなければならないということです。もう一つが「話がつながっている」ことで、要は、個々の前提やデータの間に一貫性と関係性が存在しているということです。',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'memo' => '',
                'folder' => 'マーカー',
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

    }
}
