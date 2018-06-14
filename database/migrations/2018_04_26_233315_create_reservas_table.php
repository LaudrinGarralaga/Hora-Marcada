<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data', 20);
            //$table->boolean('compareceu');
           // $table->smallInteger('pontos');
            $table->decimal('valor', 9, 2);
           // $table->boolean('bonificacao');
            $table->unsignedInteger('horarios_id');
            $table->unsignedInteger('clientes_id');
            $table->unsignedInteger('users_id');
        });

        Schema::table('reservas', function (Blueprint $table) {
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
        Schema::dropIfExists('reservas');
    }

}
