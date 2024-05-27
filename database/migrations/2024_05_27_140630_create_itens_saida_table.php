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
        Schema::create('itens_saida', function (Blueprint $table) {
            $table->id('id_itensSaida');
            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_saida');
            $table->string('lote');
            $table->integer('quantidade');
            $table->float('valor');
            $table->timestamps();

            $table->foreign('id_produto')->references('id_produto')->on('produtos');
            $table->foreign('id_saida')->references('id_saida')->on('saidas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_saida');
    }
};
