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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idrevista')->nullable();
            $table->unsignedBigInteger('idnumero')->nullable();
            $table->string('titulo');
            $table->string('doi')->unique()->nullable();
            $table->string('url');
            $table->date('fechaimpr')->nullable();
            $table->date('fechadig')->nullable();
            $table->integer('primerpag')->nullable();
            $table->integer('ultimapag')->nullable();
            $table->text('abstract')->nullable();
            //relaciones
            $table->foreign('idrevista')->references('id')->on('revistas');
            $table->foreign('idnumero')->references('id')->on('numeros')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
};
