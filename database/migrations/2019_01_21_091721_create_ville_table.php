<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVilleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ville', function (Blueprint $table) {
            /**Column**/
            $table->string('codeINSEEVille');
            $table->string('cpVille');
            $table->string('nomVille');
            $table->integer('popVille');
            $table->float('latVille');
            $table->float('longVille');
            $table->string('idDepartement');


            /**Index**/
            $table->primary(['codeINSEEVille','cpVille']);
            $table->foreign('idDepartement')->references('idDepartement')->on('Departement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ville');
    }
}
