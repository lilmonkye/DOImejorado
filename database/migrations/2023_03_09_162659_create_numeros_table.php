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
            $table->string('doi')->nullable();
            $table->string('url')->nullable();
            $table->string('fechaimpr')->nullable();
            $table->string('fechadig')->nullable();
            $table->string('numespecial')->nullable();
            $table->string('volumen')->nullable();
            $table->string('volumendoi')->nullable();
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
