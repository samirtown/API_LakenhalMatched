<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'naam' => 'Yasmine',
            'email' => 'lakenhalmoderator@gmail.com',
            'password' => bcrypt('Lakens1101813nettav.'),
            'beroep' => 'moderator',
            'admin' => true
        ]);
        DB::table('users')->insert([
            'naam' => 'Ilse storm',
            'email' => 'ilsestorm@gmail.com',
            'password' => bcrypt('Lakens1101813nettav.'),
            'beroep' => 'Filmmaker',
            'profiel_foto' => '60ce030f529a7.jfif'
        ]);
        DB::table('users')->insert([
            'naam' => 'Henk Krol',
            'email' => 'henkkrol@gmail.com',
            'password' => bcrypt('Lakens1101813nettav.'),
            'beroep' => 'Informaticus',
            'profiel_foto' => '60ce030f529a7.jfif'
        ]);
    }
}
