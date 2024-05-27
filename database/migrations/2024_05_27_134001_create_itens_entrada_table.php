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
        Schema::create('itens_entrada', function (Blueprint $table) {
            $table->uuid('id_itensEntrada')->primary();
            $table->uuid('id_produto')->index();
            $table->uuid('id_entrada')->index();
            $table->string('lote');
            $table->integer('quantidade');
            $table->float('valor');
            $table->timestamps();

            $table->foreign('id_produto')->references('id_produto')->on('produtos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_entrada')->references('id_entrada')->on('entradas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_entrada');
    }
};
