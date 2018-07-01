<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaOpcionalsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reserva_opcionals', function (Blueprint $table) {
            $table->unsignedInteger('reserva_id');
            $table->unsignedInteger('opcional_id');
        });
        Schema::table('reserva_opcionals', function (Blueprint $table) {
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('opcional_id')->references('id')->on('opcionals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reserva_opcionals');
    }

}
