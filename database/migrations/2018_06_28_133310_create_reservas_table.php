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
            $table->boolean('compareceu')->nullable();
            $table->smallInteger('pontos')->nullable();
            $table->decimal('valor', 9, 2);
            $table->boolean('bonificacao')->nullable();
            $table->unsignedInteger('horario_id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('quadra_id');
            //$table->timestamps();
        });

        Schema::table('reservas', function (Blueprint $table) {
            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('quadra_id')->references('id')->on('quadras');
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
