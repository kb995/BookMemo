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
        factory(Memo::class, 10)->create();
    }
}
