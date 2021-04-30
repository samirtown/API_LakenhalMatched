<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroepschatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groepschat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_ID');
            $table->unsignedBigInteger('groepschat_ID');
            
            $table->foreign('user_ID')->references('user_ID')->on('users');
            $table->foreign('groepschat_ID')->references('groepschat_ID')->on('groepschat'); 
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('user_groepschat', function (Blueprint $table){
            $table->dropForeign('user_groepschat_user_ID_foreign');
            $table->dropForeign('user_groepschat_groepschat_ID_foreign');
        });  
        Schema::dropIfExists('user_groepschat');
    }
}
