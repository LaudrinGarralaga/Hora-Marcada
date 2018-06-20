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
            $table->unsignedInteger('horarios_id')->unsigned();
            $table->unsignedInteger('clientes_id')->unsigned();
            $table->unsignedInteger('users_id')->unsigned();
        });

        Schema::table('permanentes', function (Blueprint $table) {
            $table->foreign('horarios_id')->references('id')->on('horarios');
            $table->foreign('clientes_id')->references('id')->on('clientes');
            $table->foreign('users_id')->references('id')->on('users');
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
