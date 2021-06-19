<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroepschatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groepschat', function (Blueprint $table) {
            $table->id('groepschat_ID'); 
            $table->integer('groeps_aantal');
            $table->integer('max_aantal_personen');
            $table->unsignedBigInteger('activiteit_ID');

            $table->foreign('activiteit_ID')->references('activiteit_ID')->on('activiteit')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('groepschat', function (Blueprint $table){
            $table->dropForeign('groepschat_activiteit_ID_foreign');
        });
        Schema::dropIfExists('groepschat');
    }
}
