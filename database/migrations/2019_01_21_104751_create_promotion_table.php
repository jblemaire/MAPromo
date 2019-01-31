<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion', function (Blueprint $table) {
            /**Column**/
            $table->integer('idPromo')->autoIncrement();
            $table->dateTime('dateDebutPromo');
            $table->dateTime('dateFinPromo');
            $table->string('libPromo');
            $table->boolean('etatPromo');
            $table->string('codePromo');
            $table->string('codeAvisPromo');
            $table->string('photo1Promo')->nullable();
            $table->string('photo2Promo')->nullable();
            $table->string('photo3Promo')->nullable();
            $table->integer('idMagasin');
            $table->softDeletes();

            /**Index**/
            $table->foreign('idMagasin')->references('idMagasin')->on('Magasin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion');
    }
}
