<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable', function (Blueprint $table) {
            /**Column**/
            $table->integer('idResponsable')->autoIncrement();
            $table->string('nomResponsable');
            $table->string('prenomResponsable');
            $table->string('mailResponsable')->unique();
            $table->string('mdpResponsable');
            $table->string('telResponsable')->nullable();
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
        Schema::dropIfExists('responsable');
    }
}
