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
            $table->uuid('id_itensSaida')->primary();
            $table->uuid('id_produto')->index();
            $table->uuid('id_saida')->index();
            $table->string('lote');
            $table->integer('quantidade');
            $table->float('valor');
            $table->timestamps();

            $table->foreign('id_produto')->references('id_produto')->on('produtos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_saida')->references('id_saida')->on('saidas')->onDelete('cascade')->onUpdate('cascade');

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
