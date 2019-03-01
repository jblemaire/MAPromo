<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villes', function (Blueprint $table) {
            /**Column**/
            $table->string('codeINSEEVille');
            $table->string('cpVille');
            $table->string('nomVille');
            $table->integer('popVille');
            $table->decimal('latVille',10,8);
            $table->decimal('longVille',10,8);
            $table->string('idDepartement');


            /**Index**/
            $table->primary(['codeINSEEVille','cpVille']);
            $table->foreign('idDepartement')->references('idDepartement')->on('departements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villes');
    }
}
