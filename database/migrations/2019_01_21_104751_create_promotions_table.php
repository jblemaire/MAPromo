<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            /**Column**/
            $table->integer('idPromo')->autoIncrement();
            $table->string('libPromo');
            $table->date('dateDebutPromo');
            $table->date('dateFinPromo');
            $table->text('descPromo');
            $table->boolean('etatPromo');
            $table->string('codePromo');
            $table->string('codeAvisPromo');
            $table->string('photo1Promo')->nullable();
            $table->string('photo2Promo')->nullable();
            $table->string('photo3Promo')->nullable();
            $table->integer('idMagasin');
            $table->timestamps();
            $table->softDeletes();

            /**Index**/
            $table->foreign('idMagasin')->references('idMagasin')->on('magasins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
