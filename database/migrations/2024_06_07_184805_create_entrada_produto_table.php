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
        Schema::create('entrada_produto', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('motivo', ['compra', 'doacao', 'acerto_de_estoque']);
            $table->uuid('produto_id')->index();
            $table->uuid('compra_id')->index()->nullable();
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_produto');
    }
};
