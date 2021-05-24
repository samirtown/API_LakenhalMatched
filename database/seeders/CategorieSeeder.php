<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorie')->insert([
            'categorie' => 'Lakenhal open atelier',
            'lakenhal_activiteit' => true
        ]);
        DB::table('categorie')->insert([
            'categorie' => 'Het thuis atelier',
            'lakenhal_activiteit' => true
        ]);
        DB::table('categorie')->insert([
            'categorie' => 'Samen kunst maken',
        ]);
        DB::table('categorie')->insert([
            'categorie' => 'Gezelschap',
        ]);
    }
}
