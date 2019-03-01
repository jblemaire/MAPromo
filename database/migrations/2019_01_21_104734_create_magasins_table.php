<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagasinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magasins', function (Blueprint $table) {
            /**Column**/
            $table->integer('idMagasin')->autoIncrement();
            $table->string('nomMagasin');
            $table->string('adresse1Magasin');
            $table->string('adresse2Magasin');
            $table->decimal('latMagasin', 10, 8);
            $table->decimal('longMagasin', 10,8);
            $table->string('mailMagasin')->unique();
            $table->string('telMagasin')->nullable();
            $table->string('siretMagasin');
            $table->string('photo1Magasin')->nullable();
            $table->string('photo2Magasin')->nullable();
            $table->string('codeINSEEVille');
            $table->integer('idResponsable');
            $table->integer('idType');
            $table->integer('idCategorie')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /**Index**/
            $table->foreign('codeINSEEVille')->references('codeINSEEVille')->on('villes');
            $table->foreign('idResponsable')->references('idUser')->on('users');
            $table->foreign('idType')->references('idType')->on('types');
            $table->foreign('idCategorie')->references('idCategorie')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magasins');
    }
}
