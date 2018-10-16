<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('endereco', 100);
            $table->integer('numero');
            $table->string('complemento', 100);
            $table->string('cidade', 100);
            $table->string('telefone', 20);
            $table->string('bairro', 100);
            $table->string('cep', 20);
            $table->unsignedInteger('user_id');
        });
        Schema::table('local', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local');
    }
}