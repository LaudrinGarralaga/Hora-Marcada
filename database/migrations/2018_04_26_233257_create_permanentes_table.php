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
            $table->date('dataInicial');
            $table->date('dataFinal');
            $table->unsignedInteger('horarios_id');
            $table->unsignedInteger('clientes_id');
        });

        Schema::table('permanentes', function (Blueprint $table) {
            $table->foreign('horarios_id')->references('id')->on('horarios');
            $table->foreign('clientes_id')->references('id')->on('clientes');
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
