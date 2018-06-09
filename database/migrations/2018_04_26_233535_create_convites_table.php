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
            $table->unsignedInteger('convidados_id');
            $table->unsignedInteger('reservas_id');
            $table->unsignedInteger('clientes_id');
        });

        Schema::table('convites', function (Blueprint $table) {
            $table->foreign('convidados_id')->references('id')->on('convidados');
            $table->foreign('reservas_id')->references('id')->on('reservas');
            $table->foreign('clientes_id')->references('id')->on('clientes');
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
