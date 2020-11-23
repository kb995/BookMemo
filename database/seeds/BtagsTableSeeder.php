<?php

use Illuminate\Database\Seeder;
use App\Models\Btag;

class BtagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Btag::class, 10)->create();
    }
}
