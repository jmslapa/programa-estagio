<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLinhaParada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linha_parada', function (Blueprint $table) {
            $table->unsignedBigInteger('linha_id');
            $table->unsignedBigInteger('parada_id');
            $table->timestamps();

            $table->primary('linha_id', 'parada_id');
            $table->foreign('linha_id')->references('id')->on('linhas')->onDelete('cascade');
            $table->foreign('parada_id')->references('id')->on('paradas');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linha_parada');
    }
}
