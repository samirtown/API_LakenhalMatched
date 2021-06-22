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
            'profiel_foto' => 'ilsestorm.png'
        ]);
        DB::table('users')->insert([
            'naam' => 'Henk Krol',
            'email' => 'henkkrol@gmail.com',
            'password' => bcrypt('Lakens1101813nettav.'),
            'beroep' => 'Informaticus',
            'profiel_foto' => 'henkkrol.png'
        ]);

        DB::table('users')->insert([
            'naam' => 'Maurice',
            'email' => '17spyker@gmail.com',
            'password' => bcrypt('17spyker'),
            'beroep' => 'worstelaar',
            'profiel_foto' => 'maurice.jfif',
        ]);
        DB::table('users')->insert([
            'naam' => 'Etienne',
            'email' => 'mg.koreman99@gmail.com',
            'password' => bcrypt('17spyker'),
            'beroep' => 'leraar',
            'profiel_foto' => 'etienne.png',
        ]);
    }
}
