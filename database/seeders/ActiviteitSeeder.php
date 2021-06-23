<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ActiviteitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activiteit')->insert([
            'titel' => '3D vilten van lakenhal',
            'beschrijving' => 'Vilt ontstaat als de schubben van wol aan elkaar gaan haken. Dat doe je met warm water en zeep. Door deze combinatie door je handen te wrijven, ontstaat er een stevig lapje stof. Deze stof, die heel warm, stevig en waterdicht is, wordt laken genoemd. De techniek is eeuwenoud en wordt ook vandaag de dag  nog gebruikt. Dit lijkt mij een leuke opdracht om mee bezig te zijn, maar ik zoek wat mensen om dit mee samen te doen.',
            'afbeelding' => '60ce030f529a7.jfif',
            'max_aantal_deelnemers' => '2',
            'lakenhal_activiteit' => true,
            'zichtbaar' => true,
            'aantal_gerapporteerd' => 6,
            'categorie' => 'Het thuis atelier',
            'user_ID' => 1,
            'afbeelding' => '3dvilten.png'
        ]);
        DB::table('activiteit')->insert([
            'titel' => 'Film project',
            'beschrijving' => 'Ik heb allerlei ideeën voor een nieuw film project. Ik heb het een en ander al uitgewerkt op papier en het is zeker concreet. Wat ik zelf echter mis aan vaardigheden is het daadwerkelijk bewerken van deze video’s. Daarom zoek ik iemand die dit samen met mij wil ondernemen en iets tofs wil neerzetten.',
            'afbeelding' => '60ce0105eb1a7.jfif',
            'max_aantal_deelnemers' => '4',
            'lakenhal_activiteit' => true,
            'zichtbaar' => true,
            'aantal_gerapporteerd' => 10,
            'categorie' => 'Samen kunst maken',
            'user_ID' => 3,
            'afbeelding' => 'filmproject.png'
        ]);
        DB::table('activiteit')->insert([
            'titel' => 'Leuke Date',
            'beschrijving' => 'Hallo ik weet dat deze website hiervoor niet bedoeld is, maar ik probeer het toch, ben opzoek naar een leuke single lady die samen met mij wat kunst wil maken.',
            'max_aantal_deelnemers' => '4',
            'lakenhal_activiteit' => false,
            'zichtbaar' => true,
            'aantal_gerapporteerd' => 22,
            'categorie' => 'Samen kunst maken',
            'user_ID' => 3,
            'afbeelding' => 'leukedate.jpg'
        ]);
    }
}
