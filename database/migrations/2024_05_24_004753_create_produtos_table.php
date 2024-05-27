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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('id_produto');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_fornecedor');
            $table->string('produto');
            $table->float('peso');
            $table->boolean('controlado');
            $table->integer('minimo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
            $table->foreign('id_fornecedor')->references('id_fornecedor')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
