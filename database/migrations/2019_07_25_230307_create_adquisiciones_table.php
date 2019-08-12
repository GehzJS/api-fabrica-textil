<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdquisicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adquisiciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->string('descripcion', 256);
            $table->double('total', 10, 2);
            $table->string('estado', 10);
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adquisiciones');
    }
}
