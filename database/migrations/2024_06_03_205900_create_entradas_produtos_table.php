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
        Schema::create('entradas_produtos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('entrada_id')->index();
            $table->uuid('produto_id')->index();
            $table->uuid('fornecedor_id')->index()->nullable();
            $table->integer('quantidade');
            $table->float('valor_unidade');
            $table->float('frete');
            $table->float('valor_total');
            $table->timestamps();

            $table->foreign('entrada_id')->references('id')->on('entradas');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas_produtos');
    }
};
