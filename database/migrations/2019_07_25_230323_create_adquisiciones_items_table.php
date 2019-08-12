<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdquisicionesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adquisiciones_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('cantidad', 10, 2);
            $table->bigInteger('adquisicion_id')->unsigned();
            $table->bigInteger('tela_id')->unsigned();
            $table->double('precio', 10, 2);
            $table->string('tela', 20);
            $table->timestamps();
            $table->foreign('adquisicion_id')->references('id')->on('adquisiciones')->onDelete('cascade');
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
        Schema::dropIfExists('adquisiciones_items');
    }
}
