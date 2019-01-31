<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagasinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magasin', function (Blueprint $table) {
            /**Column**/
            $table->integer('idMagasin')->autoIncrement();
            $table->string('nomMagasin');
            $table->string('adresse1Magasin');
            $table->string('adresse2Magasin');
            $table->float('latMagasin');
            $table->float('longMagasin');
            $table->string('mailMagasin')->unique();
            $table->string('telMagasin')->nullable();
            $table->string('siretMagasin');
            $table->string('photo1Magasin')->nullable();
            $table->string('photo2Magasin')->nullable();
            $table->string('codeINSEEVille');
            $table->integer('idResponsable');
            $table->integer('idType');
            $table->integer('idCategorie')->nullable();
            $table->softDeletes();

            /**Index**/
            $table->foreign('codeINSEEVille')->references('codeINSEEVille')->on('Ville');
            $table->foreign('idResponsable')->references('idResponsable')->on('Responsable');
            $table->foreign('idType')->references('idType')->on('Type');
            $table->foreign('idCategorie')->references('idCategorie')->on('Categorie');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magasin');
    }
}
