<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie', function (Blueprint $table) {
            /**Column**/
            $table->integer('idCategorie')->autoIncrement();
            $table->string('libCategorie');
            $table->integer('idType');

            /**Index**/
            $table->foreign('idType')->references('idType')->on('Type'); //clé étrangere

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie');
    }
}
