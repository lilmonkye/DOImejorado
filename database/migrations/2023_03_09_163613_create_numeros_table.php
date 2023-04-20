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
        Schema::create('numeros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idrevista');
            $table->string('numero');
            $table->string('titulo')->nullable();
            $table->string('doi')->unique()->nullable();
            $table->string('url')->nullable();
            $table->date('fechaimpr')->nullable();
            $table->date('fechadig')->nullable();
            $table->string('numespecial')->nullable();
            $table->integer('volumen')->nullable();
            $table->string('volumendoi')->unique()->nullable();
            $table->string('volumenurl')->nullable();
            //relaciones
            $table->foreign('idrevista')->references('id')->on('revistas')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numeros');
    }
};
