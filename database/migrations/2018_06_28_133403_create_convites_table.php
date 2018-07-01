<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvitesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('convites', function (Blueprint $table) {
            $table->unsignedInteger('convidado_id');
            $table->unsignedInteger('reserva_id');
            $table->unsignedInteger('cliente_id');
        });
        Schema::table('convites', function (Blueprint $table) {
            $table->foreign('convidado_id')->references('id')->on('convidados');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('convites');
    }

}
