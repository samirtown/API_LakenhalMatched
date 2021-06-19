<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GroepschatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('groepschat')->insert([
            'groeps_aantal' => 2,
            'max_aantal_personen' => 3,
            'activiteit_ID' => 1
        ]);
       DB::table('groepschat')->insert([
            'groeps_aantal' => 3,
            'max_aantal_personen' => 3,
            'activiteit_ID' => 2
        ]);
    }
}
