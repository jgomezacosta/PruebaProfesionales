<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('profesionales', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('dni');
            $table->string('email');
            $table->integer('matricula');
            $table->string('especialidad');
            $table->integer('telefono');
            $table->integer('celular');
            $table->string('direccion_atencion');

            // aca estoy creando la relacion de id_zona_atencion de la tabla "profesionales" con id de la tabla "zonas_atencion"
            $table->unsignedBigInteger('zona_atencion_id'); 
            $table->foreign('zona_atencion_id')->references('id')->on('zonas_atencion');

            //$table->integer('id_zona_atencion');
            $table->string('horario_atencion');
            $table->string('archivo')->nullable(); // en este campo se guardaria la ruta donde encontrar el archivo subido

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
        //
        Schema::table('profesionales', function (Blueprint $table) {
            $table->dropForeign(['zona_atencion_id']); // Eliminar clave foránea
        });
        
        Schema::dropIfExists('profesionales');
    }
}