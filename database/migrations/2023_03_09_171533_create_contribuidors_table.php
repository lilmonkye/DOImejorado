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
            $table->string('nombre');
            $table->string('apellido');
            $table->string('sufijo');
            $table->string('afiliacion');
            $table->string('orcidid');
            $table->string('nomalternativo');
            $table->string('rol');
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
