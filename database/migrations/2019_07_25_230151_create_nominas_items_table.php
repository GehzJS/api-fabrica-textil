<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->bigInteger('nomina_id')->unsigned();
            $table->bigInteger('operacion_id')->unsigned();
            $table->double('precio', 10, 2);
            $table->string('operacion', 20);
            $table->timestamps();
            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
            $table->foreign('operacion_id')->references('id')->on('operaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominas_items');
    }
}
