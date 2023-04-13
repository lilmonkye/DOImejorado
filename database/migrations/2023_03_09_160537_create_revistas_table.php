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
            $table->string('titulo');
            $table->string('tituloabr')->nullable();
            $table->string('doi')->unique()->nullable();
            $table->string('url');
            $table->integer('issnimp')->unique()->nullable();
            $table->integer('issnelec')->unique()->nullable();
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
