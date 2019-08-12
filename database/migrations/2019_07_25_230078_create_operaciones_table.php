<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 20)->unique();
            $table->double('precio', 10, 2);
            $table->string('maquina', 20);
            $table->double('necesario', 10, 2);
            $table->string('color', 7);
            $table->string('descripcion', 256);
            $table->bigInteger('modelo_id')->unsigned();
            $table->bigInteger('tela_id')->unsigned();
            $table->timestamps();
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
            $table->foreign('tela_id')->references('id')->on('telas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones');
    }
}
