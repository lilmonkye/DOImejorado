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
            $table->unsignedBigInteger('idrevista');
            $table->string('titulo');
            $table->string('doi')->nullable();
            $table->string('url');
            $table->date('fechaimpr');
            $table->date('fechadig');
            $table->integer('primerpag')->nullable();
            $table->integer('ultimapag')->nullable();
            $table->text('abstract')->nullable();
            $table->foreign('idrevista')->references('id')->on('revistas');
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
