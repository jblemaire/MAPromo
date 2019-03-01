<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            /**Column**/
            $table->integer('idUser')->autoIncrement();
            $table->string('nomUser');
            $table->string('prenomUser');
            $table->string('mailUser')->unique();
            $table->string('mdpUser')->nullable();
            $table->string('telUser')->nullable();
            $table->integer('idRole');
            $table->string('provider_id')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idRole')->references('idRole')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
