<?php

use Illuminate\Database\Seeder;
use App\Models\Qa;

class QasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qas = factory(Qa::class, 10)->create();
    }
}
