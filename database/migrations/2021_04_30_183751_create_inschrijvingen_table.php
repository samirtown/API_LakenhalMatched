<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInschrijvingenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inschrijvingen', function (Blueprint $table) {
            $table->text('bericht')->nullable();
            $table->boolean('geaccepteerd')->default(false);
            $table->unsignedBigInteger('user_ID');
            $table->unsignedBigInteger('activiteit_ID');
            
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');;
            $table->foreign('activiteit_ID')->references('activiteit_ID')->on('activiteit')->onDelete('cascade');;
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
        schema::table('inschrijvingen', function (Blueprint $table){
            $table->dropForeign('inschrijvingen_activiteit_ID_foreign');
            $table->dropForeign('inschrijvingen_user_ID_foreign');
        });
        Schema::dropIfExists('inschrijvingen');
    }
}
