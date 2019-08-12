<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 20)->unique();
            $table->string('tipo', 20);
            $table->string('material', 20);
            $table->string('para', 20);
            $table->string('talla', 15);
            $table->integer('stock');
            $table->string('descripcion', 256);
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
        Schema::dropIfExists('modelos');
    }
}
