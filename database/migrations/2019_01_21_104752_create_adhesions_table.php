<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdhesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adhesions', function (Blueprint $table) {
            /**Column**/
            $table->integer('Promotion_idPromo');
            $table->integer('Internaute_idInternaute');
            $table->integer('noteAdhesion')->nullable();
            $table->text('commentaireAdhesion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            /**Index**/
            $table->foreign('Promotion_idPromo')->references('idPromo')->on('promotions'); //clé étrangere
            $table->foreign('Internaute_idInternaute')->references('idUser')->on('users'); //clé étrangere
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adhesions');
    }
}
