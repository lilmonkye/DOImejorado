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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idusuario');
            $table->integer('revista');
            $table->string('estatus');
            $table->string('doicreado')->nullable();
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
        //
    }
};
