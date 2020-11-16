<?php

use Illuminate\Database\Seeder;
use App\Models\Mtag;

class MtagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mtag::class, 10)->create();
    }
}
