<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->bigInteger('venta_id')->unsigned();
            $table->bigInteger('modelo_id')->unsigned();
            $table->double('precio', 10, 2);
            $table->string('modelo', 20);
            $table->timestamps();
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_items');
    }
}
