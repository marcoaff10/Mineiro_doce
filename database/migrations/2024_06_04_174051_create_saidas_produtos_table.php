<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saidas_produtos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('saida_id')->index();
            $table->uuid('produto_id')->index();
            $table->uuid('cliente_id')->index()->nullable();
            $table->integer('quantidade');
            $table->float('valor_unidade');
            $table->float('frete');
            $table->float('valor_total');
            $table->timestamps();

            $table->foreign('saida_id')->references('id')->on('saidas');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saidas_produtos');
    }
};
