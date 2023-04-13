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
        Schema::create('contribuidors', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idarticulo')->nullable();
            $table->unsignedBigInteger('idnumero')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido');
            $table->string('sufijo')->nullable();
            $table->string('afiliacion')->nullable();
            $table->string('orcidid')->unique()->nullable();
            $table->string('nomalternativo')->nullable();
            $table->string('rol')->nullable();
            $table->foreign('idarticulo')->references('id')->on('articulos')->onDelete("cascade");
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
        Schema::dropIfExists('contribuidors');
    }
};
