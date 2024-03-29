<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revistas', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idusuario')->nullable();
            //campos de la base de datos
            $table->string('titulo');
            $table->string('tituloabr')->nullable();
            $table->string('doi')->nullable();
            $table->string('url');
            $table->string('issnimp')->nullable();
            $table->string('issnelec')->nullable();
            $table->string('idioma')->nullable();
            //relaciones
            $table->foreign('idusuario')->references('id')->on('users')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revistas');
    }
};
