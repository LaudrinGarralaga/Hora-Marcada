<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasOpcionaisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reservas_opcionais', function (Blueprint $table) {
            $table->unsignedInteger('reservas_id');
            $table->unsignedInteger('opcionais_id');
        });

        Schema::table('reservas_opcionais', function (Blueprint $table) {
            $table->foreign('reservas_id')->references('id')->on('reservas');
            $table->foreign('opcionais_id')->references('id')->on('opcionais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reservas_opcionais');
    }

}
