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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idusuario')->nullable();
            $table->unsignedBigInteger('idrevista')->nullable();
            $table->unsignedBigInteger('idnumero')->nullable();
            $table->unsignedBigInteger('idarticulo')->nullable();
            $table->unsignedBigInteger('idrevisor')->nullable();

            $table->string('estatus');
            $table->string('doicreado')->nullable();
            //relaciones
            $table->foreign('idusuario')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('idrevista')->references('id')->on('revistas')->onDelete("cascade");
            $table->foreign('idnumero')->references('id')->on('numeros')->onDelete("cascade");
            $table->foreign('idarticulo')->references('id')->on('articulos')->onDelete("cascade");
            $table->foreign('idrevisor')->references('id')->on('users')->onDelete("cascade");



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud');
    }
};
