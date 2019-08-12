<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 20);
            $table->string('color', 7);
            $table->string('caracteristicas', 256);
            $table->string('seccion', 20);
            $table->double('stock', 10, 2);
            $table->double('precio', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telas');
    }
}
