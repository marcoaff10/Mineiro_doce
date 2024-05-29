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
            $table->uuid('id')->primary();
            $table->uuid('produto_id')->index();
            $table->uuid('entrada_id')->index();
            $table->string('lote');
            $table->integer('quantidade');
            $table->float('valor');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('entrada_id')->references('id')->on('entradas');


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
