<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermanentesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permanentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dataInicial');
            $table->string('dataFinal');
            $table->string('valor');
            $table->unsignedInteger('horario_id')->unsigned();
            $table->unsignedInteger('cliente_id')->unsigned();
            $table->unsignedInteger('user_id')->unsigned();
            //$table->timestamps();
        });

        Schema::table('permanentes', function (Blueprint $table) {
            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permanentes');
    }

}
