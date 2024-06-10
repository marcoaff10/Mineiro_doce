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
        Schema::create('compra_produto', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('compra_id')->index();
            $table->uuid('produto_id');
            $table->float('preco_compra')->default(0);
            $table->integer('quantidade')->unsigned();
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
        Schema::dropIfExists('compra_produto');
    }
};
