<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defectos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->string('descripcion', 256);
            $table->bigInteger('empleado_id')->unsigned();
            $table->bigInteger('modelo_id')->unsigned();
            $table->timestamps();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
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
        Schema::dropIfExists('defectos');
    }
}
