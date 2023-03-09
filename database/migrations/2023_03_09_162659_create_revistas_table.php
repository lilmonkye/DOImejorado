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
            $table->unsignedBigInteger('idsolicitud');
            $table->string('titulo');
            $table->string('tituloabr')->nullable();
            $table->string('doi')->nullable();
            $table->string('url');
            $table->integer('issnimp')->nullable();
            $table->integer('issnelec');
            $table->string('idioma')->nullable();
            $table->boolean('bandoi');
            $table->foreign('idsolicitud')->references('id')->on('solicitud')->onDelete("cascade");
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
