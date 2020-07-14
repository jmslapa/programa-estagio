<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePosicaoVeiculosColumnVeiculoIdUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posicao_veiculos', function (Blueprint $table) {
            $table->unsignedBigInteger('veiculo_id')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posicao_veiculos', function (Blueprint $table) {
            $table->dropUnique('posicao_veiculos_veiculo_id_unique');
        });
    }
}
