<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CategorieSeeder::class,
            ActiviteitSeeder::class,
            InschrijvingenSeeder::class,
            RapporteerActiviteitSeeder::class,
            GroepschatSeeder::class,
            UserGroepschatSeeder::class,
        ]);
    }
}
