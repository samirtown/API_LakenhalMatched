<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapporteerActiviteitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapporteer_activiteit', function (Blueprint $table) {
            $table->text('reden');
            $table->unsignedBigInteger('activiteit_ID');

            $table->foreign('activiteit_ID')->references('activiteit_ID')->on('activiteit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('rapporteer_activiteit', function (Blueprint $table){
            $table->dropForeign('rapporteer_activiteit_activiteit_ID_foreign');
        });
        Schema::dropIfExists('rapporteer_activiteit');
    }
}
