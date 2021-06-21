<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiviteitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activiteit', function (Blueprint $table) {
            $table->id('activiteit_ID');
            $table->string('titel');
            $table->text('beschrijving');
            $table->longText('afbeelding')->nullable();
            $table->integer('max_aantal_deelnemers')->nullable();
            $table->boolean('lakenhal_activiteit')->nullable();
            $table->boolean('zichtbaar')->nullable();
            $table->integer('aantal_gerapporteerd')->nullable();
            $table->timestamps();
            $table->string('categorie')->nullable();
            $table->unsignedBigInteger('user_ID')->nullable();

            $table->foreign('categorie')->references('categorie')->on('categorie')->onDelete('cascade');;
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('activiteit', function (Blueprint $table){
            $table->dropForeign('activiteit_categorie_foreign');
            $table->dropForeign('activiteit_user_ID_foreign');
        });
        Schema::dropIfExists('activiteit');
    }
}
