<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternauteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internaute', function (Blueprint $table) {
            /**Column**/
            $table->integer('idInternaute')->autoIncrement();
            $table->string('nomInternaute');
            $table->string('prenomInternaute');
            $table->string('mailInternaute')->unique();
            $table->string('mdpInternaute');
            $table->string('telInternaute')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internaute');
    }
}
