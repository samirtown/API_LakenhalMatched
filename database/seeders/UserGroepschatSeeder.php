<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserGroepschatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groepschat')->insert([
            'user_ID' => 4,
            'groepschat_ID' => 1
        ]);
        DB::table('user_groepschat')->insert([
            'user_ID' => 5,
            'groepschat_ID' => 1
        ]);
        DB::table('user_groepschat')->insert([
            'user_ID' => 4,
            'groepschat_ID' => 2
        ]);
        DB::table('user_groepschat')->insert([
            'user_ID' => 5,
            'groepschat_ID' => 2
        ]);
    }
}
